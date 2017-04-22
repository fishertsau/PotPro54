@extends('frontEnd.layouts.default')

{{-- Page title --}}
@section('title')
    節能產品
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link href="{{ asset('assets/frontend/addOn/addOn.css') }}" rel="stylesheet" type="text/css">
    @stop
            <!--end of page level css-->

    {{-- breadcrumb --}}
@section('top')
    @include('frontEnd.partials._breadcum',['title'=>'購物車'])
@stop


{{-- Page content --}}
@section('content')

    <div style="display: table;margin-top:10px">
        <h3 style="display: table-cell" class="text-nature">
            <i class="fa fa-dot-circle-o"></i>&nbsp;加工配件設定</h3>&nbsp;&nbsp;
         <span class="pull-right">
             &nbsp;<a href="{{ URL::previous()}}">回上一頁 <i class="fa fa-reply"></i></a>
         </span>
    </div>

    <br/>

    {!! Form::open(['method' => 'post', 'url' => 'addOn/update']) !!}
    <input type="hidden" name="product-id" value="{{$product->id}}">
    <input type="hidden" name="group-id" value="{{$group_id}}">
    <?php  $group = $product->group; ?>

    @include('frontEnd.order.addOn._product')
    <hr/>
    <p>
        <button class="btn btn-sm btn-danger">設定完成</button>
        &nbsp;<span class="text-danger">*附註不能有'(' 或 ')'</span></p>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th class="text-center" style="width: 10%">選用</th>
            <th class="text-center" style="width: 40%">配件內容</th>
            <th class="text-center" style="width: 5%">編輯</th>
        </tr>
        </thead>
        <tbody>
        @foreach($group->add_ons as $index=>$add_on)
            <tr>
                <input type="hidden" name="add-on-id[]" value="{{$add_on->id}}"> {{--配件號碼--}}
                <td class="text-center">
                    <input type="checkbox" name="add-on-chosen[]" value="{{$add_on->id}}"
                            {{ isset($add_on_setting[$add_on->id]) ?'checked' : ''}} >

                </td>
                <td>
                    @include('frontEnd.order.addOn._addOnInfo')
                </td>
                <td class="text-center">
                    <a class="btn btn-sm btn-success expand-add-on-setting" add-on-index="{{$index}}">展開</a>
                    <a class="btn btn-sm btn-default close-add-on-setting">關閉</a>
                </td>
            </tr>
            <tr style="display:none;background-color: lightgrey" class="add-on-setting" add-on-index="{{$index}}">
                <td colspan="3">
                    @include('frontEnd.order.addOn._addOnOption')
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    @stop

    {{-- page level scripts --}}
    @section('footer_scripts')
            <!-- page level js starts-->
    <script type="text/javascript" src="{{ asset('assets/frontend/addOn/addOnEdit.js') }}"></script>
    <!--page level js ends-->
@stop