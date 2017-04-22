<?php namespace App\Http\Controllers\Admin;

use View;
use Lang;
use Session;
use App\User;
use Redirect;
use App\Traits\Queryable;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\RoleController;


class UserController extends Controller
{
    use Queryable;

    public function __construct()
    {
        $this->authorize('user-management');


        /*** 查詢條件名稱***/
        self::$queryTermName = 'userQueryTerm';

        /** 查詢條件**/
        self::$queryTermList = [
            'active' => '',
            'keyword_by' => '',
            'keyword' => ''
        ];

        if (!Session::has(self::$queryTermName)) {
            $this->setDefaultQueryTerm();
        }
    }

    /**
     * @param Request $request
     * @return \BladeView|bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function makeUserList(Request $request)
    {
        if ($request->has('newSearch')) {
            updateQueryTerm($request, collect(self::$queryTermList)->keys(), self::$queryTermName);
        }

        $users = $this->makeUserQuery(
            makeQueryForSearch(Session::get(self::$queryTermName),
                collect(self::$queryTermList)->keys()));

        return view('admin.user._userList', compact('users'));
    }

    /**
     * @param Request $request
     * @return \BladeView|bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function makeUserListSimple(Request $request)
    {
        if ($request->has('newSearch')) {
            updateQueryTerm($request, collect(self::$queryTermList)->keys(), self::$queryTermName);
        }

        $users = $this->makeUserQuerySimple(
            makeQueryForSearch(Session::get(self::$queryTermName),
                collect(self::$queryTermList)->keys()));

        return view('admin.user._userListSimple', compact('users'));
    }

    protected function makeUserQuery($queryTermForSearch = [])
    {
        $users = User::latest('id')->

        //關鍵字查詢
        keywordBy($queryTermForSearch['keyword_by'], $queryTermForSearch['keyword'])->

        //正常或停用
        active($queryTermForSearch['active'])->

        paginate(10);

        return $users;
    }

    protected function makeUserQuerySimple($queryTermForSearch = [])
    {
        $users = User::latest('id')->

        //關鍵字查詢
        keywordBy($queryTermForSearch['keyword_by'], $queryTermForSearch['keyword'])->

        paginate(10);

        return $users;
    }

    /**
     * Show a list of all the user.
     *
     * @return View
     */
    public function index()
    {
        $queryTerm =
            makeQueryForSearch(Session::get(self::$queryTermName),
                collect(self::$queryTermList)->keys());

        return View('admin.user.index', compact('queryTerm'));
    }

    /**
     * User update.
     *
     * @param  int $id
     * @return View
     */
    public function edit(User $user)
    {
        if (auth()->user()->cannot('edit-user')) {
            flash()->overlay('您沒有修改使用者資料的權限!');
            return redirect('admin/user');
        }

        $userOwnedRoleIds = $user->roles()->lists('id');

        return View('admin.user.edit', compact('user', 'userOwnedRoleIds'));
    }

    /**
     * User update form processing page.
     *
     * @param  User $user
     * @param UserRequest $request
     * @return Redirect
     */
    public function update(UserRequest $request, User $user)
    {
        $authorized = $this->authorizeIfSuperAdminIsSet($request->get('role_list'));

        if (!$authorized) {
            flash()->overlay('設定失敗!您沒有設定超級管理員的權限!');
            return redirect('admin/user');
        }

        if ($user->update($request->all())) {
            RoleController::syncUserRole($request->input('role_list'), $user);

            flash()->success('使用者資料/權限已修改完成!');
            return Redirect('admin/user');
        } else {
            return Redirect::route('update/user', $user->id)->with('error', Lang::get('user/message.error.update'));
        }
    }

    protected function authorizeIfSuperAdminIsSet($roleList = [])
    {
        //superAdmin has id = 9
        if (collect($roleList)->contains(9)) {
            return auth()->user()->isSuperAdmin();
        }

        return true;
    }

    /**
     * User update form processing page.
     *
     * @param  User $user
     * @param UserRequest $request
     * @return Redirect
     */
    public function updatePersonalInfo(Request $request, User $user)
    {
        if (!auth()->user()->id == $user->id) {
            flash()->overlay('您沒有修改此資料的權限!');
            return redirect('admin');
        }

        $user->update($request->all());

        flash()->success('您的資料已經修改!');

        return redirect('admin/user/profile/' . $user->id);
    }

    /**
     * Show a list of all the deleted user.
     *
     * @return View
     */
    public function getDeletedUsers()
    {

    }


    /**
     * Delete Confirm
     *
     * @param   int $id
     * @return  View
     */
    public function getModalDelete($id = null)
    {
    }

    /**
     * Delete the given user.
     *
     * @param  int $id
     * @return Redirect
     */
    public function destroy($id = null)
    {

    }

    /**
     * Restore a deleted user.
     *
     * @param  int $id
     * @return Redirect
     */
    public function getRestore($id = null)
    {

    }

    /**
     * Display specified user profile.
     *
     * @param  int $id
     * @return Response
     */
    public function show(Request $request, $id)
    {
        return '建置中...';
    }


    public function personalProfile(User $user)
    {
        if (!auth()->user()->id == $user->id) {
            flash()->overlay('您沒有查詢此筆資料的權限!');
            return redirect('admin');
        }

        return view('admin.user.personal.profile', compact('user'));
    }
}
