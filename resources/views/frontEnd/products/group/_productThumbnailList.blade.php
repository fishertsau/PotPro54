@if(count($group->products)>0)
    <br/>
    <div class="row">
        <div class="col-md-12 project_images">
            <div class="text-center">
                <h3 class="border-potmaster">
                    <span class="heading_border bg-potmaster">系列產品</span>
                </h3>
            </div>
            <div class="row">
                @foreach($group->products as $product)
                    <div class="col-md-3 col-sm-6 col-xs-6">
                        @include('frontEnd.components._productThumbnail',['item'=>$product,'model'=>'product'])
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif

