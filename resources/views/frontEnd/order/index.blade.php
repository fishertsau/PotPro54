@extends('frontEnd/layouts/default')

{{-- Page title --}}
@section('title')
    節能產品
    @parent
@stop
{{-- page level styles --}}
@section('header_styles')
    <link href="{{ asset('assets/frontend/order/order.css') }}" rel="stylesheet" type="text/css">
    @stop
            <!--end of page level css-->


    {{-- breadcrumb --}}
@section('top')
    @include('frontEnd.partials._breadcum',['title'=>'訂單明細'])
@stop


{{-- Page content --}}
@section('content')

    <h3 class="text-nature">
        <i class="fa fa-dot-circle-o"></i>&nbsp;訂單明細
    </h3>

    <div>
        &nbsp;&nbsp;
        <span class="pull-right">
            <a href="/product">產品清單</a> &nbsp;
            <a href="/cart">回購物車</a> &nbsp;
            <a href="{{ URL::previous()}}">回上一頁 <i class="fa fa-reply"></i></a>
        </span>
    </div>

    <br/>
    @if($cart->count())

        <table class="full-width table table-nomargin table-bordered table-striped">
            <thead>
            <tr>
                <th class="text-center RWDText-20" style="width: 5%">#</th>
                <th class="text-center RWDText-20" style="width: 8%">類別</th>
                <th class="text-center RWDText-20" style="width: 40%">產品</th>
                <th class="text-center RWDText-20" style="width: 15%">規格</th>
            </thead>
            <tbody>

            <?php $index = 1 ?>
            @foreach($cart as $item)
                <tr>
                    @include('frontEnd.order._orderItems')

                </tr>
                <? $index++ ?>
            @endforeach
            <tr>
                <td colspan="4" class="text-right">
                    <p class="text-right RWDText-20">總金額: <span class="text-primary">${{number_format($total)}}</span>
                    </p>

                    <p class="text-right RWDText-20">總數量: <span class="text-primary">{{number_format($count)}}</span>
                    </p>
                </td>
            </tr>
            </tbody>
        </table>

        <div>
            <form action="order" method="post">
                {{csrf_field()}}
                <button type="submit" class="btn btn-big btn-danger full-width RWDText-20"><i
                            class="fa fa-check-square-o"></i>&nbsp;&nbsp;&nbsp;內容正確,確定下單!
                </button>
            </form>
        </div>

        <br>

    @else
        @include('frontEnd.order.cart._emptyCart')
    @endif
@stop