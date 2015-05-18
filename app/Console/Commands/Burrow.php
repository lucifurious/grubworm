<?php namespace DreamFactory\Laravel\Grubworm\Console\Commands;

use Doctrine\DBAL\Schema\Table;
use DreamFactory\Library\Utility\FileSystem;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Burrows into a database to discover all the goodies within
 */
class Burrow extends Command
{
    //******************************************************************************
    //* Constants
    //******************************************************************************

    /**
     * @type string
     */
    const VERSION = 'v1.0.x-dev';
    /**
     * @type string
     */
    const VERSION_DATE = '2015-05-17';
    /**
     * @type string Default output path of this command relative to base path
     */
    const DEFAULT_OUTPUT_PATH = 'database/grubworm';

    //******************************************************************************
    //* Members
    //******************************************************************************

    /** @var string The console command name */
    protected $name = 'grubworm:burrow';
    /**  @var string The console command description */
    protected $description = 'Burrow into a database and discover all its goodies';
    /**
     * @type int
     */
    protected $_verbosity;
    /**
     * @type OutputInterface
     */
    protected $_output;
    /**
     * @type string Destination path of output. Defaults to app/database/grubworm/
     */
    protected $_destination;
    /**
     * @type string The database name to target
     */
    protected $_database;

    //******************************************************************************
    //* Methods
    //******************************************************************************

    /**
     * Echo's the intro header
     */
    protected function _intro()
    {
        $_version = static::VERSION . ' (' . static::VERSION_DATE . ')';
        ( ( $_year = date( 'Y' ) ) > 2015 ) && $_year = '2015-' . $_year;

        $_intro = <<<TEXT
DreamFactory Grubworm {$_version}
Copyright (C) {$_year} DreamFactory Software, Inc.  All rights reserved.
This software comes with NO WARRANTY: see the file .dreamfactory.php for details.

TEXT;

        $this->_writeln( $_intro );
    }

    /**
     * @return bool
     */
    protected function _initialize()
    {
        $this->_output = $this->getOutput();
        $this->_verbosity = $this->_output->getVerbosity();

        $this->_intro();

        if ( null === ( $_path = $this->option( 'output-path' ) ) )
        {
            $_path = static::DEFAULT_OUTPUT_PATH;
        }

        $_path = rtrim( base_path() . DIRECTORY_SEPARATOR . ltrim( $_path, DIRECTORY_SEPARATOR ), DIRECTORY_SEPARATOR );

        if ( !FileSystem::ensurePath( $_path ) )
        {
            $this->_writeln( '<error>error</error>: cannot write to output path <comment>' . $_path . '</comment>.' );

            return false;
        }

        $this->_destination = $_path;
        $this->_vv( '* output path set to <comment>' . $this->_destination . '</comment>' );

        $_database = $this->argument( 'database' );
        $this->_database = $_database ?: 'default';

        empty( $_database ) && $this->_v( '* using <info>default</info> database' );

        return true;
    }

    /**
     * Handle the command
     *
     * @return mixed
     */
    public function fire()
    {
        if ( !$this->_initialize() )
        {
            return false;
        }

        try
        {
            $_db = \DB::connection( $this->_database );
        }
        catch ( \Exception $_ex )
        {
            throw new \InvalidArgumentException( 'The database "' . $this->_database . '" is invalid.' );
        }

        $_database = $this->_database;
        $this->_v( '* connected to database <info>' . $_database . '</info>.' );

        $_tablesWanted = $this->option( 'tables' );

        if ( !empty( $_tablesWanted ) )
        {
            $_list = explode( ',', $_tablesWanted );
            $_tablesWanted = empty( $_list ) ? false : $_tablesWanted = $_list;
            $this->_vv( '* ' . count( $_tablesWanted ) . ' table(s) will be scanned.' );
        }
        else
        {
            $this->_vv( '* all tables will be scanned.' );
        }

        $_sm = $_db->getDoctrineSchemaManager();
        $_tableNames = $_sm->listTableNames();

        $this->_writeln( '* examining ' . count( $_tableNames ) . ' table(s)...' );

        foreach ( $_tableNames as $_tableName )
        {
            if ( $_tablesWanted && !in_array( $_tableName, $_tablesWanted ) )
            {
                $this->_vvv( '  * SKIP table <comment>' . $_tableName . '</comment>.' );
                continue;
            }

            $this->_v( '  * SCAN table <info>' . $_tableName . '</info>.' );

            if ( $this->_examineTable( $_sm->listTableDetails( $_tableName ) ) )
            {
                $this->_writeln( '  * <info>' . $_tableName . '</info> complete.' );
            }
        }

        return true;
    }

