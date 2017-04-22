@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    @parent-@lang('siteContent/title.title')
@stop

{{-- page level styles --}}
@section('header_styles')
    <link href="{{ asset('assets/vendors/summernote/summernote.css') }}" rel="stylesheet"/>
    <!--end of page level css-->
@stop

{{-- Page content --}}
@section('content')
    <section class="content-header">
        <!--section starts-->
        <h1><i class="livicon" data-name="desktop" data-size="20" data-c="#000" data-hc="#000"
               data-loop="true"></i> @lang('siteContent/title.title')-{{$contentCategoryDescription}}</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="14" data-c="#000"
                                                       data-loop="true"></i>
                    @lang('general.home')
                </a>
            </li>
            <li>
                <a href="#">@lang('siteContent/title.siteContent')</a>
            </li>
            <li class="active">{{$contentCategoryDescription}}</li>
        </ol>
    </section>
    <!--section ends-->
    <section class="content paddingleft_right15">
        <!--main content-->
        <div class="row">
            {!! Form::open(['method' => 'PATCH', 'url' => 'admin\siteContent\lifeGasSaving']) !!}

            {{--submit button--}}
            <div class="col-lg-12">
                <div class="form-group">
                    <button type="submit" class="btn btn-success form-control">@lang('siteContent/form.save')</button>
                </div>
            </div>

            @foreach($contents as $content)
                <div class="col-lg-12">
                    <input type="hidden" name="contentItem[]" value="{{$content->title}}">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <i class="livicon" data-name="edit" data-size="16" data-loop="true"
                                   data-c="#fff" data-hc="white"></i>
                                {{$content->description}}</h4>
                                <span class="pull-right">
                                <i class="glyphicon glyphicon-chevron-up clickable"></i>
                                </span>
                        </div>
                        <div class="panel-body">
                            <textarea name="{{$content->title}}"
                                      rows="4" cols="50" class="textarea form-control"
                                      style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                {{$content->body}}
                            </textarea>
                        </div>
                    </div>
                </div>
            @endforeach

            {{--submit button--}}
            <div class="col-lg-12">
                <div class="form-group">
                    <button type="submit" class="btn btn-success form-control">@lang('siteContent/form.save')</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <!--main content ends-->
    </section>
    @stop

    {{-- page level scripts --}}
    @section('footer_scripts')
            <!-- begining of page level js -->
    <script src="{{ asset('assets/vendors/summernote/summernote.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('assets/js/admin/pages/siteContent.js') }}"></script>
@stop
