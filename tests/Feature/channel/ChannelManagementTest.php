<?php

namespace Tests;


use App\Channel;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ChannelManagementTest extends TestCase
{
    use WithoutMiddleware;
    use DatabaseMigrations;

    /** @test */
    public function can_visit_management_pages()
    {
        $response = $this->get(route('admin.channels.index'));

        $response->assertSuccessful()
            ->assertSee('通路管理');
    }


    /** @test */
    public function can_assign_an_user_as_channel()
    {
        $user = factory(User::class)->create();

        //visit creation page
        $response = $this->get(route('admin.channels.create'));

        $response->assertSuccessful()
            ->assertSee('新增通路');

        //assign user as channels
        $response = $this->post(route('admin.channels.store'), ['user_id' => $user->id]);

        $response->assertRedirect(route('admin.channels.edit', $user->id));
        $channel = Channel::findByUserId($user->id);
        $this->assertEquals($user->id, $channel->user_id);
        $this->assertFalse($channel->activated);
        $this->assertEquals(100, $channel->discount_rate);
        $this->assertNull($channel->role);
    }


    /** @test */
    public function can_update_channel_management_info()
    {
        $channel = factory(Channel::class)->create(['user_id' => 1]);

        $input = [
            'discount_rate' => 60,
            'role' => 'WholeSales',
            'activated' => true
        ];

        $response = $this->put(route('admin.channels.update', $channel->user_id), $input);

        $updateChannel = $channel->fresh();
        $response->assertRedirect(route('admin.channels.index'));
        $this->assertEquals(60, $updateChannel->discount_rate);
        $this->assertEquals('WholeSales', $updateChannel->role);
        $this->assertTrue($updateChannel->activated);
    }


    /** @test */
    public function can_not_delete_channel()
    {
        //TODO: implement this

        //arrange

        //act

        //assert
    }


    /** @test */
    public function only_authorized_person_is_allowed_to_manage_sales()
    {
        //TODO: implement this

        //arrange

        //act

        //assert
    }


    /** @test */
    public function the_sales_revision_should_be_recorded()
    {
        //TODO: implement this

        //arrange

        //act

        //assert
    }
}