    protected function _generateModel( Table $table )
    {
        $_props = [];
        $_name = $table->getName();
        $_modelName = $this->_getModelName( $_name );

        try
        {
            foreach ( $table->getColumns() as $_column )
            {
                $_type = $_column->getType()->getName();
                $_type = $_type == 'datetime' ? 'Carbon' : $_type;
                $_props[] = ' * @property ' . $_type . ' $' . $_column->getName();
            }

            $_payload = [
                'tableName' => $_name,
                'modelName' => $_modelName,
                'namespace' => $this->option( 'namespace' ) ?: 'App\Models',
                'props'     => $_props,
            ];

            $_filename = $this->_destination . DIRECTORY_SEPARATOR . $_modelName . '.php';
            $_props = implode( PHP_EOL, $_props );

            $_php = <<<TEXT
<?php namespace {$_payload['namespace']};

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
{$_props}
*/
class {$_payload['modelName']} extends Model
{
    //******************************************************************************
    //* Members
    //******************************************************************************

    protected \$table = '{$_payload['tableName']}';
}
TEXT;

            return file_put_contents( $_filename, $_php );
        }
        catch ( \Exception $_ex )
        {
            $this->_writeln( '  * error examining table "' . $_name . '": ' . $_ex->getMessage() );

            return false;
        }
    }

    /**
     * @param mixed $table
     *
     * @return bool|int
     */
    protected function _examineTable( Table $table )
    {
        try
        {
            return $this->_generateModel( $table );
        }
        catch ( \Exception $_ex )
        {
            $this->_writeln( '  * error examining table "' . $table->getName() . '": ' . $_ex->getMessage() );

            return false;
        }
    }

    /**
     * @param string $tableName
     *
     * @return string
     */
    protected function _getModelName( $tableName )
    {
        static $_abbreviations = ['_arch_' => '_archive_', '_asgn_' => '_assign_', '_t' => null, '_v' => null,];

        /**
         * Check each table name for abbreviation replacements
         */
        foreach ( $_abbreviations as $_suffix => $_replacement )
        {
            $_check =
                2 == strlen( $_suffix ) && '_' == $_suffix[0]
                    ? $_suffix == substr( $tableName, -2 )
                    : false !== strpos( $tableName, $_suffix );

            if ( $_check )
            {
                $tableName = str_replace( $_suffix, $_replacement, $tableName );
            }
        }

        return
            str_replace( ' ', null, ucwords( str_replace( '_', ' ', $tableName ) ) );
    }

    /**
     * @param string|array $messages The message as an array of lines of a single string
     * @param int          $type     The type of output (one of the OUTPUT constants)
     *
     * @throws \InvalidArgumentException When unknown output type is given
     */
    protected function _vvv( $messages, $type = OutputInterface::OUTPUT_NORMAL )
    {
        $this->_writeln( $messages, OutputInterface::VERBOSITY_DEBUG, $type );
    }

    /**
     * @param string|array $messages The message as an array of lines of a single string
     * @param int          $type     The type of output (one of the OUTPUT constants)
     *
     * @throws \InvalidArgumentException When unknown output type is given
     */
    protected function _vv( $messages, $type = OutputInterface::OUTPUT_NORMAL )
    {
        $this->_writeln( $messages, OutputInterface::VERBOSITY_VERY_VERBOSE, $type );
    }

    /**
     * @param string|array $messages The message as an array of lines of a single string
     * @param int          $type     The type of output (one of the OUTPUT constants)
     *
     * @throws \InvalidArgumentException When unknown output type is given
     */
    protected function _v( $messages, $type = OutputInterface::OUTPUT_NORMAL )
    {
        $this->_writeln( $messages, OutputInterface::VERBOSITY_VERBOSE, $type );
    }

    /**
     * @param string|array $messages
     * @param int          $level
     * @param int          $type
     */
    protected function _writeln( $messages, $level = OutputInterface::VERBOSITY_NORMAL, $type = OutputInterface::OUTPUT_NORMAL )
    {
        if ( $level <= $this->_verbosity )
        {
            $this->_output->writeln( $messages, $type );
        }
    }

    /** @inheritdoc */
    protected function getOptions()
    {
        $_options = [
            ['tables', 't', InputOption::VALUE_OPTIONAL, 'Comma-separated list of table names to examine instead of all tables'],
            ['output-path', 'o', InputOption::VALUE_OPTIONAL, 'The path to write output, relative to <comment>' . base_path() . '</comment>.'],
            ['namespace', 's', InputOption::VALUE_OPTIONAL, 'The namespace of the created classes.', 'App\\Models'],
        ];

        return array_merge( parent::getOptions(), $_options );
    }

    /** @inheritdoc */
    protected function getArguments()
    {
        $_arguments = [
            ['database', InputArgument::OPTIONAL, 'The name of the database in "database.php" to use.'],
        ];

        return array_merge( parent::getArguments(), $_arguments );
    }

}
