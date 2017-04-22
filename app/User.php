<?php

namespace App;

use App\Traits\SiteRoles;
use App\Models\Channel\Sales;
use App\Events\UserHasRegistered;
use Illuminate\Notifications\Notifiable;
use App\Events\User\UserEmailHasChanged;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Controllers\Auth\PermissionController;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property string verified_token
 */
class User extends Authenticatable
{
    use Notifiable;

    protected $guarded = [];

    protected $hidden = ['password', 'remember_token', 'verified_token'];


    use SiteRoles;


    protected $casts = [
        'verified' => 'boolean',
        'active' => 'boolean'
    ];

    public static $emailChanged = false;

    public function videos()
    {
        return $this->hasMany('App\Models\Marketing\Video');
    }
}


///**
// * One user can have many newss.
// * */
//public function newss()
//{
//    return $this->hasMany('App\Models\Marketing\News');
//}
//
//
///**
// * One user can have many videos.
// * */

//
//
///**
// * One user can have many orders.
// * */
//public function orders()
//{
//    return $this->hasMany('App\Models\Order\Order');
//}
//
///**
// * One user can have many videos.
// * */
//public function talks()
//{
//    return $this->hasMany('App\Models\Marketing\Talk');
//}
//
///**
// * One user can have many  examples.
// * */
//public function example()
//{
//    return $this->hasOne('App\Models\Example\Example');
//}
//
//
///**
// *Set up the relationship between user and products
// * A user can belongs to many products.
// * many to many relationship
// */
//public function favorite_products()
//{
//    return
//        $this
//            ->belongsToMany('App\Models\Product\Product', 'user_favorite_products', 'user_id', 'product_id')
//            ->withTimestamps();
//}
//
///**
// * Get all of the User who are sales.
// */
//public function sales()
//{
//    return $this->hasOne('App\Models\Channel\Sales');
//}
//
//
//public
//function owns($relatedEntry)
//{
//    return $this->id == $relatedEntry->user_id;
//}
//
//
///**
// * get all the permissions ID associated with this role.
// * @retrun array
// */
//public
//function getRoleListAttribute()
//{
//    //A collection should be transferred to an Array for the form model binding.
//    return $this->roles()->lists('id')->toArray();
//}
//
//
//public function getActiveTextAttribute()
//{
//    return ($this->active) ? '正常' : '停用';
//}
//
//public function getVerifiedTextAttribute()
//{
//    return ($this->verified) ? '郵件已認證' : '郵件未認證';
//}
//
//public
function isSuperAdmin()
{
    return true;

    //TODO: Implement this.

//    if (
//        ($this->email == 'fishertsau2live@gmail.com')
//        | ($this->email == 'admin@admin.com')
//        | ($this->hasRole('superAdmin'))
//    ) {
//        return true;
//    };
//
//    return null;
}


//
//public
//function ownsPermission()
//{
//    return (new PermissionController)->permissionOwnedByUser($this);
//}
//
//public
//function scopeActive($query, $active)
//{
//    return $query->where('active', 'like', $active);
//}
//
//public
//function scopeKeywordBy($query, $keyword_by, $keyword)
//{
//    //add wildcard before and after keyword
//    $keyword = '%' . $keyword . '%';
//
//    if ($keyword_by == 'name') {
//        return $query->where('name', 'like', $keyword);
//    }
//
//    if ($keyword_by == 'email') {
//        return $query->where('email', 'like', $keyword);
//    }
//}
//
//
//public function isAnActivatedSales()
//{
//    return
//        Sales::
//        where('user_id', $this->id)
//            ->where('activated', true)
//            ->exists();
//}
