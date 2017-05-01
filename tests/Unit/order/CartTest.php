<?php

namespace Tests;

use Acme\Facade\Cart;
use App;
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
        $selectedProducts = ['product_id' => $productA->id, 'qty' => 10];
        $this->assertEmpty(Cart::items());

        //add product in cart
        Cart::addItem($selectedProducts);

        $this->assertEquals(Cart::count(), 10);
        $this->assertCount(1, Cart::items());
        $this->assertEquals(Cart::items()->first()['product_id'], $productA->id);

        //Same product added again
        $sameProductSelected = ['product_id' => $productA->id, 'qty' => 2];
        Cart::addItem($sameProductSelected);

        $this->assertEquals(Cart::count(), 12);
        $this->assertCount(1, Cart::items());
        $this->assertEquals(Cart::items()->first()['product_id'], $productA->id);

        //New product selected
        $newProductSelected = ['product_id' => $productB->id, 'qty' => 100];
        Cart::addItem($newProductSelected);
        $this->assertEquals(Cart::count(), 112);
        $this->assertCount(2, Cart::items());
    }


    /** @test */
    public function can_get_an_item()
    {
        $product = factory(Product::class)->make(['id' => 1]);
        $selectedProduct = ['product_id' => $product->id, 'qty' => 10];
        Cart::addItem($selectedProduct);

        $item = Cart::item($product->id);

        $this->assertEquals($item['product_id'], $product->id);
        $this->assertEquals($item['qty'], $selectedProduct['qty']);
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
        $selectedProduct = ['product_id' => $productA->id, 'qty' => 10];
        $newSelectedProduct = ['product_id' => $productB->id, 'qty' => 100];

        Cart::addItem($selectedProduct);
        Cart::addItem($newSelectedProduct);

        //act
        Cart::remove($productA->id);

        //assert
        $this->assertEquals(100, Cart::count());
        $this->assertCount(1, Cart::items());
        $this->assertNull(Cart::item($productA->id));
        $this->assertNotNull(Cart::item($productB->id));
    }

    /** @test */
    public function can_update_an_item_quantity()
    {
        $product = factory(Product::class)->make(['id' => 1]);
        $selectedProduct = ['product_id' => $product->id, 'qty' => 10];
        Cart::addItem($selectedProduct);
        $this->assertEquals(10, Cart::count());

        $updatedItem = ['product_id' => $product->id, 'qty' => 100];

        //act
        Cart::update($updatedItem);

        //assert
        $this->assertEquals(100, Cart::count());
    }


    /** @test */
    public function can_destroy_the_cart()
    {
        $productA = factory(Product::class)->make(['id' => 1]);
        $productB = factory(Product::class)->make(['id' => 2]);
        $selectedProduct = ['product_id' => $productA->id, 'qty' => 10];
        $newSelectedProduct = ['product_id' => $productB->id, 'qty' => 100];

        Cart::addItem($selectedProduct);
        Cart::addItem($newSelectedProduct);

        //act
        Cart::destroy();

        //assert
        $this->assertEquals(0, Cart::count());
        $this->assertCount(0, Cart::items());
        $this->assertNull(Cart::item($productA->id));
        $this->assertNull(Cart::item($productB->id));
    }

    //can know the sum
    //todo: add in price info, so that the cart can know the sum

    //add item validation
    //TODO: validate required information when adding item


    /** @test */
    public function can_get_cart_details()
    {
        $productA = factory(Product::class)->make(['id' => 1]);
        $productB = factory(Product::class)->make(['id' => 2]);
        $selectedProduct = ['product_id' => $productA->id, 'qty' => 10];
        $newSelectedProduct = ['product_id' => $productB->id, 'qty' => 100];

        Cart::addItem($selectedProduct);
        Cart::addItem($newSelectedProduct);

        $cart = Cart::all();

        //assert
        $this->assertEquals(Collection::class, get_class($cart));
        $this->assertCount(2, $cart);
        $this->assertEquals(110, $cart->sum('qty'));
        $this->assertTrue($cart->has($productA->id));
        $this->assertTrue($cart->has($productB->id));
    }

    public function tearDown()
    {
        parent::tearDown();

        Cart::destroy();
    }
}