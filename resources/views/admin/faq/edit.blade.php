@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Edit a faq
    @parent
    @stop


    @section('content')
    @include('admin.faq._contentHeader',
      ['section_title'=> '修改常見問題'])

            <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary ">
                    <div class="panel-heading">
                        <h4 class="panel-title"><i class="livicon" data-name="edit" data-size="16" data-loop="true"
                                                   data-c="#fff" data-hc="white"></i>
                            @lang('admin/faq/title.edit')
                        </h4>

                    <span class="pull-right">
                            <a href="{{ URL::previous()}}" style="color: white">
                                回上一頁 &nbsp; <i class="fa fa-reply"></i>
                            </a>
                         </span>
                    </div>
                    <div class="panel-body">
                        @include('admin.partials.errors')

                        {!! Form::model($faq, ['method' => 'PATCH', 'action' => ['Admin\FaqController@update', $faq->id] ])     !!}

                        @include('admin.faq._form')

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </section>
@stop