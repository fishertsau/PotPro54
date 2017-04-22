<?php

namespace App\Http\Controllers\Auth;

use Storage;
use Session;
use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Authorization\Permission;
use App\Exceptions\PermissionNotFoundException;

class PermissionController extends Controller
{
    /*** 查詢條件名稱***/
    protected static $queryTermName = 'permissionQueryTerm';

    /** 查詢條件**/
    protected static $queryTermList = [
        'category' => ''];

    /**
     * Show a list of all the permission.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
    {

        //Only super admin is allowed to make this request
        //This should be implemented

        $this->authorize('edit-permission');

        updateQueryTerm($request, collect(self::$queryTermList)->keys(), self::$queryTermName);

        $queryTerm = makeQueryForSearch(Session::get(self::$queryTermName),
            collect(self::$queryTermList)->keys());

        $permissions =
            Permission::where('category', 'like', $queryTerm['category'])
                ->orderBy('category')->get();

        return View('admin/auth/permission/index', compact('permissions'));
    }


    public function create()
    {
        return View('admin/auth/permission/create');
    }


    public function store(Request $request)
    {
        if ($this->ifExist($request->input('name'))) {

            //show warning message
            return 'name is same as previous one';
        };

        Permission::create($request->all());

        return redirect('\admin\permission');
    }

    public function edit($id)
    {
        try {
            $permission = Permission::findOrFail($id);
        } catch (PermissionNotFoundException $e) {

        }

        $users = $permission->getUserListWithThePermission();

        return View('admin/auth/permission/edit', compact('permission', 'users'));
    }


    public function update(Request $request, $id)
    {
        $permission = Permission::findOrFail($id);

        $permission->update($request->all());

        flash()->success('您剛剛修改了使用權限!');

        return redirect('\admin\permission');
    }


    protected function ifExist($name)
    {
        return Permission::where('name', $name)->first();
    }


    public function getPermissions()
    {
        return Permission::with('roles')->get();
    }


    public function saveListToStorage()
    {
        $permissionList = Permission::all();

        $onePermissionFormat = '{"name":"%s","description":"%s","category":"%s"}';

        //make an array to designated-format JSON
        $result = '';
        $index = 0;
        foreach ($permissionList as $permission) {
            $permissionString = sprintf(
                $onePermissionFormat,
                $permission->name,
                $permission->description,
                $permission->category);

            $comma = ($index == 0) ? '' : ",";
            $result .= $comma . $permissionString;
            $index++;
        }
        $result = '[' . $result . ']';

        //persist Json
        Storage::put('permission.json', $result);

        return redirect()->back();
    }


    public function permissionOwnedByUser(User $user)
    {
        $permissionList = collect();
        foreach ($user->roles as $role) {
            $permissionList->push($role->permissions);
        }

        //把有重複的項目拿掉  只剩下唯一的項目
        $dintinctPermissionList = collect();
        foreach ($permissionList->flatten() as $permission) {
            if (!$permissionList->has($permission->id)) {
                $dintinctPermissionList->push($permission);
            }
        }

        return $dintinctPermissionList;
    }


    /**
     * Delete confirmation for the given Video.
     *
     * @param  int $id
     * @return View
     */
    public function getModalDelete($id = null)
    {
        $error = '';
        $model = '';
        $confirm_route = route('admin.permission.delete', ['id' => $id]);
        return View('admin/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
    }

    /**
     * Delete the given Video.
     *
     * @param  int $id
     * @return Redirect
     */
    public function getDelete($id = null)
    {
        $permission = Permission::destroy($id);

        // Redirect to the news management page
        return redirect('admin/permission');

    }


    public function indexByCat()
    {
        $permissionList = Permission::getPermissionList();

        // Show the page
        return View('admin/auth/permission/indexByCat', compact('permissionList'));
    }


    /**
     * persist the model entry's associated data into the database.
     * @param array $tag_list
     * @param $model
     * @return bool
     * @internal param $request
     */
    public static function syncRolePermission($permission_list = [], $role)
    {
        $role->permissions()->sync($permission_list);

        return true;
    }

}
