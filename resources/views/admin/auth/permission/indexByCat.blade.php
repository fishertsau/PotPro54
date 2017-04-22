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
                                    <a href="{{ url('admin/permission') }}" class="btn btn-sm btn-success">權限清單</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br/>

                <div class="panel-body">
                    @foreach($permissionList as $permissionCat=>$permissionListForCat)
                        <li class="title-potmaster">{{$permissionCat}}</li>
                        @foreach($permissionListForCat as $id => $permission)
                            <input type="checkbox" value="{{$id}}"
                                   name="role_list[]"
                                    >
                            {{$permission}} &nbsp;
                        @endforeach
                        <hr/>
                    @endforeach
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
@stop
