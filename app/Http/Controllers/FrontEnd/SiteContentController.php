<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use View;

class SiteContentController extends Controller
{
    public function aboutUs()
    {
        return view('frontEnd.siteContent.aboutUs');
    }

    public function lifeGasSaving()
    {
        return view('frontEnd.siteContent.lifeGasSaving');
    }

    public function gasSavingDesignPrinciple()
    {
        return view('frontEnd.siteContent.gasSavingDesignPrinciple');
    }

    public function showTerms($ref)
    {
        $viewPath = 'frontEnd.siteContent.terms.' . $ref;

        if (!View::exists($viewPath)) {
            abort(404, '您要找的資料或是頁面無法找到');
        }

        return view($viewPath);
    }

}


//public function aboutUs(NewsController $newsController)
//{
//    $contents = static::getSiteContentByMajorCategory('aboutUs');
//
//    $aboutUs = [];
//    foreach ($contents as $content) {
//        $aboutUs[$content->title] = $content->body;
//    }
//
//    $carouselList = $newsController->getCarouselList();
//
//    return view('frontEnd.siteContent.aboutUs', compact('aboutUs', 'carouselList'));
//}


//public function lifeGasSaving()
//{
//    $contents = static::getSiteContentByMajorCategory('lifeGasSaving');
//
//    return view('frontEnd.siteContent.lifeGasSaving', compact('contents'));
//}
//
//public function gasSavingDesignPrinciple()
//{
//    $contents = static::getSiteContentByMajorCategory('gasSavingDesignPrinciple');
//
//    return view('frontEnd.siteContent.gasSavingDesignPrinciple', compact('contents'));
//}
//
//public static function getSiteContentByMajorCategory($contentCategory)
//{
//    $contentTitleList = collect(SiteContent::getContentListByMajorCategory($contentCategory))->keys();
//
//    return SiteContent::whereIn('title', $contentTitleList)->get();
//}
//

