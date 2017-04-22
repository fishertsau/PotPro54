@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    @parent-@lang('group/title.management')
@stop

{{-- page level styles --}}
@section('header_styles')

@stop

{{-- Page content --}}
@section('content')
    @include('admin.product.group._contentHeader',
    ['section_title'=> '系列產品清單'])

    <section class="content paddingleft_right15">
        <div class="row">
            <div class="panel panel-primary ">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title pull-left"><i class="livicon" data-name="list-ul" data-size="16"
                                                         data-loop="true" data-c="#fff" data-hc="white"></i>
                        @lang('group/title.grouplist')
                    </h4>

                    <div class="pull-right">
                        @include('admin.product.group._groupSearch')
                        <a href="{{ url('admin/product/product') }}" class="btn btn-success">
                            <span class="glyphicon glyphicon-circle-arrow-right"></span> 產品</a>
                        @can('create-product')
                        <a href="{{ route('admin.product.group.create') }}" class="btn btn-sm btn-default">
                            <span class="glyphicon glyphicon-plus"></span> @lang('button.create')</a>
                        @endcan
                    </div>
                </div>
                <br/>

                <div class="panel-body" id="groupListContent">
                </div>
            </div>
        </div>
        <!-- row-->
    </section>
@stop

{{-- Body Bottom confirm modal --}}
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/js/admin/pages/groupList.js') }}"></script>


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
