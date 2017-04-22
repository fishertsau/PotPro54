<?php

use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    protected $tagList;

    /**
     * TagTableSeeder constructor.
     */
    public function __construct()
    {
        $this->tagList = [
            '節能鍋具',
            '節能設備',
            '家用產品',
            '商用節能'
        ];
    }


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->tagList as $tag) {
            \App\Models\Tag::create([
                'name' => $tag
            ]);
        }
    }
}
