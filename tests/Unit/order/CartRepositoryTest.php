<?php

namespace Tests;

use App;
use Acme\Facade\Cart;
use App\Models\Product\Group;
use App\Models\Product\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Collection;

class CartRepositoryTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function can_see_cart_in_session_after_creation()
    {
        $this->assertFalse(session()->has('cart'));

        App::make('cart');

        $this->assertTrue(session()->has('cart'));
    }


    /** @test */
    public function can_add_product()
    {
        $addOnableGroup = factory(Group::class)->states('addOnable')->create();
        $unAddOnableGroup = factory(Group::class)->states('unAddOnable')->create();
        $addOnableProductA = $addOnableGroup->products()->create(['title' => 'productAA']);

        $unAddOnableProductA = $unAddOnableGroup->products()->create(['title' => 'productUA']);
        $unAddOnableProductB = $unAddOnableGroup->products()->create(['title' => 'productUA']);

        //put un-add-onable product A
        $selectedItems = ['product_id' => $unAddOnableProductA->id, 'qty' => 10];

        Cart::addProduct($selectedItems);

        $setId = Cart::items()->first()['set_id'];
        $this->assertNotEmpty(Cart::items()->first()['set_id']);
        $this->assertEquals(10, Cart::count()); //10

        $this->assertCount(1, Cart::items());
        $this->assertEquals($unAddOnableProductA->id, Cart::items()->first()['product_id']);
        $this->assertEquals($unAddOnableProductA->id, Cart::setItems($setId)->first()['product_id']);
        $this->assertEquals($unAddOnableProductA->id, Cart::items($setId)->first()['product_id']);
        $this->assertEquals(10, Cart::items($setId)->first()['qty']);


        //put more put un-add-onable product A
        $moreSameProductItems = ['product_id' => $unAddOnableProductA->id, 'qty' => 30];

        Cart::addProduct($moreSameProductItems);

        $this->assertEquals(40, Cart::count()); //10+30
        $this->assertEquals($unAddOnableProductA->id, Cart::items()->first()['product_id']);
        $this->assertCount(1, Cart::items());
        $this->assertEquals($unAddOnableProductA->id, Cart::setItems($setId)->first()['product_id']);
        $this->assertEquals($unAddOnableProductA->id, Cart::items($setId)->first()['product_id']);


        //put un-addonable product B
        $differentProducts = ['product_id' => $unAddOnableProductB->id, 'qty' => 20];

        Cart::addProduct($differentProducts);

        $this->assertEquals(60, Cart::count()); //10+30+20
        $this->assertCount(2, Cart::items());
        $this->assertCount(2, Cart::items()->groupBy('set_id')->all());

        //put in addonable product A
        $addonableProducts = ['product_id' => $addOnableProductA->id, 'qty' => 5];
        Cart::addProduct($addonableProducts);

        $this->assertEquals(65, Cart::count()); //10+30+20+5
        $this->assertCount(3, Cart::items());
        $this->assertCount(3, Cart::items()->groupBy('set_id')->all());

        //put in more addonable product A
        $addonableProducts = ['product_id' => $addOnableProductA->id, 'qty' => 10];
        Cart::addProduct($addonableProducts);

        $this->assertEquals(75, Cart::count());//10+30+20+5+10
        $this->assertCount(4, Cart::items());
        $this->assertCount(4, Cart::items()->groupBy('set_id')->all());
    }


    /** @test */
    public function can_get_count()
    {
        $rowId = 1;
        Cart::items()->put($rowId, ['qty' => 100]);
        $this->assertEquals(100, Cart::count());

        $rowId = 2;
        Cart::items()->put($rowId, ['qty' => 20]);
        $this->assertEquals(120, Cart::count());
    }


    /** @test */
    public function can_get_total()
    {

        //arrange

        //act

        //assert
    }

    /** @test */
    public function can_get_all_items()
    {
        $rowId = 'key1';
        Cart::items()->put($rowId, ['item' => 'a']);
        $rowId = 'key2';
        Cart::items()->put($rowId, ['item' => 'b']);

        $items = Cart::items();

        $this->assertCount(2, $items);
        $this->assertEquals(['key1', 'key2'], $items->keys()->sort()->all());
        $this->assertEquals(['a', 'b'], $items->pluck('item')->sort()->all());
    }


    /** test */
    public function can_remove_item_by_rowId()
    {
    }

    /** @test */
    public function add_ons_in_same_set_are_removed_when_product_are_removed()
    {
    }

    /** @test */
    public function can_update_an_item_quantity()
    {
//        $product = factory(Product::class)->make(['id' => 1]);
//        $selectedProduct = ['product_id' => $product->id, 'qty' => 10, 'unit_price' => 5];
//        Cart::addItem($selectedProduct);
//        $this->assertEquals(10, Cart::count());
//        $this->assertEquals(50, Cart::total());
//
//
//        $updatedItem = ['product_id' => $product->id, 'qty' => 100, 'unit_price' => 5];
//
//        //act
//        Cart::update($updatedItem);
//
//        //assert
//        $this->assertEquals(100, Cart::count());
//        $this->assertEquals(500, Cart::total());
    }


    /** @test */
    public function can_destroy_the_cart()
    {
        $selectedProduct = ['some_data' => 'data'];
        Cart::items()->put(1, $selectedProduct);
        $this->assertNotEmpty(Cart::items());

        //act
        Cart::destroy();

        //assert
        $this->assertEmpty(Cart::items());
    }


    /** @test */
    public function a_item_having_productId_has_type_product()
    {
        $product = ['product_id' => 1];
        Cart::items()->put(1, $product);

        $item = Cart::items()->first();

        $this->assertEquals('product', Cart::type($item));
    }

    /** @test */
    public function a_item_having_addOnId_has_type_addOn()
    {
        $product = ['addOn_id' => 1];
        Cart::items()->put(1, $product);

        $item = Cart::items()->first();

        $this->assertEquals('addOn', Cart::type($item));
    }


    /** @test */
    public function a_item_having_no_addOnId_nor_productId_has_type_undefined()
    {
        $product = [];
        Cart::items()->put(1, $product);

        $item = Cart::items()->first();

        $this->assertEquals('undefined', Cart::type($item));
    }


    public function tearDown()
    {
        parent::tearDown();

        Cart::destroy();
    }
}