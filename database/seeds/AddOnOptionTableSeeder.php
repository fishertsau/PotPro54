<?php

use App\Models\Product\AddOnOption;
use Illuminate\Database\Seeder;

class AddOnOptionTableSeeder extends Seeder {

	protected $addOnOptionList;

	public function __construct()
	{
		$this->addOnOptionList = json_decode(Storage::get('addOnOptionInfo.json'));
	}
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

		foreach ($this->addOnOptionList as $option) {

            $settingsString = (string)collect($option->settings)->toJson();

			$optionInfo = [
				'title' => $option->title,
                'setting_choices' => $settingsString,
				'quantity_change_allowed' => $option->quantity_change_allowed
			];

			factory(AddOnOption::class)->create($optionInfo);
		}
	}
}
