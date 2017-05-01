<?php

namespace Tests;

use App\Models\Product\Product;

class CartTest extends TestCase
{
    private $cart;

    protected function setUp()
    {
        parent::setUp();
        $this->cart = resolve('cart');
    }


    /** @test */
    public function can_add_product()
    {
        $productA = factory(Product::class)->make(['id' => 1]);
        $productB = factory(Product::class)->make(['id' => 2]);
        $selectedProducts = ['product_id' => $productA->id, 'qty' => 10];
        $this->assertEmpty($this->cart->items());

        //add product in cart
        $this->cart->addItem($selectedProducts);

        $this->assertEquals($this->cart->count(), 10);
        $this->assertCount(1, $this->cart->items());
        $this->assertEquals($this->cart->items()->first()['product_id'], $productA->id);

        //Same product added again
        $sameProductSelected = ['product_id' => $productA->id, 'qty' => 2];
        $this->cart->addItem($sameProductSelected);

        $this->assertEquals($this->cart->count(), 12);
        $this->assertCount(1, $this->cart->items());
        $this->assertEquals($this->cart->items()->first()['product_id'], $productA->id);

        //New product selected
        $newProductSelected = ['product_id' => $productB->id, 'qty' => 100];
        $this->cart->addItem($newProductSelected);
        $this->assertEquals($this->cart->count(), 112);
        $this->assertCount(2, $this->cart->items());
    }


    /** @test */
    public function can_get_an_item()
    {
        $product = factory(Product::class)->make(['id' => 1]);
        $selectedProduct = ['product_id' => $product->id, 'qty' => 10];
        $this->cart->addItem($selectedProduct);

        $item = $this->cart->item($product->id);

        $this->assertEquals($item['product_id'], $product->id);
        $this->assertEquals($item['qty'], $selectedProduct['qty']);
    }

    /** @test */
    public function return_null_if_no_product_found()
    {
        $item = $this->cart->item(1);

        $this->assertNull($item);
    }


    /** @test */
    public function can_remove_product()
    {
        $productA = factory(Product::class)->make(['id' => 1]);
        $productB = factory(Product::class)->make(['id' => 2]);
        $selectedProduct = ['product_id' => $productA->id, 'qty' => 10];
        $newSelectedProduct = ['product_id' => $productB->id, 'qty' => 100];

        $this->cart->addItem($selectedProduct);
        $this->cart->addItem($newSelectedProduct);

        //act
        $this->cart->remove($productA->id);

        //assert
        $this->assertEquals(100, $this->cart->count());
        $this->assertCount(1, $this->cart->items());
        $this->assertNull($this->cart->item($productA->id));
        $this->assertNotNull($this->cart->item($productB->id));
    }

    /** @test */
    public function can_update_an_item_quantity()
    {
        $product = factory(Product::class)->make(['id' => 1]);
        $selectedProduct = ['product_id' => $product->id, 'qty' => 10];
        $this->cart->addItem($selectedProduct);
        $this->assertEquals(10, $this->cart->count());


        $updatedItem = ['product_id' => $product->id, 'qty' => 100];

        //act
        $this->cart->update($updatedItem);

        //assert
        $this->assertEquals(100, $this->cart->count());
    }






    /** @test */
    public function can_flush_the_cart()
    {
        $productA = factory(Product::class)->make(['id' => 1]);
        $productB = factory(Product::class)->make(['id' => 2]);
        $selectedProduct = ['product_id' => $productA->id, 'qty' => 10];
        $newSelectedProduct = ['product_id' => $productB->id, 'qty' => 100];

        $this->cart->addItem($selectedProduct);
        $this->cart->addItem($newSelectedProduct);

        //act
        $this->cart->flush();

        //assert
        $this->assertEquals(0, $this->cart->count());
        $this->assertCount(0, $this->cart->items());
        $this->assertNull($this->cart->item($productA->id));
        $this->assertNull($this->cart->item($productB->id));
    }

    //can know the sum
    //todo: add in price info, so that the cart can know the sum

    //add item validation
    //TODO: validate required information when adding item

    //can see the detail of cart
    //TODO: implement  $cart->all();

    public function tearDown()
    {
        parent::tearDown();

        $this->cart->flush();
    }
}