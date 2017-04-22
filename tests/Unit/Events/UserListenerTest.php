<?php

namespace Tests\Unit;

use App\Listeners\StampSignedIn;
use Acme\Repositories\UserRepository;
use App\User;
use Carbon\Carbon;

use App\Events\User\SignedIn;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

/**
 * @group tdd
 */
class UserListenerTest extends TestCase
{
    use DatabaseMigrations;


    /** @test */
    function StampSignedIn_listener()
    {
        $userRepo = $this->spy(UserRepository::class);

        $user = factory(User::class)->create();
        $now = Carbon::now();
        $loginIp = '127.0.0.1';

        //act
        (new StampSignedIn($now, $loginIp))->handle(new SignedIn($user,$now,$loginIp));

        $userRepo->shouldHaveReceived('stampSignIn')
            ->once()->with($user, $now, $loginIp);
    }}
