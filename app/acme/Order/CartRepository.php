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

        if ($oldProduct = $this->findProduct($productId)) {
            $this->updateProductItem($productInfo, $oldProduct, $productId);
            return;
        }

        $this->generateNewProductItem($productInfo);
    }

    public function addAddon(array $addOnInfo = [])
    {
        $rowId = $this->generateRowId($addOnInfo['set_id'], $addOnInfo['addOn_id'], $addOnInfo);
        $this->items()->put($rowId, $addOnInfo);
    }


    public function count()
    {
        return $this->items()->sum('qty');
    }


    public function destroy()
    {
        $this->cart->put('cart.items', collect());
    }

    public function remove($rowId)
    {
        $setId = $this->items()->get($rowId)['set_id'];

        $this->items()->forget($rowId);

        //todo: should only proceed when the deleted item  type is 'product'
        //if item type === 'product'
        $this->getSetItems($setId)
            ->filter(function ($item, $key) {
                return $this->type($item) === 'addOn';
            })
            ->each(function ($item, $rowId) {
                $this->items()->forget($rowId);
            });
    }


    /**
     * @param $key
     * @param $updatedProduct
     */
    private function doUpdateProductItem($key, $updatedProduct)
    {
        $this->items()->pull($key);
        $this->items()->put($key, $updatedProduct);
    }

    public function getSetItems($setId)
    {
        return collect($this->items()->where('set_id', $setId)->all());
    }

    public function findProduct($id)
    {
        return $this->items()->where('product_id', $id)->first();
    }

    public function getAddon($setId, $addOnId)
    {
        return $this->items()
            ->where('set_id', $setId)
            ->where('addOn_id', $addOnId)
            ->first();
    }

    public function getProduct($setId, $productId)
    {
        return $this->items()
            ->where('set_id', $setId)
            ->where('product_id', $productId)
            ->first();
    }


    /**
     * @param array $productInfo
     */
    private function generateNewProductItem(array $productInfo)
    {
        $setId = $this->items()->pluck('set_id')->max() + 1;
        $productInfo['set_id'] = $setId;

        $rowId = $this->generateRowId($setId, $productInfo['product_id'], $productInfo);
        $this->items()->put($rowId, $productInfo);
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

    /**
     * @param array $productInfo
     * @param $oldProduct
     * @param $productId
     */
    private function updateProductItem(array $productInfo, $oldProduct, $productId)
    {
        $setId = $oldProduct['set_id'];
        $rowId = $this->generateRowId($setId, $productId, $productInfo);

        $updatedProduct = [
            'set_id' => $setId,
            'product_id' => $productId,
            'qty' => $oldProduct['qty'] + $productInfo['qty'],
        ];

        $this->doUpdateProductItem($rowId, $updatedProduct);
    }

    /**
     * @param $setId
     * @param $entityId
     * @return string
     */
    private function generateRowId($setId, $entityId, $item = 'undefined'): string
    {
        return md5($setId . $entityId . $this->type($item));
    }
}