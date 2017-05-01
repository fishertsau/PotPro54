<?php

namespace App\Http\Controllers\FrontEnd\Cart;

use App;
use Acme\Facade\Cart;
use App\Http\Controllers\Controller;

class CartController extends Controller
{

    public function addItem()
    {
        Cart::addItem(request()->all());

        return response()->json([
            'status' => 'success',
            'message' => 'products added into the cart'
        ]);
    }

    public function update($itemId)
    {
        if (request('action') == 'remove') {
            Cart::remove($itemId);
            return response()->json([
                'status' => 'success',
                'message' => 'selected product removed from the cart'
            ]);
        }

        Cart::update([
            'product_id' => $itemId,
            'qty' => request('qty')
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'selected product qty updated from the cart'
        ]);
    }
}
