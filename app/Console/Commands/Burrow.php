<?php namespace DreamFactory\Laravel\Grubworm\Console\Commands;

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
     * @type string Default output path of this command relative to app path
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
     * Handle the command
     *
     * @return mixed
     */
    public function fire()
    {
        $this->_output = $this->getOutput();
        $this->_verbosity = $this->_output->getVerbosity();

        $this->_intro();

        if ( null === ( $_path = $this->option( 'output-path' ) ) )
        {
            $_path = app_path() . DIRECTORY_SEPARATOR . ltrim( static::DEFAULT_OUTPUT_PATH, DIRECTORY_SEPARATOR );
        }

        $_database = $this->argument( 'database' );
        empty( $_database ) && $this->_v( '* using <info>default</info> database' );

        try
        {
            $_db = \DB::connection( $_database );
        }
        catch ( \Exception $_ex )
        {
            throw new \InvalidArgumentException( 'The database "' . ( $_database ?: 'default' ) . '" is invalid.' );
        }

        $_database = $_database ?: \DB::getDatabaseName();
        $this->_v( '* connected to database <info>' . $_database . '</info>.' );

        $_tablesWanted = $this->option( 'tables' );

        if ( !empty( $_tablesWanted ) )
        {
            $_list = explode( ',', $_tablesWanted );
            $_tablesWanted = empty( $_list ) ? false : $_tablesWanted = $_list;
        }

        !empty( $_tablesWanted ) &&
        $this->_vv( '* there are ' . count( $_tablesWanted ) . ' table(s) to be scanned.' ) ||
        $this->_vv( '* all tables will be scanned.' );

        $_sm = $_db->getDoctrineConnection()->getSchemaManager();
        $_tableNames = $_sm->listTableNames();

        $this->_writeln( '* examining ' . count( $_tableNames ) . ' table(s)...' );

        foreach ( $_tableNames as $_tableName )
        {
            if ( $_tablesWanted && !in_array( $_tableName, $_tablesWanted ) )
            {
                $this->_vvv( '  * SKIP table <comment>' . $_tableName . '</comment>.' );
                continue;
            }

            $this->_vv( '  * SCAN table <info>' . $_tableName . '</info>.' );
        }
    }

    /** @inheritdoc */
    protected function getOptions()
    {
        $_options = [
            ['tables', 't', InputOption::VALUE_OPTIONAL, 'Comma-separated list of table names to examine instead of all tables'],
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

}
