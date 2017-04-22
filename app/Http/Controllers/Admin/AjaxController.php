<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AjaxController extends Controller
{
    protected static $functionMap = [
        'deleteExampleManager' =>
            'App\Http\Controllers\Admin\Example\ExampleController@deleteManager',
        'isUserASales' =>
            'App\Http\Controllers\Admin\Channel\SalesController@hasUser'
    ];


    public function changeLeftMenuVisibilitySetting(Request $request)
    {
        $request->session()->put('left_menu_show', $request->input('left_menu_show'));

        return session('left_menu_show');
    }


    public function getHandler($command, $data, Request $request)
    {
        $funs= $this->getMethod($command);
        return (new $funs[0])->$funs[1]($data,$request);
    }


    public function postHandler($command, $data, Request $request)
    {
        $funs= $this->getMethod($command);

        return (new $funs[0])->$funs[1]($data,$request);
    }


    protected function getMethod($command)
    {
        return explode('@',self::$functionMap[$command]);
    }
}
