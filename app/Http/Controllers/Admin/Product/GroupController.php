<?php

namespace App\Http\Controllers\Admin\Product;

use Gate;
use Session;
use Illuminate\Http\Request;
use App\Models\Product\Group;
use App\Http\Requests\GroupRequest;
use App\Http\Controllers\Controller;

class GroupController extends Controller
{

    /*** 查詢條件名稱***/
    protected static $queryTermName = 'groupQueryTerm';

    /** 查詢條件**/
    protected static $queryTermList = [
        'status_flag' => true,
        'category' => '',
        'sub_category' => '',
        'keyword' => ''
    ];

    /**
     * GroupController constructor.
     */
    public function __construct()
    {
        $this->authorize('product-management');
    }


    protected function setDefaultQueryTerm()
    {
        Session::put(self::$queryTermName, self::$queryTermList);
    }


    public function makeList(Request $request)
    {
        if ($request->has('newSearch')) {
            updateQueryTerm($request, collect(self::$queryTermList)->keys(), self::$queryTermName);
        }

        $groups = $this->makeGroupQuery(
            makeQueryForSearch(Session::get(self::$queryTermName),
                collect(self::$queryTermList)->keys()));

        return view('admin.product.group._groupList', compact('groups'));
    }


    /**
     * Display a listing of the resource.
     *
     * @param string $productionSetting
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

        return view('admin.product.group.index', compact('queryTerm'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        $this->authorize('create-product');
        return view('admin.product.group.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $this->authorize('create-product');
        $group = $this->createGroup($request);

        return redirect($this->redirectToEdit($group->id));
    }


//    /**
//     * Display the specified resource.
//     *
//     * @param  int $id
//     * @return \Illuminate\Http\Response
//     */
//    public function show($id)
//    {
//        $group = Group::findOrFail($id);
//
//        return view('admin.product.group.show', compact('group'));
//    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
//        $this->authorize('edit-product');
        return view('admin.product.group.edit', compact('group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(GroupRequest $request, Group $group)
    {
//        $this->authorize('edit-product');

        $group->update($request->all());

        $this->syncUpAddOnList($group, $request->get('add_on_list'));

        flash()->overlay('您剛剛修改了產品系列!');

        return redirect('\admin\product\group');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function getGroupSubCategoryList(Request $request)
    {
        if ($request->ajax()) {
            $catId = $request->input('id');
            return \App\Models\Product\GroupSubCategory::where('group_category_id', $catId)->get();
        }
    }


    protected function createGroup($request)
    {
        $request['active'] = 1;
        return Group::create($request->all());
    }


    protected function redirectToEdit($id)
    {
        return 'admin\product\group\\' . $id . '\edit';
    }


    /**
     * @param array $queryTermForSearch
     * @return mixed
     */
    protected function makeGroupQuery($queryTermForSearch = [])
    {
        $groups = Group::
        joinOnCategoryAndSubCategory($queryTermForSearch['category'], $queryTermForSearch['sub_category'])
            ->statusWithJoin($queryTermForSearch['status_flag'])
            ->keywordWithJoin($queryTermForSearch['keyword'])
            ->paginate(10);

        return $groups;
    }

    protected function syncUpAddOnList($group, $add_on_list = [])
    {
        if ($add_on_list == null) {
            $add_on_list = [];
        }
        $group->add_ons()->sync($add_on_list);
    }

    public function productionSetting(Group $group)
    {
        return view('admin.product.group.production.edit', compact('group'));
    }

    public function updateProductionSetting(Request $request, Group $group)
    {
        if (Gate::denies('edit-production')) {
            abort(403);
        }

        $this->syncUpAddOnList($group, $request->get('add_on_list'));

        flash()->overlay('您剛剛修改了系列產品加工配件!');

        return redirect('\admin\product\group');
    }

}
