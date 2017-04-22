<?php

use App\Models\Example\Example;
use App\User;
use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class ExampleTableSeeder extends Seeder
{
    protected $exampleList;

    public function __construct()
    {
        $this->exampleList = json_decode(Storage::get('example.json'));
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userList = User::pluck('id')->toArray();
        $faker = Faker::create('zh_CN');

        foreach ([1, 2, 3] as $index) {
            foreach ($this->exampleList as $example) {
                $bodyString = $this->makeBodyString($faker);
                factory(Example::class)->create([
                    'title' => $example->name,
                    'body' => $bodyString,
                    'activated' => $faker->randomElement([true, false]),
                    'published' => $faker->randomElement([true, false]),
                    'coverPhoto_path' => $example->imageUrl]);
            }
        }
    }

    protected function makeBodyString($faker)
    {
        $bodyString = '';
        foreach (range(1, 20) as $index2) {
            $bodyString .= $faker->name();
        };
        return $bodyString;
    }
}
