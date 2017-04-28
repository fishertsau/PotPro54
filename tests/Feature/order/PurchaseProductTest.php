<?php

namespace Tests;


use App;
use App\User;
use Tests\TestCase;
use App\Models\Product\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PurchaseProductTest extends TestCase
{
    /** @test */
    public function an_signed_in_user_can_put_products_in_the_cart_from_frontend()
    {
        //Todo: implement this
        //arrange
//        $product = factory(Product::class)->create([
//            'title' => 'A New product',
//            'list_price' => 5000
//        ]);
//
//        $this->actingAs($user = factory(User::class)->create());
//
//        $selectedProduct = ['qyt' => 10, $product->id];
//
//        //act
//        $response = $this->json('post', route('cart.add'), $selectedProduct);
//
//        //assert
//        $response->assertSuccessful()
//            ->assertExactJson([
//                'status' => 'success',
//                'message' => 'products added into the cart'
//            ]);
//
//        $cart = App::make(Cart::class);
//
//        $this->assertEquals($cart->itemCount(), 10);
//        $this->assertEquals($cart->products()->first(), $product);
////        $this->assertEquals($cart->sum(), TBD);
//        //price = list price * discount rate
    }


    public function an_singed_in_user_can_remove_products_in_the_cart_from_frontend()
    {

    }


    public function an_signed_in_user_can_change_products_qty_in_the_cart()
    {

    }


    public function can_put_the_cart_to_order()
    {
        //cart is empty when the order is rendered
    }

    public function can_see_cart_details()
    {

    }

    public function only_sales_is_allowed_to_put_products_in_cart()
    {

    }
}