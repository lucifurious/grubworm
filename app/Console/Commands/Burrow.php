<?php namespace DreamFactory\Laravel\Grubworm\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * Burrows into a database to discover all the goodies within
 */
class Burrow extends Command
{
    //******************************************************************************
    //* Members
    //******************************************************************************

    /** @var string The console command name */
    protected $name = 'grubworm:burrow';
    /**  @var string The console command description */
    protected $description = 'Burrow into a database and discover all its goodies';

    //******************************************************************************
    //* Methods
    //******************************************************************************

    /**
     * Handle the command
     *
     * @return mixed
     */
    public function fire()
    {
        $_database = $this->argument( 'database' );

        empty( $_database ) && $this->output->writeln( 'grubworm: using default database' );

        try
        {
            $_db = \DB::connection( $_database );
        }
        catch ( \Exception $_ex )
        {
            throw new \InvalidArgumentException( 'The database "' . $_database ?: \DB::getDatabaseName() . '" is invalid.' );
        }

        $this->output->writeln( 'grubworm: connected to database <info>' . $_database ?: \DB::getDatabaseName() . '</info>.' );

        $_tablesWanted = $this->option( 'tables' );

        if ( !empty( $_tablesWanted ) )
        {
            $_list = explode( ',', $_tablesWanted );
            $_tablesWanted = empty( $_list ) ? false : $_tablesWanted = $_list;
        }

        $_sm = $_db->getDoctrineConnection()->getSchemaManager();
        $_dbTables = $_sm->listTableNames();
        $this->output->writeln( 'grubworm: found <info>' . count( $_dbTables ) . '</info> tables.' . print_r( $_dbTables, true ) );

        foreach ( $_dbTables as $_table )
        {
            if ( $_tablesWanted && !in_array( $_table, $_tablesWanted ) )
            {
                $this->output->writeln( '<info>* Would SKIP table <warning>' . $_table . '</warning>.</info>' );
                continue;
            }

            $this->output->writeln( '<success>* Would check table <warning>' . $_table . '</warning>.</success>' );
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
}
