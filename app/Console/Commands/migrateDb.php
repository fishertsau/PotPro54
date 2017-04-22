<?php

namespace App\Console\Commands;

use DB;
use Illuminate\Console\Command;

class migrateDb extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrateDb';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->comment("Migrating Db ...");
        $tables = DB::connection('mysqlOri')->select('show tables');

        $index = 0;

        collect($tables)->each(function ($table) use (&$index) {
            $index += 1;

            $tableName = $table->Tables_in_pot_master_ori;
            $this->comment("Moving Table {$index} {$tableName} ....");

//            $entities = collect(DB::connection('mysqlOri')->table($tableName)->select('*')->get());
//
//            if ($entities->count() > 0) {
////                $entities = $entities->toArray();
////                $this->comment(collect($entities[0])->toJson());
//                $this->comment($entities);
//            }
        });
    }
}
