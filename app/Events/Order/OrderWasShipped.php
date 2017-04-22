<?php

namespace App\Events\Order;

use App\Models\Order\Order;
use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class OrderWasShipped extends Event
{
    use SerializesModels;

    public $order;

    /**
     * Create a new event instance.
     *
     * @param $user
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
