@extends('admin.layouts.default')

{{-- Page title --}}
@section('title')
@parent-@lang('role/title.management')
@stop


{{-- Content --}}
@section('content')
@include('admin.auth.role._contentHeader',
    ['section_title'=> '新增群組'])

        <!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="livicon" data-name="wrench" data-size="16" data-loop="true"
                                               data-c="#fff" data-hc="white"></i>
                        @lang('role/title.create')
                    </h4>
                        <span class="pull-right">
                            <a href="{{ URL::previous()}}" style="color: white">
                                回上一頁 &nbsp; <i class="fa fa-reply"></i>
                            </a>
                        </span>
                </div>
                <div class="panel-body">
                    @include('admin.partials.errors')

                    {!! Form::model($role = new \App\Models\Authorization\Role, ['method'=>'post','action'=>'Auth\RoleController@store']) !!}

                    <div class="form-horizontal">
                        <div class='form-group'>

                            {!! Form::label('category', '類別',['class'=>'col-sm-2 control-label']) !!}

                            <div class="col-sm-3">
                                {!! Form::select( 'category' ,$role->getCatlist() , null , ['id'=>'tag_list','class'=>'form-control tagSelect'] ) !!}
                            </div>
                        </div>

                        <div class="form-group {{ $errors->
                                first('name', 'has-error') }}">
                            <label for="title" class="col-sm-2 control-label">
                                @lang('role/form.name')
                            </label>

                            <div class="col-sm-5">
                                <input type="text" id="name" name="name" class="form-control"
                                       placeholder=@lang('role/form.name') value="{!! old('name', $role->
                                    name) !!}" required>
                            </div>
                            <div class="col-sm-4">
                                {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>

                        {{--群組內容--}}
                        <div class="form-group">
                            <label for="description"
                                   class="col-sm-2 control-label">@lang('role/form.description')</label>

                            <div class="col-sm-5">
                                {!! Form::text('description', null , ['class'=>'form-control','placeholder'=>'群組內容','id'=>'description','required'=>true]) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-4">
                                <a class="btn btn-danger" href="#">
                                    @lang('button.cancel')
                                </a>
                                <button type="submit" class="btn btn-success">
                                    @lang('button.save')
                                </button>
                            </div>
                        </div>
                    </div>


                    {!! Form::close() !!}

                    <hr/>

                </div>
            </div>
        </div>
    </div>
    <!-- row-->
</section>
@stop