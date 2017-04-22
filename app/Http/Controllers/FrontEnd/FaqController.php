<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Marketing\Faq;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::active()->hotFirst()->get();

        return view('frontEnd.customerServices.faqList',compact('faqs'));
    }
}
