@extends('admin.layouts.default')

{{-- Page title --}}
@section('title')
    @parent-@lang('addOn/title.management')
@stop

{{-- page level styles --}}
@section('header_styles')
    <link href="{{ asset('assets/admin/product/addOn/addOnEdit.css') }}" rel="stylesheet" type="text/css"/>
    @stop


    @section('content')
    @include('admin.product.addOn._contentHeader',
    ['section_title'=> '修改內容'])

            <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary ">
                    <div class="panel-heading">
                        <h4 class="panel-title"><i class="livicon" data-name="edit" data-size="16" data-loop="true"
                                                   data-c="#fff" data-hc="white"></i>
                            @lang('addOn/title.edit')
                            &nbsp; &nbsp;
                            @include('admin.product.addOn.partials._showNoteToggleBtn')

                        </h4>

                        <span class="pull-right">
                            <a href="{{ URL::previous()}}" style="color: white">
                                回上一頁 &nbsp; <i class="fa fa-reply"></i>
                            </a>
                         </span>
                    </div>
                    <div class="panel-body">
                        @include('admin.partials.errors')
                        {!! Form::model($add_on, ['method' => 'PATCH', 'files'=> true ,
                        'action' => ['Admin\Product\AddOnController@update', $add_on->id],
                        'onsubmit'=>"return validateThis()"])     !!}

                        @include('admin.product.addOn._form', ['newItem' => false])

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- END modal-->
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/admin/product/addOn/addOnEdit.js') }}"></script>
@stop