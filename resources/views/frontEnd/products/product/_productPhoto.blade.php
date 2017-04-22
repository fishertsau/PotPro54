<?php $photoPath = $product->coverPhoto_path == '' ? 'gasSavingProduct.jpg' : $product->coverPhoto_path; ?>
<img class="full-width" src="{{URL::asset('assets/images/cover')}}/{{$photoPath}}">
