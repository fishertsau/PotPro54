<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class AddOn extends Model
{
    protected $guarded = [];
}


/**
 * One AddOn can belong to  many groups.
 * */
//public function groups()
//    {
//        return $this->belongsToMany(Group::class, 'group_add_ons', 'add_on_id', 'group_id')
//            ->withTimestamps();
//    }
//
///**
// * One AddOn can belong to  many AddOn Options.
// * */
//public function options()
//{
//    return $this->belongsToMany('App\Models\Product\AddOnOption', 'add_on_selected_options', 'add_on_id', 'add_on_option_id')
//        ->withPivot('no', 'id', 'optionable', 'note')
//        ->withTimestamps();
//}


///**
// * @return string
// */
//public function getOptionListAttribute()
//{
//    $temp = $this->options();
//
//    $str = '';
//
//    foreach ($temp as $oneEntry) {
//        $add_option = AddOnOption::findOrFail($oneEntry->add_on_option_id);
//        $str .= $oneEntry->no . ":" . $add_option->title;
//        $str .= "[" . $add_option->readable_settings . "], ";
//    }
//
//    return $str;
//}