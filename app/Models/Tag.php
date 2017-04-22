<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
	/*
	 * The fillable fields in Tag table.
	 */
	protected $fillable = [
		'name'
	];


	/**
	 *	Get the news associated with the tag.
	 *	@return \Illuminate\Database\Elequent\Relations\morphedByMany
	 */
	public function newss(){
		return $this->morphedByMany('App\Models\News','taggable')->withTimestamps();
	}

	/**
	 *	Get the news associated with the tag.
	 *	@return \Illuminate\Database\Elequent\Relations\morphedByMany
	 */
	public function videos(){
		return $this->morphedByMany('App\Models\Video','taggable')->withTimestamps();
	}

	/**
	 *	Get the news associated with the tag.
	 *	@return \Illuminate\Database\Elequent\Relations\morphedByMany
	 */
	public function talks(){
		return $this->morphedByMany('App\Models\Talk','taggable')->withTimestamps();
	}
}
