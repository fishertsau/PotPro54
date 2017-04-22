<?php  $photoPath = $item->coverPhoto_path == '' ? 'gasSavingProduct.jpg' : $item->coverPhoto_path  ?>
<div class="productThumbnail">
    <a href="{{ asset('assets/images/cover')}}/{{$photoPath}}" data-lity>
        <img class="productThumbnail__img"
             src="{{ asset('assets/images/cover')}}/{{$photoPath}}">
    </a>

    <a href="/{{$model}}/{{$item->slug }}"
       class="productThumbnail__link">
        <i class="fa fa-search-plus productThumbnail__link__search"></i>
    </a>

    <h4 class="productThumbnail__title title-potmaster">{{$item->title}}</h4>
</div>
