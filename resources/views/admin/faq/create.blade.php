@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Create New faq
    @parent
    @stop

    {{-- Page content --}}
    @section('content')
    @include('admin.faq._contentHeader',
  ['section_title'=> '新增常見問題'])

            <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary ">
                    <div class="panel-heading">
                        <h4 class="panel-title"><i class="livicon" data-name="plus-alt" data-size="16" data-loop="true"
                                                   data-c="#fff" data-hc="white"></i>
                            @lang('admin/faq/title.add-faq')
                        </h4>

                    <span class="pull-right">
                            <a href="{{ URL::previous()}}" style="color: white">
                                回上一頁 &nbsp; <i class="fa fa-reply"></i>
                            </a>
                         </span>
                    </div>
                    <div class="panel-body">
                        @include('admin.partials.errors')

                        {!! Form::model($faq = new \App\Models\Marketing\Faq, ['method'=>'post','action'=>'Admin\FaqController@store']) !!}

                        @include('admin.faq._form',['isNew'=>true])

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
        <!-- row-->
    </section>

@stop