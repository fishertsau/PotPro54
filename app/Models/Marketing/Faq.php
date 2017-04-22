<?php

namespace App\Models\Marketing;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = [
        'title',
        'body',
        'category',
        'active',
        'hot'
    ];

    protected static $catList = [
        'n' => '購物問題',
        'p' => '商品問題',
        's' => '經銷問題',
        'm' => '其他問題'
    ];


    /*get text of the active status
     * */
    public
    function getActiveTextAttribute()
    {
        return showStatus($this->active);
    }


    /*get text of the category status
     * */
    public
    function getCategoryTextAttribute()
    {
        if ($this->category == '') return '尚未定義';

        return self::$catList[$this->category];
    }


    public function getHotTextAttribute()
    {
        if ($this->hot) {
            return '熱門';
        }
    }


    public static function getCatList()
    {
        return self::$catList;
    }


    public function scopeStatus($query, $status_flag)
    {
        return $query->where('active', 'like', $status_flag);
    }

    public function scopeHotFirst($query)
    {
        return $query->orderBy('hot','desc');
    }


    public function scopeActive($query)
    {
        return $query->whereActive(true);
    }


    public function scopeKeyword($query, $keyword)
    {
        //add wildcard before and after keyword
        $keyword = '%' . $keyword . '%';

        return $query->where('title', 'like', $keyword);
    }


    public function scopeCategory($query, $category)
    {
        return $query->where('category', 'like', $category);
    }


}
