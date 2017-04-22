{{--適用料理--}}
@if(! $product->body=='')
    <hr/>
    <h5 class="title-potmaster"><i class="fa fa-square"></i>&nbsp;產品介紹</h5>
    <p class="text-potmaster"><i class="fa fa-check"></i>&nbsp;
        {{$product->body}}
    </p>
@endif