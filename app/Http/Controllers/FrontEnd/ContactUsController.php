<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Mailer\CompanyMailer;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SystemConfigController;
use Mail;

class ContactUsController extends Controller
{
    public function showContactForm()
    {
        return view('frontEnd.customerServices.contactUsForm');
    }


    public function sendContactMessage(Request $request)
    {
//        Mail::queue(new ContactUsMail($request->input()));

        //        $mailer->contactUsNotice($request);
//
        flash()->overlay('感謝您!我們會盡快與您聯絡.', '訊息已寄出...');

        return redirect('/');
    }
}
