@extends('frontEnd.layouts.default')

{{-- Page title --}}
@section('title')
    節能產品
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link href="{{ asset('assets/frontend/cart/cart.css') }}" rel="stylesheet" type="text/css">
    @stop
            <!--end of page level css-->


{{-- breadcrumb --}}
@section('top')
    @include('frontEnd.partials._breadcum',['title'=>'購物車'])
@stop


{{-- Page content --}}
@section('content')

    <div style="display: table;margin-top:10px">
        <h3 style="display: table-cell">
            <span class="text-nature"><i class="fa fa-dot-circle-o"></i>&nbsp;購物車</span>
        </h3>

        &nbsp;&nbsp;
        <span style="display: table-cell">
             <a href="/product">產品清單</a> &nbsp;
             <a href="{{ URL::previous()}}">回上一頁<i class="fa fa-reply"></i></a>
         </span>
    </div>

    <br/>
    @if($cart->count())
    @include('frontEnd.order.cart._cartItems')
    @else
    @include('frontEnd.order.cart._emptyCart')
    @endif
    @stop

    {{-- page level scripts --}}
    @section('footer_scripts')
            <!-- page level js starts-->
    <script type="text/javascript" src="{{ asset('assets/frontend/cart/cart.js') }}"></script>
    <!--page level js ends-->

@stop