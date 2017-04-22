<?php

use Acme\Auth\FakeSocialiteGateway;
use Acme\Auth\SocialiteGateway;
use App\Events\User\SignedIn;
use App\User;
use Tests\TestCase;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group  user
 */
class UserAccountBasicTest extends TestCase
{
    use DatabaseMigrations;

    protected function registerAccount(array $params)
    {
        return $this->json('post', "/register", $params);
    }

    protected function assertValidationError($response, $field)
    {
        $response->assertStatus(422);
        $this->assertArrayHasKey($field, $response->decodeResponseJson());
    }

    /** @test */
    function an_user_can_register_an_account()
    {
        $this->disableExceptionHandling();

        Event::fake();
        Event::assertNotDispatched(Registered::class);
        Event::assertNotDispatched(SignedIn::class);

        $response = $this->registerAccount([
            'email' => 'john@example.com',
            'name' => 'John Doe',
            'password' => 'secret',
            'password_confirmation' => 'secret',
            'agreed' => true
        ]);


        $user = User::first();

        $response->assertStatus(302)->assertRedirect('/account');
        $this->assertEquals('John Doe', $user->name);
        $this->assertEquals('john@example.com', $user->email);
        $this->assertTrue(Hash::check('secret', $user->password));

        $this->assertTrue(auth()->check());
        $this->assertEquals('john@example.com', auth()->user()->email);

        Event::assertDispatched(Registered::class, function ($e) use ($user) {
            return $e->user->id = $user->id;
        });

        Event::assertDispatched(SignedIn::class, function ($e) use ($user) {
            return $e->user->id === $user->id;
        });
    }

    /** @test */
    function default_setting_for_first_time_register_account_is_correct()
    {
        $response = $this->registerAccount([
            'email' => 'john@example.com',
            'name' => 'John Doe',
            'password' => 'secret',
            'password_confirmation' => 'secret',
            'agreed' => true
        ]);

        $response->assertStatus(302)->assertRedirect('/account');
        $this->assertSame(1, auth()->user()->signIn_count);
    }


    /** @test */
    function email_is_required_for_inSite_account_registration()
    {
        $response = $this->registerAccount([
            'name' => 'John Doe',
            'password' => 'secret',
            'password_confirmation' => 'secret',
            'agreed' => true
        ]);

        $this->assertValidationError($response, 'email');
    }

    /** @test */
    function name_is_required_for_inSite_account_registration()
    {
        $response = $this->registerAccount([
            'email' => 'john@example.com',
            'password' => 'secret',
            'password_confirmation' => 'secret',
            'agreed' => true
        ]);

        $this->assertValidationError($response, 'name');
    }

    /** @test */
    function password_is_required_for_inSite_account_registration()
    {
        $response = $this->registerAccount([
            'email' => 'john@example.com',
            'name' => 'John Doe',
            'password_confirmation' => 'secret',
            'agreed' => true
        ]);

        $this->assertValidationError($response, 'password');
    }

    /** @test */
    function passwordConfirmation_is_required_for_inSite_account_registration()
    {
        $response = $this->registerAccount([
            'email' => 'john@example.com',
            'name' => 'John Doe',
            'password' => 'secret',
            'agreed' => true
        ]);
        $this->assertValidationError($response, 'password');
    }


    /** @test */
    function an_user_must_agree_service_policy_in_order_to_register()
    {
        $response = $this->registerAccount([
            'email' => 'jack@example.com',
            'name' => 'jack Doe',
            'password' => 'secret',
            'password_confirmation' => 'secret'
        ]);
        $this->assertValidationError($response, 'agreed');
    }


    /** @test */
    function an_unique_email_is_required_for_account_registration()
    {
        $this->registerAccount([
            'email' => 'jane@example.com',
            'name' => 'Jane Doe',
            'password' => 'secret',
            'password_confirmation' => 'secret',
            'agreed' => true
        ]);

        $response = $this->registerAccount([
            'email' => 'jane@example.com',
            'name' => 'Jane Hash',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
            'agreed' => true
        ]);

        $response->assertStatus(302); //found
        $this->assertCount(1, User::whereEmail('jane@example.com')->get());
    }


    /** @test */
    function can_logout()
    {
        $response = $this->registerAccount([
            'email' => 'jack@example.com',
            'name' => 'jack Doe',
            'password' => 'secret',
            'password_confirmation' => 'secret',
            'agreed' => true
        ]);
        $this->assertTrue(auth()->check());

        $this->post("/logout");

        $response->assertStatus(302);

        $this->assertFalse(auth()->check(), "The auth user should have logged out, but he didn't.");
    }


    /**
    *@test
    */
    public function can_get_login_page(){
        $response = $this->get('/login');

        $response->assertStatus(200)
            ->assertSee('御鼎節能科技(股)有限公司')
            ->assertSee('台中市烏日區五光路復光六巷141號')
            ->assertSee('04-3507 9900')
            ->assertSee('04-2336 9277')
            ->assertSee('使用電子信箱登入')
            ->assertSee('使用Facebook登入');
    }

    /** @test */
    function can_login_with_email()
    {
        Event::fake();
        Event::assertNotDispatched(SignedIn::class);

        //arrange
        $this->registerAccount([
            'email' => 'jerry@example.com',
            'name' => 'Jerry Doe',
            'password' => 'secret',
            'password_confirmation' => 'secret',
            'agreed' => true
        ]);
        auth()->logout();

        //act
        $response = $this->json('post', "/login", [
            'email' => 'jerry@example.com',
            'password' => 'secret'
        ]);

        $user = auth()->user();

        $response->assertStatus(302)
            ->assertRedirect('/');
        $this->assertTrue(auth()->check());
        $this->assertSame(auth()->user()->email, 'jerry@example.com');

        Event::assertDispatched(SignedIn::class, function ($e) use ($user) {
            return $e->user->id === $user->id;
        });
    }


    /** @test */
    function can_use_FB_for_authentication()
    {
//       TODO: Review the testing mechanism, and rewrite if necessary

//        $socialiteGateway = Mockery::spy(FakeSocialiteGateway::class);
//        $this->app->instance(SocialiteGateway::class, $socialiteGateway);
//
//        //act + assert
//        $this->json('get', '/auth/socialite/facebook');
//        $socialiteGateway->shouldHaveReceived('redirectToProvider')->once()->with('facebook');
//
//
//        //act + assert
//        $user = \GuzzleHttp\json_encode(factory(User::class)->make([
//            'name' => 'John Doe',
//            'email' => 'john@example.com',
//            'password' => 'secret'
//        ]));
//
//        $this->json('get', "/auth/socialite/callback/{$user}");
//
//        $socialiteGateway->shouldHaveReceived('handleProviderCallback')->once();
    }
}
