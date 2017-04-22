<div class="productShow-panel">
    {{csrf_field()}}
    <input type="hidden" id="product_id" value="{{$product->id}}">
    @can('create-order')
    <span class="productShow-panel__qty">數量</span>
    <input type="number"
           class="form-control productShow-panel__qtyInput"
           id="product_qty"
           value="1" min="1">

    <span class="productShow-panel_addToCart"
          onclick="addItemToCartFromProductShow()"
          id="put_to_cart">
            <button class="productShow-panel_addToCart__btn">選購
            </button>
        </span>
    @endcan

    <span class="productShow-panel_addToFavorite">
         <form action="/product/favorite/push/{{ $product->id }}" method="POST"
               v-ajax
               complete="已加入您的收藏!"
               notComplete="請先登入會員,才可使用此功能"
               class="formBlock">
             {{csrf_field()}}
             <button type="submit"
                     class="productShow-panel__addToFavorite__btn">
                 <i class="fa fa-heart" aria-hidden="true"></i>收藏
             </button>
         </form>
    </span>
</div>
