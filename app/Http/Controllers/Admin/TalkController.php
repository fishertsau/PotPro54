<?php

namespace App\Http\Controllers\Admin;

use Lang;
use Auth;
use Session;
use App\Models\Marketing\Talk;
use Illuminate\Http\Request;
use App\Http\Requests\TalkRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PhotoController;


/**
 * Class TalkController
 * @package App\Http\Controllers\Admin
 */
class TalkController extends Controller
{
    /*** 查詢條件名稱***/
    protected static $queryTermName = 'talkQueryTerm';

    /** 查詢條件**/
    protected static $queryTermList = [
        'status_flag' => true,
        'keyword' => ''
    ];
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        updateQueryTerm($request,collect(self::$queryTermList)->keys(),self::$queryTermName);

        $queryTerm =makeQueryForSearch(Session::get(self::$queryTermName),
            collect(self::$queryTermList)->keys());

        $talks =
            Talk::status($queryTerm['status_flag'])->keyword($queryTerm['keyword'])
                ->latest('id')->paginate(10);

        return view('admin.talk.index', compact('talks', 'queryTerm'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.talk.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TalkRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TalkRequest $request)
    {
        $talk = $this->createTalk($request);

        return redirect($this->redirectToEdit($talk->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $talk = Talk::findOrFail($id);

        return view('admin.talk.show', compact('talk'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Talk $talk)
    {
        return view('admin.talk.edit', compact('talk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(TalkRequest $request, Talk $talk)
    {
        $talk->update($request->all());

        syncTag($request->input('tag_list'),$talk);

        flash()->success('您剛剛修改了演講與推廣!');

        return redirect('\admin\talk');
    }


    protected function createTalk($request)
    {
        $talk = Auth::user()->talks()->create($request->all());
        $talk->active = 1;
        $talk->save();

        return $talk;
    }


    protected function redirectToEdit($id){
        return 'admin\talk\\' . $id . '\edit';
    }

    /**
     * Delete confirmation for the given Video.
     *
     * @param  int      $id
     * @return View
     */
    public function getModalDelete($id = null)
    {
        $error = '刪除後資料無法復原';
        $model = 'talk';
        $confirm_route =  route('admin.talk.delete',['id'=>$id]);
        return View('admin/layouts/modal_confirmation', compact('error','model', 'confirm_route'));
    }

    /**
     * Delete the given Video.
     *
     * @param  int      $id
     * @return Redirect
     */
    public function getDelete($id = null, PhotoController $photoController)
    {
        $photoController->deleteCoverPhoto('talks', $id);
        Talk::destroy($id);
        flash()->warning('您剛剛刪除了一則演講與推廣!');
        return redirect('admin/talk');
    }
}


