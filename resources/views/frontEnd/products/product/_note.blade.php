{{--其他說明--}}
@if(! $product->note == '')
    <hr style="margin:10px 0px;"/>
    <div class="row">
        <div class="col-md-2 col-sm-12 col-xs-12">
            <h4 class="text-nature">其他說明</h4>
        </div>
        <div class="col-md-10 col-sm-12 col-xs-12">
            <p class="text-potmaster">
                {{$product->note}}
            </p>
        </div>
    </div>
@endif