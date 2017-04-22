<?php

use App\Models\Marketing\Faq;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class FaqTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('zh_CN');

        $catList = collect(Faq::getCatList())->keys()->toArray();
//        $catList = \App\Models\Faq::getCatList();

        foreach (range(1, 30) as $index) {
            $titleString = '';
            foreach (range(1, 5) as $index2) {
                $titleString .= $faker->name();
            }

            $bodyString = '';
            foreach (range(1, 70) as $index2) {
                $bodyString .= $faker->name();
            }

            Faq::create([
                'title' => $titleString,
                'body' => $bodyString,
                'category' => $faker->randomElement($catList),
                'active' => $faker->randomElement([true, false])
            ]);
        }
    }
}
