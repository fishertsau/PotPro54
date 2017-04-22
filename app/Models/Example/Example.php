<?php

namespace App\Models\Example;

use App\Models\Channel\Sales;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Example extends Model
{
    use Sluggable;
    use SluggableScopeHelpers;

    protected $fillable = [
        //開通 上下架與熱門控制
        'activated',
        'published',
        'hot',

        //基本資料
        'title',
        'body',
        'photo_path',
        'address',
        'tel',
        'main_product',

        'manager_id',
        'editor_id',

        //各項連結
        'fb_url',
        'web_url',
        'gplus_url',

        //使用狀況
        'use_result',
        'use_gear'
    ];


    protected $casts = [
        'activated' => 'boolean',
        'published' => 'boolean',
        'hot' => 'boolean'
    ];


    protected $appends = ['manager_name'];


    public function getManagerNameAttribute()
    {

        if ($this->hasManager()) {
            return $this->manager->name;
        }
        return '';
    }

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
                'method' => sameStringIfChinese()
            ]
        ];
    }

    /* An example could be edited by an editor.
      @retrun App\User;
    */
    public function editor()
    {
        return $this->belongsTo('App\User', 'editor_id');
    }


    /* An example could be managed by a sales.
      @retrun App\User;
    */
    public function manager()
    {
        return $this->belongsTo('App\Models\Channel\Sales', 'manager_id');
    }


    /*get all the tags associated with this model.
      @retrun illuminate\Database\Eloquent\Relations\morphToMany
    */
    public function photos()
    {
        return $this->morphMany('App\Models\Photo', 'imageable');
    }


    /**
     * One example can have many services.
     * */
    public function services()
    {
        return $this->hasMany('App\Models\Example\ExampleService');
    }

    /**
     * One example can have many products.
     * */
    public function products()
    {
        return $this->hasMany('App\Models\Example\ExampleProduct');
    }


    public function getProductListAttribute()
    {
        return ExampleProduct::where('example_id', $this->id)->orderBy('rank')->get();
    }

    public function getServiceListAttribute()
    {
        return ExampleService::where('example_id', $this->id)->orderBy('rank')->get();
    }


    public function getActivatedTextAttribute()
    {
        return showActivation($this->activated);
    }

    /**
     * get text of the active status
     * */
    public function getPublishedTextAttribute()
    {
        return showStatus($this->published);
    }

    public function getHotTextAttribute()
    {
        return showHot($this->hot);
    }


    public function scopePublished($query)
    {
        return $query->wherePublished(true);
    }

    public function scopeHotFirst($query)
    {
        return $query->orderBy('hot', 'desc');
    }

    public function scopeHot($query, $hot)
    {
        if ($hot == '%') {
            return;
        }

        return $query->whereHot($hot);
    }


    public function scopePublishedForAdmin($query, $published)
    {
        if ($published == '%') {
            return;
        }

        return $query->wherePublished($published);
    }


    public function scopeActivatedForAdmin($query, $activated)
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

        if ($keyword_by == 'example_title') {
            return $query->where('title', 'like', $keyword);
        }

        if ($keyword_by == 'manager_name') {
            return $query
                ->select('examples.*', 'sales.user_id','users.name')
                ->join('sales', 'examples.manager_id', '=', 'sales.id')
                ->join('users','sales.user_id','=','users.id')
                ->where('name', 'like', $keyword);
        }


        if ($keyword_by == 'editor_name') {
            return $query
                ->select('examples.*', 'users.name')
                ->join('users', 'examples.editor_id', '=', 'users.id')
                ->where('name', 'like', $keyword);
        }
    }


    public function scopeKeywordByTitle($query, $keyword)
    {
        //add wildcard before and after keyword
        $keyword = '%' . $keyword . '%';

        return $query->where('title', 'like', $keyword);
    }


    public function managedBy(Sales $sales)
    {
        return $this->manager_id == $sales->id;
    }



    public function hasManager()
    {
        return !! $this->manager()->count();
    }
}
