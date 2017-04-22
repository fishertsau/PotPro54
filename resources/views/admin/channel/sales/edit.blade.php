@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    編輯通路
    @parent
    @stop


    @section('content')
    @include('admin.channel.sales._contentHeader',
      ['section_title'=> '修改通路設定'])

            <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary ">
                    <div class="panel-heading">
                        <h4 class="panel-title"><i class="livicon" data-name="edit" data-size="16" data-loop="true"
                                                   data-c="#fff" data-hc="white"></i>
                            @lang('admin/channel/sales/title.edit')
                        </h4>

                    <span class="pull-right">
                            <a href="{{ URL::previous()}}" style="color: white">
                                回上一頁 &nbsp; <i class="fa fa-reply"></i>
                            </a>
                         </span>
                    </div>
                    <div class="panel-body">
                        @include('admin.partials.errors')

                        {!! Form::model($sales, ['method' => 'PATCH', 'action' => ['Admin\Channel\SalesController@update', $sales->id] ])     !!}

                        @include('admin.channel.sales._form')

                        {!! Form::close() !!}

                    </div>
                </div>

                @include('admin.channel.sales._adjustment')
            </div>
        </div>
    </section>
@stop