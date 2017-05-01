<?php

namespace Acme\Order;


class Cart
{
    //cart should be persisted into session

    private $items = [];

    /**
     * Cart constructor.
     * @param array $items
     */
    public function __construct()
    {
        $this->items = collect();
    }


    public function items()
    {
        return $this->items;
    }


    public function addItem(array $productInfo = [])
    {
        $id = $productInfo['product_id'];

        if ($oldProduct = $this->findItemInCart($id)) {
            $key = $oldProduct['product_id'];
            $updatedProduct = [
                'product_id' => $key,
                'qty' => $oldProduct['qty'] + $productInfo['qty']
            ];
            $this->items->pull($key);
            $this->items->put($key, $updatedProduct);
            return;
        }

        $this->items->put($id, $productInfo);
    }


    public function count()
    {
        return $this->items->sum('qty');
    }

    public function item($id)
    {
        if ($this->findItemInCart($id)) {
            return $this->items[$id];
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

    public function remove($id)
    {
        $item = $this->item($id);

        $this->items->pull($item['product_id']);
    }

    public function update($productInfo)
    {
        $this->remove($productInfo['product_id']);
        $this->addItem($productInfo);
    }

    public function flush()
    {
        $this->items = collect([]);
    }
}