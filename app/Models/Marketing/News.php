<?php

namespace App\Models\Marketing;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;


/**
 * @property mixed location
 */
class News extends Model
{
    use Sluggable;
    use SluggableScopeHelpers;

    protected $table = 'newss';

    protected static $locationList = [
        'n' => '最新消息',
        'm' => '首頁廣告',
        'p' => '關於鍋教授'
    ];


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

    protected $fillable = [
        'title',
        'body',
        'active',
        'hot',
        'location',
        'coverPhoto_path',
        'effective_from',
        'effective_until',
        'effective_forever',
    ];

    protected $casts = [
        'active' => 'boolean',
        'effective_forever' => 'boolean',
        'hot' => 'boolean',
    ];

    protected $dates = ['published_at', 'effective_from', 'effective_until'];
//    protected $dateFormat = 'U';

    /***
     * Setup the relationship between News and User.
     * @retrun App\User;
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }


//    /**
//     * get all the tags ID associated with this articles.
//     * @retrun array
//     */
//    public function getTagListAttribute()
//    {
//        //A collection should be transferred to an Array for the form model binding.
//        return $this->tags()->lists('id')->toArray();
//    }

    /**
     * get text of the active status
     * */
    public function getActiveTextAttribute()
    {
        return showStatus($this->active);
    }

    /**
     * get text of the active status
     * */
    public function getHotTextAttribute()
    {
        if ($this->hot) {
            return "/<br/><span class='text-danger'>熱門消息</span>";
        }
    }

    public function getCreatedAtAttribute($date)
    {
        return $this->convertDateString($date);
    }

    public function getUpdatedAtAttribute($date)
    {
        return $this->convertDateString($date);
    }

    public function getEffectiveFromAttribute($date)
    {
        return $this->convertDateString($date);
    }


    public function getEffectiveUntilAttribute($date)
    {
        return $this->convertDateString($date);
    }

    /**
     * get the effective status or duration
     * */
    public function getEffectiveDateAttribute()
    {
        if ($this->effective_forever) {
            return '永遠上架';
        }

        $startFrom = $this->convertDateString($this->effective_from);
        $endUntil = $this->convertDateString($this->effective_until);

        return ($startFrom . '<br/>-' . $endUntil);
    }

    /**
     * get text of the location status
     * */
    public function getLocationTextAttribute()
    {
        if (collect(self::$locationList)->has($this->location)) {
            return self::$locationList[$this->location];
        }

        return '尚未定義';
    }

    /**
     * conver the input date string to the designated format
     * @return string
     * */
    private function convertDateString($date)
    {
        return Carbon::parse($date)->format('Y-m-d');
    }

    /**
     * Scope a query to only include news that are allowed to show to public.
     *      Condition:  (active=true) and ( (effective_forever) or (validDate))
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished($query)
    {
        return $query->
        where('active', true)->
        where(function ($query) {
            $query->where('effective_forever', true)
                ->orWhere(function ($query) {
                    $query->validDate();
                });
        });
    }


    /**
     * Scope a query to only include popular users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAboutUs($query)
    {
        return $query->where('location', '=', 'p');
    }

    /**
     * Scope a query to only include popular users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNewsItem($query)
    {
        return $query->where('location', '=', 'n');
    }


    public function scopeValidDate($query)
    {
        $today = getToday();

        return $query->
        where('effective_from', '<=', $today)->
        where('effective_until', '>=', $today);
    }


    /** Find the articles which should be displayed between the designated time period
     * @param $query
     * @param $begin_since
     * @param $end_until
     */
    public function scopeEffectiveBetween($query, $begin_since, $end_until)
    {
        if ($begin_since == '%') {
            return;
        }


        /***有以下情況,表示在指定區間內,有上架 ***/
        /** (1)永遠上架
         * (2)上架開始日在指定區間內,
         * (3)上架結束日在指定區間內,
         * (4)指定區間 在上架開始日 以及上架結束日之間***/
        return $query->
        where('effective_forever', true)
            ->orWhere(function ($query) use ($begin_since, $end_until) {
                $query
                    ->where('effective_from', '>=', $begin_since)
                    ->where('effective_from', '<=', $end_until);
            })
            ->orWhere(function ($query) use ($begin_since, $end_until) {
                $query
                    ->where('effective_until', '>=', $begin_since)
                    ->where('effective_until', '<=', $end_until);
            })
            ->orWhere(function ($query) use ($begin_since, $end_until) {
                $query
                    ->where('effective_from', '<=', $begin_since)
                    ->where('effective_until', '>=', $end_until);
            });
    }


    /**
     * Scope a query to only include popular users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeHotNews($query)
    {
        return $query->
        where('hot', true)->
        recentNews();
    }

    /**
     * Scope a query to only include popular users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRecentNews($query)
    {
        return $query->
        NewsItem()->
        published();
    }


    /**
     * Scope a query to only include popular users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMainPage($query)
    {
        return $query->where('location', '=', 'm');
    }


    /**
     *  get the Category for News
     * @return array
     */
    public static function getLocationList()
    {
        return self::$locationList;
    }


    public function scopeStatus($query, $status_flag)
    {
        return $query->where('active', 'like', $status_flag);
    }


    public function scopeLocation($query, $location)
    {
        return $query->where('location', 'like', $location);
    }


    public function scopeKeyword($query, $keyword)
    {
        //add wildcard before and after keyword
        $keyword = '%' . $keyword . '%';

        return $query->where('title', 'like', $keyword);
    }
}
