<table class="table">
    <tr>
        <td>出貨日期</td>
        <td>{{ $order->shipment->shipped_at }}</td>
    </tr>
    <tr>
        <td>記錄人</td>
        <td>{{ $order->shipment->entry_person->name }}</td>
    </tr>

    <tr>
        <td>銷貨單號</td>
        <td>{{ $order->shipment->sales_slip_no }}</td>
    </tr>
    <tr>
        <td>貨運公司</td>
        <td>{{ $order->shipment->shipper }}</td>
    </tr>
    <tr>
        <td>追蹤號碼</td>
        <td>{{ $order->shipment->tracking_no }}</td>
    </tr>
</table>