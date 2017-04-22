<?php

namespace App\Http\Controllers\Admin;

use Excel;
use Carbon\Carbon;
use App\Http\Requests;
use App\Models\Order\Order;
use Illuminate\Http\Request;
use App\Repositories\OrderRepository;
use App\Events\Order\OrderWasShipped;
use App\Events\Order\OrderWasRejected;
use App\Models\Order\OrderStatusRecord;

class OrderController extends OrderRepository
{
    protected $actionList = [
        'order_shipped' => [
            'name' => '出貨',
            'form' => '_shipmentRecordFormForModal',
            'action' => 'proceedOrderShipped',
            'doneMsg' => '出貨紀錄已經設定完成'
        ],

        'reject' => [
            'name' => '退回',
            'form' => '_rejectFormForModal',
            'action' => 'auditAction',
            'doneMsg' => '訂單已退回,並已發出退回通知給訂購人'
        ],
        'restore' => [
            'name' => '回復',
            'form' => '_restoreFormForModal',
            'action' => 'auditAction',
            'doneMsg' => '訂單已回復'
        ],
        'on-hold' => [
            'name' => '暫停',
            'form' => '_on-holdFormForModal',
            'action' => 'auditAction',
            'doneMsg' => '訂單已暫停'
        ],
        'cancel' => [
            'name' => '取消',
            'form' => '_cancelFormForModal',
            'action' => 'auditAction',
            'doneMsg' => '訂單已取消'
        ],
        'accept' => [
            'name' => '接受',
            'form' => '',
            'action' => 'auditAction',
            'doneMsg' => '訂單已接受'
        ],
    ];


    public function __construct()
    {
        $this->authorize('order-management');

        parent::__construct();
    }

    /**
     * @param Request $request
     * @return \BladeView|bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function makeList(Request $request)
    {
        if ($request->has('newSearch')) {
            $this->updateQueryTermInSession($request);
        }

        $orders = $this->fetchFilteredList();

        return view('admin.order.index._orderList', compact('orders'));
    }


    public function index(Request $request)
    {
        if ($request->has('newSearch')) {
            $this->updateQueryTermInSession($request);
        }

        $queryTerm = $this->getQueryTerm();

        return view('admin.order.index.index', compact('queryTerm'));
    }


    public function edit(Order $order)
    {
        $this->authorize('audit-order');
        return view('admin.order.edit.audit', compact('order'));
    }


    /**
     * @param string $action
     * @param Order $order
     */
    protected function sendFlashNotice($action = '', Order $order)
    {
        flash()
            ->overlay($this->actionList[$action]['doneMsg'],
                sprintf('訂單(號碼:%s): 設定成功.', $order->po_no));
    }


    /**
     * Fire a necessary events for further action,
     * e.g. notifying buyer on order being rejected
     * @param $decision
     * @param Order $order
     * @param OrderStatusRecord $auditRecord
     */
    protected function fireEvent($decision, Order $order, OrderStatusRecord $auditRecord)
    {
        if ($decision == 'reject') {
            event(new OrderWasRejected($order, $auditRecord));
        }
    }


    public function makeExcelList(Request $request)
    {
        $orders = Order::whereIn('id',
            $this->normalizeIdList($request->input('idList')))
            ->get();
        $this->exportToExcel($orders);
    }


    protected function normalizeIdList($idListString = '')
    {
        return explode(',', $idListString);
    }


    protected function exportToExcel($orders)
    {
        Excel::create('訂單清單', function ($excel) use ($orders) {

            $excel->sheet('訂單內容', function ($sheet) use ($orders) {

                $sheet->setAutoSize(true);
                $sheet->row(1, []);

                $data = collect();
                foreach ($orders as $order) {
                    $data = $data->merge($this->generateOrderHeadingOrSummary($order));
                    $data = $data->merge($this->generateOrderItems($order));
                }

                $sheet->fromArray($data);
            });
        })->export('xlsx');
    }


    protected function generateOrderItems(Order $order)
    {
        $data = collect();
        foreach ($order->items as $item) {
            $data->push(['', $item->type_text, $item->item->title, $item->qty, $item->note, $item->setting]);
        }
        $data->push([]);
        return $data;
    }

    /**
     * @param Order $order
     * @return \Illuminate\Support\Collection
     */
    protected function generateOrderHeadingOrSummary(Order $order)
    {
        $data = collect([]);
        $data->push(['訂單號碼', '狀態/類型', '階段/名稱', '數量', '附註', '設定']);
        $data->push([
            $order->po_no,
            $order->status_text,
            $order->phase_text . '/' . $order->phase_status_text
        ]);

        return $data;
    }


    public function nextMoveForm($action = '', Order $order)
    {
        return view(
            'admin.order.partials.' . $this->getActionForm($action),
            compact('order')
        );
    }


    public function nextMove($action = '', Order $order, Request $request)
    {
        $this->{$this->getAction($action)}($order, $request, $action);

        $this->sendFlashNotice($action, $order);

        return redirect('/admin/order');
    }


    protected function getActionForm($action = '')
    {
        return $this->actionList[$action]['form'];
    }


    protected function getAction($action = '')
    {
        return $this->actionList[$action]['action'];
    }


    protected function proceedOrderShipped(Order $order, Request $request)
    {
        $this->updatePhaseAndStatus($this->nextPhaseAndStatus('order_shipped', $order), $order);
        $this->updateOrCreateShipmentRecord($order, $request);
        event(new OrderWasShipped($order));
    }


    /**
     * @param Order $order
     * @param Request $request
     * @param $action
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @internal param $decision
     */
    protected function auditAction(Order $order, Request $request, $action)
    {
        $this->authorize('audit-order');

        $this->updatePhaseAndStatus(
            $this->nextPhaseAndStatus($action, $order), $order);

        $auditRecord = $this->persistAuditRecord($order, $request, $action);

        $this->fireEvent($action, $order, $auditRecord);
    }


    protected function persistAuditRecord(Order $order, Request $request, $action)
    {
        return $order->auditRecords()->create(
            ['action' => $this->actionList[$action]['name'],
                'created_at' => Carbon::now(),
                'comments' => $request->input('comments'),
                'auditor_id' => auth()->user()->id
            ]
        );
    }

}