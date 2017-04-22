<?php

use App\Models\Marketing\News;
use App\User;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;


class NewsTableSeeder extends Seeder
{

    protected $newsList;

    public function __construct()
    {
        $this->newsList = json_decode(Storage::get('newsList.json'));
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('zh_CN');

        $userList = User::pluck('id')->toArray();

//        $locationList = collect(\App\Models\News::getLocationList())->keys()->toArray();

        $today = Carbon::today();

        $startDateList = [
            $today->toDateString('y-m-d'),
            $today->subWeek(1)->toDateString('y-m-d'),
            $today->subWeek(2)->toDateString('y-m-d'),
            $today->subWeek(3)->toDateString('y-m-d')
        ];

        $endDateList = [
            $today->addWeek(1)->toDateString('y-m-d'),
            $today->addWeek(2)->toDateString('y-m-d'),
            $today->addWeek(3)->toDateString('y-m-d'),
            $today->addMonth(1)->toDateString('y-m-d'),
            $today->addMonth(2)->toDateString('y-m-d'),
            $today->addMonth(3)->toDateString('y-m-d')
        ];

        foreach ($this->newsList as $news) {
            News::create([
                'title' => $news->title,
                'body' => $news->body,
                'user_id' => $faker->randomElement($userList),
                'location' => $news->location,
                'coverPhoto_path' => $news->coverPhoto_path,
                'active' => $news->active,
                'hot' => $news->hot,
                'effective_forever' => $faker->randomElement([true, false]),
                'effective_from' => $faker->randomElement($startDateList),
                'effective_until' => $faker->randomElement($endDateList)
            ]);
        }
    }
}
