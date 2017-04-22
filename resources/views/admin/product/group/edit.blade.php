@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    @parent-@lang('group/title.management')
@stop

{{-- page level styles --}}
@section('header_styles')
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/admin/product/group/groupEdit.css') }}"/>
    @stop

    @section('content')
    @include('admin.product.group._contentHeader',
    ['section_title'=> '修改內容'])

            <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary ">
                    <div class="panel-heading">
                        <h4 class="panel-title"><i class="livicon" data-name="edit" data-size="16" data-loop="true"
                                                   data-c="#fff" data-hc="white"></i>
                            @lang('group/title.edit')
                            :&nbsp;<span >{{$group->title}}</span>
                        </h4>
                        <span class="pull-right">
                            <a href="{{ URL::previous()}}" style="color: white">
                                回上一頁123 &nbsp; <i class="fa fa-reply"></i>
                            </a>
                         </span>
                    </div>
                    <div class="panel-body">
                        {!! Form::model($group, ['method' => 'PATCH', 'files'=> true ,'action' => ['Admin\Product\GroupController@update', $group->id] ])     !!}

                        @include('admin.product.group._form')

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    @stop

    {{-- page level scripts --}}
    @section('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/admin/product/group/groupEdit.js') }}"></script>
@stop