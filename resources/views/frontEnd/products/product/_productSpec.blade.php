@if(! $product->spec == '')
    <hr/>
    <h5 class="title-potmaster"><i class="fa fa-square"></i>&nbsp;產品規格</h5>

    <p class="text-potmaster">
        {{$product->spec}}
    </p>

@endif