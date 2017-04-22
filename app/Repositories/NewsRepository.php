<?php

namespace App\Repositories;

use Session;
use App\Http\Requests;
use App\Models\Marketing\News;
use App\Http\Controllers\Controller;

class NewsRepository extends Controller
{
    /*** �d�߱���W��***/
    protected static $queryTermName = 'newsQueryTerm';

    /** �d�߱���**/
    protected static $queryTermList = [
        'status_flag' => true,
        'location' => '',
        'begin_since' => '',
        'end_until' => '',
        'keyword' => ''
    ];


    protected function setDefaultQueryTerm()
    {
        Session::put(self::$queryTermName, self::$queryTermList);
    }


    /**
     * @param array $queryTermForSearch
     * @return mixed
     */
    protected function makeNewsQuery($queryTermForSearch = [])
    {
        $newss = News::
        latest('id')->

        //�̷s�������A
        status($queryTermForSearch['status_flag'])->

        //�̷s������m
        location($queryTermForSearch['location'])->

        //����r�d��
        keyword($queryTermForSearch['keyword'])->

        //����϶�
        effectiveBetween($queryTermForSearch['begin_since'], $queryTermForSearch['end_until'])->

        paginate(10);

        return $newss;
    }

}
