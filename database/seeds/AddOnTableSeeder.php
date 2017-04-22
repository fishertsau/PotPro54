<?php

use App\Models\Product\AddOn;
use Illuminate\Database\Seeder;

class AddOnTableSeeder extends Seeder
{

    protected $addOnList;

    public function __construct()
    {
        $this->addOnList = json_decode(Storage::get('addOnInfo.json'));
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->addOnList as $addOn) {


            $addOnInfo = [
                'title' => $addOn->title,
                'quantity_change_allowed' => $addOn->quantity_change_allowed
            ];


            factory(AddOn::class)->create($addOnInfo);
        }
    }
}
