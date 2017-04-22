<?php

use App\Models\Marketing\Video;
use App\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class VideoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $userList = User::pluck('id')->toArray();

//        foreach (range(1, 30) as $index) {
//            \App\Models\Video::create([
//                'title' => $faker->sentence(5),
//                'body' => $faker->paragraph(4),
//                'user_id' => $faker->randomElement($userList),
//                'active' => $faker->randomElement([true, false])]);
//        }


        Video::create([
            'title' => '湯蒸鍋介紹',
            'body' => '現在物價上漲，瓦斯越來越貴，但生活上又不能不使用瓦斯，媽媽們要如何精打細算才能節­省瓦斯費呢？讓我們繼續看下去。',
            'user_id' => $faker->randomElement($userList),
            'active' => '1',
            'youtube_url' => 'https://www.youtube.com/embed/Xdwx5elJO18'
        ]);

        Video::create([
            'title' => '草地狀元專訪',
            'body' => '想知道餐飲業的店家、老闆如何一個月省下將近一半的瓦斯嗎？那你就不能錯過這好康的消息！',
            'user_id' => $faker->randomElement($userList),
            'active' => '1',
            'youtube_url' => 'https://www.youtube.com/embed/9j-xaAJ045A'
        ]);
    }
}
