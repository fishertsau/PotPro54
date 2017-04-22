@extends('frontEnd/layouts/master2Column')

{{-- Page title --}}
@section('title')
    節能產品
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link href="{{ asset('assets/css/frontend/group.css') }}" rel="stylesheet" type="text/css">
    <!--end of page level css-->
    @stop

    {{-- breadcrumb --}}
    @section('top')
    @include('frontEnd.partials._breadcum',['title'=>'節能案例'])
    @stop

    {{-- Page content --}}
    @section('content')
            <!-- Container Section Strat -->

    <div style="padding:0 10px;">

        <br/>

        <h3 style="display: inline" class="text-nature">案例列表</h3>
        <a href="{{ URL::previous()}}">回上一頁</a>

        <div class="pull-right" style="width: 40%;">
            @include('frontEnd.eventOrRecord.examples._exampleSearch')
        </div>
        <hr/>

        <div id="listContent">
            @if(count($examples)>0)
                <div class="row">
                    <div class="col-md-12">
                        @foreach($examples as $example)
                            <div class="row thumbnail">
                                <div class="col-md-4  col-sm-4 col-xs-5 zeroPadding">
                                <span class="pull-left visible-xs" style="font-size: x-small">{{$example->created_at}}
                                    &nbsp;發表</span>

                                    <h3 class="visible-xs title-potmaster">{{$example->title}}</h3>
                                    <img src="{{ asset('assets/images/cover')}}/{{$example->coverPhoto_path}}"
                                         class="full-width zeroMargin">
                                </div>
                                <div class="col-md-8  col-sm-8 col-xs-7">
                                    <span class="pull-left hidden-xs">{{$example->created_at}}&nbsp;發表</span></h5>
                                    <p class="pull-right">
                                        <a href="/example/{{$example->slug}}">
                                        <span class="text-danger"><i
                                                    class="fa fa-arrow-circle-right"></i>&nbsp;查看細節</span>
                                        </a>
                                    </p>
                                    <br/>

                                    <h3 class="hidden-xs title-potmaster">{{$example->title}}</h3>
                                    <h4>
                                    <span class="text-nature">
                                        使用效果: {!! $example->use_result !!}
                                    </span>
                                    </h4>
                                    @if($example->hasManager())
                                        <hr/>
                                        <h4 class="text-potmaster" style="display: inline">
                                            服務人員:&nbsp;
                                            {{$example->manager->name}} &nbsp;
                                            (電話:{{$example->manager->tel}})
                                        </h4>
                                        @if($example->manager->avatar!='')
                                            <img src="{!! asset('assets/images/cover').'/'.$example->manager->avatar !!}"
                                                 alt="img"
                                                 class="img-responsive pull-right" height="35px"
                                                 width="35px"/>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="text-center">
                        {!! $examples->appends($queryTerm)->render() !!}
                    </div>

                    <script>
                        $(document).ready(function () {
                            $('.pagination a').on('click', function (event) {
                                event.preventDefault();
                                if ($(this).attr('href') != '#') {
                                    $('#listContent').load($(this).attr('href'));
                                }
                            });
                        });
                    </script>
                </div>


            @endif

            @if(count($examples)==0)
                @include('frontEnd.partials._noResult')
            @endif
        </div>

    </div>
@stop