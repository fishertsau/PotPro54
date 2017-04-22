<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LockScreenController extends Controller
{
    public function getLockScreen()
    {
        // only if user is logged in
        if (Auth::check()) {
            \Session::put('locked', true);

            $user = Auth::user();
            return view('admin.auth.lockscreen', compact('user'));
        }
        return redirect('/login');
    }


    public function postLockScreen(Request $request)
    {
        // if user in not logged in
        if (!\Auth::check())
            return redirect('/login');

        $password = $request->get('password');

        if (\Hash::check($password, \Auth::user()->password)) {
            \Session::forget('locked');
            return redirect('/admin');
        }

        //handle the password mismatch errors
        return redirect('admin/lockscreen');
    }
}