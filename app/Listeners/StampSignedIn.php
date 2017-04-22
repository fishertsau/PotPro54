<?php

namespace App\Listeners;

use App\Events\User\SignedIn;
use Acme\Repositories\UserRepository;

class StampSignedIn
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SignedIn  $event
     * @return void
     */
    public function handle(SignedIn $event)
    {
        app()->make(UserRepository::class)
            ->stampSignIn($event->user, $event->time, $event->ip);
    }
}
