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
        $addOnableGroup = factory(Group::class)->states('addOnable')->create();
        $addOnableProduct = $addOnableGroup->products()->create(['title' => 'productUA']);
        $selectedProduct = ['product_id' => $addOnableProduct->id, 'qty' => 10];
        $this->putToCart($selectedProduct);
        $setId = Cart::items()->first()['set_id'];

        $addOnsInput = [
            'set_id' => $setId,
            'add_on' => [
                [
                    'addOn_id' => 1,
                    'setting' => 'AddOnA Setting'],
                [
                    'addOn_id' => 2,
                    'setting' => 'AddOnB Setting'],
            ]
        ];

        //act
        $this->post(route('cart.addAddon'), $addOnsInput);

        //assert
        collect($addOnsInput['add_on'])
            ->each(function ($addon) use ($setId) {
                $cartAddOn = Cart::getSetItems($setId)
                    ->where('addOn_id', $addon['addOn_id'])->first();

                $this->assertEquals($setId, $cartAddOn['set_id']);
                $this->assertEquals('addOn', Cart::type($cartAddOn));
                $this->assertEquals($addon['addOn_id'], $cartAddOn['addOn_id']);
                $this->assertEquals(10, $cartAddOn['qty']);
                $this->assertEquals($addon['setting'], $cartAddOn['setting']);
            });
    }


    /** @test */
    public function can_remove_item_in_cart_from_frontend()
    {
        Cart::items()->put('a', ['set_id' => 's1', 'dataA' => 'dataA']);
        Cart::items()->put('b', ['set_id' => 's1', 'dataB' => 'dataB']);
        $this->assertNotNull(Cart::items()->get('a'));
        $this->assertNotNull(Cart::items()->get('b'));

        $rowId = 'a';
        $this->delete(route('cart.removeItem', ['rowId' => $rowId]));

        $this->assertNull(Cart::items()->get('a'));
        $this->assertNotNull(Cart::items()->get('b'));
    }


    /** @test */
    public function addOn_qty_is_updated_along_with_product_qty_update()
    {
        $addOnableGroup = factory(Group::class)->states('addOnable')->create();
        $addOnableProduct = $addOnableGroup->products()->create(['title' => 'productA']);

        //put product in cart
        $selectedProduct = ['product_id' => $addOnableProduct->id, 'qty' => 3];
        $this->putToCart($selectedProduct);
        $rowId = Cart::items()->keys()->first();
        $setId = collect(Cart::items()->where('product_id', $addOnableProduct->id)->all())
            ->first()['set_id'];

        //put add on for product
        $addOnsInput = [
            'set_id' => $setId,
            'add_on' => [
                [
                    'addOn_id' => 1,
                    'setting' => 'AddOnA Setting'],
                [
                    'addOn_id' => 2,
                    'setting' => 'AddOnB Setting'],
            ]
        ];
        $this->post(route('cart.addAddon'), $addOnsInput);
        $this->assertEquals(3, Cart::item($rowId)['qty']);
        collect($addOnsInput['add_on'])
            ->each(function ($addon) use ($setId) {
                $cartAddOn = Cart::getSetItems($setId)
                    ->where('addOn_id', $addon['addOn_id'])->first();
                $this->assertEquals(3, $cartAddOn['qty']);
            });


        //act: update product in cart
        $this->put(route('cart.update', $rowId), ['qty' => 10]);


        //assert
        $this->assertEquals(10, Cart::item($rowId)['qty']);
        collect($addOnsInput['add_on'])
            ->each(function ($addon) use ($setId) {
                $cartAddOn = Cart::getSetItems($setId)
                    ->where('addOn_id', $addon['addOn_id'])->first();
                $this->assertEquals(10, $cartAddOn['qty']);
            });
    }

    /** @test */
    public function addOn_qty_in_another_set_doesNot_change_when_product_qty_updated()
    {
        $addOnableGroup = factory(Group::class)->states('addOnable')->create();
        $addOnableProduct = $addOnableGroup->products()->create(['title' => 'productA']);
        $addOnableProductB = $addOnableGroup->products()->create(['title' => 'productB']);

        //*** First put an addonable product and some addons in cart
        //put product in cart
        $selectedProduct = ['product_id' => $addOnableProduct->id, 'qty' => 3];
        $this->putToCart($selectedProduct);
        $rowId = Cart::items()->keys()->first();

        //*** Secondly, put another product and some addons in cart
        //put productB in cart
        $selectedProductB = ['product_id' => $addOnableProductB->id, 'qty' => 5];
        $this->putToCart($selectedProductB);
        $setIdB = collect(Cart::items()->where('product_id', $addOnableProductB->id)->all())
            ->first()['set_id'];

        //put add on for productB
        $addOnsInputB = [
            'set_id' => $setIdB,
            'add_on' => [
                [
                    'addOn_id' => 1,
                    'setting' => 'AddOnA Setting'],
                [
                    'addOn_id' => 2,
                    'setting' => 'AddOnB Setting'],
            ]
        ];
        $this->post(route('cart.addAddon'), $addOnsInputB);
        collect($addOnsInputB['add_on'])
            ->each(function ($addon) use ($setIdB) {
                $cartAddOn = Cart::getSetItems($setIdB)
                    ->where('addOn_id', $addon['addOn_id'])->first();
                $this->assertEquals(5, $cartAddOn['qty']);
            });


        //act: update product in cart
        $this->put(route('cart.update', $rowId), ['qty' => 10]);

        //assert
        //Addon Qty for 2nd product is not changed
        collect($addOnsInputB['add_on'])
            ->each(function ($addon) use ($setIdB) {
                $cartAddOn = Cart::getSetItems($setIdB)
                    ->where('addOn_id', $addon['addOn_id'])->first();
                $this->assertEquals(5, $cartAddOn['qty']);
            });
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