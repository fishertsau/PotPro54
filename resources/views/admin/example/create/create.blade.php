@extends('admin.layouts.default')

{{-- Page title --}}
@section('title')
    @parent-@lang('example/title.add-example')
@stop



@section('header_styles')
    {{-- page level styles --}}
    <link href="{{ asset('assets/admin/example/exampleCreate.css') }}" rel="stylesheet" type="text/css"/>
    @stop

    @section('content')
    @include('admin.example._contentHeader',
    ['section_title'=> '新增案例'])

            <!-- Main content -->
    <section class="content" id="app">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary ">
                    <div class="panel-heading">
                        <h4 class="panel-title"><i class="livicon" data-name="plus-alt" data-size="16" data-loop="true"
                                                   data-c="#fff" data-hc="white"></i>
                            @lang('example/title.add-example')
                        </h4>
                        <span class="pull-right">
                            <a href="{{ URL::previous()}}" style="color: white">
                                回上一頁 &nbsp; <i class="fa fa-reply"></i>
                            </a>
                         </span>
                    </div>
                    <div class="panel-body">
                        @include('admin.partials.errors')
                        {!! Form::model($example = new \App\Models\Example\Example, ['method'=>'post','action'=>'Admin\Example\ExampleController@store']) !!}

                        <div class="form-horizontal">
                            <!--標題-->
                            <div class="form-group">
                                {!! Form::label('title', '案例名稱',['class'=>'col-sm-2 control-label']) !!}

                                <div class="col-sm-8">
                                    {!! Form::text('title', null , ['class'=>'form-control','placeholder'=>'標題','id'=>'title','required'=>true]) !!}
                                    <p class="text-danger">*最少3個字</p>
                                </div>
                            </div>
                            <hr>


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
        @include('admin.example.create._userSelectionModal')
        @include('admin.example.create._userListContentTemplate')
        @include('admin.example.create._userItemTemplate')
    </section>
@stop