<?php

namespace App\Console\Commands;

use DB;
use Illuminate\Console\Command;

class clearDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clearDb';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean Up the Database';

    protected $tables;

    protected $databaseName;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->tables = collect();

        try {
            $this->databaseName = DB::connection()->getDatabaseName();
        } catch (\Exception $e) {
            die("Could not connect to the database.  Please check your configuration.");
        }
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->comment('Clearing DB .... ');

        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        $this->getTables()
            ->truncateTables();

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    /**
     * @return clearDB
     */
    private function getTables()
    {
        $tables = collect(DB::select('show tables'));

        if ($tables->count() > 0) {
            $this->tables = $tables;
        }

        return $this;
    }

    /**
     * @param $tables
     */
    private function truncateTables()
    {
        $index = 0;

        $this->tables
            ->each(function ($table) use (&$index) {
                $index += 1;

                $tableName = $this->getTableName($table);

                $this->comment("Truncating Table {$index} {$tableName} ....");

                DB::table($tableName)->truncate();
            });
    }

    private function getTableName($table)
    {
        $tableKey = 'Tables_in_' . $this->databaseName;

        return $table->{$tableKey};
    }
}
