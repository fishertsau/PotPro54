<?php

namespace App\Http\Controllers\Admin\Channel;

use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Channel\Sales;
use App\Http\Controllers\Tool\Filterable;

class SalesController extends Filterable
{
    protected $queryTermName = 'salesQueryTerm';
    protected $queryTermList = [
        'activated',
        'keyword_by',
        'keyword'
    ];

    public function __construct()
    {
        if (!$this->authorize('channel-management')) {
            return 'hello';
        }
        parent::__construct();
    }


    public function index()
    {
        $queryTerm = $this->getQueryTerm();
        return view('admin.channel.sales.index', compact('queryTerm'));
    }

    public function create()
    {
        return view('admin.channel.sales.create.create');
    }

    public function store(Request $request)
    {
        //validate input

        if (Sales::hasUser($request->user_id)) {
            return redirect('/admin/sales');
        }

        $sales = User::findOrFail($request->user_id)
            ->sales()->create($request->all());
        flash()->success('你剛剛新增了一個通路');

        //log the creation
        return redirect($this->redirectToEdit($sales->id));
    }


    public function show(Sales $sales)
    {
        return view('admin.channel.sales.show', compact('sales'));
    }


    public function edit(Sales $sales)
    {
        //authorize editing user (ModelPolicy?)

        return view('admin.channel.sales.edit', compact('sales'));
    }


    protected function redirectToEdit($id)
    {
        return 'admin\sales\\' . $id . '\edit';
    }


    public function update(Sales $sales, Request $request)
    {
        //authorize editing user  'edit-sales' (model-policy)
        $sales->update($request->all());
        //log the change
        flash()->success('您剛剛修改了通路設定');
        return redirect('admin/sales');
    }


    protected function putDefaultQueryTerm()
    {
        session()->put(
            $this->queryTermName,
            $defaultQueryTerm = [
                'activated' => true,
                'keyword_by' => 'user_name',
                'keyword' => ''
            ]);
    }


    protected function doFilterWithQueryTerm()
    {
        $salesPersons = Sales::
        latest('id')->

        //開通 activated
        activated($this->queryTermForFilter['activated'])->

        //關鍵字查詢
        keywordBy($this->queryTermForFilter['keyword_by'],
            $this->queryTermForFilter['keyword'])->

        paginate(10);

        return $salesPersons;
    }


    public function makeList(Request $request)
    {

        if ($request->has('newSearch')) {
            $this->updateQueryTermInSession($request);
        }

        $salesPersons = $this->fetchFilteredList();
        return view('admin.channel.sales._salesList', compact('salesPersons'));
    }


    public function hasUser($user_id)
    {
        //if request is ajax, return string
        //otherwise, just return boolean

        return (string)Sales::where('user_id', $user_id)->exists();
    }


    public function makeListSimple(Request $request)
    {

        if ($request->has('newSearch')) {
            $this->updateQueryTermInSession($request);
        }

        $salesPersons = $this->fetchFilteredList();
        return view('admin.channel.sales._salesListSimple', compact('salesPersons'));
    }
}
