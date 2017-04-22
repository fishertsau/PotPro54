<?php

namespace App\Events\User;

use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SignedIn
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $time;
    public $ip;

    /**
     * Create a new event instance.
     *
     * @param User $user
     * @param $time
     * @param $ip
     */
    public function __construct(User $user, $time, $ip)
    {
        $this->user = $user;
        $this->time = $time;
        $this->ip = $ip;
    }

}
