@extends('admin.layouts.default')

{{-- Page title --}}
@section('title')
@parent-@lang('example/title.management')
@stop

{{-- page level styles --}}
@section('header_styles')
        <!--end of page level css-->
<link href="{{ asset('assets/admin/example/exampleEdit.css') }}" rel="stylesheet" type="text/css"/>
@stop

@section('content')
@include('admin.example._contentHeader',
['section_title'=> '修改內容'])

        <!-- Main content -->
<section class="content" id="app">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="livicon" data-name="edit" data-size="16" data-loop="true"
                                               data-c="#fff" data-hc="white"></i>
                        @lang('example/title.edit'): {{$example->title}}
                    </h4>
                        <span class="pull-right">
                            <a href="{{ URL::previous()}}" style="color: white">
                                回上一頁 &nbsp; <i class="fa fa-reply"></i>
                            </a>
                         </span>
                </div>
                <div class="panel-body">
                    @include('admin.partials.errors')
                    {!! Form::model($example, ['method' => 'PATCH', 'action' => ['Admin\Example\ExampleController@update', $example->id]]) !!}

                    <input type="text"
                           class="hidden"
                           v-model="example"
                           value="{{$example}}">

                    <input type="text"
                           class="hidden"
                           v-model="manager"
                           id="manager"
                           value="{{$example->manager}}">

                    @include('admin.example.edit._mangementPanel')

                    <p>&nbsp;</p>
                    @include('admin.example.edit._form')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    @include('admin.example.create._salesSelectionModal')
</section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/admin/example/exampleEdit.js') }}"></script>
@stop