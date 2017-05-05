<?php

namespace Tests;

use App\Models\Product\AddOn;
use App\Models\Product\Group;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProductTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function can_create_product_through_group()
    {
        $group = factory(Group::class)->create();

        $product = $group->products()->create(['title' => 'New Product']);

        $this->assertEquals($group->id, $product->group_id);
    }


    /** @test */
    public function can_know_which_group_it_belongs_to()
    {
        $group = factory(Group::class)->create();
        $product = $group->products()->create(['title' => 'New Product']);

        $foundGroup = $product->group;

        $this->assertEquals($group->id, $foundGroup->id);
    }

    /** @test */
    public function can_get_add_onables_through_group()
    {
        $addOns = factory(AddOn::class, 3)->create();
        $group = factory(Group::class)->create();
        $group->addOnables()->sync($addOns->pluck('id'));
        $product = $group->products()->create(['title' => 'new product']);

        $retrievedAddOns = $product->group->addOnables;

        $this->assertEquals($addOns->pluck('id')->toArray(),
            $retrievedAddOns->pluck('id')->toArray());
    }

    /** @test */
    public function can_know_if_add_onable()
    {
        $addOnableGroup = factory(Group::class)->states('addOnable')->create();
        $unAddOnableGroup = factory(Group::class)->states('unAddOnable')->create();
        $addOnableProduct = $addOnableGroup->products()->create(['title' => 'productAA']);
        $unAddOnableProduct = $unAddOnableGroup->products()->create(['title' => 'productUA']);


        $this->assertTrue($addOnableProduct->addonable);
        $this->assertFalse($unAddOnableProduct->addonable);
    }

}