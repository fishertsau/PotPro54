<?php

namespace Acme\Tool\Filterable;



use App\Models\Product\Group;

class GroupFilter extends Filterable
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
        return Group::status($queryTerm['published'])
            ->keyword($queryTerm['keyword']);
    }
}