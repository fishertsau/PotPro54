<?php

namespace App\Traits;

use Session;

trait Queryable
{
    /*** �d�߱���W��***/
    protected static $queryTermName;

    /** �d�߱���**/
    protected static $queryTermList;


    protected function setDefaultQueryTerm()
    {
        Session::put(self::$queryTermName, self::$queryTermList);
    }
}