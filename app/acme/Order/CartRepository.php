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



    public function addProduct(array $productInfo = [])
    {
        $productId = $productInfo['product_id'];

        if (Product::find($productId)->addonable) {
            $this->generateNewProductItem($productInfo);
            return;
        }

        if ($oldProduct = $this->findProductItemInCart($productId)) {
            $this->updateProductItem($productInfo, $oldProduct, $productId);
            return;
        }

        $this->generateNewProductItem($productInfo);
    }

    public function addAddon(array $addOnInfo = [])
    {
        $rowId = $this->items()->count() + 1;
        $this->items()->put($rowId, $addOnInfo);
    }


    public function count()
    {
        return $this->items()->sum('qty');
    }


    private function findProductItemInCart($id)
    {
        return $this->items()->where('product_id', $id)->first();
    }


    public function destroy()
    {
        $this->cart->put('cart.items', collect());
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
    private function generateNewProductItem(array $productInfo)
    {
        $setId = $this->items()->count() + 1;
        $productInfo['set_id'] = $setId;
        $this->items()->put($setId, $productInfo);
    }

    private function updateProductItem(array $productInfo, $oldProduct, $id)
    {
        $setId = $oldProduct['set_id'];
        $updatedProduct = [
            'set_id' => $setId,
            'product_id' => $id,
            'qty' => $oldProduct['qty'] + $productInfo['qty'],
        ];

        $this->doUpdateItem($setId, $updatedProduct);
    }


    public function type($item)
    {
        $item = collect($item);

        if ($item->has('addOn_id')) {
            return 'addOn';
        }

        if ($item->has('product_id')) {
            return 'product';
        }

        return 'undefined';
    }
}