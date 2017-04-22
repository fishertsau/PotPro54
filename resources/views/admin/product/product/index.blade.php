@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    @parent-@lang('product/title.management')
@stop

{{-- page level styles --}}
@section('header_styles')
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/vendors/datatables/css/dataTables.bootstrap.css') }}"/>
    <link href="{{ asset('assets/css/pages/tables.css') }}" rel="stylesheet" type="text/css"/>
@stop

{{-- Page content --}}
@section('content')
    @include('admin.product.product._contentHeader',
    ['section_title'=> '產品清單'])

    <section class="content paddingleft_right15">
        @include('admin.product.product._productSearch')
        <br/>

        <div class="row">
            <div class="panel panel-primary ">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title pull-left"><i class="livicon" data-name="list-ul" data-size="16"
                                                         data-loop="true" data-c="#fff" data-hc="white"></i>
                        @lang('product/title.productlist')
                    </h4>

                    <div class="pull-right">
                        <a href="{{ url('admin/product/group') }}" class="btn btn-success"><span
                                    class="glyphicon glyphicon-circle-arrow-right"></span> 系列</a>
                        @can('create-product')
                            <a
                                    href="{{ route('admin.product.create') }}"
                                    class="btn btn-sm btn-default"><span
                                        class="glyphicon glyphicon-plus"></span> @lang('button.create')</a>
                        @endcan
                        {{--todo: implement dump to excel file  function--}}
                        {{--<a href="{{ route('productExcelFile') }}" class="btn btn-sm btn-default">輸出Excel</a>--}}
                    </div>
                </div>
                <div class="panel-body" id="productListContent">
                </div>
            </div>
        </div>
        <!-- row-->
    </section>
@stop

{{-- Body Bottom confirm modal --}}
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/js/admin/pages/productList.js') }}"></script>

    <div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="user_delete_confirm_title"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content"></div>
        </div>
    </div>

    <script>
        $(function () {
            $('body').on('hidden.bs.modal', '.modal', function () {
                $(this).removeData('bs.modal');
            });
        });
    </script>
@stop
