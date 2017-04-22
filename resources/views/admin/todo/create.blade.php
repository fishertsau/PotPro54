@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
@parent-@lang('todo/title.add-todo')
@stop

{{-- Page content --}}
@section('content')
@include('admin.todo._contentHeader',
['section_title'=> '新增待辦事項'])

        <!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="livicon" data-name="plus-alt" data-size="16" data-loop="true"
                                               data-c="#fff" data-hc="white"></i>
                        @lang('todo/title.create')
                    </h4>
                        <span class="pull-right">
                            <a href="{{ URL::previous()}}" style="color: white">
                                回上一頁 &nbsp; <i class="fa fa-reply"></i>
                            </a>
                         </span>
                </div>
                <div class="panel-body">
                    @include('admin.partials.errors')

                    {!! Form::model($todo = new \App\Models\Todo,
                    ['method'=>'post','action'=>'Admin\TodoController@store']) !!}

                    {{csrf_field()}}
                    @include('admin.todo._form')


                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
    <!-- row-->
</section>
@stop

