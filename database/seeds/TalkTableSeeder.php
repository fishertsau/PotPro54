<?php

use App\Models\Marketing\Talk;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TalkTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $userList = \App\User::pluck('id')->toArray();

        foreach (range(1, 30) as $index) {
            factory(Talk::class)->create([
                'title' => $faker->sentence(5),
                'body' => $faker->paragraph(4),
                'user_id' => $faker->randomElement($userList),
                'active' => $faker->randomElement([true, false])]);
        }
    }
}
