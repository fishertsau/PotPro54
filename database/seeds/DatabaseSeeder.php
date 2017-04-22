<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    private $tables = [

        'tags',

        'newss',

        'group_categories',
        'group_sub_categories',
        'groups',
        'products',

        'add_ons',
        'add_on_options',
        'users',
        'talks',
        'videos',
        'examples',
        'faqs',
        'site_content',
        'system_config',

        'permissions',
        'roles',
        'orders'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->cleanDatabase();
        $this->call(AdminSeeder::class);
        $this->call(UserTableSeeder::class);

        $this->call(TagTableSeeder::class);

        $this->call(SystemConfigTableSeeder::class);
        $this->call(TalkTableSeeder::class);
        $this->call(VideoTableSeeder::class);
        $this->call(FaqTableSeeder::class);
        $this->call(NewsTableSeeder::class);
        $this->call(ExampleTableSeeder::class);
//        $this->call(CategoryGroupProductTableSeeder::class);
        $this->call(AddOnTableSeeder::class);
        $this->call(AddOnOptionTableSeeder::class);
        $this->call(SiteContentTableSeeder::class);

        $this->call(PermissionTableSeeder::class);
        $this->call(RoleTableSeeder::class);

        Model::reguard();
    }

    private function cleanDatabase()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        foreach ($this->tables as $tableName) {
            DB::table($tableName)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

}
