<?php

namespace Acme\Order;


class Cart
{
    //cart should be persisted into session

    private $products = [];

    /**
     * Cart constructor.
     * @param array $products
     */
    public function __construct()
    {
        $this->products = collect();
    }


    public function products()
    {
        return $this->products;
    }


    public function addItem($productInfo)
    {
        $id = $productInfo['product_id'];

        dump($id);

        if ($this->products->has($id)) {
            dump('true');
        }

        $this->products[] = $productInfo;
    }


    public function count()
    {
        return $this->products->sum('qty');
    }
}