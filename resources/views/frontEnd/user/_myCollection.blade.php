<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <h4 class="title-potmaster">您的個人收藏</h4>
        @if($user->favorite_products->count()>0)
            <div class="row">
                @foreach($user->favorite_products as $product)
                    <div class="col-md-4 col-sm-6 col-xs-6"
                         style="background-color: white;border:1px solid #aaa;padding-bottom: 1em;">
                        <div>
                            @include('frontEnd.components._productThumbnail',['model'=>'product','item'=>$product])
                            <form action="/product/favorite/pull/{{ $product->id }}"
                                  method="POST"
                                  v-ajax
                                  complete="已經從收藏中移除"
                                  notComplte="無法完成要求,請稍後再試">

                                {{csrf_field()}}
                                <button type="submit"
                                        class="btn-pot-master">
                                    <i class="fa fa-minus-square" aria-hidden="true"></i>&nbsp;解除
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h5><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 您尚收藏任何產品!</h5>

                <p>您可以到產品展示中,將產品放入您的收藏中!</p>
            </div>
        @endif
    </div>
</div>