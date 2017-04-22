<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ServiceSiteController extends Controller
{
    public function index()
    {
        return view('frontEnd.channelMgnt.serviceSiteList');
    }
}
