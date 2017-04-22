<table width="100%" class="table table-nomargin table-bordered table-striped formTable"
       {{--style="background-color: white"--}}>
    <thead>
    <tr>
        <th class="text-center RWDText-20" style="width: 5%">#</th>
        <th class="text-center RWDText-20" style="width: 8%">類別</th>
        <th class="text-center RWDText-20" style="width: 40%">產品</th>
        <th class="text-center RWDText-20" style="width: 15%">規格</th>
        <th class="text-center RWDText-20" style="width: 5%">修改</th>
    </tr>
    </thead>
    <tbody>

    <?php $index = 1 ?>
    @foreach($cart as $item)
        <tr>
            <td><p class="text-center">{!! $index !!}</p></td>
            <td><p class="text-center {{$item->getType()=='產品'?'':'text-warning'}}">
                    {{$item->getType()=='產品'?'':'&nbsp;&nbsp;'}}
                    {{$item->getType()}}
                </p>
            </td>
            <td>
                @include('frontEnd.order.cart._product')
            </td>

            <td class="" style="font-size: small">
                @if(!$item->note=='')
                    附註:{{$item->note}}<br/>
                @endif
                {{$item->options->setting}}
            </td>


            <td class="text-center">
                @if ($item->type =="product")
                    @if($item->product->group->add_on_allowed)
                        <form method="get" action="addOn/edit">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="group_id" value="{{$item->groupid}}">
                            <button type="submit" class="btn btn-success btn-xs">
                                <span class="RWDText-16">加工</span>
                            </button>
                        </form>
                    @endif
                @endif
                <form method="post" action="/cart/{{$item->rowid}}/delete" onsubmit="return validateThis()">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-danger btn-xs">
                        <span class="RWDText-16">刪除</span>
                    </button>
                </form>
            </td>
        </tr>
        <? $index++ ?>
    @endforeach
    <tr>
        <td colspan="5" class="text-right">
            <p class="text-right RWDText-20">總金額: <span class="text-primary">${{number_format($total)}}</span></p>

            <p class="text-right RWDText-20">總數量: <span class="text-primary">{{number_format($count)}}</span></p>
        </td>
    </tr>
    </tbody>
</table>

<div>
    <a href="order"
       class="btn btn-big btn-danger full-width"
       style="color:white">
        <span class="RWDText-20">
            <i class="fa fa-check-square-o"></i>&nbsp;&nbsp;進行下單
        </span>
    </a>
</div>
<br/>