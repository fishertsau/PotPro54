<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Talk;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TalkController extends Controller
{
    public function index(Request $request)
    {
        $queryCondition = getQueryCondition($request);

        /*
         * make the query basing upon the input condition
         * */
        $talks = Talk::where('title', 'like', $queryCondition['keyword'])
            ->latest('id')->paginate(10);

        /*
         * collect all the pagination information, and pass to view.
         * */
        $pager = getPager($talks);
        return view('frontEnd.eventOrRecord.talks.talkList',compact('talks', 'pager', 'queryCondition'));
    }

    public function show($id)
    {
        $talk = Talk::findOrFail($id);

        return view('frontEnd.eventOrRecord.talks.talkShow',compact('talk'));
    }
}
