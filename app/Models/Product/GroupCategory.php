<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class GroupCategory extends Model
{
    protected $fillable = [
        'title',
        'body',
        'active',
        'tag_no',
        'rank'
    ];

    /**
     * One category can have many subCategorys.
     * */
    public function groupSubCategories()
    {
        return $this->hasMany('App\Models\Product\GroupSubCategory');
    }


    public static function getGroupCategoryList()
    {
        $list = ['0' => '-所有類別-']+ (GroupCategory::lists('title', 'id')->toArray());

        return $list;
    }
}
