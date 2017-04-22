<?php

namespace App\Http\Controllers\FrontEnd;

use DB;
use Response;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Product\Group;
use App\Models\Product\Product;
use App\Http\Controllers\Controller;
use App\Models\Product\GroupCategory;
use App\Models\Product\GroupSubCategory;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class GroupController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('subcategory')) {
            $groupSubCategory = GroupSubCategory::where('id', $request->input('subcategory'))->get();
            return view('frontEnd.products.group.groupList', compact('groupSubCategory'));
        }

        $groupCategories =
            $request->has('category')
                ? GroupCategory::where('id', $request->input('category'))->get()
                : GroupCategory::all();

        return view('frontEnd.products.group.groupList', compact('groupCategories'));
    }


    public function show($slug = '')
    {
        if ($slug == '') {
            $group = Group::first();
        }

        try {
            $group = Group::findBySlugOrFail($slug);
        } catch (ModelNotFoundException $e) {
            return Response::view('404', array(), 404);
        }
        return view('frontEnd.products.group.groupShow', compact('group'));
    }

    public function productDetail($slug = '')
    {
        if ($slug == '') {
            $product = Product::first();
        }

        try {
            $product = Product::findBySlugOrFail($slug);
        } catch (ModelNotFoundException $e) {
            return Response::view('404', array(), 404);
        }

        return view('frontEnd.products.product.productShow', compact('product'));
    }

    public function productList()
    {
        $groupCategories = GroupCategory::all();

        return view('frontEnd.products.product.productList', compact('groupCategories'));
    }


    /**
     * @param Request $request
     * @return string
     */
    public function addProductToFavorite($action = null, $product_id = null, Request $request)
    {
        if (!auth()->check()) {
            //flash a warning message that only registered user is allowed.
            return false;
        }

        if ($action == 'push') {
            $favoriteExists = $this->isInUserFavorite($product_id);
            if (!$favoriteExists) {
                auth()->user()->favorite_products()->attach($product_id);
            }
        }

        if ($action == 'pull') {
            auth()->user()->favorite_products()->detach($product_id);
        }
    }

    protected function isInUserFavorite($product_id)
    {
        $result = DB::table('user_favorite_products')->
        where('product_id', $product_id)
            ->where('user_id', auth()->user()->id)
            ->exists();

        return $result;
    }

    public function productSearch(Request $request)
    {
        $keyword = $request->input('keyword');

        $groups = Group::where('title', 'like', '%' . $keyword . '%')->get();
        $products = Product::where('title', 'like', '%' . $keyword . '%')->get();

        return view('frontEnd.products.productSearchResult', compact('groups', 'products'));
    }
}
