@extends('frontEnd.layouts.master2Column')

{{-- Page title --}}
@section('title')
    節能產品
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link href="{{ asset('assets/frontend/product/productAll.css') }}" rel="stylesheet">
    <!--end of page level css-->
@stop

{{-- breadcrumb --}}
@section('top')
    @include('frontEnd.products._breadcum',['title'=>'節能產品','subTitle'=>'產品清單'])
@stop

{{-- Page content --}}
@section('content')
    {{csrf_field()}}
    @include('frontEnd.products.partials._groupSelectionList')

    <br/>
    <div>
        @include('frontEnd.products.partials._productKeywordSearch')
    </div>
    <br/>

    <h3 class="text-nature">產品清單</h3>

    <table width="100%" class="table table-nomargin table-bordered table-striped formTable"
           style="text-align: center;background-color: white">
        <thead>
        <tr style="background-color: #f4f4f4">
            <td width="20%" class="text-default"><h4>系列</h4></td>
            <td width="18%" class="text-default"><h4>產品名稱/型號</h4></td>
            @can('behave-sales')
            <td width="20%" class="text-default"><h4>訂購</h4></td>
            @endcan
        </tr>
        </thead>
        <tbody>

        @foreach($groupCategories as $groupCategory)
            <tr style="background-color: #eefcef">
                <td colspan="5" align="left" class="bg-info">
                    <h4 style="display: inline;"><i class="fa fa-angle-right"></i>&nbsp;{{$groupCategory->title}}</h4>

                    <div class="pull-right">
                        <button type="button" class="btn btn-xs btn-warning" data-action="expand-all"
                                style="display: table-cell">
                            全部展開
                        </button>
                        &nbsp;
                        <button type="button" class="btn btn-xs btn-success" data-action="collapse-all"
                                style="display: table-cell">
                            全部收起
                        </button>
                    </div>
                </td>
            </tr>
            @foreach($groupCategory->groupSubCategories as $groupSubCategory)
                <tr class="groupSubCategory" groupSubCategoryId="{{$groupSubCategory->id}}"
                    style="background-color: #fbfcee">
                    <td colspan="5" align="left">
                        <h4><i class="fa fa-angle-double-right"></i>&nbsp;{{$groupSubCategory->title}}&nbsp;
                            <i class="fa fa-minus-circle productItemClose"></i>
                            <i class="fa fa-plus-circle productItemOpen"></i></h4>

                    </td>
                </tr>
                @foreach($groupSubCategory->groups as $group )
                    @foreach($group->products as $product)
                        <tr class="productItem" groupSubCategoryId="{{$groupSubCategory->id}}">
                            <td class="text-primary">
                                <a href="/group/{{$product->group->slug}}">
                                    <span class="text-primary">{{$group->title}}</span>
                                </a>
                            </td>
                            <td><a href="/product/{{$product->slug}}">
                                    <span class="text-danger">{{$product->title}}</span>
                                </a>
                            </td>
                            @can('behave-sales')
                            <td>
                                <div class="add-item-block" id="product_{{$product->id}}">
                                    <input type="hidden" name="product-id" value="{{$product->id}}"
                                           class="product-id">

                                    <div class="input-group input-group-sm">
                                        <input type="number" name='qty' class="form-control item-qty"
                                               placeholder="數量"
                                               aria-describedby="sizing-addon3" min="1" required>

                                        <div class="input-group-btn">
                                            <button onclick="addItemToCartFromProductList(this)" type=""
                                                    class="btn btn-warning btn-sm add-item-to-cart"
                                                    id="btn_{{$product->id}}">
                                                選購
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            @endcan
                        </tr>
                    @endforeach
                @endforeach
            @endforeach
        @endforeach
        </tbody>
    </table>
    @stop

    {{-- page level scripts --}}
    @section('footer_scripts')
            <!-- page level js starts-->
    <script type="text/javascript" src="{{ asset('assets/frontend/product/productList.js') }}"></script>
    <!--page level js ends-->

@stop