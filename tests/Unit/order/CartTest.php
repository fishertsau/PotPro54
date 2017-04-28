<?php

namespace Tests;

//use Acme\Order\Cart;
use App;
use App\Models\Product\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

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
//        $this->disableExceptionHandling();
//
//        $productA = factory(Product::class)->make(['id' => 1]);
//        $productB = factory(Product::class)->make(['id' => 2]);
//        $selectedProducts = ['qty' => 10, 'product_id' => $productA->id];
//        $this->assertEmpty($this->cart->products());
//
//
//        $this->cart->addItem($selectedProducts);
//
//        $this->assertEquals($this->cart->count(), 10);
//        $this->assertCount(1, $this->cart->products());
//        $this->assertEquals($this->cart->products()->first()['product_id'], $productA->id);
//
//
//        //Same product selected again
//        $sameProductSelected = ['qty' => 2, 'product_id' => $productA->id];
//        $this->cart->addItem($sameProductSelected);
//        $this->assertEquals($this->cart->count(), 12);
//        $this->assertCount(1,$this->cart->products());
//        $this->assertEquals($this->cart->products()[0]->id, $productA->id);
//
//
//        //New product selected
//        $sameProductSelected = ['qty' => 100, 'product_id' => $productB->id];
//        $this->cart->addItem($sameProductSelected);
//        $this->assertEquals($this->cart->count(), 112);
//        $this->assertCount($this->cart->products(), 2);
    }

    //can remove product
    //can change product qty
    //can know the sum
    //can know the product count


    //clear up the cart every time after each test
    public function tearDown()
    {
        parent::tearDown();

//        $this->cart->flush();
    }
}