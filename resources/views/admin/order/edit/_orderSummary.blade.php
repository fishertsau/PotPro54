{{--訂單內容--}}
<h4 class="text-primary">訂單內容</h4>
<table class="table">
    <tr>
        <td>訂單號碼</td>
        <td>{{ $order->po_no }}</td>
    </tr>
    <tr>
        <td>訂單狀態</td>
        <td>{{ $order->status_text}}</td>
    </tr>
    <tr>
        <td>階段/狀態</td>
        <td>{{$order->phase_text}} / {{$order->phase_status_text}}</td>
    </tr>
    <tr>
        <td>訂購人</td>
        <td>{{ $order->buyer->name }}</td>
    </tr>
    {{--<tr>--}}
        {{--<td>下單人</td>--}}
        {{--<td>{{ $order->entry_person->name }}</td>--}}
    {{--</tr>--}}
    <tr>
        <td>金額/數量</td>
        <td>NTD{{number_format($order->amount)}} / {{ number_format($order->qty) }}</td>
    </tr>

</table>