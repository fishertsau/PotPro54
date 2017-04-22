<?php

namespace App\Http\Controllers\FrontEnd;

use Response;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Example\Example;
use App\Repositories\ExampleRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ExampleController extends ExampleRepository
{
    /** This property override the ExampleRepository
     * @var string
     */
    protected $queryTermName = 'frontExampleQueryTerm';


    /** Display the example for front view
     * @param Request $request
     * @return \BladeView|bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        if ($request->has('newSearch')) {
            $this->updateQueryTermInSession($request);
        }

        $examples = $this->fetchFilteredList();

        $queryTerm = $this->getQueryTerm();

        return view('frontEnd.eventOrRecord.examples.exampleList', compact('examples', 'queryTerm'));
    }


    public function show($slug = '')
    {
        try {
            $example = Example::findBySlugOrFail($slug);
        } catch (ModelNotFoundException $e) {
            return Response::view('404', array(), 404);
        }

        return view('frontEnd.eventOrRecord.examples.exampleShow', compact('example'));
    }


    /**This method overrides the parent's method
     * @param array $queryTermForSearch
     * @return mixed
     */
    protected function doFilterWithQueryTerm()
    {
        $examples = Example::

        hot($this->queryTermForFilter['hot'])->

        published($this->queryTermForFilter['published'])->

        hotFirst()->

        latest('id')->

        keywordByTitle($this->queryTermForFilter['keyword'])->

        paginate(10);

        return $examples;
    }



    public function create($user_id, Request $request)
    {
        $request['user_id'] = $user_id;
        return (new ExampleRepository)->createExample($request);
    }

}
