<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'name' => 'Zeus',
            'email' => 'a@c.com',
            'password' => bcrypt('tttaaa'),
            'remember_token' => str_random(10)]);

        factory(App\User::class, 30)->create();
    }
}
