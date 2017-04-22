@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
@parent-@lang('product/title.add-product')
@stop


{{-- Page content --}}
@section('content')
@include('admin.product.product._contentHeader',
['section_title'=> '新增系列產品'])

        <!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="livicon" data-name="plus-alt" data-size="16" data-loop="true"
                                               data-c="#fff" data-hc="white"></i>
                        @lang('product/title.add-product')
                    </h4>
                        <span class="pull-right">
                            <a href="{{ URL::previous()}}" style="color: white">
                                回上一頁 &nbsp; <i class="fa fa-reply"></i>
                            </a>
                         </span>
                </div>
                <div class="panel-body">
                    @include('admin.partials.errors')

                    {!! Form::model($product = new \App\Models\Product\Product, ['method'=>'post','files'=>true,'action'=>'Admin\Product\ProductController@store']) !!}

                    <div class="form-horizontal">
                        @include('errors.list')

                                <!--手動上下架-->
                        <div class="form-group">
                            <label class="col-sm-2 control-label">產品編號</label>

                            <div class="col-sm-10">
                                <p class="form-control-static" style="font-size: larger">
                                    *系統自動產生
                                </p>
                            </div>
                        </div>


                        <!--子類別-->
                        {{--<div class="form-group">--}}
                            {{--<label for="" class="col-sm-2 control-label">產品系列</label>--}}

                            {{--<div class="col-sm-3">--}}
                                {{--{!! Form::select('group_id', $group_list ,null, ['class'=>'form-control selectList','placeholder'=>'產品系列','id'=>'group_id','required'=>'true']) !!}--}}
                            {{--</div>--}}
                        {{--</div>--}}


                        <!--產品名稱-->
                        <div class="form-group">
                            {!! Form::label('title', '產品名稱',['class'=>'col-sm-2 control-label']) !!}

                            <div class="col-sm-8">
                                {!! Form::text('title', null , ['class'=>'form-control','placeholder'=>'產品名稱','id'=>'title','required'=>'true']) !!}
                            </div>
                        </div>

                        <hr/>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-4">
                                <a class="btn btn-danger" href="{{ url('/admin/product/product') }}">
                                    <i class="fa fa-times"></i> @lang('button.cancel')
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <span class="glyphicon glyphicon-ok-sign"></span>&nbsp; @lang('button.save')
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
</section>
@stop

