<?php


namespace Acme\Tool\Filterable;


/**
 * Interface FilterableInterface
 * @package Acme\Tool\Filterable
 */
interface FilterableInterface
{
    /**
     * @param array $queryTerm
     * @param bool|false $admin
     * @return mixed
     */
    public function getList($queryTerm = [], $admin = false);
}