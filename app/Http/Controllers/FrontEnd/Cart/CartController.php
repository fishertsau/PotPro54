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

    public function update($rowId)
    {
        //todo: should validate the input has 'qty'

        $setId = Cart::item($rowId)['set_id'];


        Cart::getSetItems($setId)
            ->map(function ($item, $key) {
                return $key;
            })
            ->each(function ($rowId) {
                $item = Cart::item($rowId);
                $item['qty'] = request('qty');
                Cart::items()->put($rowId, $item);
            });
    }
}
