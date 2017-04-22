<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Product\AddOn;
use App\Http\Requests\AddOnRequest;
use App\Http\Controllers\Controller;

class AddOnController extends Controller
{
    protected $addOnSelectedOptionController;

    /**
     * AddOnController constructor.
     * @param AddOnSelectedOptionController $addOnSelectedOptionController
     * @internal param $addOnSelectedOption
     */
    public function __construct(AddOnSelectedOptionController $addOnSelectedOptionController)
    {
        $this->authorize('production-config');
        $this->addOnSelectedOptionController = $addOnSelectedOptionController;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $add_ons = AddOn::all();

        return view('admin.product.addOn.index', compact('add_ons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $noteText = '*不須設定,系統自動產生';

        return view('admin.product.addOn.create', compact('noteText', 'add_on_options'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $add_on = $this->createAddOn($request);

        return redirect($this->redirectToEdit($add_on->id));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $add_on = AddOn::findOrFail($id);
        return view('admin.product.addOn.edit', compact('add_on'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(AddOnRequest $request, $id)
    {
        $add_on = AddOn::findOrFail($id);

        $add_on->update($request->all());

        $this->addOnSelectedOptionController->store($request, $add_on);

		flash()->success('您剛剛修改了加工配件!');

        return redirect('\admin\product\addOn');
    }


    protected function createAddOn($request)
    {
        $add_on = AddOn::create($request->all());
        return $add_on;
    }


    protected function redirectToEdit($id)
    {
        return 'admin\product\addOn\\' . $id . '\edit';
    }
}
