@extends('frontEnd/layouts/master2Column')

{{-- Page title --}}
@section('title')
    最新消息
    @parent
@stop


{{-- breadcrumb --}}
@section('top')
    @include('frontEnd.partials._breadcum',['title'=>'節能資訊','subTitle'=>'影音專區'])
@stop

{{-- Page content --}}
@section('content')
    <!-- Container Section Strat -->

    <br/>
    <h3 style="display: inline" class="text-nature">影音列表</h3>
    <a href="{{ URL::previous()}}">回上一頁</a>

    <div class="pull-right" style="width: 40%;">
        @include('frontEnd.eventOrRecord.videos._videoSearch')
    </div>
    <hr/>

    @if(isset($videos))
        @if(count($videos)>0)
            <div class="row">
                <div class="col-md-12">
                    @foreach($videos as $video)
                        <div class="thumbnail ">
                            <div class="row">
                                <div class="col-md-5  col-sm-5 col-xs-5">
                                <span class="pull-left visible-xs" style="font-size: x-small">{{$video->created_at}}
                                    &nbsp;發表</span>

                                    <h3 class="visible-xs text-danger">{{$video->title}}</h3>
                                    <iframe class="full-width"
                                            src="{{$video->youtube_url}}" frameborder="0"
                                            allowfullscreen="">
                                    </iframe>
                                </div>
                                <div class="col-md-7  col-sm-7 col-xs-7">
                                    <span class="hidden-xs">{{$video->created_at}}&nbsp;發表</span>
                                    <p class="pull-right">
                                        &nbsp;
                                        <a href="/video/{{$video->id}}"><span class="text-danger"><i
                                                        class="fa fa-arrow-circle-right"></i>&nbsp;看更多</span></a>
                                    </p>

                                    <h3 class="hidden-xs title-potmaster">{{$video->title}}</h3>
                                    {!! $video->body !!}
                                    <h5>相關設備:&nbsp;&nbsp;湯蒸鍋,免火再煮鍋</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

                <div class="text-center">
                    {!! $videos->appends($queryCondition)->render() !!}
                </div>

            </div>
        @endif

        @if(count($videos)==0)
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h4><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp;搜尋不到符合條件的影音!</h4>
                No any videos are found.
            </div>
        @endif
    @endif
@stop
