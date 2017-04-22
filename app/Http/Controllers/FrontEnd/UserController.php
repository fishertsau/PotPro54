<?php

namespace App\Http\Controllers\FrontEnd;

use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Example\Example;
use Acme\Repositories\UserRepository;
use App\Http\Controllers\Admin\Example\ExampleController;

class UserController extends UserRepository
{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth.basic');
    }


    public function show()
    {
        $user = auth()->user();

        //get the Example belongs to the user.
        //確認信箱是否認證
        $example = Example::findOrFail(3);
        $example = null;

        return view('frontEnd.user.userAccount', compact('user', 'example'));
    }


    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'tel' => 'required'
        ]);

        $user->update($request->all());

        flash()->overlay('您的資料修改成功');

        return redirect('my-account');
    }
}
