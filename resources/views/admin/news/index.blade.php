@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    @parent-@lang('news/title.management')
@stop

{{-- page level styles --}}
@section('header_styles')
    <link rel="stylesheet" href="{{ asset('assets/admin/news/newsIndex.css') }}"/>
@stop

{{-- Page content --}}
@section('content')
    @include('admin.news._contentHeader',
    ['section_title'=> '消息廣告清單'])

    <section class="content paddingleft_right15">
        <div class="row">
            @include('admin.news._newsSearchForm')
            <br/>

            <div class="panel panel-primary ">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title pull-left">
                        <i class="livicon" data-name="list-ul" data-size="16"
                           data-loop="true" data-c="#fff" data-hc="white"></i>
                        @lang('news/title.newslist')
                    </h4>

                    <div class="pull-right">
                        <a href="{{ route('news.create') }}" class="btn btn-sm btn-default">
                            <span class="glyphicon glyphicon-plus"></span> @lang('button.create')</a>
                    </div>
                </div>
                <br/>

                <div class="panel-body" id="newsListContent"></div>
            </div>
        </div>
        <!-- row-->
    </section>
@stop

{{-- Page-level footer js or modal --}}
@section('footer_scripts')
    <script type="text/javascript" src="{{  asset('assets/admin/news/newsIndex.js') }}"></script>

    @include('admin.partials._delete_confirmModal')

    <script>
//        $('div.alert').not('.alert-important').delay(2500).fadeOut(350);
    </script>
@stop
