<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Marketing\SiteContent;


class SiteContentController extends Controller
{

    public function __construct()
    {
//        $this->authorize('content-management');
    }

    public function edit($contentCategory)
    {
        $contents = $this->getSiteContentByMajorCategory($contentCategory);
        $contentCategoryDescription = SiteContent::getCategoryDescription($contentCategory);
        return view('admin.siteContent.edit', compact('contents', 'contentCategoryDescription'));
    }


    //Store Site Content information
    public function update(Request $request)
    {
        $contentTitleList = collect($request->input('contentItem'));

        foreach ($contentTitleList as $contentTitle) {
            $this->saveOrCreateContentEntry($request, $contentTitle);
        }
        return redirect('/admin');
    }


    protected function saveOrCreateContentEntry($request, $title)
    {
        $contentEntry = SiteContent::firstOrCreate(['title' => $title]);
        $contentEntry->body = $request->input($title);
        $contentEntry->save();
    }


    protected function getSiteContentByMajorCategory($contentCategory)
    {
        $contentTitleList = collect(SiteContent::getContentListByMajorCategory($contentCategory))->keys();

        return DB::table('site_content')->whereIn('title', $contentTitleList)->get();
    }
}
