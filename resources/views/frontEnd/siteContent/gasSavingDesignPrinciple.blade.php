@extends('frontEnd/layouts/master2Column')

{{-- Page title --}}
@section('title')
    節能產品
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/siteContent.css') }}">
@stop

{{-- breadcrumb --}}
@section('top')
    @include('frontEnd.partials._breadcum',['title'=>'節能資訊','subTitle'=>'瓦斯節能原理'])
@stop

{{-- Page content --}}
@section('content')
    <h3 class="text-nature">節能鍋原理</h3>
    @include('frontEnd.siteContent._contentFilter')

    @include('frontEnd.siteContent._contentPanel')

@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/vendors/mixitup/jquery.mixitup.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/frontend/siteContent.js') }}"></script>
@stop
