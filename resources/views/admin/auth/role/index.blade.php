@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    @parent-@lang('role/title.management')
@stop

{{-- page level styles --}}
@section('header_styles')
@stop

{{-- Page content --}}
@section('content')
    @include('admin.auth.role._contentHeader',
    ['section_title'=> '使用者群組清單'])

    <section class="content paddingleft_right15">
        <div class="row">
            <div class="panel panel-primary ">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title pull-left"><i class="livicon" data-name="list" data-size="16"
                                                         data-loop="true" data-c="#fff" data-hc="white"></i>
                        @lang('role/title.groupslist')
                    </h4>

                    <div class="pull-right">
                        @include('admin.auth.role._roleSearch')

                        <a href="{{ url('admin/role/create') }}" class="btn btn-sm btn-default"><span
                                    class="glyphicon glyphicon-plus"></span> @lang('button.create')</a>
                        <a href="{{ url('admin/role/listByCat') }}" class="btn btn-sm btn-success">類別清單</a>
                        @if(Auth::user()->isSuperAdmin())
                            <form method="post" action="{{route('storeRoleList')}}" style="display: inline">
                                {{csrf_field()}}
                                <button class="btn btn-sm btn-danger" type="submit">儲存清單</button>
                            </form>
                        @endif
                    </div>
                </div>
                <br/>

                <div class="panel-body">
                    @include('admin.auth.role._roleList')
                </div>
            </div>
        </div>
        <!-- row-->
    </section>
@stop

{{-- Body Bottom confirm modal --}}
@section('footer_scripts')

    <div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="user_delete_confirm_title"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content"></div>
        </div>
    </div>
@stop
