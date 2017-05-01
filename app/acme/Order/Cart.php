<?php

namespace Acme\Order;


class Cart
{
    private $session;

    /**
     * Cart constructor.
     * @param $session
     * @internal param array $items
     */
    public function __construct($session)
    {
        $this->session = $session;
        $this->session->put('cart.items', collect());
    }


    public function items()
    {
        return $this->session->get('cart.items');
    }


    public function addItem(array $productInfo = [])
    {
        $id = $productInfo['product_id'];

        if ($oldProduct = $this->findItemInCart($id)) {
            $updatedProduct = [
                'product_id' => $id,
                'qty' => $oldProduct['qty'] + $productInfo['qty'],
                'sub_total' => ($oldProduct['qty'] + $productInfo['qty']) * $productInfo['unit_price']
            ];

            $this->doUpdateItem($id, $updatedProduct);
            return;
        }

        $productInfo['sub_total'] = $productInfo['unit_price'] * $productInfo['qty'];
        $this->items()->put($id, $productInfo);
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
    public function update($productInfo)
    {
        $this->remove($productInfo['product_id']);
        $this->addItem($productInfo);
    }


    public function destroy()
    {
        $this->session->put('cart.items', collect());
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
}