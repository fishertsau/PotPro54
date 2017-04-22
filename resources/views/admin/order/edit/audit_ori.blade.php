@extends('admin.layouts.default')

{{-- Page title --}}
@section('title')
    @parent-@lang('order/title.orderdetail')
@stop

@section('content')
    @include('admin.order._contentHeader',
        ['section_title'=> '訂單審核/明細'])
    <section class="content paddingleft_right15">
        <div class="row">
            <div class="col-lg-12">

                @if(isset($audit))
                    @include('admin.order.edit._orderAudit')
                @endif

                <div class="panel panel-primary ">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">
                            <i class="livicon" data-name="list-ul" data-size="16" data-loop="true"
                               data-c="#fff" data-hc="white"></i>&nbsp;訂單明細
                        </h4>
                        @if(!isset($audit))
                            <span class="pull-right">
                            <a href="{{ URL::previous()}}" style="color: white">
                                回上一頁 &nbsp; <i class="fa fa-reply"></i>
                            </a>
                         </span>
                        @endif
                    </div>

                    <div class="panel-body">
                        @include('admin.order.edit._orderSummary')
                        @include('admin.order.edit._orderItemList')
                        @include('admin.order.edit._orderShipment')
                        @include('admin.order.edit._orderAuditRecord')
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop