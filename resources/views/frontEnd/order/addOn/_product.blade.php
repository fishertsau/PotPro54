採購品項
<div>
    <?php $photoPath = $product->coverPhoto_path == '' ? 'gasSavingProduct.jpg' : $product->coverPhoto_path; ?>
    <img src="{{URL::asset('assets/images/cover')}}/{{$photoPath}}" style="height: 30px">

    <h3 class="title-potmaster" style="display: inline">{{$product->title}}</h3>
</div>