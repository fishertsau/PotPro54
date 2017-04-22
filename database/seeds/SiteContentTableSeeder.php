<?php

use App\Models\Marketing\SiteContent;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class SiteContentTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('zh_CN');

        //關於我們
        $contentItems = collect(SiteContent::getContentListByMajorCategory('aboutUs'));

        //日常瓦斯節能
        $contentItems = $contentItems->merge(SiteContent::getContentListByMajorCategory('lifeGasSaving'));

        //瓦斯節能設計原則
        $contentItems = $contentItems->merge(SiteContent::getContentListByMajorCategory('gasSavingDesignPrinciple'));

        foreach ($contentItems as $title => $description) {
            $bodyString = '';
            foreach (range(1, 50) as $index2) {
                $bodyString .= $faker->name();
            }

            SiteContent::create([
                'title' => $title,
                'description' => $description,
                'body'=> $bodyString
                ]);
        }
    }
}
