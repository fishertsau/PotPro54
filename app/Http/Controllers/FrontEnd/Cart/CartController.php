<?php

namespace App\Http\Controllers\FrontEnd\Cart;

use App;
use Acme\Facade\Cart;
use App\Http\Controllers\Controller;

class CartController extends Controller
{

    public function addItem()
    {
        //todo: unit price should be got somewhere else
        $itemInfo = [
            'product_id' => request('product_id'),
            'qty' => request('qty'),
            'unit_price' => 0
        ];

        Cart::addItem($itemInfo);

        return response()->json([
            'status' => 'success',
            'message' => 'products added into the cart'
        ]);
    }


//    public function update($itemId)
//    {
//        if (request('action') == 'remove') {
//            Cart::remove($itemId);
//            return response()->json([
//                'status' => 'success',
//                'message' => 'selected product removed from the cart'
//            ]);
//        }
//
//        //todo: unit price should be got somewhere else
//        Cart::update([
//            'product_id' => $itemId,
//            'qty' => request('qty'),
//            'unit_price' => 0
//        ]);
//
//        return response()->json([
//            'status' => 'success',
//            'message' => 'selected product qty updated from the cart'
//        ]);
//    }
}
