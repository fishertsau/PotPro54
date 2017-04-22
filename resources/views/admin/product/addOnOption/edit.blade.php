@extends('admin.layouts.default')

{{-- Page title --}}
@section('title')
@parent-@lang('addOnOption/title.management')
@stop


@section('content')
@include('admin.product.addOnOption._contentHeader',
['section_title'=> '修改內容'])

        <!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="livicon" data-name="edit" data-size="16" data-loop="true"
                                               data-c="#fff" data-hc="white"></i>
                        @lang('addOnOption/title.edit')
                    </h4>
                        <span class="pull-right">
                            <a href="{{ URL::previous()}}" style="color: white">
                                回上一頁 &nbsp; <i class="fa fa-reply"></i>
                            </a>
                         </span>
                </div>
                <div class="panel-body">
                    @include('admin.partials.errors')
                    {!! Form::model($add_on_option, ['method' => 'PATCH', 'action' => ['Admin\Product\AddOnOptionController@update', $add_on_option->id] ])     !!}

                    @include('admin.product.addOnOption._form', ['newItem' => false])

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
        <!-- begining of page level js -->

{{--my javascript--}}
<script type="text/javascript" src="{{ asset('assets/js/admin/pages/addOnOption.js') }}"></script>

@stop