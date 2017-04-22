@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
@parent-@lang('group/title.add-group')
@stop


{{-- Page content --}}
@section('content')
@include('admin.product.group._contentHeader',
['section_title'=> '新增系列產品'])

        <!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="livicon" data-name="plus-alt" data-size="16" data-loop="true"
                                               data-c="#fff" data-hc="white"></i>
                        @lang('group/title.add-group')
                    </h4>
                        <span class="pull-right">
                            <a href="{{ URL::previous()}}" style="color: white">
                                回上一頁 &nbsp; <i class="fa fa-reply"></i>
                            </a>
                         </span>
                </div>
                <div class="panel-body">
                    @include('admin.partials.errors')

                    {!! Form::model($group = new \App\Models\Group, ['method'=>'post','files'=>true,'action'=>'Admin\Product\GroupController@store']) !!}

                    <div class="form-horizontal">
                        @include('errors.list')

                                <!--主類別-->
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">主類別</label>

                            <div class="col-sm-4">
                                {!! Form::select('category', $categories,null, ['id'=>'category','class'=>'form-control']) !!}
                            </div>
                        </div>

                        <!--子類別-->
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">子類別</label>

                            <div class="col-sm-4">
                                {!! Form::select('group_sub_category_id',$subCategories ,null, ['id'=>'group_sub_category_id','class'=>'form-control']) !!}
                            </div>
                        </div>


                        <!--系列名稱-->
                        <div class="form-group">
                            {!! Form::label('title', '系列名稱',['class'=>'col-sm-2 control-label']) !!}

                            <div class="col-sm-8">
                                {!! Form::text('title', null , ['class'=>'form-control','placeholder'=>'系列名稱','id'=>'title', 'required'=>'true']) !!}
                            </div>
                        </div>


                        <hr/>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-4">
                                <a class="btn btn-danger" href="{{ url('/admin/product/group') }}">
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

{{-- page level scripts --}}
@section('footer_scripts')
        <!-- begining of page level js -->
{{--my javascript--}}
<script type="text/javascript" src="{{ asset('assets/js/admin/pages/groupCreate.js') }}"></script>
@stop