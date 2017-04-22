@extends('frontEnd/layouts/master2Column')

{{-- Page title --}}
@section('title')
    最新消息
    @parent
    @stop

    {{-- page level styles --}}
    @section('header_styles')
    {{--    <link href="{{ asset('assets/css/frontend/group.css') }}" rel="stylesheet" type="text/css">--}}
            <!--end of page level css-->
    @stop

    {{-- breadcrumb --}}
    @section('top')
    @include('frontEnd.partials._breadcum',['title'=>'客戶服務','subTitle'=>'最新消息'])
    @stop

    {{-- Page content --}}
    @section('content')
            <!-- Container Section Strat -->

    @include('frontEnd.eventOrRecord.news._plugins')
    <div style="padding: 5px">

        <br/>
        @include('frontEnd.eventOrRecord.news._newsSearch')
        <br/>

        @include('components._FB_and_Line_Share_btn')

        <span>{{$news->created_at}}&nbsp;發表</span>&nbsp;&nbsp;
        <span>瀏覽次數: {{$news->views}}</span>
        <h3 class="title-potmaster">{{$news->title}}</h3>
        <br/>

        <!--Content-->
        <div>
            <img src="{{ asset('assets/images/cover')}}/{{$news->coverPhoto_path}}" style="width:30%;margin:0px 5px;"
                 align="left"
                 class="thumbnail">

            <div>
                {!! $news->body !!}
            </div>
        </div>
    </div>
    @stop


    {{-- page level scripts --}}
    @section('footer_scripts')
            <!-- page level js starts-->
    {{--    <script type="text/javascript" src="{{ asset('assets/js/frontend/newsEdit.js') }}"></script>--}}
    <!--page level js ends-->
@stop
