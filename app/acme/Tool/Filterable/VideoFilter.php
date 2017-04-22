<?php

namespace Acme\Tool\Filterable;


use App\Models\Marketing\Video;

class VideoFilter extends Filterable
{
    public $queryTermKeys = [
        'keyword',
        'active'
    ];

    /**
     * @param array $queryTerm
     * @param $admin
     * @return mixed
     */
    protected function modelQueryBuilder(array $queryTerm, $admin)
    {
        return Video::status($queryTerm['active'])
            ->keyword($queryTerm['keyword']);
    }
}