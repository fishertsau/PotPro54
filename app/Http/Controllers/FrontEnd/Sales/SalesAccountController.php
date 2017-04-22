<?php

namespace App\Http\Controllers\FrontEnd\Sales;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SalesAccountController extends Controller
{
    protected $user;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth.basic');
        $this->middleware('activatedSales');
        $this->user = auth()->user();
    }


    public function index(SalesOrderController $salesOrderController)
    {
        $sales = $this->user->sales;

        $salesOrderQueryTerm = $salesOrderController->getQueryTerm();

        return view('frontEnd.sales.salesAccount',
            compact('sales','salesOrderQueryTerm'));
    }
}
