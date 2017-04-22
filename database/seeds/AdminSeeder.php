<?php

use App\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{

    public function run()
    {
        factory(User::class)->create([
            'email' => 'admin@admin.com',
            'password' => bcrypt("admin"),
            'name' => 'Admin'
        ]);

        $this->command->info('Admin User created with username admin@admin.com and password admin');
    }
}