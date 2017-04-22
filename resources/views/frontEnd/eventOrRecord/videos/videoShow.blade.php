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

    @include('frontEnd.eventOrRecord.videos._plugins')



    <div style="background-color: white;padding: 8px;">

        <!--註解 外掛功能-->
        <div style="margin-bottom: 5px;">
            <span>{{$video->created_at}}&nbsp;發表</span>&nbsp;&nbsp;

            <span class="fb-like" data-layout="button"></span>
					<span class="fb-share-button" data-href="http://www.potpro888.com/"
                          data-layout="button_count"></span>&nbsp;&nbsp;&nbsp;
					<span style="color: red"><div class="line-share visible-xs-inline-block">
                            <a href="http://line.naver.jp/R/msg/text/?%E3%80%8E%E5%A6%9E%E4%BB%94%E3%80%82%E4%BC%91%E6%97%A5%E5%A5%BD%E9%A3%9F%E5%85%89%E3%80%8F%E4%B8%89%E7%A8%AE%E9%A2%A8%E5%91%B3%E7%9A%84%E8%96%84%E8%84%86%E7%A1%AC%E9%A4%85%20https%3A%2F%2Ficook.tw%2Frecipes%2F131027">
                                <img height="20" width="84"
                                     src="https://d3kjtz7uyul5bi.cloudfront.net/assets/linebutton_84x20_zh-hant-1643b3a5909754c7d80b9d123e41831f.png"
                                     alt="Linebutton 84x20 zh hant">
                            </a></div></span>
        </div>
        <h3 class="zeroPadding title-potmaster">{{$video->title}}</h3>

        <div class="row">
            <div class="col-md-7 col-sm-12">
                <div class="thumbnail " id="videoClip">
                    <iframe width="100%" src="{{$video->youtube_url}}" frameborder="0"
                            allowfullscreen="">
                    </iframe>
                </div>
            </div>
            <div class="col-md-5 col-sm-12">
                <p class="text-potmaster">
                    {{$video->body}}
                </p>

            </div>
        </div>

        <h5>相關設備:&nbsp;&nbsp;湯蒸鍋,免火再煮鍋</h5>
        <hr class="zeroMargin" style="line-height: 0.2em">
        <h5 class="">關鍵字:&nbsp;&nbsp;<span class="text-warning">湯蒸鍋,節能原理,免火再煮鍋,瓦斯用量比較</span>
    </div>
@stop
