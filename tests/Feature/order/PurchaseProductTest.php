<?php

namespace Tests;


use Acme\Facade\Cart;
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


    /** @test */
    public function can_put_products_in_the_cart_from_frontend()
    {
        $productA = factory(Product::class)->create();
        $productB = factory(Product::class)->create();

        $selectedItems = ['product_id' => $productA->id, 'qty' => 10];

        $response = $this->json('post', route('cart.addItem'), $selectedItems);

        $response->assertSuccessful()
            ->assertExactJson([
                'status' => 'success',
                'message' => 'products added into the cart'
            ]);

        $this->assertEquals(10, Cart::count());
        $this->assertEquals(Cart::items()->first()['product_id'], $productA->id);
        $this->assertCount(1, Cart::items());


        //put more items with the same idn in cart
        $moreSameProductItems = ['product_id' => $productA->id, 'qty' => 30];
        $response = $this->json('post', route('cart.addItem'), $moreSameProductItems);

        $response->assertSuccessful()
            ->assertExactJson([
                'status' => 'success',
                'message' => 'products added into the cart'
            ]);

        $this->assertEquals(40, Cart::count());
        $this->assertEquals(Cart::items()->first()['product_id'], $productA->id);
        $this->assertCount(1, Cart::items());


        //different product items
        $differentProductMoreItems = ['product_id' => $productB->id, 'qty' => 20];
        $response = $this->json('post', route('cart.addItem'), $differentProductMoreItems);

        $response->assertSuccessful()
            ->assertExactJson([
                'status' => 'success',
                'message' => 'products added into the cart'
            ]);

        $this->assertEquals(60, Cart::count());
        $this->assertCount(2, Cart::items());
    }


    /** @test */
    public function can_remove_products_in_the_cart_from_frontend()
    {
        $productA = factory(Product::class)->create();
        Cart::addItem(['product_id' => $productA->id, 'qty' => 1]);
        $this->assertNotNull(Cart::item($productA->id));


        $response = $this->json('post',
            route('cart.update', $productA->id),
            ['action' => 'remove']);

        $response->assertSuccessful()
            ->assertExactJson([
                'status' => 'success',
                'message' => 'selected product removed from the cart'
            ]);

        $this->assertNull(Cart::item($productA->id));
    }


    /** @test */
    public function can_change_items_qty_in_cart()
    {
        $productA = factory(Product::class)->create();
        Cart::addItem(['product_id' => $productA->id, 'qty' => 1]);
        $this->assertEquals(1, Cart::item($productA->id)['qty']);


        $response = $this->json('post',
            route('cart.update', $productA->id),
            ['action' => 'update', 'qty' => 10]);

        $response->assertSuccessful()
            ->assertExactJson([
                'status' => 'success',
                'message' => 'selected product qty updated from the cart'
            ]);

        $this->assertEquals(10, Cart::item($productA->id)['qty']);
    }


    public function can_make_order_with_shopping_cart()
    {
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

    }


    public function only_signedIn_user_is_allowed_to_use_cart()
    {

    }
}