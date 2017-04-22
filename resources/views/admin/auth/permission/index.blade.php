@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    @parent-@lang('permission/title.management')
@stop

{{-- page level styles --}}
@section('header_styles')
@stop

{{-- Page content --}}
@section('content')
    @include('admin.auth.permission._contentHeader',
    ['section_title'=> '權限清單'])

    <section class="content paddingleft_right15">
        <div class="row">
            <div class="panel panel-primary ">
                <div class="panel-heading clearfix">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-4 col-xs-12">
                                <h4 class="panel-title pull-left"><i class="livicon" data-name="list" data-size="16"
                                                                     data-loop="true" data-c="#fff" data-hc="white"></i>
                                    @lang('permission/title.permissionlist')
                                </h4>
                            </div>

                            <div class="col-md-8 col-xs-12">
                                <div class="pull-right">
                                    @include('admin.auth.permission._permissionSearch')
                                    @can('create-permission')
                                    <a href="{{ url('admin/permission/create') }}" class="btn btn-sm btn-default"><span
                                                class="glyphicon glyphicon-plus"></span> @lang('button.create')</a>
                                    @endcan
                                    <a href="{{ route('permissionListByCat') }}" class="btn btn-sm btn-success">權限列表</a>

                                    <form method="post" action="{{route('storePermissionList')}}"
                                          style="display: inline">
                                        {{csrf_field()}}
                                        <button class="btn btn-sm btn-danger" type="submit">儲存清單</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <br/>

                <div class="panel-body">
                    @include('admin.auth.permission._permissionList')
                </div>
            </div>
        </div>
        <!-- row-->
    </section>
@stop

{{-- Body Bottom confirm modal --}}
@section('footer_scripts')
    <script type="text/javascript" src="{{  asset('assets/js/admin/auth/permissionIndex.js') }}"></script>

    <div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="user_delete_confirm_title"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content"></div>
        </div>
    </div>

    {{--<script>--}}
    {{--$(function () {--}}
    {{--$('body').on('hidden.bs.modal', '.modal', function () {--}}
    {{--$(this).removeData('bs.modal');--}}
    {{--});--}}
    {{--});--}}
    {{--</script>--}}
@stop
