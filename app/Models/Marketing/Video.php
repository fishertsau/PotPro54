<?php

namespace App\Models\Marketing;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $guarded = [];


    public function scopeStatus($query, $status_flag)
    {
        if (is_bool($status_flag)) {
            return $query->where('active', $status_flag);
        }

        return null;
    }

    /**
     * @param $query
     * @param null $keyword
     * @return mixed
     */
    public function scopeKeyword($query, $keyword = null)
    {
        if (!empty($keyword)) {
            //add wildcard before and after keyword
            $keyword = '%' . $keyword . '%';

            return $query->where('title', 'like', $keyword);
        }
    }
}



//	public function user()
//	{
//		return $this->belongsTo('App\User');
//	}
//
//	public function tags()
//	{
//		return $this->morphToMany('App\Models\Tag','taggable')->withTimestamps();
//	}
//
//
//	public function scopePublished($query)
//	{
//		$query->where('active', true);
//	}
//
//
//	public function getActiveTextAttribute()
//	{
//		$text = ($this->active) ? "上架" : '<span style="color:red">下架</span>';
//
//		return $text;
//
//	}
//
//
//	public function getTagListAttribute()
//	{
//		//A collection should be transferred to an Array for the form model binding.
//		return $this->tags()->lists('id')->toArray();
//	}
