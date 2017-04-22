@extends('frontEnd/layouts/master2Column')

{{-- Page title --}}
@section('title')
    演講與推廣
    @parent
    @stop

    {{-- page level styles --}}
    @section('header_styles')
    {{--    <link href="{{ asset('assets/css/frontend/group.css') }}" rel="stylesheet" type="text/css">--}}
            <!--end of page level css-->
    @stop

    {{-- breadcrumb --}}
    @section('top')
    @include('frontEnd.partials._breadcum',['title'=>'節能資訊','subTitle'=>'演講與推廣'])
    @stop

    {{-- Page content --}}
    @section('content')
            <!-- Container Section Strat -->

    <div style="background-color: white;padding: 5px;" xmlns="http://www.w3.org/1999/html">

        <span>{{$talk->created_at}}&nbsp;發表</span>&nbsp;&nbsp;
        <div class="pull-right" style="width: 40%;">
            @include('frontEnd.eventOrRecord.talks._talkSearch')
        </div>

        <h3 class="zeroPadding title-potmaster">{{$talk->title}}</h3>

        <!--Content-->
        <div>
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <img src="{{URL::asset('images/speech/eventRecord1.JPG')}}" width="100%" align="left">
                </div>
                <div class="col-md-8 col-sm-8 col-xs-8">
                    <h4 class="text-potmaster" style="display: inline;">主辦單位:&nbsp;
                        <a href="http://www.tgpf.org.tw/" target="_blank" style="display: inline;">
                            <img src="{{URL::asset('images/speech/speechCase1.jpg')}}" class="zeroMarginPadding"
                                 style="width:50%;display: inline;">
                        </a>
                    </h4>
                    <h4 class="text-potmaster">演講日期:&nbsp; 2015-11-28</h4>
                    <h4 class="text-potmaster">演講地點:&nbsp;台南市文化中心</h4>
                    <h4 class="text-potmaster">節能講師:&nbsp;楊復成</h4>
                </div>
            </div>

            <hr/>
            <h4 class="title-potmaster"><i class="fa fa-caret-right"></i>&nbsp;活動內容</h4>
            <span class="text-potmaster">演講推廣內容,演講推廣內容,演講推廣內容,演講推廣內容,演講推廣內容,</span>
            <span class="text-potmaster">演講推廣內容,演講推廣內容,演講推廣內容,演講推廣內容,演講推廣內容,</span>
            <span class="text-potmaster">演講推廣內容,演講推廣內容,演講推廣內容,演講推廣內容,演講推廣內容,</span>
            <span class="text-potmaster">演講推廣內容,演講推廣內容,演講推廣內容,演講推廣內容,演講推廣內容,</span>

            <br/>
            <br/>
            <h4 class="title-potmaster"><i class="fa fa-caret-right"></i>&nbsp;活動相片</h4>

            <div class="row">
                @foreach($talk->photos as $photo)
                    <div class="col-md-4 col-sm-4 col-xs-6">
                        <img src="{{URL::asset('assets/images/photos')}}/{{$photo->path}}" class="full-width thumbnail">
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@stop
