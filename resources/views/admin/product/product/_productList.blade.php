@if(!count($products)>0)
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <h4><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 無符合條件的項目/資料!</h4>
        No any items which conforms the search criteria were found.
    </div>
@else
    總筆數: {{$products->total()}} &nbsp;頁數:{{$products->currentPage()}}/{{$products->lastPage()}}
    <table class="table table-bordered " id="table">
        <thead>
        <tr class="filters">
            <td width="10%" class="text-primary">系列產品</td>
            <td width="10%" class="title-potmaster">產品圖片</td>
            <td width="15%" class="title-potmaster">產品名稱/型號</td>
            <td width="10%" style="text-align: center">狀態</td>
            <td width="40%" class="visible-desktop-cell">內容</td>
            <th width="15%" align="center">動作</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($products as $product)
            <tr>
                <td class="title-potmaster">
                    {{$product->group->subCategory->groupCategory->title}}/<br/>
                    {{$product->group->subCategory->title}}/<br/>
                    {{$product->group->title}}</td>
                <td>
                    <img src="{{($product->coverPhoto_path=='')?URL::asset('assets/images/mainPhoto.jpg'):URL::asset('assets/images/cover').'/'. $product->coverPhoto_path}}"
                         style="width: 60%">
                </td>
                <td class="title-potmaster">{{$product->title}}/{{$product->model}}</td>
                <td class="text-center">{!! $product->active_text!!}</td>
                <td style="text-align: left" class="visible-desktop-cell">
                    <div style="max-height: 150px;overflow: hidden">{!! $product->body !!}</div>
                </td>
                <td align="center">
                    <a href="{{ route('admin.product.product.show', $product->id) }}">
                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                    </a>
                    <a href="{{ route('admin.product.product.edit', $product->id) }}">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </a>
                    <a href="{{ route('admin.product.product.confirm-delete', $product->id) }}"
                       data-toggle="modal"
                       data-target="#delete_confirm">
                        <i class="fa fa-times text-danger" aria-hidden="true"></i>
                    </a>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
    <div class="text-center">
        {!! $products->links() !!}
    </div>

    <script>
        $(document).ready(function () {
            $('.pagination a').on('click', function (event) {
                event.preventDefault();
                if ($(this).attr('href') != '#') {
                    $('#productListContent').load($(this).attr('href'));
                }
            });
        });
    </script>
@endif