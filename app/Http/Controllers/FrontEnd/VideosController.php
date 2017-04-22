<?php

namespace App\Http\Controllers\FrontEnd;


use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Marketing\Video;
use App\Http\Controllers\Controller;

class VideosController extends Controller
{
    public function index(Request $request)
    {
        // todo:  (1)Video CRUD in admin (and test),
        // todo: (2)Video Filter Test  ,
        // todo: (3) Pager

        return view('frontEnd.eventOrRecord.videos.videoList', compact('videos', 'pager', 'queryCondition'));

        //        $queryCondition = getQueryCondition($request);
//
//        $videos = Video::where('title', 'like', $queryCondition['keyword'])
//            ->latest('id')->paginate(10);
//
//        $pager = getPager($videos);

//        return view('frontEnd.eventOrRecord.videos.videoList',compact('videos', 'pager', 'queryCondition'));
    }


    public function show($id)
    {
        $video = Video::findOrFail($id);

        return view('frontEnd.eventOrRecord.videos.videoShow', compact('video'));
    }
}
