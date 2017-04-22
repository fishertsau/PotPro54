@extends('admin.layouts.default')

{{-- Page title --}}
@section('title')
@parent-@lang('role/title.management')
@stop

{{-- page level styles --}}
@section('header_styles')
    <!--end of page level css-->
    @stop

{{-- Content --}}
@section('content')
@include('admin.auth.role._contentHeader',
    ['section_title'=> '編輯群組'])

        <!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="livicon" data-name="wrench" data-size="16" data-loop="true"
                                               data-c="#fff" data-hc="white"></i>
                        @lang('role/title.edit'):&nbsp <span>{{$role->name}}</span>
                    </h4>
                        <span class="pull-right">
                            <a href="{{ URL::previous()}}" style="color: white">
                                回上一頁 &nbsp; <i class="fa fa-reply"></i>
                            </a>
                        </span>
                </div>
                <div class="panel-body">
                    @if($role)
                        {!! Form::model($role, ['method' => 'patch', 'action' => ['Auth\RoleController@update', $role->id]]) !!}

                        @include('admin.auth.role._form')

                        {!! Form::close() !!}
                    @else
                        <h1>@lang('role/message.no_role_exists')</h1>
                    @endif

                    <hr/>

                </div>
            </div>
        </div>
    </div>
    <!-- row-->
</section>
@stop


{{-- page level scripts --}}
@section('footer_scripts')
        <!-- begining of page level js -->
@stop