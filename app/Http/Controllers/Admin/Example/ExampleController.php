<?php

namespace App\Http\Controllers\Admin\Example;

use Lang;
use App\Http\Requests;
use App\Models\Example\Example;
use Illuminate\Http\Request;
use Mockery\CountValidator\Exception;
use App\Http\Requests\ExampleRequest;
use App\Repositories\ExampleRepository;

/**
 * Class ExampleController
 * @package App\Http\Controllers\Admin
 */
class ExampleController extends ExampleRepository
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $queryTerm = $this->getQueryTerm();

        return view('admin.example.index', compact('queryTerm'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.example.create.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ExampleRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExampleRequest $request)
    {
        $this->authorize('edit-example');
        $example = $this->createExample($request);
        flash()->success('您剛剛新增了節能案例!');
        return redirect($this->redirectToEdit($example->id));
    }

    /**
     * Display the specified resource.
     *
     * @param Example $example
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function show(Example $example)
    {
        return view('admin.example.show', compact('example'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Example $example)
    {
        return view('admin.example.edit.edit', compact('example'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ExampleRequest|Request $request
     * @param Example $example
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(Request $request, Example $example)
    {
        $this->authorize('edit-example');

        $this->saveExample($request, $example);

        flash()->success('您剛剛修改了節能案例!');

        return redirect('\admin\example');
    }


    protected function redirectToEdit($id)
    {
        return 'admin\example\\' . $id . '\edit';
    }


    /**
     * Delete confirmation for the given Video.
     *
     * @param  int $id
     * @return View
     */
    public function getModalDelete($id = null)
    {
        $error = '請注意.刪除的資料無法復原! 確認要刪除?';
        $model = '';
        $confirm_route = route('admin.example.delete', ['id' => $id]);
        return View('admin/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
    }

    /**
     * Delete the given Example.
     *
     * @param  int $id
     * @return Redirect
     */
    public function getDelete($id = null)
    {
        try {
            $example = Example::findOrfail($id);
        } catch (Exception $e) {
            flash()->overlay('找不到要編輯的資料');
            return redirect()->back();
        }

        $this->delete($example);

        flash()->error('案例已被刪除');

        return redirect('admin/example')->with('success', Lang::get('message.success.delete'));
    }


    /** This method overrides the parent's method
     * @param array $queryTermForSearch
     * @return mixed
     */
    protected function doFilterWithQueryTerm()
    {
        $examples = Example::

        hot($this->queryTermForFilter['hot'])->
        publishedForAdmin($this->queryTermForFilter['published'])->
        activatedForAdmin($this->queryTermForFilter['activated'])->

        latest('id')->

        //����r�d��
        keywordBy($this->queryTermForFilter['keyword_by'],
            $this->queryTermForFilter['keyword'])->

        paginate(10);

        return $examples;
    }

    /**  This overrides the method in parent class
     * @param Request $request
     * @return \BladeView|bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function makeList(Request $request)
    {
        if ($request->has('newSearch')) {
            $this->updateQueryTermInSession($request);
        }

        $examples = $this->fetchFilteredList();

        return view('admin.example._exampleList', compact('examples'));
    }
}
