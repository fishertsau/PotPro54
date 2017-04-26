<?php

namespace Tests;

use App\Models\Product\AddOn;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AddOnOptionTestTest extends TestCase
{

    use DatabaseMigrations;

//    /** @test */
//    public function addOns_could_be_listed_from_the_admin()
//    {
//        $response = $this->get(route('admin.addons.index'));
//
//        $response->assertSuccessful()
//            ->assertSee('加工配件清單');
//    }
//
//    /** @test */
//    public function addon_create_page_could_be_visited_form_admin()
//    {
//        $response = $this->get(route('admin.addons.create'));
//
//        $response->assertSuccessful()
//            ->assertSee('新增加工配件');
//    }
//
//
//    /** @test */
//    public function an_addOn_could_be_created_from_the_admin()
//    {
//        $newAddOnInput = [
//            'title' => 'A new AddOn',
//        ];
//
//        $response = $this->post(route('admin.addons.store'), $newAddOnInput);
//
//        $addOn = AddOn::first();
//
//        $response->assertRedirect(route('admin.addons.edit', $addOn->id));
//        $this->assertEquals($newAddOnInput['title'], $addOn->title);
//        $this->assertCount(1, AddOn::all());
//    }
//
//
//    /** @test */
//    public function group_edit_form_could_be_visited_from_admin()
//    {
//        $addOn = factory(AddOn::class)->create([
//            'title' => 'Wonderful AddOn'
//        ]);
//
//        $response = $this->get(route('admin.addons.edit', $addOn->id));
//
//        $response->assertSuccessful()
//            ->assertSee('Wonderful AddOn');
//    }
//
//    /** @test */
//    public function addon_could_be_updated_from_the_admin()
//    {
//        $addOn = factory(AddOn::class)->create([
//            'title' => 'Old AddOn title'
//        ]);
//
//        $updatedInfo = [
//            'title' => 'new AddOn title'
//        ];
//
//        $response = $this->put(route('admin.addons.update', $addOn->id), $updatedInfo);
//
//        $updatedAddOn = $addOn->fresh();
//        $response->assertRedirect(route('admin.addons.index'));
//        $this->assertEquals($addOn->id, $updatedAddOn->id);
//        $this->assertEquals($updatedInfo['title'], $updatedAddOn->title);
//    }
//
//
//    /** @test */
//    public function can_see_addon_detail_from_admin()
//    {
//        $addOn = factory(AddOn::class)->create();
//
//        $response = $this->get(route('admin.addons.show', $addOn->id));
//
//        $response->assertSuccessful()
//            ->assertSee($addOn->title);
//    }
}