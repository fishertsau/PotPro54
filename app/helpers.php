<?php

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

function showStatus($status = null)
{
    return ($status) ? "上架" : '<span style="color:red">下架</span>';
}

function showActivation($activated = null)
{
    return ($activated) ? "開通" : '<span style="color:red">未開通</span>';
}

function showHot($hot)
{
    return ($hot) ? '<span style="color:red">熱門</span>' : '';
}

/**
 *organize the pagination info for view display
 * @param Illuminate\Pagination\Paginator
 * @reutrn object
 */
function getPager(Illuminate\Pagination\LengthAwarePaginator $paginator)
{
    $result = [
        'total' => $paginator->total(),
        'currentPage' => $paginator->currentPage(),
        'lastPage' => $paginator->lastPage()];

    return json_decode(collect($result)->toJson());
}


/**
 * organize the query condition for SQL query
 *
 * @param Request
 * @return array QueryCondition
 * */
function getQueryCondition(Request $request)
{
    //$qC = $queryCondition
    $qC = [
        'keyword' => $request->get('keyword'),
        'category' => $request->get('category'),
        'subCategory' => $request->get('subCategory'),
        'location' => $request->get('location')
    ];

    if ($qC['keyword'] == '') {
        $qC['keyword'] = '%';
    } elseif (!(substr($qC['keyword'], 0) == '%')) {
        $qC['keyword'] = '%' . $qC['keyword'] . '%';
    }

    if ($qC['category'] == '' or $qC['category'] == 0) $qC['category'] = '%';

    if ($qC['subCategory'] == '' or $qC['subCategory'] == 0) $qC['subCategory'] = '%';

    if ($qC['location'] == '' or $qC['location'] == 0) $qC['location'] = '%';

    return $qC; //query condition
}


/**
 * The function is to get the instances of the designated class from the id list
 * @param null $queryResult
 * @param null $DBClass
 * @return mixed //The instance collection of the designated class
 */
function getQueryInstances($queryResult = null, $DBClass = null)
{
    $chosenList = [];
    foreach ($queryResult->items() as $item) {
        $chosenList[] = $item->id;
    }

    return $DBClass::whereIn('id', $chosenList)
        ->get();
}

//function makeJoinQueryFor2Tables($queryCondition = [], $primaryTable, $joinedTable, $itemsPerPage = 10, $joinedTableForeignKey = null)
//{
//    $primaryTableId = $primaryTable . "." . 'id';
//    $joinedTableId = $joinedTable . "." . 'id';
//
//    $joinedTableForeignKey = $joinedTable . (($joinedTableForeignKey != null) ? $joinedTableForeignKey : '.' . substr($primaryTable, 0, -1) . '_id');
//
//    $categoryField = $primaryTableId;
//    $keywordField = $joinedTable . "." . 'title';
//
//    return DB::table($primaryTable)
//        ->join($joinedTable, $primaryTableId, '=', $joinedTableForeignKey)
//        ->select($joinedTableId)
//        ->where($categoryField, 'like', $queryCondition['category'])
//        ->where($keywordField, 'like', $queryCondition['keyword'])
//        ->paginate($itemsPerPage);
//}


/**
 * persist the model entry's associated data into the database.
 * @param array $tag_list
 * @param $model
 * @return bool
 * @internal param $request
 */
function syncTag($tag_list = [], $model)
{
    $tag_list = ($tag_list) ? $tag_list : [];

    $model->tags()->sync($tag_list);

    return true;
}


/**
 * Get today and make it as  string with format "yyyymmdd"
 * @return string
 */
function getTodayString()
{
    $date = (new Carbon)->toDateString('y-m-d');
    $todayString = str_replace('-', "", $date);
    return $todayString;
}

/**
 * Get today and make it as  string with format "yyyymmdd"
 * @return string
 */
function getToday()
{
    return Carbon::today()->toDateString('y-m-d');
}


/**
 *  Update the query term in session
 * @param Request $request
 * @param $queryTermList
 * @param $queryTermName
 */
function updateQueryTerm(Request $request, $queryTermList = [], $queryTermName)
{
    $termList = collect($queryTermList);

    foreach ($termList as $term) {
        $key = $queryTermName . '.' . $term;
        Session::put($key, $request->input($term));
    }
}


function makeQueryForSearch($queryTerm = [], $queryTermList = [])
{
    $termList = collect($queryTermList);

    $queryTermForSearch = [];

    foreach ($termList as $term) {
        $queryTermForSearch[$term] =
            ($queryTerm[$term] == '') ? '%' : $queryTerm[$term];
    }

    return $queryTermForSearch;
}

// Function to get the client IP address
function get_client_ip()
{
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if (getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if (getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if (getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if (getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if (getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}


// Function to get the client ip address
function get_client_ip_server()
{
    $ipaddress = '';
    if ($_SERVER['HTTP_CLIENT_IP'])
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if ($_SERVER['HTTP_X_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if ($_SERVER['HTTP_X_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if ($_SERVER['HTTP_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if ($_SERVER['HTTP_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if ($_SERVER['REMOTE_ADDR'])
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';

    return $ipaddress;
}

function showOrWarning($msg = '', $warning = '無資料')
{
    return ($msg == '') ?
        '<span class="text-danger">' . $warning . '</span>' :
        $msg;
}


/** Delete the input
 * @param null $list
 * @return bool
 */
function deleteRecord(Collection $list = null)
{
    if ((!$list) || $list->isEmpty()) {
        return false;
    }

    DB::table(getCollectionTable($list))->
    whereIn('id', getCollectionIdList($list))->
    delete();
}


function getCollectionTable(Collection $collection)
{
    return $collection[0]->getTable();
}


function getCollectionIdList(Collection $collection)
{
    $collection->transform(function ($item) {
        return $item->id;
    });

    return $collection;
}


function entryExist($table, $id)
{
    return DB::table($table)
        ->whereId($id)
        ->exists();
}


function sameStringIfChinese()
{
    return function ($string, $separator) {
        //if the input string is in Chinese characters, return the original string
        $slug = (mb_strlen($string, "Big5") == strlen($string)) ?
            $slug = strtolower(preg_replace('/[^A-Za-z0-9]+/i', $separator, $string)) :
            $string;

        return $slug;
    };
}

function normalizeTo3LetterSN($newSerial)
{
    //在字串前面加上'0'
    switch (strlen($newSerial)) {
        case 1:
            return '00' . $newSerial;
            break;
        case 2:
            return '0' . $newSerial;
            break;
        default:
            return $newSerial;
    }
}


