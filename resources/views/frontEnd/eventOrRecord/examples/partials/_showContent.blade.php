{{--產品照片 與 重要說明--}}
<div class="row">
    <div class="row">
        <!-- Slider Section Start -->
        <div class="col-md-7 col-sm-7 col-xs-7 ">
            <img class="full-width img-rounded"
                 src="{{URL::asset('assets/images/cover')}}/{{$example->coverPhoto_path}}">
        </div>
        <!-- //Slider Section End -->

        <!-- Project Description Section Start -->
        <div class="col-md-5 col-sm-5 col-xs-5">

            <h4 class="title-potmaster" {{--style="margin: 0"--}}>
                <i class="fa fa-angle-right"></i>&nbsp;店家介紹:
            </h4>

            <p class="text-potmaster">
                {{$example->body}}
            </p>

            <br>
            <h5 class="title-potmaster"><i class="fa fa-angle-right"></i>&nbsp;主要產品: </h5>

            <p class="text-potmaster">{{$example->main_product}}</p>

            <hr>
            {{--店面地址--}}
            <h5 class="title-potmaster"><i class="fa fa-angle-right"></i>&nbsp;地址: {{$example->address}}</h5>
            <h5 class="title-potmaster"><i class="fa fa-angle-right"></i>&nbsp;電話: {{$example->tel}}</h5>

            {{--使用效果--}}
            <br>
            <h5 class="title-potmaster"><i class="fa fa-angle-right"></i>&nbsp;使用效果</h5>

            <p class="text-nature">{{$example->use_result}}</p>
        </div>
        <!-- //Project Description Section End -->
    </div>
</div>


{{--產品介紹--}}
<hr style="margin:5px 0;"/>
<div class="row">
    <div class="col-md-2 col-sm-12 col-xs-12">
        <h4 class="text-nature">產品介紹</h4>
    </div>
    <div class="col-md-10 col-sm-12 col-xs-12">
        <div class="row">
            @foreach($example->products as $product)
                <div class="col-md-4">
                    <img src="{!! asset('assets/images/cover').'/'.$product->coverPhoto_path !!}" alt="img"
                         class="img-rounded" style="width: 100%"/>
                    <h4 class="title-potmaster">{{$product->title}}</h4>
                    <h5 class="text-potmaster">{{$product->body}}</h5>
                    <h5 class="text-potmaster">價格: {{$product->price}}</h5>
                </div>
            @endforeach
        </div>
    </div>
</div>

{{--服務內容--}}
<hr style="margin:5px 0;"/>
<div class="row">
    <div class="col-md-2 col-sm-12 col-xs-12">
        <h4 class="text-nature">服務內容</h4>
    </div>
    <div class="col-md-10 col-sm-12 col-xs-12">
        <ul style="list-style: disc;padding:0">
            @foreach($example->services as $service)
                <li class="title-potmaster" style="padding: 0">{{$service->title}}</li>
                <p class="text-potmaster" style="padding: 0">{{$service->body}}</p>
            @endforeach
        </ul>
    </div>
</div>

{{--使用設備--}}
<hr style="margin:5px 0;"/>
<div class="row">
    <div class="col-md-2 col-sm-12 col-xs-12">
        <h4 class="text-nature">使用設備</h4>
    </div>
    <div class="col-md-10 col-sm-12 col-xs-12">
        <p class="text-potmaster">{{$example->use_gear}}</p>
    </div>
</div>

{{--現場照片--}}
<hr style="margin:5px 0;"/>
<div class="row">
    <div class="col-md-2 col-sm-12 col-xs-12">
        <h4 class="text-nature">現場照片</h4>
    </div>
    <div class="col-md-10 col-sm-12 col-xs-12">
        <div class="row">
            @foreach($example->photos as $photo)
                <div class="col-md-4">
                    <img class="full-width img-rounded"
                         src="{{URL::asset('assets/images/photos')}}/{{$photo->path}}">
                </div>
            @endforeach
        </div>
    </div>
</div>