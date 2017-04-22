<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class AddOnSelectedOption extends Model {

	protected $fillable = [
		//�򥻸��
		'no',
		'add_on_id',
		'add_on_option_id',
		'optionable',
        'rank',
		'note'
	];
}
