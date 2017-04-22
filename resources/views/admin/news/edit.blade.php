@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    @parent-@lang('news/title.management')
@stop

{{-- page level styles --}}
@section('header_styles')
    <link href="{{ asset('assets/admin/news/newsEdit.css') }}" rel="stylesheet" type="text/css">
    @stop

    @section('content')
    @include('admin.news._contentHeader',
    ['section_title'=> '修改內容'])

            <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary ">
                    <div class="panel-heading">
                        <h4 class="panel-title"><i class="livicon" data-name="edit" data-size="16" data-loop="true"
                                                   data-c="#fff" data-hc="white"></i>
                            @lang('news/title.edit')
                        </h4>
                        <span class="pull-right">
                            <a href="{{ URL::previous()}}" style="color: white">
                                回上一頁 &nbsp; <i class="fa fa-reply"></i>
                            </a>
                        </span>
                    </div>
                    <div class="panel-body">
                        @include('admin.partials.errors')
                        {!! Form::model($news, ['method' => 'PATCH', 'action' => ['Admin\NewsController@update', $news->id]]) !!}

                        @include('admin.news._form')

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript" src="{{  asset('assets/admin/news/newsEdit.js') }}"></script>
@stop