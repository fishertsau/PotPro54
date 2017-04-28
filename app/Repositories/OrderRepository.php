<?php

namespace App\Repositories;

use App\User;
use App\Http\Requests;
use App\Models\Order\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Tool\Filterable;

class OrderRepository extends Filterable
{
    /*** �d�߱���W��***/
    protected $queryTermName = 'orderQueryTerm';

    /** �d�߱���**/
    protected $queryTermList = [
        'status_flag',
        'phase',
        'phase_status_flag',

        'begin_since',
        'end_until',

        'keyword_by',
        'keyword'
    ];


    /**
     *  The following methods are implemented in their child class
     * */
    public function makeList(Request $request)
    {
    }


    /**  order Decision***/
    /**  (1)newOrder (2)reject (3)on-hold (4)cancel (5)accept **/

    public function create(User $buyer, User $entry_person, array $orderInfo)
    {
        $orderInfo +=
            ['buyer_id' => $buyer->id, 'entry_user_id' => $entry_person->id]
            + $this->setNewOrderPhaseAndStatus();

        return Order::create($orderInfo);
    }


    protected function saveOrderItem(Order $order, $cart)
    {
        foreach ($cart as $item) {
            $itemInfo = $this->transformOrderItem($item);
            $order->items()->create($itemInfo);
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


    protected function putDefaultQueryTerm()
    {
        session()->put(
            $this->queryTermName,
            [
                'status_flag' => '',
                'phase' => '',
                'phase_status_flag' => Order::getPhaseStatusChar('TBP'),
                'begin_since' => '',
                'end_until' => '',
                'keyword_by' => '',
                'keyword' => ''
            ]);
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
    protected function doFilterWithQueryTerm($queryTermForSearch = [])
    {
        $orders = $this->quo()
            ->paginate(10);

        return $orders;
    }


    public function quo()
    {
        return Order::
        latest('id')->

        //�q�檬�A�P���q
        targetStatus(
            $this->queryTermForFilter['status_flag'],
            $this->queryTermForFilter['phase'],
            $this->queryTermForFilter['phase_status_flag'])->

        //����r�d��
        keywordBy($this->queryTermForFilter['keyword_by'],
            $this->queryTermForFilter['keyword'])->

        //����϶�
        placedBetween($this->queryTermForFilter['begin_since'],
            $this->queryTermForFilter['end_until']);
    }


    public function toBeAuditCount()
    {
        $toBeAuditTerm = [
            'status_flag' => 'n',
            'phase' => 'a',
            'phase_status_flag' => 't'
        ];
        return $this->getCount($toBeAuditTerm);
    }


    public function toBeShipCount()
    {
        $toBeShipTerm = [
            'status_flag' => 'n',
            'phase' => 'i',
            'phase_status_flag' => 't'
        ];
        return $this->getCount($toBeShipTerm);
    }


    protected function getCount($term)
    {
        $request = $this->generateRequest($term);
        $this->updateQueryTermInSession($request);
        $this->makeQueryForFilter();

        return $this->quo()->get()->count();
    }


    private function generateRequest($term)
    {
        $request = new Request();
        $request->query->add($term);
        return $request;
    }
}
