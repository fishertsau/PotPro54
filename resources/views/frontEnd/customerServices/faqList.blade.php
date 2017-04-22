@extends('frontEnd/layouts/master2Column')

{{-- Page title --}}
@section('title')
    節能產品
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/faq.css') }}">

    {{--<link href="{{ asset('assets/css/frontend/group.css') }}" rel="stylesheet" type="text/css">--}}
    <!--end of page level css-->
    @stop

    {{-- breadcrumb --}}
    @section('top')
    @include('frontEnd.partials._breadcum',['title'=>'客戶服務','subTitle'=>'常見問題'])
    @stop

    {{-- Page content --}}
    @section('content')
            <!-- Container Section Strat -->
    <h3 class="text-nature">常見問題</h3>
    <div class="control-bar sandbox-control-bar mt10">
        <span class="btn btn-primary mr10 mb10 filter active" data-filter="all"
              style="background-color: #02a98e">所有問題</span>
        @foreach($faqCat_list as $catNumber=>$title)
            <span class="btn btn-default mr10 mb10 filter" data-filter=".category-{{$catNumber}}">{{$title}}</span>
        @endforeach

    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="panel-group panel-accordion faq-accordion">
                <div id="faq">
                    @foreach($faqs as $index => $faq)
                        <div class="mix category-{{$faq->category}} col-lg-12 panel panel-default"
                             data-value="{{$index+1}}">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#faq"
                                       href="#question{{$index}}">
                                        <strong class="c-gray-light">{{$index+1}}.</strong>
                                        {{$faq['title']}}
                                        <span class="pull-right">
                                                    <i class="glyphicon glyphicon-plus"></i>
                                                </span>
                                    </a>
                                </h4>
                            </div>
                            <div id="question{{$index}}" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p>
                                        {{$faq['body']}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/vendors/mixitup/jquery.mixitup.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/frontend/faq.js') }}"></script>
@stop
