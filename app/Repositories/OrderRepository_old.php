<?php

namespace App\Repositories;

use Session;
use App\User;
use App\Http\Requests;
use App\Models\Order\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderRepository_old extends Controller
{

    /*** �d�߱���W��***/
    protected static $queryTermName = 'orderQueryTerm';

    /** �d�߱���**/
    protected static $queryTermList = [
        'status_flag',
        'phase',
        'phase_status_flag',

        'begin_since',
        'end_until',

        'keyword_by',
        'keyword'
    ];


    /**  Order Decision***/
    /**  (1)newOrder (2)reject (3)on-hold (4)cancel (5)accept **/

    /**
     * Format for option setting string
     * [no] title:'setting' setting_unit (note)
     *  note���A��,�ݭn�bserialization�� �ۤv�[�J
     *   * @var string
     */
    private $PONoFormat = "%s-%s";

    /**
     * OrderRepository constructor.
     */
    public function __construct()
    {
        if (!$this->sessionHasQueryTerm()) {
            $this->setDefaultQueryTerm();
        }
    }


    public function create(User $buyer, User $entry_person, array $orderInfo)
    {
        $orderInfo +=
            ['buyer_id' => $buyer->id, 'entry_user_id' => $entry_person->id] +
            ['po_no' => $this->createPONo()] +
            $this->setNewOrderPhaseAndStatus();

        return Order::create($orderInfo);
    }


    protected function saveOrderItem(Order $order, $cart)
    {
        foreach ($cart as $item) {
            $itemInfo = $this->transformOrderItem($item);
            $order->items()->create($itemInfo);
        }
    }

    /**
     * Generate new PO No for this PO
     * @return string
     */
    protected function createPONo()
    {
        $todayString = getTodayString();

        $serial = $this->generateNewPOSerial($todayString);

        $PONo = sprintf(
            $this->PONoFormat,
            $todayString,
            $serial
        );

        return $PONo;
    }


    protected function generateNewPOSerial($todayString)
    {
        $latestOrder =
            Order::where('po_no', 'like', $todayString . '%')
                ->orderBy('id', 'desc')
                ->first();

        if ($latestOrder == null) {
            return '001';
        }

        $lastSerial = hexdec(substr($latestOrder->po_no, -3));

        $newSerial = dechex($lastSerial + 1);

        //�b�r��e���[�W'0'
        switch (strlen($newSerial)) {
            case 1:
                return '00' . $newSerial;
                break;
            case 2:
                return '0' . $newSerial;
                break;
            default:
                return $newSerial;
        }
    }

    protected function setNewOrderPhaseAndStatus()
    {
        $phaseSetting = [
            'status_flag' => Order::getStatusChar('normal'),
            'phase' => Order::getPhaseChar('auditing'),
            'phase_status_flag' => Order::getPhaseStatusChar('TBP')];

        return $phaseSetting;
    }

    /**
     * Make the necessary setting for next phase
     * Necessary checking is required before making any change
     * @param $nextMoveDecision
     * @param Order $order
     * @return array
     */
    public function nextPhaseAndStatus($nextMoveDecision, Order $order)
    {
        /**接受訂單*/
        if ($nextMoveDecision == 'accept') {
            $status_flag = Order::getStatusChar('normal');
            $phase = Order::getPhaseChar('shipping');
            $phase_status_flag = Order::getPhaseStatusChar('TBP');
        }

        /**退回訂單*/
        if ($nextMoveDecision == 'reject') {
            $status_flag = Order::getStatusChar('rejected');
            $phase = Order::getPhaseChar('start');
            $phase_status_flag = Order::getPhaseStatusChar('cancelled');
        }


        /**暫停訂單*/
        if ($nextMoveDecision == 'on-hold') {
            $status_flag = Order::getStatusChar('on-hold');
            $phase = $order->phase;
            $phase_status_flag = Order::getPhaseStatusChar('on-hold');
        }

        /**回復訂單*/
        if ($nextMoveDecision == 'restore') {
            $status_flag = Order::getStatusChar('normal');
            $phase = $order->phase; //Original value
            $phase_status_flag = Order::getPhaseStatusChar('TBP');
        }

        /**取消訂單*/
        if ($nextMoveDecision == 'cancel') {
            $status_flag = Order::getStatusChar('cancelled');
            $phase = $order->phase;
            $phase_status_flag = Order::getPhaseStatusChar('cancelled');
        }

        /**訂單出貨*/
        if ($nextMoveDecision == 'order_shipped') {
            $status_flag = Order::getStatusChar('finished');
            $phase = Order::getPhaseChar('finished');
            $phase_status_flag = Order::getPhaseStatusChar('finished');
        }


        $phaseSetting = [
            'status_flag' => $status_flag,
            'phase' => $phase,
            'phase_status_flag' => $phase_status_flag];

        return $phaseSetting;
    }


    public function updatePhaseAndStatus($phaseSetting, Order $order)
    {
        $order->update($phaseSetting);
    }


    /**
     * Transform the cart item into the saving format.
     * @param $item
     * @return array
     */
    protected function transformOrderItem($item)
    {
        $itemInfo = [
            'group_id' => $item->groupid,
            'product_id' => $item->id,
            'type' => $item->type,
            'qty' => $item->qty,
            'price' => $item->price,
            'subtotal' => $item->subtotal,
            'options' => $item->options,
            'note' => $item->note
        ];

        return $itemInfo;
    }


    protected function setDefaultQueryTerm()
    {
        $defaultQueryTerm = [
            'status_flag' => '',
            'phase' => '',
            'phase_status_flag' => Order::getPhaseStatusChar('TBP'),
            'begin_since' => '',
            'end_until' => '',
            'keyword_by' => '',
            'keyword' => ''
        ];

        Session::put(self::$queryTermName, $defaultQueryTerm);
    }


    protected function updateOrCreateShipmentRecord(Order $order, Request $request)
    {
        $orderShipment = $order->shipment;

        if ($orderShipment == null) {
            $input = $request->all();
            $input['recorder_id'] = auth()->user()->id;
            $order->shipment()->create($input);
            return;
        }

        $orderShipment->update($request->all());
    }


    /**
     * @param array $queryTermForSearch
     * @return mixed
     */
    protected function filterOrderWithQueryTerm($queryTermForSearch = [])

    {
        $orders = Order::
        latest('id')->

        //�q�檬�A�P���q
        targetStatus($queryTermForSearch['status_flag'], $queryTermForSearch['phase'], $queryTermForSearch['phase_status_flag'])->

        //����r�d��
        keywordBy($queryTermForSearch['keyword_by'], $queryTermForSearch['keyword'])->

        //����϶�
        placedBetween($queryTermForSearch['begin_since'], $queryTermForSearch['end_until'])->

        paginate(10);

        return $orders;
    }


    protected function sessionHasQueryTerm()
    {
        return Session::has(self::$queryTermName);
    }
}
