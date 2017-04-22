@if($order->status_flag=='n')

    @can('shipment-management')
    {{--準備出貨 要輸入出貨紀錄--}}
    @if(($order->phase=='i')&&($order->phase_status_flag=='t'))
        <a class="entry_btn" title="{{$order->po_no}}"
           onclick="showActionForm({{$order->id}},'order_shipped')">
            <button class="btn btn-xs btn-danger">出貨紀錄</button>
        </a>
    @endif
    @endcan

    @can('audit-order') {{--有審核訂單權限--}}
    {{--訂單完成 要審核--}}
    @if(($order->phase=='a')&&($order->phase_status_flag=='t'))
        {{--<a href="/admin/order/{{$order->id}}/edit" class="btn btn-xs btn-success">訂單審核</a>--}}
        <a onclick="fetchEditOrder({{$order->id}})"
           class="btn btn-xs btn-success">訂單審核</a>
    @endif
    @endcan
@endif