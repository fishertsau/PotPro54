<div class="app-orderItem">
    {{--產品名稱--}}
    <div class="app-orderItem--title">
        <p class="text-center {{$item->getType()=='產品'?'':'text-warning'}}">
            <?php $photoPath = $item->type == "product" ?
                    $item->product->coverPhoto_path :
                    $item->addon->coverPhoto_path;?>
            <img src="{{URL::asset('assets/images/cover')}}/{{$photoPath}}"
                 style="max-width:20px"/>
            <span class="RWDText-20">{{$item->name}}</span>
        </p>
    </div>


    {{--單價--}}
    <div class="app-orderItem--unitPrice">
        <p class="RWDText-20">單價${{number_format($item->price)}}</p>
    </div>

    {{--數量--}}
    <div class="app-orderItem--qty">
        <span class="text-warning RWDText-20">數量:{{$item->qty}}</span>

    </div>

    {{--小計--}}
    <div class="app-orderItem--subTotal">
        <p class="text-danger RWDText-20">小計${{number_format($item->subtotal)}}</p>
    </div>
</div>
