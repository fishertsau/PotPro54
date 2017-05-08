<?php

namespace Tests;


use Acme\Facade\Cart;
use App\Models\Product\AddOn;
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
        return $this->json('post', route('cart.addProduct'), $products);
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
        $unAddOnableGroup = factory(Group::class)->states('unAddOnable')->create();
        $unAddOnableProductA = $unAddOnableGroup->products()->create(['title' => 'productUA']);

        //put un-add-onable product A
        $selectedItems = ['product_id' => $unAddOnableProductA->id, 'qty' => 10];
        $response = $this->putToCart($selectedItems);

        $this->assertResponseSuccess($response);
    }


    /** @test */
    public function can_put_several_add_ons_at_one_time()
    {
        //arrange
        $addOnsInput = [
            'set_id' => 'setId',
            'add_on' => [
                [
                    'addOn_id' => 1,
                    'qty' => 10,
                    'setting' => 'AddOnA Setting'],
                [
                    'addOn_id' => 2,
                    'qty' => 5,
                    'setting' => 'AddOnB Setting'],
            ]
        ];

        $this->post(route('cart.addAddon'), $addOnsInput);


        collect($addOnsInput['add_on'])
            ->each(function ($addon) {
                $cartAddOn = Cart::items()
                    ->where('addOn_id', $addon['addOn_id'])->first();

                $this->assertEquals('setId', $cartAddOn['set_id']);
                $this->assertEquals('addOn', Cart::type($cartAddOn));
                $this->assertEquals($addon['addOn_id'], $cartAddOn['addOn_id']);
                $this->assertEquals($addon['qty'], $cartAddOn['qty']);
                $this->assertEquals($addon['setting'], $cartAddOn['setting']);
            });
    }


    /** @test */
    public function can_remove_item_in_cart_from_frontend()
    {
        Cart::items()->put('a', ['set_id'=>'s1','dataA' => 'dataA']);
        Cart::items()->put('b', ['set_id'=>'s1','dataB' => 'dataB']);
        $this->assertNotNull(Cart::items()->get('a'));
        $this->assertNotNull(Cart::items()->get('b'));

        $rowId = 'a';
        $this->delete(route('cart.removeItem', ['rowId' => $rowId]));

        $this->assertNull(Cart::items()->get('a'));
        $this->assertNotNull(Cart::items()->get('b'));
    }


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

    /** @test */
    public function can_update_addons_for_a_set()
    {

        //arrange

        //act

        //assert
    }


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