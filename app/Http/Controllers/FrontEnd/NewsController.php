<?php

namespace App\Http\Controllers\FrontEnd;

use Response;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Marketing\News;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class NewsController extends Controller
{
    public function getAboutUsList()
    {
        return News::aboutUs()->published()->get();
    }


    public function index(Request $request)
    {
        $queryCondition = getQueryCondition($request);

        /*
         * make the query basing upon the input condition
         * */
        $newss = News::published()->newsItem()->where('title', 'like', $queryCondition['keyword'])
            ->where('location', 'like', $queryCondition['location'])
            ->latest('id')->paginate(10);

//		$users = App\User::popular()->active()->orderBy('created_at')->get();
        /*
         * collect all the pagination information, and pass to view.
         * */
        $pager = getPager($newss);

        return view('frontEnd.eventOrRecord.news.newsList', compact('newss', 'pager', 'queryCondition'));
    }

    public function show($slug='')
    {
//        if ($slug == '') {
//            $news = News::first();
//        }

        try {
            $news = News::findBySlugOrFail($slug);
            $news->increment('views');
        } catch (ModelNotFoundException $e) {
            return Response::view('404', array(), 404);
        }

        return view('frontEnd.eventOrRecord.news.newsShow', compact('news'));
    }

}
