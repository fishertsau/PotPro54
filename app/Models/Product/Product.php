<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    protected $guarded = [];

    public function scopeStatus($query, $status_flag)
    {
        if (is_bool($status_flag)) {
            return $query->where('published', $status_flag);
        }

        return null;
    }

    public function scopeKeyword($query, $keyword = null)
    {
        if (!empty($keyword)) {
            //add wildcard before and after keyword
            $keyword = '%' . $keyword . '%';

            return $query->where('title', 'like', $keyword);
        }
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function getAddOnableAttribute()
    {
        return !!$this->group->addonable;
    }
}



//use Sluggable;
//use SluggableScopeHelpers;
//
///**
// * Return the sluggable configuration array for this model.
// *
// * @return array
// */
//public function sluggable()
//{
//    return [
//        'slug' => [
//            'source' => 'title',
//            'method' => function ($string, $separator) {
//                //if the input string is in Chinese characters, return the original string
//                $slug = (mb_strlen($string, "Big5") == strlen($string)) ?
//                    $slug = strtolower(preg_replace('/[^A-Za-z0-9]+/i', $separator, $string)) :
//                    $string;
//
//                return $slug;
//            }
//        ]
//    ];
//}
//
//private $PNFormat = "%s-%s";
//
//static private $specList = [
//    'length' => ['長度', '公分'], //長度
//    'width' => ['寬度', '公分'], //寬度
//    'height' => ['高度', '公分'],  //高度
//    'diameter' => ['直徑', '公分'], //直徑
//    'depth' => ['深度', '公分'], //深度
//    'capacity' => ['容量', '公升'], //容量公升
//];
//
//
//    protected $casts = [
//    'active' => 'boolean',
//];
//
//
//    public static function boot()
//{
//    parent::boot();
//
////        static::creating(
////            function ($product) {
////                $serial = $product->generatePN();
////                $group = $product->group->title;
////                $product->pn = sprintf(
////                    $product->PNFormat, $group, $serial);
////            });
//}


//public function scopeFetchList($query, $byPagination = true, $perPage = null)
//    {
//
//        if ($byPagination) {
//            return $query->paginate($perPage);
//        }
//
//        return $query->get();
//    }


//    protected function generatePN()
//    {
//        //get the lastest Product in the same group series
//        $latestProduct =
//            Product::where('pn', 'like', $this->group->title . '%')
//                ->orderBy('id', 'desc')
//                ->first();
//
//        if ($latestProduct == null) {
//            return '0001';
//        }
//
//        $lastSerial = hexdec(substr($latestProduct->pn, -4));
//
//        $newSerial = dechex($lastSerial + 1);
//
//        //在字串前面加上'0'
//        switch (strlen($newSerial)) {
//            case 1:
//                return '000' . $newSerial;
//                break;
//            case 2:
//                return '00' . $newSerial;
//                break;
//            case 3:
//                return '0' . $newSerial;
//                break;
//            default:
//                return $newSerial;
//        }
//    }


///**
// * setup the relationship between Group and Product.
// */

//
///**
// * A product belongs to many users as users' favorite products.
// * many to many relationship
// */
//public function users()
//{
//    return $this->belongsToMany('App\User', 'user_favorite_products', 'product_id', 'user_id');
//}
//
//
//public function getActiveTextAttribute()
//{
//    return showStatus($this->active);
//}
//
//
//public function getSpecAttribute()
//{
//    $specString = '';
//    $specList = collect(self::$specList);
//
//    $index_chineseName = 0;
//    $index_unit = 1;
//
//    foreach ($specList as $specName => $spec) {
//        if ($this->isSpecLegal($specName)) {
//            $specString .=
//                sprintf('%s:%s%s ',
//                    $spec[$index_chineseName], $this->$specName, $spec[$index_unit]);
//        }
//    }
//
//    return $specString;
//}
//
//protected function isSpecLegal($specName)
//{
//    if ($this->$specName == '') {
//        return false;
//    }
//
//    if ($this->$specName == 0) {
//        return false;
//    }
//
//    return true;
//}
//
//

//
//
//public function scopeKeywordByWithJoin($query, $keyword_by, $keyword)
//{
//    //add wildcard before and after keyword
//    $keyword = '%' . $keyword . '%';
//
//    if ($keyword_by == 'product_name') {
//        return $query->where('products.title', 'like', $keyword);
//    }
//
//    if ($keyword_by == 'product_pn') {
//        return $query->where('products.pn', 'like', $keyword);
//    }
//}
//