@extends('frontEnd.layouts.default')

{{-- page level styles --}}
@section('header_styles')
        <!--page level css starts-->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/owl.carousel/css/owl.carousel.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/owl.carousel/css/owl.theme.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/home/home.css') }}">
<!--end of page level css-->
@stop

{{-- slider --}}
@section('top')
        <!--Carousel Start -->
@include('frontEnd.home._carousel')

<!-- //Carousel End -->
@stop


{{-- content --}}
@section('content')
@include('frontEnd.home._salesWanted')
<hr>
@include('frontEnd.home._welcomeToPotpro')
@include('frontEnd.home._gasSavingGuru2')
@include('frontEnd.home._exampleListHot')
<br>
@include('frontEnd.home._gasSavingBenefit')
<br>

        <!-- //Container End -->
@stop

{{-- footer scripts --}}
@section('footer_scripts')
        <!-- page level js starts-->
<script type="text/javascript" src="{{ asset('assets/vendors/owl.carousel/js/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/frontend/home/home.js') }}"></script>
<!--page level js ends-->
@stop
