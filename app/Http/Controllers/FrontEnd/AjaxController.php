<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AjaxController extends Controller
{
    protected static $functionMap = [
        'getSalesExample' =>
            'App\Http\Controllers\FrontEnd\Sales\SalesExampleController@getExampleAndView',
        'getSalesOrder' =>
            'App\Http\Controllers\FrontEnd\Sales\SalesOrderController@getOrderAndView',
        'cancelSalesOrder' =>
            'App\Http\Controllers\FrontEnd\Sales\SalesOrderController@cancelOrder'
    ];


    public function getHandler($command, $data)
    {
        $funs= $this->getMethod($command);
        return (new $funs[0])->$funs[1]($data);
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
