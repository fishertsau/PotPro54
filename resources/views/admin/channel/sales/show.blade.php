@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    編輯通路
    @parent
    @stop


    @section('content')
    @include('admin.channel.sales._contentHeader',
      ['section_title'=> '修改常見問題'])

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
                        <div class="form-horizontal">
                            @include('admin.channel.sales._salesInfo')

                                    <!--帳號開通或關閉-->
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">開通</label>

                                <div class="col-sm-8">
                                    <p class="form-control-static text-primary">{{$sales->activated_text}}</p>
                                </div>
                            </div>

                            <!--價格折數-->
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">折數(%)</label>

                                <div class="col-sm-8">
                                    <p class="form-control-static text-primary">{{$sales->discount_rate}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @include('admin.channel.sales._adjustment')
            </div>
        </div>
    </section>
@stop