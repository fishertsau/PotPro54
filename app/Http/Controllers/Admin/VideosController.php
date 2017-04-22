<?php

namespace App\Http\Controllers\Admin;

use Acme\Tool\Filterable\VideoFilter;
use Lang;
use Auth;
use Session;
use Illuminate\Http\Request;
use App\Models\Marketing\Video;
use App\Http\Requests\VideoRequest;
use App\Http\Controllers\Controller;


class VideosController extends Controller
{
    /*** 查詢條件名稱***/
    protected static $queryTermName = 'videoQueryTerm';

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
        updateQueryTerm($request, collect(self::$queryTermList)->keys(), self::$queryTermName);

        $queryTerm = makeQueryForSearch(Session::get(self::$queryTermName),
            collect(self::$queryTermList)->keys());

        $vidoes = Video::all();

//		$videos =
//            Video::status($queryTerm['status_flag'])->keyword($queryTerm['keyword'])
//			->latest('id')->paginate(10);

        return view('admin.videos.index', compact('videos', 'queryTerm'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.videos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param TagRepository $tagRepo
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $majorFields = ['title', 'youtube_url', 'body', 'active'];

        Auth::user()->videos()->create($request->only($majorFields));

//        flash()->overlay('您剛剛新增了一則影音!', 'Good job!');

        return redirect(route('admin.videoIndex'))->with('success', Lang::get('message.success.create'));;
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function show($id)
    {
        $video = Video::findOrFail($id);

        return view('admin.videos.show', compact('video'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        return view('admin.videos.edit', compact('video'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(VideoRequest $request, Video $video)
    {
        $video->update($request->all());

        $tag_list = ($request->input('tag_list')) ? $request->input('tag_list') : [];
        $video->tags()->sync($tag_list);

        flash()->overlay('您剛剛修改了影音訊息!');

        return redirect('\admin\video')->with('success', Lang::get('message.success.update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Delete confirmation for the given Video.
     *
     * @param  int $id
     * @return View
     */
//    public function getModalDelete($id = null)
//    {
//        $error = '';
//        $model = '';
//        $confirm_route = route('admin.video.delete', ['id' => $id]);
//        return View('admin/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
//    }

    /**
     * Delete the given Video.
     *
     * @param Request $request
     * @return Redirect
     * @internal param int $id
     */
//    public function getDelete($id = null)
//    {
//        $video = Video::destroy($id);
//
//        // Redirect to the group management page
//        return redirect('admin/video')->with('success', Lang::get('message.success.delete'));
//
//    }

    /**
     * @param Request $request
     * @param VideoFilter $videoFilter
     * @return mixed
     */
    public function getList(Request $request, VideoFilter $videoFilter)
    {
        return $videoFilter->getList($request->input('queryTerm'));
    }
}
