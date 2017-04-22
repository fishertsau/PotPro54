@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    使用者管理
    @parent
    @stop

    {{-- Page content --}}
    @section('content')
    @include('admin.user._contentHeader',
        ['section_title'=> '使用者清單'])

            <!-- Main content -->
    <section class="content paddingleft_right15">
        <div class="row" id="app">
            <div class="panel panel-primary ">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title pull-left"><i class="livicon" data-name="list" data-size="16"
                                                         data-loop="true" data-c="#fff" data-hc="white"></i>
                        @lang('user/title.userlist')
                    </h4>

                    <div class="pull-right">
                        @include('admin.user._userSearch')
                    </div>
                </div>
                <div class="panel-body" id="userListContent">
                </div>
            </div>
        </div>
        <!-- row-->
    </section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')

    <script type="text/javascript" src="{{  asset('assets/admin/user/userIndex.js') }}"></script>

    <div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="user_delete_confirm_title"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content"></div>
        </div>
    </div>
@stop