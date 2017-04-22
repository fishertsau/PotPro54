@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    @parent-@lang('todo/title.management')
@stop

{{-- page level styles --}}
@section('header_styles')
    <link rel="stylesheet" href="{{ asset('assets/admin/todo/todoIndex.css') }}"/>
@stop

{{-- Page content --}}
@section('content')
    @include('admin.todo._contentHeader',
    ['section_title'=> '待辦事項清單'])

    <section class="content paddingleft_right15">
        <div class="row">
            {{--@include('admin.todo._newsSearchForm')--}}
            <br/>

            <div class="panel panel-primary ">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title pull-left">
                        <i class="livicon" data-name="list-ul" data-size="16"
                           data-loop="true" data-c="#fff" data-hc="white"></i>
                        @lang('todo/title.todolist')
                    </h4>

                    <div class="pull-right">
                        <a href="{{ route('todo.create') }}" class="btn btn-sm btn-default">
                            <span class="glyphicon glyphicon-plus"></span> @lang('button.create')</a>
                    </div>
                </div>
                <br/>

                <div class="panel-body" id="listContent">
                    @include('admin.todo._todoList')
                </div>
            </div>
        </div>
        <!-- row-->
    </section>
@stop

{{-- Page-level footer js or modal --}}
@section('footer_scripts')
    <script type="text/javascript" src="{{  asset('assets/admin/todo/todoIndex.js') }}"></script>

    @include('admin.partials._delete_confirmModal')

    <script>
        //        $('div.alert').not('.alert-important').delay(2500).fadeOut(350);
    </script>
@stop
