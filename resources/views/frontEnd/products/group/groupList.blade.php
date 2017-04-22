@extends('frontEnd.layouts.master2Column')

{{-- Page title --}}
@section('title')
    節能產品
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link href="{{ asset('assets/frontend/product/productAll.css') }}" rel="stylesheet">
    <link href="{{asset('assets/vendors/lity-1/dist/lity.css')}}" rel="stylesheet">
    <!--end of page level css-->
    @stop

    {{-- breadcrumb --}}
    @section('top')
    @include('frontEnd.products._breadcum',['title'=>'節能產品','subTitle'=>'系列產品'])
    @stop

    {{-- Page content --}}
    @section('content')
            <!-- Container Section Strat -->

    @include('frontEnd.products.partials._groupSelectionList')

    <br/>
    <div>
        @include('frontEnd.products.partials._productKeywordSearch')
    </div>
    <br/>


    <!-- Images Section Start -->
    <div class="row">
        <div class="col-md-12">
            @if(isset($groupCategories))
                @include('frontEnd.products.group._listByCategory')
            @else
                @include('frontEnd.products.group._listBySubCategory',
                ['groupSubCategories'=>$groupSubCategory])
            @endif
        </div>
    </div>
    @stop


    {{-- page level scripts --}}
    @section('footer_scripts')
            <!-- page level js starts-->
    <script src="{{ asset('assets/frontend/product/productAll.js') }}"></script>
    <script src="{{asset('assets/vendors/lity-1/dist/lity.js')}}"></script>
    <!--page level js ends-->
@stop
