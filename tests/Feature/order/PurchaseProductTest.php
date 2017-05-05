<?php

namespace Tests;


use Acme\Facade\Cart;
use App\Models\Product\Group;
use App\Models\Product\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PurchaseProductTest extends TestCase
{
    use DatabaseMigrations;

    public function tearDown()
    {
        parent::tearDown();
        Cart::destroy();
    }

    private function putToCart($products)
    {
        return $this->json('post', route('cart.addItem'), $products);
    }

    private function assertResponseSuccess($response)
    {
        $response->assertSuccessful()
            ->assertExactJson([
                'status' => 'success',
                'message' => 'products added into the cart',
            ]);
    }

    /** @test */
    public function can_put_products_in_the_cart_from_frontend()
    {
        $addOnableGroup = factory(Group::class)->states('addOnable')->create();
        $unAddOnableGroup = factory(Group::class)->states('unAddOnable')->create();
        $addOnableProductA = $addOnableGroup->products()->create(['title' => 'productAA']);

        $unAddOnableProductA = $unAddOnableGroup->products()->create(['title' => 'productUA']);
        $unAddOnableProductB = $unAddOnableGroup->products()->create(['title' => 'productUA']);

        //put un-add-onable product A
        $selectedItems = ['product_id' => $unAddOnableProductA->id, 'qty' => 10];
        $response = $this->putToCart($selectedItems);

        $this->assertResponseSuccess($response);

        $setId = Cart::items()->first()['set_id'];
        $this->assertNotEmpty(Cart::items()->first()['set_id']);
        $this->assertEquals(10, Cart::count()); //10

        // todo: make array to property
        $this->assertEquals($unAddOnableProductA->id, Cart::items()->first()['product_id']);
        $this->assertCount(1, Cart::items());
        $this->assertEquals($unAddOnableProductA->id, Cart::setItems($setId)->first()['product_id']);
        $this->assertEquals($unAddOnableProductA->id, Cart::items($setId)->first()['product_id']);


        //put more put un-add-onable product A
        $moreSameProductItems = ['product_id' => $unAddOnableProductA->id, 'qty' => 30];

        $response = $this->putToCart($moreSameProductItems);

        $this->assertResponseSuccess($response);
        $this->assertEquals(40, Cart::count()); //10+30
        $this->assertEquals($unAddOnableProductA->id, Cart::items()->first()['product_id']);
        $this->assertCount(1, Cart::items());
        $this->assertEquals($unAddOnableProductA->id, Cart::setItems($setId)->first()['product_id']);
        $this->assertEquals($unAddOnableProductA->id, Cart::items($setId)->first()['product_id']);


        //put un-addonable product B
        $differentProducts = ['product_id' => $unAddOnableProductB->id, 'qty' => 20];

        $response = $this->putToCart($differentProducts);

        $this->assertResponseSuccess($response);
        $this->assertEquals(60, Cart::count()); //10+30+20
        $this->assertCount(2, Cart::items());
        $this->assertCount(2, Cart::items()->groupBy('set_id')->all());

        //put in addonable product A
        $addonableProducts = ['product_id' => $addOnableProductA->id, 'qty' => 5];
        $response = $this->putToCart($addonableProducts);

        $this->assertResponseSuccess($response);
        $this->assertEquals(65, Cart::count()); //10+30+20+5
        $this->assertCount(3, Cart::items());
        $this->assertCount(3, Cart::items()->groupBy('set_id')->all());

        //put in more addonable product A
        $addonableProducts = ['product_id' => $addOnableProductA->id, 'qty' => 10];

        $response = $this->putToCart($addonableProducts);

        $this->assertResponseSuccess($response);
        $this->assertEquals(75, Cart::count());//10+30+20+5+10
        $this->assertCount(4, Cart::items());
        $this->assertCount(4, Cart::items()->groupBy('set_id')->all());
    }


    /** @test */
//    public function can_remove_products_in_the_cart_from_frontend()
//    {
//        $productA = factory(Product::class)->create();
//        Cart::addItem(['product_id' => $productA->id, 'qty' => 1, 'unit_price' => 0]);
//        $this->assertNotNull(Cart::item($productA->id));
//
//
//        $response = $this->json('post',
//            route('cart.update', $productA->id),
//            ['action' => 'remove']);
//
//        $response->assertSuccessful()
//            ->assertExactJson([
//                'status' => 'success',
//                'message' => 'selected product removed from the cart'
//            ]);
//
//        $this->assertNull(Cart::item($productA->id));
//    }
//
//
//    /** @test */
//    public function can_change_items_qty_in_cart()
//    {
//        $productA = factory(Product::class)->create();
//        Cart::addItem(['product_id' => $productA->id, 'qty' => 1, 'unit_price' => 0]);
//        $this->assertEquals(1, Cart::item($productA->id)['qty']);
//
//
//        $response = $this->json('post',
//            route('cart.update', $productA->id),
//            ['action' => 'update', 'qty' => 10]);
//
//        $response->assertSuccessful()
//            ->assertExactJson([
//                'status' => 'success',
//                'message' => 'selected product qty updated from the cart'
//            ]);
//
//        $this->assertEquals(10, Cart::item($productA->id)['qty']);
//    }


    public function can_make_order_with_shopping_cart()
    {
        //TODO: implement this
        //cart is empty when the order is rendered
    }


    public function can_see_cart_details()
    {
        //TODO: implement this
        //visit the page
        //see necessary information
    }


    public function only_sales_is_allowed_to_put_products_in_cart()
    {
        //TODO: implement this
    }


    public function only_signedIn_user_is_allowed_to_use_cart()
    {
        //TODO: implement this
    }
}