<?php

namespace App\Http\Controllers\FrontEnd\Cart;

//use Cart;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Http\Controllers\Controller;

class ProductOrderController extends Controller
{
//    protected $user;
//
//    protected $add_on_controller;
//
//
//    public function __construct(AddOnController $addOnController)
//    {
//        $this->middleware('activatedSales');
//        $this->user = auth()->user();
//        $this->add_on_controller = $addOnController;
//    }
//
//
//    /**
//     * @return \BladeView|bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
//     */
//    public function index()
//    {
//        $cart = $this->getGroupedCart();
//        $total = Cart::total();
//        $count = Cart::count();
//        return view('frontEnd.order.cart.cart', compact('cart', 'total', 'count'));
//    }
//
//
//    /**
//     * @param Request $request
//     * @return \BladeView|bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
//     */
//    public function addItem(Request $request)
//    {
//        if ($request->isMethod('post')) {
//
//            $product_id = $request->input('product-id');
//            $product = Product::find($product_id);
//
//            $qty = $request->input('qty');
//
//            //群組號碼
//            $group_id = $this->generateGroupId($product);
//
//            //產品價格
//            //Should the price be put to a single controller
//            $price = $product->price * $this->user->sales->discount_rate / 100;
//
//            $this->addToCart($group_id, $product, $price, $qty);
//        }
//    }
//
//
//    protected function generateGroupId($product)
//    {
//        $group_id = (string)$product->id;
//
//        //若是無法加工的產品 接傳回目前的群組號碼
//        if (!$product->group->add_on_allowed) {
//            return $group_id;
//        }
//
//        //針對可以加工的產品 判斷產品是否已經重複選擇
//        $productRowIds = Cart::search(['id' => $product->id, 'type' => 'product']);
//
//        $group_postfix = ($productRowIds == false) ?
//            (string)(collect($productRowIds)->count()) :
//            (string)(collect($productRowIds)->count() + 1);
//
//        return $group_id . '_' . $group_postfix;
//    }
//
//    public function update(Request $request, $rowId)
//    {
//        Cart::update($rowId, $request->input('qty'));
//
//        $this->updateAddOnQtyInSameGroup($rowId);
//
//        return redirect('cart');
//    }
//
//
//    protected function updateAddOnQtyInSameGroup($rowId)
//    {
//        $productRow = Cart::get($rowId);
//
//
//        $addOnRowIds = Cart::search(['groupid' => $productRow->groupid, 'type' => 'add_on']);
//
//        if (!$addOnRowIds) {
//            return false;
//        }
//
//        foreach ($addOnRowIds as $addOnRowId) {
//            $addOnRow = Cart::get($addOnRowId);
//            $qty = $productRow->qty * $addOnRow->options['unit_qty'];
//            Cart::update($addOnRowId, ['qty' => $qty]);
//        }
//
//    }
//
//
//    public function destroy(Request $request, $rowId)
//    {
//        $item = Cart::get($rowId);
//
//        //如果類別是產品 將相關的配件都刪除
//        if ($item->type == 'product') {
//            $this->add_on_controller->removeAddOn($item);
//        }
//
//        Cart::remove($rowId);
//        return redirect('cart');
//    }
//
//    protected function addToCart($group_id, $product, $price, $qty)
//    {
//        Cart::associate('Product', 'App\Models\Product')
//            ->add([
//                'id' => $product->id,
//                'name' => $product->title,
//                'qty' => $qty,
//                'price' => $price,
//                'options' => [],
//                'groupid' => $group_id,
//                'type' => 'product',
//                'note' => ''
//            ]);
//    }
//
//
//    public function getGroupedCart()
//    {
//        $cart = Cart::content();
//
//        //把同一組的產品放在一起 然後依據類型排序
//        $newCart = $cart->groupBy('groupid')->sortBy('type');
//
//        //把資料放在一個單一array, 讓view可以使用
//        $cart = collect([]);
//        foreach ($newCart as $group) {
//            foreach ($group as $item) {
//                $cart->push($item);
//            }
//        }
//
//        return $cart;
//    }
}
