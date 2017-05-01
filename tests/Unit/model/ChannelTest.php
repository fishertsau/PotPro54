<?php

namespace Tests\Feature\Unit;

use App\Channel;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group  user
 */
class ChannelTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function can_find_channel_by_user_id()
    {
        $channel = factory(Channel::class)->create(['user_id' => 1]);

        $foundChannel = Channel::findByUserId(1);

        $this->assertEquals($channel->id, $foundChannel->id);
    }

    /** @test */
    public function an_account_can_have_at_most_one_channel()
    {
        //TODO: implement this
        //arrange

        //act

        //assert
    }
}
