<?php

namespace Acme\Order;


use App\Models\Product\Product;

class CartRepository
{
    private $cart;

    /**
     * Cart constructor.
     * @internal param array $items
     * @param $session
     */
    public function __construct($session)
    {
        $this->cart = $session;
        $this->cart->put('cart.items', collect());
    }


    public function items()
    {
        return $this->cart->get('cart.items');
    }


    public function addItem(array $productInfo = [])
    {
        $productId = $productInfo['product_id'];

        if (Product::find($productId)->addonable) {
            $this->generateNewItem($productInfo);
            return;
        }

        if ($oldProduct = $this->findItemInCart($productId)) {
            $this->updateOldItem($productInfo, $oldProduct, $productId);
            return;
        }

        $this->generateNewItem($productInfo);
    }


    public function total()
    {
        return $this->items()->sum('sub_total');
    }

    public function count()
    {
        return $this->items()->sum('qty');
    }

    public function item($id)
    {
        if ($this->findItemInCart($id)) {
            return $this->items()[$id];
        }

        return null;
    }

    /**
     * @param $id
     * @return mixed
     */
    private function findItemInCart($id)
    {
        return $this->items()->where('product_id', $id)->first();
    }

    /**
     * @param $id
     */
    public function remove($id)
    {
        $item = $this->item($id);
        $this->items()->pull($item['product_id']);
    }

    /**
     * @param $productInfo
     */
//    public function update($productInfo)
//    {
//        $this->remove($productInfo['product_id']);
//        $this->addItem($productInfo);
//    }


    public function destroy()
    {
        $this->cart->put('cart.items', collect());
    }

    public function all()
    {
        return $this->items();
    }

    /**
     * @param $key
     * @param $updatedProduct
     */
    private function doUpdateItem($key, $updatedProduct)
    {
        $this->items()->pull($key);
        $this->items()->put($key, $updatedProduct);
    }

    public function setItems($setId)
    {
        return collect($this->items()->where('set_id', $setId)->all());
    }

    /**
     * @param array $productInfo
     */
    private function generateNewItem(array $productInfo)
    {
        $setId = $this->items()->count() + 1;
        $productInfo['set_id'] = $setId;
        $productInfo['sub_total'] = $productInfo['unit_price'] * $productInfo['qty'];
        $this->items()->put($setId, $productInfo);
    }

    /**
     * @param array $productInfo
     * @param $oldProduct
     * @param $id
     */
    private function updateOldItem(array $productInfo, $oldProduct, $id)
    {
        $setId = $oldProduct['set_id'];
        $updatedProduct = [
            'set_id' => $setId,
            'product_id' => $id,
            'qty' => $oldProduct['qty'] + $productInfo['qty'],
            'sub_total' => ($oldProduct['qty'] + $productInfo['qty']) * $productInfo['unit_price']
        ];

        $this->doUpdateItem($setId, $updatedProduct);
    }
}