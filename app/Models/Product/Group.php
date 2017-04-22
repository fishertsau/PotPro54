<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;


class Group extends Model
{
    use Sluggable;
    use SluggableScopeHelpers;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
                'method' => function ($string, $separator) {
                    //if the input string is in Chinese characters, return the original string
                    $slug = (mb_strlen($string, "Big5") == strlen($string)) ?
                        $slug = strtolower(preg_replace('/[^A-Za-z0-9]+/i', $separator, $string)) :
                        $string;

                    return $slug;
                }
            ]
        ];
    }

    protected $fillable = [
        'title',
        'description', //產品特色
        'active',

        'coverPhoto_path',
        'note', //說明
        'good_at', //適用料理        'group_sub_category_id',

        'add_on_allowed', //是否可以加工

        'group_sub_category_id', //系列產品中的子系列

        'auxiliary' //一般配件
    ];


    protected $casts = [
        'active' => 'boolean',
        'add_on_allowed'
    ];


    /**
     * setup the relationship between Group and SubCategory.
     * @retrun App\Category;
     */
    public function subCategory()
    {
        return $this->belongsTo('App\Models\Product\GroupSubCategory', 'group_sub_category_id');
    }


    /**
     * One Group can have many products.
     * */
    public function products()
    {
        return $this->hasMany('App\Models\Product\Product');
    }

    /**
     * One Group can belong to  many add_ons.
     * */
    public function add_ons()
    {
        return $this->belongsToMany('App\Models\Product\AddOn', 'group_add_ons', 'group_id', 'add_on_id')
            ->withTimestamps();
    }

    /**
     * get all the add_ons ID associated with this group.
     * @retrun array
     */
    public function getAddOnListAttribute()
    {
        //A collection should be transferred to an Array for the form model binding.
        return $this->add_ons()->lists('id')->toArray();
    }

    /**
     * get all the add_ons ID associated with this group.
     * @retrun array
     */
    public function getAddOnListStringAttribute()
    {
        if (!$this->add_on_allowed)
            return "無法加工";


        $addOnList = $this->getAddOnListAttribute();

        $temp = '';

        foreach ($addOnList as $addOnId) {
            $temp .=
                sprintf("<a href='/admin/product/addOn/%s/edit'><i class='fa fa-caret-right'></i> %s</a>&nbsp;&nbsp;"
                    , $addOnId, AddOn::findOrFail($addOnId)->title);
        }

        $addOnString = ($temp == '') ? "<sapn class='text-danger'>尚未設定加工配件</sapn>" : $temp;
        return $addOnString;
    }

    public function getActiveTextAttribute()
    {
        return showStatus($this->active);
    }


    /**
     * Get the GroupList which is applied in selection in product editing
     * @return array
     */
    public static function getGroupList()
    {
        $categories = GroupCategory::get();

        $subCategoryArray = [];
        foreach ($categories as $category) {

            $subCategories = GroupSubCategory::where('group_category_id', $category->id)->get();

            foreach ($subCategories as $subCategory) {

                $groups = Group::where('group_sub_category_id', $subCategory->id)->get();

                $groupArray = [];

                foreach ($groups as $group) {
                    $groupArray += [$group->id => $group->title];
                }

                $subCategoryArray += [$subCategory->title => $groupArray];
            }
        }
        return $subCategoryArray;
    }


    public function scopeStatusWithJoin($query, $status_flag)
    {
        return $query->where('groups.active', 'like', $status_flag);
    }


    public function scopeKeywordWithJoin($query, $keyword)
    {
        //add wildcard before and after keyword
        $keyword = '%' . $keyword . '%';

        return $query->where('groups.title', 'like', $keyword);
    }


    public function scopeJoinOnCategoryAndSubCategory($query, $category, $sub_category)
    {
        return $query->
        join('group_sub_categories', 'group_sub_categories.id', '=', 'groups.group_sub_category_id')
            ->join('group_categories', 'group_categories.id', '=', 'group_sub_categories.group_category_id')
            ->select('groups.*', 'group_sub_categories.group_category_id')
            ->where('group_category_id', 'like', $category)
            ->where('group_sub_category_id', 'like', $sub_category);
    }

}
