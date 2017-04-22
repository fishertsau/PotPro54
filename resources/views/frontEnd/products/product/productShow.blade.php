@extends('frontEnd.layouts.master2Column')

{{-- Page title --}}
@section('title')
    節能產品
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link href="{{ asset('assets/frontend/product/productAll.css') }}" rel="stylesheet" type="text/css">
    @stop
            <!--end of page level css-->

    {{-- breadcrumb --}}
@section('top')
    @include('frontEnd.products._breadcum',['title'=>'節能產品','subTitle'=>$product->group->subCategory->title])
@stop

{{-- Page content --}}
@section('content')
    @include('frontEnd.products.partials._groupSelectionList')

    <br/>
    <div>
        @include('frontEnd.products.partials._productKeywordSearch')
    </div>
    <br/>

    <h3 class="text-nature" style="display: inline;">{{$product->group->title}}:&nbsp;{{$product->title}}</h3>
    <a href="{{ URL::previous()}}">回上一頁</a>

    <br>
    <br>
    <div class="container-fluid">
        {{--產品照片 與 重要說明--}}
        <div class="row">
            <div class="col-md-7 col-sm-7 col-xs-12 ">
                @include('frontEnd.products.product._productPhoto')
                <br/><br/>
            </div>

            <!-- Project Description Section Start -->
            <div class="col-md-5 col-sm-5 col-xs-12" id="app">
                {{--數量 加入購物車 收藏--}}
                @include('frontEnd.products.product._productShowPanel')

                <br/>
                {{--產品型號--}}
                <h5 class="title-potmaster"><i class="fa fa-square"></i>&nbsp;型號: {{$product->title}}</h5>

                {{--產品價格--}}
                <h5 class="title-potmaster"><i class="fa fa-square"></i>&nbsp;參考價格: {{number_format($product->price)}}</h5>

                {{--產品介紹--}}
                @include('frontEnd.products.product._body')

                {{--適用料理--}}
                @include('frontEnd.products.partials._goodAt',['group'=>$product->group])

                {{--產品規格--}}
                @include('frontEnd.products.product._productSpec')

                {{--加工配件--}}
                @include('frontEnd.products.partials._addOn',['group'=>$product->group])

                {{--一般配件--}}
                @include('frontEnd.products.partials._auxiliary',['group'=>$product->group])
            </div>
            <!-- //Project Description Section End -->

        </div>


        {{--產品特色--}}
        @include('frontEnd.products.product._description')

        {{--其他說明--}}
        @include('frontEnd.products.product._note')


        {{--加工配件--}}
        @include('frontEnd.products._addOnList',['group'=>$product->group])

    </div>

    @stop


    {{-- page level scripts --}}
    @section('footer_scripts')
            <!-- page level js starts-->
    <script type="text/javascript" src="{{ asset('assets/frontend/product/productAll.js') }}"></script>
    <!--page level js ends-->
@stop




