@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Create New test
    @parent
@stop

{{-- Page content --}}
@section('content')
    <section class="content-header">
        <h1>Tests</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16"
                                                       data-color="#000"></i>
                    Dashboard
                </a>
            </li>
            <li>tests</li>
            <li class="active">Create New test</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary ">
                    <div class="panel-heading">
                        <h4 class="panel-title"><i class="livicon" data-name="plus-alt" data-size="16" data-loop="true"
                                                   data-c="#fff" data-hc="white"></i>
                            Create a new test
                        </h4>
                    </div>
                    <div class="panel-body">
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::open(['url' => 'test']) !!}


                        <input name="a_name"/>
                        <input name="a_second_name"/>
                        <input name="subform[another_name]"/>
                        <input name="subform[another_second_name]"/>

                        <div class="form-group">
                            {!! Form::label('title', 'Title: ') !!}
                            {!! Form::text('title', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('body', 'Body: ') !!}
                            {!! Form::text('body', null, ['class' => 'form-control']) !!}
                        </div>


                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-4">
                                <a class="btn btn-danger" href="{{ route('test.index') }}">
                                    @lang('button.cancel')
                                </a>
                                <button type="submit" class="btn btn-success">
                                    @lang('button.save')
                                </button>
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