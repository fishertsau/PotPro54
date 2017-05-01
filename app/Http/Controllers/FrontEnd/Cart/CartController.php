<?php

namespace App\Http\Controllers\FrontEnd\Cart;

use App;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    private $cart;

    /**
     * CartController constructor.
     */
    public function __construct()
    {
        $this->cart = App::make('cart');
    }

    public function addItem()
    {
        $this->cart->addItem(request()->all());

        return response()->json([
            'status' => 'success',
            'message' => 'products added into the cart'
        ]);
    }

    public function update($itemId)
    {
        if (request('action') == 'remove') {
            $this->cart->remove($itemId);
            return response()->json([
                'status' => 'success',
                'message' => 'selected product removed from the cart'
            ]);
        }


        $this->cart->update([
            'product_id' => $itemId,
            'qty' => request('qty')
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'selected product qty updated from the cart'
        ]);
    }
}
