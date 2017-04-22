<?php

namespace App\Models\Example;

use Illuminate\Database\Eloquent\Model;

class ExampleProduct extends Model
{
	protected $fillable = [

		//�򥻸��
		'title',
		'body',
		'rank',
		'coverPhoto_path',
		'price'
	];


	/**
	 * Get the example that owns the ExampleProduct.
	 */
	public function example()
	{
		return $this->belongsTo('App\Models\Example\Example');
	}
}
