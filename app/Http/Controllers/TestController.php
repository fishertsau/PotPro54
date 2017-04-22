<?php namespace App\Http\Controllers;

use Lang;
use Session;
use App\User;
use App\Test;
use Illuminate\Http\Request;


class TestController extends Controller
{
    public function __construct()
    {
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('test.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.tests.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($topic)
    {
        $view = 'test.' . $topic;

        if (view()->exists($view)) {
            return view($view);
        }

        Session::flash('error','no topic found');
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id, Request $request)
    {
    }

    public function destroy(Test $test)
    {
        $test->delete();

        return 'Success';
    }

    /**
     * Delete confirmation for the given Test.
     *
     * @param  int $id
     * @return View
     */
    public function getModalDelete($id = null)
    {
        $error = '';
        $model = '';
        $confirm_route = route('admin.tests.delete', ['id' => $id]);
        return View('admin/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));

    }

    /**
     * Delete the given Test.
     *
     * @param  int $id
     * @return Redirect
     */
    public function getDelete($id = null)
    {
        $test = Test::destroy($id);

        // Redirect to the group management page
        return redirect('admin/tests')->with('success', Lang::get('message.success.delete'));
    }


    public function eventTest($arg1, $arg2)
    {
        dump('in event Test');
        if ($arg1 instanceof User) {
            dump($arg1);
        }

        dump($arg2);
    }

    public function eventTest2($arg1, $arg2)
    {
        dump('in event Test2');
        dump($arg1);
        dump($arg2);

    }

}