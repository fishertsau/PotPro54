<?php

namespace App\Models\Marketing;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\PhotoController;


class Talk extends Model {

	protected $fillable = [
		'title',
		'body',
		'active',
		'location',
		'held_on',
		'speaker_id',
		'coverPhoto_path',

		'organizer',  //主辦單位
		'organizer_url',
		'execute_org',  //執行單位
		'execute_org_url',
		'assist_org',  //協辦單位
		'assist_org_url'
	];

	protected $dates = ['held_on'];

	//protected $hidden = ['body'];

	/* setup the relationship between News and User.
	  @retrun App\User;
	*/
	public function user()
	{

		return $this->belongsTo('App\User');
	}


	/*get all the tags associated with this talk.
	  @retrun illuminate\Database\Eloquent\Relations\morphToMany
	*/
	public function tags()
	{
		return $this->morphToMany('App\Models\Tag', 'taggable')->withTimestamps();
	}


	/*get all the tags associated with this talk.
  @retrun illuminate\Database\Eloquent\Relations\morphToMany
*/
	public function photos()
	{
		return $this->morphMany('App\Models\Photo', 'imageable');
	}


	/*get all the tags ID associated with this articles.
	  @retrun array
	*/
	public function getTagListAttribute()
	{
		//A collection should be transferred to an Array for the form model binding.
		return $this->tags()->lists('id')->toArray();
	}


	/*get text of the active status
	 * */
	public function getActiveTextAttribute()
	{
		return showStatus($this->active);

	}

	public function getHeldOnAttribute($date)
	{
		return Carbon::parse($date)->format('Y-m-d');
	}


    public function scopeKeyword($query, $keyword)
    {
        //add wildcard before and after keyword
        $keyword = '%' . $keyword . '%';

        return $query->where('title', 'like', $keyword);
    }


    public function scopeStatus($query, $status_flag)
    {
        return $query->where('active', 'like', $status_flag);
    }


}
