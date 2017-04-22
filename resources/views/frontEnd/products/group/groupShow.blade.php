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
    @include('frontEnd.products._breadcum',['title'=>'節能產品','subTitle'=>$group->subCategory->title])
@stop


{{-- Page content --}}
@section('content')
    @include('frontEnd.products.partials._groupSelectionList')

    {{--產品照片 與 重要說明--}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <br/>

                <div class="pull-right">
                    @include('frontEnd.products.partials._productKeywordSearch')
                </div>
                <br/><br/><br/>

                <h3 class="text-nature" style="display: inline;">
                    {{$group->title}}</h3>
                <a href="{{ URL::previous()}}">回上一頁</a>

                <br/><br/>
                <hr style="margin:5px 0px;"/>
                <br/>
            </div>

            <!-- Slider Section Start -->
            <div class="col-md-7 col-sm-7 col-xs-12 ">
                <img class="full-width" src="{{URL::asset('assets/images/cover')}}/{{$group->coverPhoto_path}}">
            </div>
            <!-- //Slider Section End -->

            {{--產品介紹與說明--}}
            <div class="col-md-5 col-sm-5 col-xs-12">
                {{--產品特色--}}
                @include('frontEnd.products.group._description')

                {{--適用料理--}}
                @include('frontEnd.products.partials._goodAt')

                {{--加工配件--}}
                @include('frontEnd.products.partials._addOn')

                {{--一般配件--}}
                @include('frontEnd.products.partials._auxiliary')

                {{--產品型號--}}
                <hr/>
                <a href="#productTable">
                    <button class="btn btn-warning full-width">系列產品型號</button>
                </a>

            </div>
            <!-- //Project Description Section End -->
        </div>
    </div>


    {{--其他說明--}}
    @include('frontEnd.products.group._note')

    {{--加工配件--}}
    @include('frontEnd.products._addOnList',['group'=>$group])

    {{--標準型號--}}
    @include('frontEnd.products.group._productTable')


    {{--系列產品--}}
    @include('frontEnd.products.group._productThumbnailList')

    @stop


    {{-- page level scripts --}}
    @section('footer_scripts')
            <!-- page level js starts-->
    <script type="text/javascript" src="{{ asset('assets/frontend/product/productAll.js') }}"></script>
    <!--page level js ends-->
@stop