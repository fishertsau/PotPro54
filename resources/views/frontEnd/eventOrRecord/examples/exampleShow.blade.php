@extends('frontEnd/layouts/master2Column')

{{-- Page title --}}
@section('title')
    節能產品
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link href="{{ asset('assets/css/frontend/example.css') }}" rel="stylesheet" type="text/css">
    <!--end of page level css-->
    @stop

    {{-- breadcrumb --}}
    @section('top')
    @include('frontEnd.partials._breadcum',['title'=>'節能案例','subTitle'=>$example->title])
    @stop

    {{-- Page content --}}
    @section('content')
            <!-- Container Section Strat -->
    <div style="padding: 0 10px">
        <br/>
        @include('components._FB_and_Line_Share_btn')

        <br>
        <h3 style="display: inline" class="text-nature">{{$example->title}}</h3>
        <a href="{{ URL::previous()}}">回上一頁</a>

        <div class="pull-right" style="width: 40%;">
            @include('frontEnd.eventOrRecord.examples._exampleSearch')
        </div>

        <hr/>
        @include('frontEnd.eventOrRecord.examples.partials._showContent')
        <br>
    </div>
@stop

@if($example->hasManager())

@section('sideContent')
    <div class="row" style="margin: 10px 0 0 0;background: #eeede8;padding: 8px">
        <h4 class="title-potmaster">服務人員</h4>
        <div class="col-md-12">
            @if($example->manager->avatar!='')
                <img src="{!! asset('assets/images/cover').'/'.$example->manager->avatar !!}"
                     alt="img"
                     class="img-responsive"
                     style="width: 100%"/>
            @endif
        </div>

        <div class="col-md-12">
            <br>
            <h5 class="title-potmaster" style="margin: 0">姓名: &nbsp; {{$example->manager->name}}</h5>

            <h5 class="title-potmaster">電話: &nbsp; {{$example->manager->tel}}</h5>
            <h5 class="title-potmaster" style="margin: 0">電子信箱:</h5>
            <p class="title-potmaster">{{$example->manager->email}}</p>

            <h5 class="title-potmaster" style="margin: 0">地址:</h5>
            <p class="title-potmaster">{{$example->manager->address}}</p>
        </div>
    </div>
    <hr>
    @stop

    @endif


    {{-- page level scripts --}}
    @section('footer_scripts')
            <!-- page level js starts-->
    <script type="text/javascript" src="{{ asset('assets/js/frontend/example.js') }}"></script>
    <!--page level js ends-->
@stop