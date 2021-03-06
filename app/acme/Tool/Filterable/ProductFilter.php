<?php

namespace Acme\Tool\Filterable;


use App\Models\Product\Product;

class ProductFilter extends Filterable
{

    public $queryTermKeys = [
        'published',
        'keyword'
    ];

    /**
     * @param array $queryTerm
     * @param $admin
     * @return mixed
     */
    protected function modelQueryBuilder(array $queryTerm, $admin)
    {
        return Product::status($queryTerm['published'])
            ->keyword($queryTerm['keyword']);
    }
}