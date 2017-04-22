<?php

namespace Acme\Repositories;


use App\Models\Product\Product;

class ProductRepository
{
    public function create($newProductAttribute)
    {
        return Product::create($newProductAttribute);
    }

    public function update(Product $product, array $updatedInfo)
    {
        $product->update($updatedInfo);
        return $product->fresh();
    }
}