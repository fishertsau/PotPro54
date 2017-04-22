<?php

namespace App\Events\Order;

use App\Events\Event;
use App\Models\Order\Order;
use Illuminate\Queue\SerializesModels;
use App\Models\Order\OrderStatusRecord;

class OrderWasRejected extends Event
{
    use SerializesModels;

    public $order;
    public $auditRecord;

    /**
     * Create a new event instance.
     *
     * @param Order $order
     * @param OrderStatusRecord $orderStatusRecord
     */
    public function __construct(Order $order, OrderStatusRecord $orderStatusRecord)
    {
        $this->order = $order;
        $this->auditRecord = $orderStatusRecord;
    }
}
