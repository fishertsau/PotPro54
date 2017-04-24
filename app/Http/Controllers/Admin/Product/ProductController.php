<?php

namespace App\Http\Controllers\Admin\Product;

use Acme\Tool\Filterable\ProductFilter;
use App;
use App\Models\Product\Product;
use App\Http\Controllers\Controller;
use Acme\Repositories\ProductRepository;
use Validator;

class ProductController extends Controller
{
    /**
     * @var ProductRepository
     */
    private $productRepo;


    /**
     * ProductController constructor.
     * @param ProductRepository $productRepository
     * @param ProductFilter $filter
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepo = $productRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.product.product.create');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store()
    {
        $validator = Validator::make(request()->all(), [
            'title' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.products.create'))
                ->withErrors($validator)
                ->withInput();
        }

        $product = $this->productRepo->create(request()->all());
        return redirect(route('admin.products.edit', $product->id));
    }


    public function update(Product $product)
    {
        $this->productRepo->update($product, request()->all());
        return redirect(route('admin.products.index'));
    }

    public function edit(Product $product)
    {
        return view('admin.product.product.edit', compact('product'));
    }

    public function show(Product $product)
    {
        return view('admin.product.product.show', compact('product'));
    }

    public function index()
    {
        return view('admin.product.product.index');
    }

    public function getList()
    {
        return App::make(ProductFilter::class)->getList(request('queryTerm'));
    }
}



//    public function __construct()
//    {
////        $this->authorize('product-management');
//    }


/**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request $request
 * @param  int $id
 * @return \Illuminate\Http\Response
 */
//    public function update(Request $request, $id)
//    {
//        $product = Product::findOrFail($id);
//
//        $product->update($request->all());
//
//        flash()->overlay('您剛剛修改一項產品!', 'Good job!');
//
//        return redirect('\admin\product\product');
//    }

//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param  int $id
//     * @return \Illuminate\Http\Response
//     */
//    public function destroy($id)
//    {
//        //
//    }
//    protected function setDefaultQueryTerm()
//    {
//        Session::put(self::$queryTermName, self::$queryTermList);
//    }
//
//    /**
//     * Delete confirmation for the given Video.
//     *
//     * @param  int $id
//     * @return View
//     */
//    public function getModalDelete($id = null)
//    {
//        $error = '';
//        $model = '';
//        $confirm_route = route('admin.product.product.delete', ['id' => $id]);
//        return View('admin/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
//    }

//    /**
//     * Delete the given Video.
//     *
//     * @param  int $id
//     * @return Redirect
//     */
//    public function getDelete($id = null, PhotoController $photoController)
//    {
//        $photoController->deleteCoverPhoto('products', $id);
//
//        $product = Product::destroy($id);
//
//        // Redirect to the news management page
//        return redirect('admin/product/product')->with('success', Lang::get('message.success.delete'));
//
//    }


///**
// * Show the form for editing the specified resource.
// *
// * @param  int $id
// * @return \Illuminate\Http\Response
// */
//    public function edit($id)
//    {
//        $product = Product::findOrFail($id);
//
//        return view('admin.product.product.edit', compact('product'));
//    }


//    public function makeList(Request $request)
//    {
//        if ($request->has('newSearch')) {
//            updateQueryTerm($request, collect(self::$queryTermList)->keys(), self::$queryTermName);
//        }
//
//        $products = $this->getProductListByQuery();
//
//        return view('admin.product.product._productList', compact('products'));
//    }


//    protected function getProductListByQuery($byPagination = true, $perPage = null)
//    {
//        return $this->makeProductQuery(
//            makeQueryForSearch(Session::get(self::$queryTermName),
//                collect(self::$queryTermList)->keys()), $byPagination, $perPage);
//    }


//    public function makeExcelList()
//    {
//        $byPagination = false;
//
//        $products = $this->getProductListByQuery($byPagination);
//
//        $this->exportToExcel($products);
//    }


//    protected function exportToExcel($products)
//    {
//        Excel::create('產品清單', function ($excel) use ($products) {
//            $excel->sheet('單一產品', function ($sheet) use ($products) {
//
//                $sheet->setAutoSize(true);
//                $sheet->row(1, ['產品編號','AAA']);
//
//
//                $data = [];
//                foreach ($products as $product) {
//                    $data[] = [$product->pn, $product->title];
//                }
//
//                $sheet->fromArray($data);
//            });
//        })->export('xlsx');
//    }


/**
 * @param array $queryTermForSearch
 * @return mixed
 */
//    protected function makeProductQuery($queryTermForSearch = [], $byPagination = true, $perPage = null)
//    {
//        $products = Product::
//        join('groups', 'groups.id', '=', 'products.group_id')
//            ->select('products.*')
//            ->where('group_id', 'like', $queryTermForSearch['group_id'])
//            ->statusWithJoin($queryTermForSearch['status_flag'])
//            ->keywordByWithJoin($queryTermForSearch['keyword_by'], $queryTermForSearch['keyword'])
//            ->fetchList($byPagination, $perPage);
//
//        return $products;
//    }
//

/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */
//    public function index(Request $request)
//    {
//        if (!Session::has(self::$queryTermName)) {
//            $this->setDefaultQueryTerm();
//        }
//
//        $queryTerm =
//            makeQueryForSearch(Session::get(self::$queryTermName),
//                collect(self::$queryTermList)->keys());
//
//        return view('admin.product.product.index', compact('queryTerm'));
//    }