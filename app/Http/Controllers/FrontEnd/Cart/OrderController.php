<?php

namespace App\Http\Controllers\FrontEnd\Cart;

use Cart;
use App\Http\Requests\OrderRequest;
use App\Events\Order\OrderWasCreated;
use App\Repositories\OrderRepository;

class OrderController extends OrderRepository
{
//    protected $cartController;
//
//    public function __construct(ProductOrderController $cartController)
//    {
//        $this->middleware('auth');
//        $this->middleware('activatedSales');
//        $this->cartController = $cartController;
//    }
//
//    /**
//     * @param OrderRequest $request
//     * @return \BladeView|bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
//     */
//    public function index()
//    {
//        $cart = $this->cartController->getGroupedCart();
//        $total = Cart::total();
//        $count = Cart::count();
//
//        return view('frontEnd.order.index', compact('cart', 'total', 'count'));
//    }
//
//
//    public function store()
//    {
//        $cart = $this->cartController->getGroupedCart();
//        $orderInfo = ['amount' => Cart::total(), 'qty' => Cart::count()];
//
//        $order = $this->create(auth()->user(), auth()->user(), $orderInfo);
//        $this->saveOrderItem($order, $cart);
//
//        Cart::destroy();
//
//        event(new OrderWasCreated($order));
//
//        flash()->overlay('您的訂單已經送出,我們會盡快為您處理!', '產品訂購成功');
//
//        return redirect('cart');
//    }
}
