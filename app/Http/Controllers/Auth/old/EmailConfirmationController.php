<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Requests;
use App\Mailer\UserMailer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontEnd\UserController;

class EmailConfirmationController extends Controller
{

    protected $userMailer;

    public function __construct(UserMailer $userMailer)
    {
        $this->userMailer = $userMailer;
    }

    public function confirmEmail($token)
    {
        $user = UserController::findUserByAttribute('verified_token', $token);

        if (!$user instanceof User) {
            flash()->overlay('找不到您的資料,請輸入其他電子信箱!');
            return redirect()->back();
        }

        $user->confirmEmail();
        flash()->overlay('您的電子信箱已經認證完成!');
        return redirect('/');
    }


    public function showEmailConfirm(Request $request)
    {
        if ($request->ajax()) {
            $user = UserController::getCurrentUser();
            $user->generateVerifiedToken()->save();
            $this->userMailer->emailConfirmation($user);
            return 'success';
        }

        return view('auth.emailVerification');
    }


    public function
    sendEmailVerificationLinkEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);

        $user = UserController::findUserByAttribute('email', $request->input('email'));

        if (!$user instanceof User) {
            flash()->overlay('找不到您的資料,請輸入其他的電子信箱!');
            return redirect()->back();
        }

        if ($user->verified) {
            flash()->overlay('您的電子信箱已認證,無需再認證!');
            return redirect('/');
        }

        $user->generateVerifiedToken()->save();

        $this->userMailer->emailConfirmation($user);

        flash()->overlay('請收取您的電子郵件,並依照步驟認證您的電子信箱');

        return redirect()->route('home');
    }


    public function sendEmailConfirmation(User $user)
    {
        $user = $user ?: UserController::getCurrentUser();
        $user->verified = false;
        $user->generateVerifiedToken()->save();
        $this->userMailer->emailConfirmation($user);
    }
}
