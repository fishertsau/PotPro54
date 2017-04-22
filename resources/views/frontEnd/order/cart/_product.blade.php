<div class="app-cartProduct">

    {{--產品名稱--}}
    <div class="app-cartProduct--title">
        <p class="{{$item->getType()=='產品'?'':'text-warning'}}">
            <?php $photoPath = $item->type == "product" ?
                    $item->product->coverPhoto_path :
                    $item->addon->coverPhoto_path;?>
                <img src="{{URL::asset('assets/images/cover')}}/{{$photoPath}}"
                     style="max-width:20px"/>
            <span class="RWDText-20">{{$item->name}}</span>
        </p>
    </div>

    {{--單價--}}
    <div class="app-cartProduct--unitPrice">
        <p class="RWDText-20">單價${{number_format($item->price)}}</p>
    </div>

    {{--小計--}}
    <div class="app-cartProduct-subTotal">
        <p class="text-danger RWDText-20">小計${{number_format($item->subtotal)}}</p>
    </div>

    {{--數量--}}
    <div class="app-cartProduct--qty">
        @if($item->type=='product')
            <form method="post" action="/cart/{{$item->rowid}}/edit">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="input-group input-group-sm">
                    <input type="number"
                           name='qty'
                           class="form-control input-group-sm"
                           placeholder="數量"
                           aria-describedby="" min="1" value="{{$item->qty}}"
                           >

                    <div class="input-group-btn">
                        <button type="" class="btn btn-warning btn-sm" id="btn_{{$item->id}}">
                            <span class="RWDText-16">變更</span>
                        </button>
                    </div>
                </div>
            </form>
        @else
            <span class="text-warning RWDText-20">數量:{{$item->qty}}</span>
        @endif
    </div>



</div>


