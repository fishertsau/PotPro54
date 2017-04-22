{{--產品特色--}}
@if(! $product->group->description=='')
    <div class="row">
        <div class="col-md-2 col-sm-12 col-xs-12">
            <h4 class="text-nature">產品特色</h4>
        </div>
        <div class="col-md-10 col-sm-12 col-xs-12">
            <p class="text-potmaster">
                {{$product->group->description}}
            </p>
        </div>
    </div>
@endif