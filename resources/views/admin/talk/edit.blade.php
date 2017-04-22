@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    @parent-@lang('talk/title.management')
@stop

{{-- page level styles --}}
@section('header_styles')
    <link href="{{ asset('assets/vendors/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/vendors/summernote/summernote.css') }}" rel="stylesheet"/>

    <!-- DropZone  css-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/dropzone.css" rel="stylesheet">
    <!--end of page level css-->
    @stop

    @section('content')
    @include('admin.talk._contentHeader',
    ['section_title'=> '修改內容'])

            <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary ">
                    <div class="panel-heading">
                        <h4 class="panel-title"><i class="livicon" data-name="edit" data-size="16" data-loop="true"
                                                   data-c="#fff" data-hc="white"></i>
                            @lang('talk/title.edit')
                        </h4>
                        <span class="pull-right">
                            <a href="{{ URL::previous()}}" style="color: white">
                                回上一頁 &nbsp; <i class="fa fa-reply"></i>
                            </a>
                         </span>
                    </div>
                    <div class="panel-body">
                        @include('admin.partials.errors')
                        {!! Form::model($talk, ['method' => 'PATCH', 'action' => ['Admin\TalkController@update', $talk->id]]) !!}

                        @include('admin.talk._form')

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    @stop

    {{-- page level scripts --}}
    @section('footer_scripts')
            <!-- begining of page level js -->
    <script src="{{ asset('assets/vendors/select2/js/select2.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/summernote/summernote.min.js') }}" type="text/javascript"></script>

    <!-- DropZone js-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/dropzone.js"></script>
    <script type="text/javascript" src="{{ asset('assets/js/admin/myDropZoneControl.js')}}"></script>

    {{--my javascript--}}
    <script type="text/javascript" src="{{ asset('assets/js/admin/pages/talk.js') }}"></script>
@stop