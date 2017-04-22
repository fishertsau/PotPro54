<?php

namespace App\Models\Channel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sales extends Model
{
    protected $fillable = [
        'activated',
        'discount_rate',
        'role'
    ];

    protected $casts = [
        'activated' => 'boolean'
    ];

    protected $appends = ['name','email','tel'];

    /**
     * To allow soft deletes
     */
    use SoftDeletes;

    protected $dates = ['deleted_at'];


    /**
     * Get all of the owning entityable models.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }


    //a sales can manage many example
    public function examples()
    {
        return $this->hasMany('App\Models\Example\Example');
    }


    public function scopeActivated($query, $activated)
    {
        if ($activated == '%') {
            return;
        }

        return $query->whereActivated($activated);
    }

    public function scopeKeywordBy($query, $keyword_by, $keyword)
    {

        //add wildcard before and after keyword
        $keyword = '%' . $keyword . '%';


        if ($keyword_by == 'user_name') {
            return $query->join('users', 'sales.user_id', '=', 'users.id')
                ->select('sales.*', 'users.name')
                ->where('name', 'like', $keyword);
        }

        if ($keyword_by == 'user_email') {
            return $query->join('users', 'sales.user_id', '=', 'users.id')
                ->select('sales.*', 'users.email')
                ->where('email', 'like', $keyword);
        }

    }

    public function getActivatedTextAttribute()
    {
        return showActivation($this->activated);
    }

    public function getNameAttribute()
    {
        return $this->user->name;
    }

    public function getEmailAttribute()
    {
        return $this->user->email;
    }


    public function getTelAttribute()
    {
        return $this->user->tel;
    }

    public function getAvatarAttribute()
    {
        return $this->user->avatar;
    }




    public static function hasUser($user_id)
    {
        return Sales::whereUserId($user_id)->exists();
    }
}
