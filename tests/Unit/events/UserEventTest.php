<?php

namespace Tests\Unit;

use App\Listeners\StampSignedIn;
use App\User;
use Carbon\Carbon;

use App\Events\User\SignedIn;
//use App\Listeners\User\StampSignedIn;

//use Illuminate\Auth\events\Registered;
//use App\Listeners\User\WelcomeEmail;

//use App\events\User\UserEmailChanged;
//use App\events\User\ConfirmationEmailRequested;
//use App\Listeners\User\ConfirmationEmail;
//
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

/**
 * @group tdd
 */
class UserEventTest extends TestCase
{
    use DatabaseMigrations;


//    /** @test */
//    function registered_event()
//    {
//        $user = factory(User::class)->make();
//        $this->assertNotPushed(WelcomeEmail::class);
//
//        event(new Registered($user));
//
//        $this->assertPushed(WelcomeEmail::class);
//    }
//
//
//    /** @test */
//    function a_welcome_email_is_sent_when_registered_is_process()
//    {
//        $user = factory(User::class)->make(['email' => 'john@example.com']);
//        $this->assertNotPushed(WelcomeEmail::class);
//
//        event(new Registered($user));
//
//        $this->assertPushed(WelcomeEmail::class);
//    }
//
//
//    /** @test */
//    function UserEmailChanged_event()
//    {
//        $user = factory(User::class)->make();
//        $this->assertNotPushed(ConfirmationEmail::class);
//
//        event(new UserEmailChanged($user));
//
//        $this->assertPushed(ConfirmationEmail::class);
//    }
//
//    /** @test */
//    function ConfirmationEmailRequested_event()
//    {
//        $user = factory(User::class)->make();
//        $this->assertNotPushed(ConfirmationEmail::class);
//
//        event(new ConfirmationEmailRequested($user));
//
//        $this->assertPushed(ConfirmationEmail::class);
//    }


    /** @test */
    function SignedIn_event()
    {
        $stampSignInListener = $this->spy(StampSignedIn::class);
        $user = factory(User::class)->create();

        $time = Carbon::now();
        $ip = '100.100.100.100';

        event(new SignedIn($user, $time, $ip));

        $stampSignInListener->shouldHaveReceived('handle')
            ->once()->with(SignedIn::class);
    }
}
