<?php

namespace App\Http\Controllers\FrontEnd\Cart;

use App;
use Acme\Facade\Cart;
use App\Http\Controllers\Controller;

class CartController extends Controller
{

    public function store()
    {
        //todo: unit price should be got somewhere else
        $itemInfo = [
            'product_id' => request('product_id'),
            'qty' => request('qty'),
        ];

        Cart::addProduct($itemInfo);

        return response()->json([
            'status' => 'success',
            'message' => 'products added into the cart'
        ]);
    }


    public function destroy($rowId)
    {
        Cart::remove($rowId);
    }
}
