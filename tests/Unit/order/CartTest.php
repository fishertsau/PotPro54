<?php

namespace Tests;

use App;
use Acme\Facade\Cart;
use App\Models\Product\Product;
use Illuminate\Support\Collection;

class CartTest extends TestCase
{
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
        $productA = factory(Product::class)->make(['id' => 1]);
        $productB = factory(Product::class)->make(['id' => 2]);
        $this->assertEmpty(Cart::items());

        //add product in cart
        $selectedProducts = ['product_id' => $productA->id, 'qty' => 10, 'unit_price' => 100];
        Cart::addItem($selectedProducts);

        $this->assertEquals(10, Cart::count());
        $this->assertCount(1, Cart::items());
        $this->assertEquals($productA->id, Cart::item($productA->id)['product_id']);
        $this->assertEquals(1000, Cart::item($productA->id)['sub_total']);
        $this->assertEquals(1000, Cart::total());


        //Same product added again
        $sameProductSelected = ['product_id' => $productA->id, 'qty' => 2, 'unit_price' => 100];
        Cart::addItem($sameProductSelected);

        $this->assertEquals(12, Cart::count());
        $this->assertCount(1, Cart::items());
        $this->assertEquals($productA->id, Cart::item($productA->id)['product_id']);
        $this->assertEquals(1200, Cart::item($productA->id)['sub_total']);
        $this->assertEquals(1200, Cart::total());

        //New product selected
        $newProductSelected = ['product_id' => $productB->id, 'qty' => 100,
            'unit_price' => 150];
        Cart::addItem($newProductSelected);
        $this->assertEquals(112, Cart::count());
        $this->assertCount(2, Cart::items());
        $this->assertEquals($productB->id, Cart::item($productB->id)['product_id']);
        $this->assertEquals(15000, Cart::item($productB->id)['sub_total']);
        $this->assertEquals(16200, Cart::total());
    }


    /** @test */
    public function can_get_an_item()
    {
        $product = factory(Product::class)->make(['id' => 1]);
        $selectedProduct = ['product_id' => $product->id, 'qty' => 10, 'unit_price' => 25];
        Cart::addItem($selectedProduct);

        $item = Cart::item($product->id);

        $this->assertEquals($product->id, $item['product_id']);
        $this->assertEquals($selectedProduct['qty'], $item['qty']);
        $this->assertEquals(250, $item['sub_total']);
    }

    /** @test */
    public function return_null_if_no_product_found()
    {
        $item = Cart::item(1);

        $this->assertNull($item);
    }


    /** @test */
    public function can_remove_product()
    {
        $productA = factory(Product::class)->make(['id' => 1]);
        $productB = factory(Product::class)->make(['id' => 2]);
        $selectedProduct = ['product_id' => $productA->id, 'qty' => 10, 'unit_price' => 5];
        $newSelectedProduct = ['product_id' => $productB->id, 'qty' => 66, 'unit_price' => 3];

        Cart::addItem($selectedProduct);
        Cart::addItem($newSelectedProduct);
        $this->assertEquals(248, Cart::total());

        //act
        Cart::remove($productA->id);

        //assert
        $this->assertEquals(66, Cart::count());
        $this->assertCount(1, Cart::items());
        $this->assertEquals(198, Cart::total());
        $this->assertNull(Cart::item($productA->id));
        $this->assertNotNull(Cart::item($productB->id));
    }

    /** @test */
    public function can_update_an_item_quantity()
    {
        $product = factory(Product::class)->make(['id' => 1]);
        $selectedProduct = ['product_id' => $product->id, 'qty' => 10, 'unit_price' => 5];
        Cart::addItem($selectedProduct);
        $this->assertEquals(10, Cart::count());
        $this->assertEquals(50, Cart::total());


        $updatedItem = ['product_id' => $product->id, 'qty' => 100, 'unit_price' => 5];

        //act
        Cart::update($updatedItem);

        //assert
        $this->assertEquals(100, Cart::count());
        $this->assertEquals(500, Cart::total());
    }


    /** @test */
    public function can_destroy_the_cart()
    {
        $productA = factory(Product::class)->make(['id' => 1]);
        $productB = factory(Product::class)->make(['id' => 2]);
        $selectedProduct = ['product_id' => $productA->id, 'qty' => 10, 'unit_price' => 0];
        $newSelectedProduct = ['product_id' => $productB->id, 'qty' => 100, 'unit_price' => 0];

        Cart::addItem($selectedProduct);
        Cart::addItem($newSelectedProduct);

        //act
        Cart::destroy();

        //assert
        $this->assertEquals(0, Cart::count());
        $this->assertCount(0, Cart::items());
        $this->assertEquals(0, Cart::total());
        $this->assertNull(Cart::item($productA->id));
        $this->assertNull(Cart::item($productB->id));
    }

    //todo: input validation
//    /** @test */
//    public function enough_info_is_required_to_add_item()
//    {
//        //product_id, unit_price, qty
//        //arrange
//
//        //act
//
//        //assert
//    }


    /** @test */
    public function can_get_cart_details()
    {
        $productA = factory(Product::class)->make(['id' => 1]);
        $productB = factory(Product::class)->make(['id' => 2]);
        $selectedProduct = ['product_id' => $productA->id, 'qty' => 10, 'unit_price' => 0];
        $newSelectedProduct = ['product_id' => $productB->id, 'qty' => 100, 'unit_price' => 0];

        Cart::addItem($selectedProduct);
        Cart::addItem($newSelectedProduct);

        $cart = Cart::all();

        //assert
        $this->assertEquals(Collection::class, get_class($cart));
        $this->assertCount(2, $cart);
        $this->assertEquals(110, $cart->sum('qty'));
        $this->assertEquals(0, $cart->sum('sub_total'));
        $this->assertTrue($cart->has($productA->id));
        $this->assertTrue($cart->has($productB->id));
    }

    public function tearDown()
    {
        parent::tearDown();

        Cart::destroy();
    }
}