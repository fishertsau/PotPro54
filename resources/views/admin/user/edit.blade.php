@extends('admin.layouts.default')

{{-- Page title --}}
@section('title')
@parent-@lang('user/title.management')
@stop

{{-- page level styles --}}
@section('header_styles')
    <link href="{{ asset('assets/css/admin/pages/news.css') }}" rel="stylesheet" type="text/css">

    <!--end of page level css-->
    @stop

{{-- Content --}}
@section('content')
@include('admin.user._contentHeader',
    ['section_title'=> '修改使用者資料'])

        <!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="livicon" data-name="wrench" data-size="16" data-loop="true"
                                               data-c="#fff" data-hc="white"></i>
                        @lang('user/title.edit')
                    </h4>
                        <span class="pull-right">
                            <a href="{{ URL::previous()}}" style="color: white">
                                回上一頁 &nbsp; <i class="fa fa-reply"></i>
                            </a>
                        </span>
                </div>
                <div class="panel-body">
                    @include('admin.partials.errors')

                    @if($user)
                        {!! Form::model($user, ['method' => 'patch', 'action' => ['Admin\UserController@update', $user->id]]) !!}

                        @include('admin.user._form')

                        {!! Form::close() !!}
                    @else
                        <h1>@lang('user/message.no_user_exists')</h1>
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
<script src="{{ asset('assets/vendors/select2/js/select2.js') }}" type="text/javascript"></script>

{{--my javascript--}}
<script type="text/javascript" src="{{ asset('assets/js/admin/pages/user.js') }}"></script>

@stop