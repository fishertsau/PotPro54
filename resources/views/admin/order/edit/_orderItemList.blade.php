{{--訂單明細--}}
<hr/>
<h4 class="text-primary">訂購品項</h4>
<table class="table">
    <thead>
    <tr>
        <th>項次</th>
        <th>類別</th>
        <th>產品名稱/型號</th>
        <th>單價</th>
        <th>數量</th>
        <th>小計</th>
        <th>規格</th>
    </tr>
    </thead>
    <tbody>
    @foreach($order->items as $index=>$item)
        <tr>
            <td>{{$index+1}}</td>
            <td>{{$item->type_text}}</td>
            <td>{{$item->item->title}}</td>
            <td>{{number_format($item->price)}}</td>
            <td>{{number_format($item->qty)}}</td>
            <td>{{number_format($item->subtotal)}} </td>
            <td>
                @if(!$item->note=='')
                    附註:{{$item->note}}<br/>
                @endif
                {{$item->setting}}
        </tr>
    @endforeach
    </tbody>
</table>