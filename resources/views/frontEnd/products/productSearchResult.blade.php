@extends('frontEnd/layouts/master2Column')

{{-- Page title --}}
@section('title')
    節能產品
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link href="{{ asset('assets/frontend/product/productAll.css') }}" rel="stylesheet">

    <!--end of page level css-->
@stop

{{-- breadcrumb --}}
@section('top')
    @include('frontEnd.products._breadcum',['title'=>'節能產品','subTitle'=> '產品搜尋'])
@stop


{{-- Page content --}}
@section('content')
    @include('frontEnd.products.partials._groupSelectionList')

    <br/>
    <div>
        @include('frontEnd.products.partials._productKeywordSearch')
    </div>
    <br/>

    <h3 style="display: inline" class="title-potmaster">
        <i class="fa fa-dot-circle-o"></i>&nbsp;產品搜尋結果</h3>
    <br/>
    <hr/>
    @if(count($groups)>0)
        <h3 class="text-nature">系列產品</h3>
        <table width="100%" class="table table-nomargin table-bordered table-striped formTable"
               style="text-align: center;background-color: white">
            <thead>
            <tr>
                <td width="40%" class="text-danger">系列名稱</td>
                <td width="10%" class="text-danger">圖片</td>
                <td width="10%" class="text-danger">查看</td>
            </tr>
            </thead>
            <tbody>

            @foreach($groups as $group)

                <?php $photoPath = $group->coverPhoto_path == '' ?
                        'gasSavingProduct.jpg' :
                        $group->coverPhoto_path; ?>
                <tr>
                    <td class="title-potmaster">{{$group->title}}</td>
                    <td><img src="{{ asset('assets/images/cover')}}/{{$photoPath}}"
                             class="img-responsive"></td>
                    <td><a href="\group\{{$group->slug}}"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <hr/>
    @endif

    @if(count($products)>0)
        <h3 class="text-nature">單一產品</h3>
        <table width="100%" class="table table-nomargin table-bordered table-striped formTable"
               style="text-align: center;background-color: white">
            <thead>
            <tr>
                <td width="20%" class="text-danger">系列產品</td>
                <td width="20%" class="text-danger">產品名稱</td>
                <td width="10%" class="text-danger">圖片</td>
                <td width="20%" class="text-danger">查看</td>
            </tr>
            </thead>
            <tbody>

            @foreach($products as $product)
                <?php $photoPath = $product->coverPhoto_path == '' ?
                        'gasSavingProduct.jpg' :
                        $product->coverPhoto_path; ?>
                <tr>
                    <td class="text-primary">{{$product->group->title}}</td>
                    <td class="title-potmaster">{{$product->title}}</td>
                    <td><img src="{{ asset('assets/images/cover')}}/{{$photoPath}}"
                             class="img-responsive"></td>
                    <td><a href="\product\{{$product->slug}}"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif

    @if(count($groups)==0  && count($products)==0 )
        <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h4><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp;搜尋不到符合條件的產品!</h4>
            No any articles are found.
        </div>
        @endif

        @stop

        {{-- page level scripts --}}
        @section('footer_scripts')
                <!-- page level js starts-->
        <script type="text/javascript" src="{{ asset('assets/frontend/product/productAll.js') }}"></script>
        <!--page level js ends-->
@stop




