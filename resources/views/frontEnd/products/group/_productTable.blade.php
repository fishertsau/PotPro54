{{--標準型號--}}
<span id="productTable"></span>
<hr/>
<div >
    <h4 class="text-nature"><i class="fa fa-square"></i>&nbsp;標準規格與型號</h4>
    @if(count($group->products)>0)
        <table width="200" class="table table-responsive table-bordered text-center table-striped table-hover">
            <thead>
            <tr>
                <td class="title-potmaster">型號</td>
                <td class="title-potmaster">編號</td>
                <td class="title-potmaster">規格</td>
                <td class="title-potmaster">其他</td>
            </tr>
            </thead>
            <tbody>

            @foreach($group->products as $product)
                <tr>
                    <td><a href="/product/{{$product->slug}}" class="noDecoration title-potmaster"><span class="text-danger">{{$product->title}}</span> </a></td>
                    <td class="title-potmaster">{{$product->pn}}</td>
                    <td class="title-potmaster text-left">{{$product->spec}}</td>
                    <td>{{$product->note}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p class="title-potmaster">此系列產品無標準產品,需自備設備,送廠加工</p>
    @endif
</div>