<td><p class="text-center">{!! $index !!}</p></td>
<td><p class="text-center {{$item->getType()=='產品'?'':'text-warning'}}">
        {{$item->getType()=='產品'?'':'&nbsp;&nbsp;'}}
        {{$item->getType()}}
    </p>
</td>
<td>
    @include('frontEnd.order._orderItem')
</td>

<td class="" style="font-size: small">
    @if(!$item->note=='')
        附註:{{$item->note}}<br/>
    @endif
    {{$item->options->setting}}
</td>