<?php

namespace Tests\Feature;

use App\User;
use Hash;
use Tests\TestCase;
use Acme\Repositories\UserRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group user
 * */
class UserRepositoryTest extends TestCase
{
    use DatabaseMigrations;

    private $userRepo;

    protected function setUp()
    {
        parent::setUp();

        $this->userRepo = new UserRepository;
    }

    /** @test */
    function can_create_user()
    {
        $user = $this->userRepo->createUser([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'secret'
        ]);

        $this->assertEquals($user->name, 'John Doe');
        $this->assertEquals($user->email, 'john@example.com');
        $this->assertTrue(Hash::check('secret', $user->password));
    }


    /** @test */
    function can_find_user_by_email()
    {
        $user = factory(User::class)->create(['email' => 'john@example.com']);

        $this->assertEquals($user->id, $this->userRepo->findByEmail('john@example.com')->id);
    }
}
