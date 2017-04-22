@extends('admin.layouts.default')

{{-- Page title --}}
@section('title')
    @parent-@lang('order/title.management')
@stop

{{-- page level styles --}}
@section('header_styles')
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/admin/order/orderIndex.css') }}"/>
@stop


@section('content')
    @include('admin.order._contentHeader',
    ['section_title'=> '訂單清單'])

    {{Form::open(['url'=>'admin/order/listExcel','id'=>'generateExcelForm','method'=>'get'])}}
    {{csrf_field()}}
    <input type="text"
           class="hidden"
           name="idList"
           id="idList">
    {{Form::close()}}


    <section class="content paddingleft_right15">

        @include('admin.order.index._orderSearchForm')
        <br/>

        <div class="row">
            <div class="app-content">
                <div v-show="listShow">
                    <div class="panel panel-primary ">
                        <div class="panel-heading clearfix">
                            <h4 class="panel-title pull-left"><i class="livicon" data-name="list-ul" data-size="16"
                                                                 data-loop="true" data-c="#fff" data-hc="white"></i>
                                @lang('order/title.orderlist')
                            </h4>

                            <div class="pull-right">

                                <button class="btn btn-sm btn-default" onclick="outputOrderToExcel()">
                                    <i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;輸出Excel
                                </button>
                            </div>
                        </div>
                        <div class="panel-body" id="listContent"></div>
                    </div>
                </div>

                <div id="orderContent"
                     v-show="!listShow"></div>
            </div>

        </div>
        <!-- row-->
    </section>
@stop

{{-- Body Bottom confirm modal --}}
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/admin/order/orderIndex.js') }}"></script>

    <!-- Modal -->
    <div class="modal fade" id="entry_form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="modal-content">
            </div>
        </div>
    </div>
@stop
