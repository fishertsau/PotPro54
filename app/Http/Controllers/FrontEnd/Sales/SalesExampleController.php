<?php


namespace App\Http\Controllers\FrontEnd\Sales;

use Illuminate\Http\Request;
use App\Models\Example\Example;
use App\Repositories\ExampleRepository;

class SalesExampleController extends ExampleRepository
{

    protected $user;

    /**
     * SalesExampleController constructor.
     * @param $user
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('activatedSales');
        $this->user = auth()->user();
        parent::__construct();
    }


    public function update(Example $example, Request $request)
    {
        if (!$example->managedBy($this->user->sales)) {
            flash()->error('您無法修改此處的資料,資料未儲存!');
            return redirect('sales');
        }

        $this->saveExample($request, $example);

        flash()->success('您剛剛修改了案例的資料');

        return redirect('sales');
    }


    public function store(Request $request)
    {
        $request['activated']=true;
        return Example::create($request->all())->id;
    }


    public function show(Example $example)
    {
        if (!$example->managedBy(auth()->user()->sales)) {
            return '<p class="text-danger text-center">您無法查詢此案例!</p>';
        }

        return view('frontEnd.sales.example.show', compact('example'))->render();
    }


    protected function doFilterWithQueryTerm()
    {
        $examples = Example::
        latest('id')
            ->where('manager_id', $this->user->sales->id)
            ->publishedForAdmin($this->queryTermForFilter['published'])
            ->activatedForAdmin($this->queryTermForFilter['activated'])
            ->keywordBy($this->queryTermForFilter['keyword_by'],
                $this->queryTermForFilter['keyword'])
            ->paginate(10);

        $examples = $this->appendUriToPagination($examples, 'sales/example/list');

        return $examples;
    }


    public function makeList(Request $request)
    {
        if ($request->has('newSearch')) {
            $this->updateQueryTermInSession($request);
        }

        $examples = $this->fetchFilteredList();
        return view('frontEnd.sales.example._exampleList', compact('examples'));
    }


    public function getExampleAndView($id)
    {
        $example = Example::findOrFail($id);

        $view = $this->show($example);

        return response()->json([
            'view' => $view,
            'example' => $example
        ]);
    }


}