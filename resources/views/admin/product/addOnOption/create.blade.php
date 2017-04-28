@extends('admin.layouts.default')

{{-- Page title --}}
@section('title')
    @parent-@lang('addOnOption/title.add-addOnOption')
@stop


{{-- page level styles --}}
@section('header_styles')
    <link href="{{ asset('assets/vendors/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <!--end of page level css-->
@stop


{{-- Page content --}}
@section('content')
    @include('admin.product.addOnOption._contentHeader',
    ['section_title'=> '新增加工配件'])

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary ">
                    <div class="panel-heading">
                        <h4 class="panel-title"><i class="livicon" data-name="plus-alt" data-size="16" data-loop="true"
                                                   data-c="#fff" data-hc="white"></i>
                            @lang('addOnOption/title.add-addOnOption')
                        </h4>
                        <span class="pull-right">
                            <a href="{{ URL::previous()}}" style="color: white">
                                回上一頁 &nbsp; <i class="fa fa-reply"></i>
                            </a>
                         </span>
                    </div>
                    <div class="panel-body">
                        @include('admin.partials.errors')

                        {!! Form::model($add_on_option = new \App\Models\Product\AddOnOption,
                        ['method'=>'post',
                        'files'=>true,
                        'action'=>'Admin\Product\AddOnOptionController@store']) !!}

                        <div class="form-horizontal">
                            <!--標題-->
                            <div class="form-group">
                                {!! Form::label('title', '標題',['class'=>'col-sm-2 control-label']) !!}

                                <div class="col-sm-8">
                                    {!! Form::text('title', null , ['class'=>'form-control','placeholder'=>'標題','id'=>'title','required'=>true]) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-offset-2 col-md-8">
                                    <button id="SubmitBtn" class="btn btn-success full-width" type="submit"><span
                                                class="glyphicon glyphicon-ok-sign"></span>&nbsp;送出新增
                                    </button>
                                </div>
                            </div>

                        </div>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
        <!-- row-->
    </section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <!-- begining of page level js -->
    <!--edit blog-->
    <script src="{{ asset('assets/vendors/select2/js/select2.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/admin/pages/addOnOption.js') }}" type="text/javascript"></script>
@stop