<!--品稱-->
<div class="form-group" style="margin-bottom: 5px;">

        <label for="">品稱-
            <sapn class="productRank"></sapn>
        </label>
						<span class="pull-right">
							<span class="text-primary"
                                  onclick="moreExampleProduct(this)">
                                <i class="fa fa-plus-circle "></i>新增</span>&nbsp;&nbsp;
							<span class="text-danger"
                                  onclick="fewerItem(this,'product')">
                                <i class="fa fa-trash-o "></i>刪除</span>
						</span>
        <input type="text" class="form-control productContent" id="" style="display: inline;"
               name="proTitle[]" placeholder="產品名稱"
               value="{{ ($newItem) ? '' : $product->title }}">
        <span>剩餘10個字</span>
    </div>

<!--價格-->
<div class="form-group" style="margin-bottom: 5px;">
        <label for="">價格</label>
        <input type="text" class="form-control productContent" id="" name="proPrice[]"
               placeholder="產品價格" value="{{ ($newItem) ? '' : $product->price }}">
    </div>

<!--產品介紹-->
<div class="form-group" style="margin-bottom: 5px;">
        <label for="exampleInputEmail1">產品介紹</label>
                        <textarea type="text" class="form-control productContent" id="" cols="50" rows="2"
                                  name="proBody[]" placeholder="產品介紹">{{ ($newItem) ? '' : $product->body }}</textarea>
        <span>剩餘20個字</span>
    </div>


