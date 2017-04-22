<?php


namespace App\Http\Controllers\Tool;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class Filterable extends Controller
{
    //Should be set up in the child class;
    protected $queryTermName = '';
    protected $queryTermList = [];

    //This one does not need to set in the child class
    protected $queryTermForFilter = [];

    /**
     * Filterable constructor.
     */
    public function __construct()
    {
        if (!$this->sessionHasQueryTerm()) {
            $this->putDefaultQueryTerm();
        }
    }


    abstract protected function putDefaultQueryTerm();
    abstract protected function doFilterWithQueryTerm();
    abstract public function makeList(Request $request);


    protected function updateQueryTermInSession(Request $request)
    {
        foreach (collect($this->queryTermList) as $term) {
            session()->put(
                $this->keyName($term),
                $request->input($term));
        }
    }


    /**
     *  Transform the query term to the usable and convenient format for  sql query
     * @return array
     */
    protected function makeQueryForFilter()
    {
        $queryTerm = session()->get($this->queryTermName);

        foreach ($this->queryTermList as $term) {
            $this->queryTermForFilter[$term] =
                ($queryTerm[$term] == '') ? '%' : $queryTerm[$term];
        }

        return true;
    }

    public function getQueryTerm()
    {
        return session($this->queryTermName);
    }

    /**
     * @return bool
     */
    protected function sessionHasQueryTerm()
    {
        return session()->has($this->queryTermName);
    }



    public function fetchFilteredList()
    {
        $this->makeQueryForFilter();
        return $this->doFilterWithQueryTerm();
    }



    protected function appendUriToPagination(LengthAwarePaginator $paginatedList, $uri = '')
    {
        return $paginatedList->setPath($uri);
    }

    /**
     * @param $term
     * @return string
     */
    protected function keyName($term)
    {
        return $this->queryTermName . '.' . $term;
    }
}