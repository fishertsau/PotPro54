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

    <br/>
    <h3 style="display: inline" class="text-nature">演講與推廣列表</h3>
    <a href="{{ URL::previous()}}">回上一頁</a>

    <div class="pull-right" style="width: 40%;">
        @include('frontEnd.eventOrRecord.talks._talkSearch')
    </div>
    <hr/>

    @if(count($talks)>0)
        <div class="row">
            <div class="col-md-12">

                @foreach($talks as $talk)
                    <div class="row thumbnail ">
                        <div class="col-md-4  col-sm-4 col-xs-5 zeroPadding">
                            <img src="images/speech/@{{speech.eventRecordImageUrl}}" class="full-width zeroMargin">
                        </div>
                        <div class="col-md-8 col-sm-8 col-xs-7">

                            <p class="pull-left">
                                {{$talk->created_at}}&nbsp;發表
                            </p>

                            <p class="pull-right">
                                <a href="talk/{{$talk->id}}">
                                    <span class="text-danger"><i class="fa fa-arrow-circle-right"></i>&nbsp;看更多</span>
                                </a>
                            </p><br/>

                            <h3 class="title-potmaster">{{$talk->title}}</h3>
                            <h4 class="text-potmaster">主辦單位:&nbsp;
                                <a href="http://www.tgpf.org.tw/" target="_blank" style="display: inline;">
                                    <img src="images/speech/@{{speech.imageUrlMain}}" class="zeroMarginPadding"
                                         style="width:60%;display: inline;">
                                </a>
                            </h4>
                            <h4 class="text-potmaster">執行單位:&nbsp;
                                <a href="http://www.tgpf.org.tw/" target="_blank" style="display: inline;">
                                    <img src="images/speech/@{{speech.imageUrlDo}}" class="zeroMarginPadding"
                                         style="width:60%;display: inline;">
                                </a>
                            </h4>

                            <h4 class="text-potmaster">協辦單位:&nbsp;
                                <a href="http://www.tgpf.org.tw/" target="_blank" style="display: inline;">
                                    <img src="images/speech/@{{speech.imageUrlHelpDo}}" class="zeroMarginPadding"
                                         style="width:25%;display: inline;">

                                    <p style="display: inline">台南市烹飪商業同業公會</p>
                                </a>
                            </h4>
                            <h4 class="text-potmaster">演講日期:&nbsp;<span class="text-potmaster">@{{speech.date}}</span>
                            </h4>
                            <h4 class="text-potmaster">演講地點:&nbsp;<span class="text-potmaster"> 台南市文化中心</span></h4>
                            <h4 class="text-potmaster">節能講師:&nbsp;楊復成</h4>

                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center">
                {!! $talks->appends($queryCondition)->render() !!}
            </div>

        </div>
    @endif

    @if(count($talks)==0)
        <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h4><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp;搜尋不到符合條件的演講與推廣!</h4>
            No any talks or promotion activities are found.
        </div>
    @endif
@stop
