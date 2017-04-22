<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Requests;
use App\Models\Marketing\News;
use App\Models\Example\Example;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function home(NewsController $newsController)
    {
        //Take the hot first 4 in a random way
        //This should be implemented
//        $examples = Example::hotfirst()->get()->take(4);
//
//        $contents = SiteContentController::getSiteContentByMajorCategory('aboutUs');
//        $aboutUs = [];
//        foreach ($contents as $content) {
//            $aboutUs[$content->title] = $content->body;
//        }
//
//        $aboutUsList = $newsController->getAboutUsList();
//
//        $main_news_list = News::mainPage()->published()->get();

        return view('frontEnd.home.home');
//        return view('frontEnd.home.home',
//            compact('main_news_list',
//                'aboutUs',
//                'aboutUsList',
//                'examples'));
    }
}
