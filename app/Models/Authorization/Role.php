<?php

namespace App\Models\Authorization;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Role extends Model {

    protected $fillable = [
        'name',
        'description',
        'category'
    ];

    protected static $catList = [
        's' => '系統管理者',
        'e' => '公司員工',
        'd' => '公司內部作業',
        'x' => '公司對外作業',
        'p' => '協力廠商',
        'c' => '行銷通路',
        'm' => '一般會員'
    ];


    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function givePermissionTo(Permission $permission)
    {
        return $this->permissions()->save($permission);
    }

    /**
     *  get the Category for Role
     * @return array
     */
    public static function getCatList()
    {
        return self::$catList;
    }

    /**
     * get text of the location status
     * */
    public function getCategoryTitleAttribute()
    {
        if (collect(self::$catList)->has($this->category)) {
            return self::$catList[$this->category];
        }
        return '尚未定義';
    }


    /**
     * get all the permissions ID associated with this role.
     * @retrun array
     */
    public function getPermissionListAttribute()
    {
        //A collection should be transferred to an Array for the form model binding.
        return $this->permissions()->lists('id')->toArray();
    }


    /**
     * Get the PermissionList which is applied in selection in product editing
     * @return array
     */
    public static function getRoleList()
    {
        $roleListArray = [];

        $roleCategories = collect(self::getCatList());

        foreach ($roleCategories as $index => $category) {

            //get all permission associated with that category
            $byCategoryRoles = \App\Models\Authorization\Role::where('category', $index)->get();

            //build up the array for the category permissions
            $byCategoryRoleArray = [];
            foreach ($byCategoryRoles as $role) {
                $byCategoryRoleArray += [$role->id => $role->name];
            }

            //push the by-category permission in the total permission array
            $roleListArray += [$category => $byCategoryRoleArray];
        }
        return $roleListArray;
    }
}