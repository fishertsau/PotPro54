<?php

namespace App\Models\Authorization;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'name',
        'description',
        'category'
    ];

    protected static $catList = [
        's' => '訂單管理',
        'l' => '通路管理',
        'm' => '行銷規劃',
        'a' => '一般行政',
        'd' => '產品管理',
        'c' => '財務會計',
        'p' => '生產管理',
        'h' => '人資管理',
        'y' => '系統管理',
        'o' => '營運管理'
    ];


    public function roles()
    {
        return $this->belongsToMany(Role::class);
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
     * Get the PermissionList which is applied in selection in product editing
     * @return array
     */
    public static function getPermissionList()
    {
        $permissionListArray = [];

        $permissionCategories = collect(self::getCatList());

        foreach ($permissionCategories as $index => $category) {

            //get all permission associated with that category
            $byCategoryPermissions = \App\Models\Authorization\Permission::where('category', $index)->get();

            //build up the array for the category permissions
            $byCategoryPermissionArray = [];
            foreach ($byCategoryPermissions as $permission) {
                $byCategoryPermissionArray += [$permission->id => $permission->description];
            }

            //push the by-category permission in the total permission array
            $permissionListArray += [$category => $byCategoryPermissionArray];
        }
        return $permissionListArray;
    }




    public static function generatePermissionListWithCat()
    {
        $catList = collect(Permission::getCatList());

        $permissionList = [];
        foreach ($catList as $key => $description) {
            $permissions = collect(Permission::where('category', $key)->get());
            $permissionList[$description] = $permissions;
        }

        return collect($permissionList);
    }


    public function getUserListWithThePermission()
    {
        //get role Ids with the permission
        $roleIdListWithPermission = $this->roles()->lists('id');

        //get user Ids with the roles
        $userIds = RoleUser::whereIn('role_id', $roleIdListWithPermission)->select('user_id')->distinct()->get();

        return User::whereIn('id', $userIds)->get();
    }
}
