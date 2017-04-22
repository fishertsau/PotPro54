<?php

namespace App\Repositories;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Example\Example;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\Tool\Filterable;

class ExampleRepository extends Filterable
{
    /** �d�߱���**/
    protected $queryTermList = [
        'activated',
        'published',
        'hot',
        'keyword_by',
        'keyword',
    ];

    /*** �d�߱���W��***/
    protected $queryTermName = 'exampleQueryTerm';


    protected function putDefaultQueryTerm()
    {
        session()->put($this->queryTermName,
            [
                'activated' => true,
                'published' => true,
                'hot' => '',
                'keyword_by' => 'user_name',
                'keyword' => ''
            ]);
    }

    public function hasUser($user_id, Request $request)
    {
        $hasUser = Example::where('user_id', $user_id)->exists();

        if ($request->ajax()) {
            return (string)$hasUser;
        }

        return $hasUser;
    }

    public function deleteManager($id, Request $request)
    {
        $example = Example::findOrFail($id);
        $example->manager_id = null;
        $example->save();

        if ($request->ajax()) {
            return (string)true;
        }

        return true;
    }

    /**
     * The real implementation of this method is in the child class
     */
    protected function doFilterWithQueryTerm()
    {
    }


    public function saveExample(Request $request, Example $example)
    {
        $example->update($request->all());

        $this->saveExampleProductIntro($request, $example);
        $this->saveExampleService($request, $example);

        return true;
    }


    protected function saveExampleProductIntro($request, $example)
    {
        ExampleProductRepository::store($request, $example);
    }


    protected function saveExampleService($request, $example)
    {
        ExampleServiceRepository::store($request, $example);
    }


    protected function createExample(Request $request)
    {
        $request['activated'] = 1;
        $request['published'] = 0;
        $example = Example::create($request->all());

        return $example;
    }

    protected function delete($example)
    {
        $this->deleteAssociatedPhotos($example);

        Example::destroy($example->id);

        return true;
    }


    private function deleteAssociatedPhotos($example)
    {
        $photoController = new PhotoController();
        $photoController->deleteCoverPhoto('examples', $example->id);
        $photoController->deletePhotos($example->photos);

        deleteRecord($example->services);
        deleteRecord($example->products);

        return true;
    }

    /** The real implementation is in child class
     * @param Request $request
     */
    public function makeList(Request $request)
    {}
}
