@can('audit-order'){{--有審核訂單權限--}}
@include('admin.order.edit._orderAudit')
@endcan

<div class="panel panel-primary ">
    <div class="panel-heading clearfix">
        <h4 class="panel-title">
            <i class="livicon" data-name="list-ul" data-size="16" data-loop="true"
               data-c="#fff" data-hc="white"></i>&nbsp;訂單明細
        </h4>
        @include('admin.order.partials._goBackToListViewBtn')
    </div>

    <div class="panel-body">
        @include('admin.order.edit._orderSummary')
        @include('admin.order.edit._orderItemList')
        @include('admin.order.edit._orderShipment')
        @include('admin.order.edit._orderAuditRecord')
    </div>
</div>
