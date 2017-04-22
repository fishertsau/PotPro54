<?php

namespace App\Http\Controllers\FrontEnd;

//use App\Mailer\CompanyMailer;
use App\Http\Controllers\Controller;
use Auth;

class ResellerController extends Controller
{
    public function becomeReseller()
    {
        if (!Auth::check()) {
            flash()->overlay('請要先註冊成我們的會員,並登入後,即可申請加入經銷商');
            return redirect('register');
        }

        return view('frontEnd.channelMgnt.becomeReseller');
    }


    //todo: This part should be implemented again with the test case.
//    public function applyForReseller(CompanyMailer $mailer)
//    {
//        if (!UserRepository::validateUser()) {
//            flash()->overlay('請要先註冊成我們的會員,並登入後,即可申請加入經銷商');
//            return redirect('my-account');
//        }
//
//        $mailer->applyForReseller(UserRepository::getCurrentUser());
//
//        flash()->overlay('感謝您!您的申請已經寄出,我們將盡快與您聯絡!');
//        return redirect('my-account');
//    }
}
