<div class="row exampleProductBlock"
     id="{{ ($newItem) ? 'pro_ini' : 'product_'.$product->id }}">
    <input type="hidden" class="productId" id="" name="productId[]"
           value="{{ ($newItem) ? 0 : $product->id }}">


    <div class="col-md-5 col-xs-12">
        <!--主要圖片-->
        @include('partials._coverPhotoDropzone' ,
        ['id'=> ($newItem) ? 'pro_ini' : $product->id,
        'path' => ($newItem) ? '' : $product->coverPhoto_path,
        'associatedTable'=>'example_products',
        'foreignTable'=>'examples',
        'foreignKey'=>$example->id])
    </div>

    <div class="col-md-7 col-sm-7 col-xs-12">
        <!--品稱-->
        <div class="form-group" style="margin-bottom: 5px;">

            <label class="title-potmaster">品稱-
                <span class="exampleProductRank"></span>
            </label>
						<span class="pull-right">
							<span class="text-primary"
                                  onclick="moreExampleProduct(this)">
                                <i class="fa fa-plus-circle "></i>新增</span>&nbsp;&nbsp;
							<span class="text-danger"
                                  onclick="fewerItem(this,'exampleProduct')">
                                <i class="fa fa-trash-o "></i>刪除</span>
						</span>
            <input type="text" class="form-control productContent" style="display: inline;"
                   name="proTitle[]" placeholder="產品名稱"
                   value="{{ ($newItem) ? '' : $product->title }}"
                    required>
            <span>剩餘10個字</span>
        </div>

        <!--價格-->
        <div class="form-group" style="margin-bottom: 5px;">
            <label class="title-potmaster">價格</label>
            <input type="text" class="form-control productContent" id="" name="proPrice[]"
                   placeholder="產品價格" value="{{ ($newItem) ? '' : $product->price }}">
        </div>
        <!--產品介紹-->
        <div class="form-group" style="margin-bottom: 5px;">
            <label class="title-potmaster">產品介紹</label>
                        <textarea type="text" class="form-control productContent" id="" cols="50" rows="2"
                                  name="proBody[]" placeholder="產品介紹">{{ ($newItem) ? '' : $product->body }}</textarea>
            <span>剩餘20個字</span>
        </div>
    </div>

    <hr style="border: 1px solid #ddd;"/>
</div>