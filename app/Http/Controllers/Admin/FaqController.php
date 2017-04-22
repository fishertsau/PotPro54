<?php namespace App\Http\Controllers\Admin;


use Lang;
use Session;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Marketing\Faq;
use App\Http\Controllers\Controller;

class FaqController extends Controller
{
    /*** 查詢條件名稱***/
    protected static $queryTermName = 'faqQueryTerm';

    /** 查詢條件**/
    protected static $queryTermList = [
        'status_flag' => true,
        'category' => '',
        'keyword' => ''
    ];

    public function makeList(Request $request)
    {
        if ($request->has('newSearch')) {
            updateQueryTerm($request, collect(self::$queryTermList)->keys(), self::$queryTermName);
        }

        $faqs = $this->makeFaqQuery(
            makeQueryForSearch(Session::get(self::$queryTermName),
                collect(self::$queryTermList)->keys()));

        return view('admin.faq._faqList', compact('faqs'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (!Session::has(self::$queryTermName)) {
            $this->setDefaultQueryTerm();
        }



        $queryTerm =
            makeQueryForSearch(Session::get(self::$queryTermName),
                collect(self::$queryTermList)->keys());

        return view('admin.faq.index', compact('queryTerm'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.faq.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        Faq::create($request->all());
        return redirect('admin/faq')->with('success', Lang::get('message.success.create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $faq = Faq::findOrFail($id);
        return view('admin.faq.show', compact('faq'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $faq = Faq::findOrFail($id);
        return view('admin.faq.edit', compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        //$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
        $faq = Faq::findOrFail($id);
        $faq->update($request->all());

        flash()->overlay('您剛剛修改了常見問題!');

        return redirect('admin/faq')->with('success', Lang::get('message.success.update'));
    }


    protected function setDefaultQueryTerm()
    {
        Session::put(self::$queryTermName, self::$queryTermList);
    }

    /**
     * @param array $queryTermForSearch
     * @return mixed
     */
    protected function makeFaqQuery($queryTermForSearch = [])
    {
        $faqs = Faq::
        latest('id')->

        //最新消息狀態
        status($queryTermForSearch['status_flag'])->

        //類別
        category($queryTermForSearch['category'])->

        //關鍵字查詢
        keyword($queryTermForSearch['keyword'])->

        paginate(10);

        return $faqs;
    }

}