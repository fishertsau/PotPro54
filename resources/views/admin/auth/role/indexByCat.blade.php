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
                        <a href="{{url('admin/role')}}" class="btn btn-sm btn-success">一般清單</a>
                    </div>
                </div>
                <br/>

                <div class="panel-body">
                    @foreach($roleList as $roleCat=>$roleListForCat)
                        <li class="title-potmaster">{{$roleCat}}</li>
                        @foreach($roleListForCat as $id => $role)
                            <input type="checkbox" value="{{$id}}"
                                   name="role_list[]"
                                    >
                            {{$role}} &nbsp;
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

@stop
