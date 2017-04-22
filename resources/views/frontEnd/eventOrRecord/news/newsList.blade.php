@extends('frontEnd/layouts/master2Column')

{{-- Page title --}}
@section('title')
    最新消息
    @parent
    @stop

    {{-- breadcrumb --}}
    @section('top')
    @include('frontEnd.partials._breadcum',['title'=>'客戶服務','subTitle'=>'最新消息'])
    @stop

    {{-- Page content --}}
    @section('content')
            <!-- Container Section Strat -->

    <br/>
    <h3 style="display: inline" class="text-nature">最新消息</h3>
    <a href="{{ URL::previous()}}">回上一頁</a>

    <div class="pull-right" style="width: 40%;">
        @include('frontEnd.eventOrRecord.news._newsSearch')
    </div>
    <hr/>
    <!-- Images Section Start -->
    <div class="row">
        <div class="col-md-12">
            @foreach($newss as $news)
                <div class="row thumbnail ">
                    <div class="col-md-4  col-sm-4 col-xs-5 zeroPadding">
                        <span class="pull-left visible-mobile-inline title-potmaster">{{$news->created_at}}
                            &nbsp;發表</span>
                        <img src="{{ asset('assets/images/cover')}}/{{$news->coverPhoto_path}}" class="full-width zeroMargin">
                    </div>
                    <div class="col-md-8  col-sm-8 col-xs-7">
                        <span class="pull-right visible-desktop-inline title-potmaster">{{$news->created_at}}
                            &nbsp;發表</span>

                        <h3 class="title-potmaster">{{$news->title}}</h3>

                        <div style="height: 120px; overflow: hidden">
                            {!! $news->body !!}
                        </div>
                        <p class="pull-right" style="margin-top:3px;">
                            <a href="/news/{{$news->slug}}"><span class="text-danger"><i
                                            class="fa fa-arrow-circle-right"></i>&nbsp;看更多</span></a>
                        </p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center">
            {!! $newss->appends($queryCondition)->render() !!}
        </div>

    </div>
@stop
