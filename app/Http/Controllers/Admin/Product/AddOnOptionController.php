<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Product\AddOnOption;
use App\Http\Controllers\Controller;

class AddOnOptionController extends Controller
{

    public function index()
    {
        return view('admin.product.addOnOption.index');
    }


    public function create()
    {
        $noteText = '*不須設定,系統自動產生';

        return view('admin.product.addOnOption.create', compact('noteText'));
    }

    public function store()
    {
        $add_on_option = AddOnOption::create(request()->all());

        return redirect(route('admin.addonOptions.edit', $add_on_option->id));
    }

    public function edit($id)
    {
        $add_on_option = AddOnOption::findOrFail($id);

        return view('admin.product.addOnOption.edit', compact('add_on_option'));
    }

    public function update($id)
    {
        $add_on_option = AddOnOption::findOrFail($id);
        $add_on_option->update(request()->all());

        return redirect(route('admin.addonOptions.index'));
    }

    public function show($id)
    {
        $add_on_option = AddOnOption::findOrFail($id);

        return view('admin.product.addOnOption.show', compact('add_on_option'));
    }
}


///**
// * AddOnOptionController constructor.
// */
//public function __construct()
//{
//    $this->authorize('production-config');
//}
//
//
///**
// * Display a listing of the resource.
// *
// * @return \Illuminate\Http\Response
// */

//
///**
// * Show the form for creating a new resource.
// *
// * @return \Illuminate\Http\Response
// */
//public function create()
//{
//    $noteText = '*不須設定,系統自動產生';
//
//    return view('admin.product.addOnOption.create', compact('noteText'));
//}
//
///**
// * Store a newly created resource in storage.
// *
// * @param  \Illuminate\Http\Request $request
// * @return \Illuminate\Http\Response
// */
//public function store(Request $request)
//{
//    $add_on_option = $this->createAddOnOption($request);
//
//    return redirect($this->redirectToEdit($add_on_option->id));
//}
//
//
///**
// * Show the form for editing the specified resource.
// *
// * @param  int $id
// * @return \Illuminate\Http\Response
// */
//public function edit($id)
//{
//    $add_on_option = AddOnOption::findOrFail($id);
//
//    return view('admin.product.addOnOption.edit', compact('add_on_option'));
//}
//
///**
// * Update the specified resource in storage.
// *
// * @param  \Illuminate\Http\Request $request
// * @param  int $id
// * @return \Illuminate\Http\Response
// */
//public function update(Request $request, $id)
//{
//    $add_on_option = AddOnOption::findOrFail($id);
//    $add_on_option->update($request->all());
//    $this->updateOptionSettingsAttribute($add_on_option, $request->get('setting'));
//
//    flash()->overlay('您剛剛修改了加工方式!');
//
//    return redirect('\admin\product\addOnOption');
//}
//
//
//private function updateOptionSettingsAttribute($entry, $settings)
//{
//    $settingsString = (string)collect($settings)->toJson();
//    $entry->update(['setting_choices' => $settingsString]);
//}
//
//
///** An array is returned to the client, and client make it a string for view
// * @param Request $request
// * @return mixed
// */
//public function getAddOnOptionSettingArray(Request $request)
//{
//    //this is designed for an ajax request
//    if ($request->ajax()) {
//        $option = AddOnOption::findOrFail($request->input('id'));
//
//
//        return response()->json([
//            "optionSetting" => collect($option->settings_array),
//            "optionBody" => $option->body
//        ]);
//    }
//}
//
//
//protected function createAddOnOption($request)
//{
//    $add_on_option = AddOnOption::create($request->all());
//    return $add_on_option;
//}
