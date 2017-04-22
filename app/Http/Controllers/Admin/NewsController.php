<?php

namespace App\Http\Controllers\Admin;

use Session;
use Illuminate\Http\Request;
use App\Models\Marketing\News;
use App\Http\Requests\NewsRequest;
use App\Repositories\NewsRepository;
use App\Http\Controllers\PhotoController;


class NewsController extends NewsRepository
{
    /**
     * @param Request $request
     * @return \BladeView|bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function makeNewsList(Request $request)
    {
        if ($request->has('newSearch')) {
            updateQueryTerm($request, collect(self::$queryTermList)->keys(), self::$queryTermName);
        }

        $newss = $this->makeNewsQuery(
            makeQueryForSearch(Session::get(self::$queryTermName),
                collect(self::$queryTermList)->keys()));

        return view('admin.news._newsList', compact('newss'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Session::has(self::$queryTermName)) {
            $this->setDefaultQueryTerm();
        }

        $queryTerm =
            makeQueryForSearch(Session::get(self::$queryTermName),
                collect(self::$queryTermList)->keys());

        return view('admin.news.index', compact('queryTerm'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('edit-news');

        $news = $this->createNews($request);

        return redirect($this->redirectToEdit($news->id));
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        return view('admin.news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param NewsRequest|Request $request
     * @param News $news
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(NewsRequest $request, News $news)
    {
        $this->authorize('edit-news');

        $news->update($request->all());

        flash()->success('您剛剛修改了最新消息!');

        return redirect('admin\news');
    }


    protected function createNews($request)
    {
        $news = auth()->user()->newss()->create($request->all());
        $news->active = 1;
        $news->save();

        return $news;
    }

    protected function redirectToEdit($id)
    {
        return 'admin\news\\' . $id . '\edit';
    }

    /**
     * Delete confirmation for the given Video.
     *
     * @param  int $id
     * @return View
     */
    public function getModalDelete(News $news)
    {
        $error = '刪除後資料無法復原.' . sprintf("&nbsp;<span class='text-danger'>標題:%s</span>", $news->title);
        $model = 'news';
        $confirm_route = route('admin.news.delete', ['id' => $news->id]);
        return View('admin/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
    }

    /**
     * Delete the given News.
     *
     * @param News $news
     * @param PhotoController $photoController
     * @return Redirect
     * @internal param int $id
     */
    public function getDelete(News $news = null, PhotoController $photoController)
    {
        $photoController->deleteCoverPhoto('newss', $news->id);

        News::destroy($news->id);

        flash()->warning('您剛剛刪除了一則消息/廣告');

        return redirect('admin/news');
    }


    /**
     *  get the Category for Role
     * @return array
     */
    public static function getHotNewsList()
    {
        $hotNews = News::hotNews()->get();
        return $hotNews;
    }

    /**
     *  get the Category for Role
     * @return array
     */
    public static function getRecentNewsList()
    {
        $recentNewsList = News::recentNews()->get();
        return $recentNewsList;
    }
}