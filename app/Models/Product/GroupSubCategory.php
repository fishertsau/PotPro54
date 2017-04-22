<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class GroupSubCategory extends Model
{
    protected $fillable = [
        'title',
        'body',
        'active',
        'tag_no',
        'rank'
    ];


    /**
     * setup the relationship between SubCategory and Category.
     * @retrun App\User;
     */
    public function groupCategory()
    {
        return $this->belongsTo('App\Models\Product\GroupCategory');
    }



    /**
     * One subCategory can have many groups.
     * */
    public function groups()
    {
        return $this->hasMany('App\Models\Product\Group');
    }

}