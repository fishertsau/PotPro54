<?php

namespace Tests\Feature\Unit;

use App\Models\Marketing\Video;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

/**
 * @group  user
 */
class UserTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function can_get_signIn_count()
    {
        $user = factory(User::class)->create(['signIn_count' => 15]);

        $this->assertSame(15, $user->signIn_count);
    }

    /**
     * @test
     */
    public function can_have_many_videos()
    {
        //arrange
        $user = factory(User::class)->create();

        //act
        factory(Video::class, 3)->create([
            'user_id' => $user->id
        ]);

        //assert
        $this->assertCount(3, $user->videos);
    }
}
