<?php namespace App\Http\Controllers\Admin;

use Gate;
use App\Http\Controllers\Controller;
use App\Repositories\OrderRepository;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{

    public function showDashboard(OrderRepository $orderRepository)
    {
        if (!auth()->check()) {
            return Redirect::to('admin/signin')->with('error', 'You must be logged in!');
        }

        //訂單審核
        if (Gate::allows('audit-order')) {
            $openOrderQty = $orderRepository->toBeAuditCount();
        }

        //出貨管理
        if (Gate::allows('shipment-management')) {
            $toBeShipOrderQty = $orderRepository->toBeShipCount();
        }

        return View('admin/index', compact('openOrderQty', 'toBeShipOrderQty'));
    }
}