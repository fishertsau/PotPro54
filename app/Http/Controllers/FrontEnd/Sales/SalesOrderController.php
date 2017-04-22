<?php

namespace App\Http\Controllers\FrontEnd\Sales;

use Carbon\Carbon;
use App\Http\Requests;
use App\Models\Order\Order;
use Illuminate\Http\Request;
use App\Repositories\OrderRepository;

/** This class is designed for  sales to take care of his own order
 *  Most of the time Sales are only allowed to see their own orders
 *  and make necessary change when needed
 */
class SalesOrderController extends OrderRepository
{
    protected $queryTermName = 'salesOrderQueryTerm';

    protected $user;

    /**
     * SalesOrderController constructor.
     * @param $user
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('activatedSales');
        $this->user = auth()->user();
        parent::__construct();
    }


    protected function putDefaultQueryTerm()
    {
        session()->put($this->queryTermName, [
            'status_flag' => 'n',
            'phase' => '',
            'phase_status_flag' => '',
            'begin_since' => '',
            'end_until' => '',
            'keyword_by' => '',
            'keyword' => ''
        ]);
    }

    /**
     * @return mixed  model collection
     */
    public function doFilterWithQueryTerm()
    {
        $orders = Order::
        latest('id')->

        //屬於這個使用者個訂單
        whereBuyerId($this->user->id)->

        //訂單狀態與階段
        targetStatus($this->queryTermForFilter['status_flag'],
            $this->queryTermForFilter['phase'],
            $this->queryTermForFilter['phase_status_flag'])->

        //關鍵字查詢
        keywordBy($this->queryTermForFilter['keyword_by'],
            $this->queryTermForFilter['keyword'])->

        //日期區間
        placedBetween($this->queryTermForFilter['begin_since'],
            $this->queryTermForFilter['end_until'])->
        paginate(10);

        $orders = $this->appendUriToPagination($orders, 'sales/order/list');

        return $orders;
    }

    public function makeList(Request $request)
    {
        if ($request->has('newSearch')) {
            $this->updateQueryTermInSession($request);
        }

        $orders = $this->fetchFilteredList();
        return view('frontEnd.sales.order._orderList', compact('orders'));
    }


    public function show(Order $order)
    {
        if (!$order->ownedBy(auth()->user())) {
            return '<p class="text-danger text-center">您無法查詢此張訂單!</p>';
        }

        return view('frontEnd.sales.order.show', compact('order'))->render();
    }


    public function getOrderAndView($id)
    {
        $order = Order::findOrFail($id);
        $view = $this->show($order);

        return response()->json([
            'order' => $order,
            'view' => $view
        ]);
    }


    public function cancelOrder($id)
    {
        $order = Order::findOrFail($id);

        if (!$order->ownedBy(auth()->user())) {
            return false;
        }

        $this->updatePhaseAndStatus(
            $this->nextPhaseAndStatus('cancel', $order),
            $order);

        $this->saveCancelRecord($order);

        return 'success';
    }



    protected function saveCancelRecord(Order $order)
    {
        $order->auditRecords()->create([
            'action' => '取消',
            'created_at' => Carbon::now(),
            'comments' => '訂購人自行取消',
            'auditor_id' => auth()->user()->id
        ]);

        return true;
    }
}
