<?php

namespace App\Models\Example;

use Illuminate\Database\Eloquent\Model;

class ExampleService extends Model
{
	protected $fillable = [

		//�򥻸��
		'title',
		'body',
		'rank'
		];

	/**
	 * Get the example that owns the ExampleService.
	 */
	public function example()
	{
		return $this->belongsTo('App\Models\Example\Example');
	}
}
