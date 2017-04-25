<?php

namespace Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AddOnFeatureTest extends TestCase
{

    /** @test */
    public function addOns_could_be_listed_from_the_admin()
    {
        $response = $this->get(route('admin.addons.index'));

        $response->assertSuccessful()
            ->assertSee('加工配件清單');
    }

    /** @test */
    public function addon_create_page_could_be_visited_form_admin()
    {
        //Todo: implement this.

//        $response = $this->get(route('admin.addons.create'));
//
//        $response->assertSuccessful()
//            ->assertSee('新增加工配件');
    }


//    /** @test */
//    public function a_product_could_be_created_from_the_admin()
//    {
//        $newGroupInput = [
//            'title' => 'A new product',
//        ];
//
//        $response = $this->post(route('admin.addons.store'), $newGroupInput);
//
//        $group = Group::first();
//
//        $response->assertRedirect(route('admin.addons.edit', $group->id));
//        $this->assertEquals($newGroupInput['title'], $group->title);
//        $this->assertCount(1, Group::all());
//    }
//
//
//    /** @test */
//    public function group_edit_form_could_be_visited_from_admin()
//    {
//        $group = factory(Group::class)->create([
//            'title' => 'Wonderful Group'
//        ]);
//
//        $response = $this->get(route('admin.addons.edit', $group->id));
//
//        $response->assertSuccessful()
//            ->assertSee('Wonderful Group');
//    }
//
//    /** @test */
//    public function group_could_be_updated_from_the_admin()
//    {
//        $group = factory(Group::class)->create([
//            'title' => 'Old group title'
//        ]);
//
//        $updatedInfo = [
//            'title' => 'new group title'
//        ];
//
//        $response = $this->put(route('admin.addons.update', $group->id), $updatedInfo);
//
//        $updatedGroup = $group->fresh();
//        $response->assertRedirect(route('admin.addons.index'));
//        $this->assertEquals($group->id, $updatedGroup->id);
//        $this->assertEquals($updatedInfo['title'], $updatedGroup->title);
//    }
//
//
//    /** @test */
//    public function can_see_product_detail_from_admin()
//    {
//        $group = factory(Group::class)->create();
//
//        $response = $this->get(route('admin.addons.show', $group->id));
//
//        $response->assertSuccessful()
//            ->assertSee($group->title);
//    }

}