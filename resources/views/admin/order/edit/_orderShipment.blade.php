{{--出貨紀錄--}}
<hr/>
<h4 class="text-primary">出貨紀錄</h4>

@if($order->shipment==null)
    <p>尚無出貨紀錄!</p>
@else
    @include('admin.order.edit._shipmentRecord')
@endif