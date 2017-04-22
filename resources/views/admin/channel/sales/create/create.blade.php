@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    編輯通路
    @parent
    @stop


    @section('content')
    @include('admin.channel.sales._contentHeader',
      ['section_title'=> '新增通路'])

            <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary ">
                    <div class="panel-heading">
                        <h4 class="panel-title"><i class="livicon" data-name="edit" data-size="16" data-loop="true"
                                                   data-c="#fff" data-hc="white"></i>
                            @lang('admin/channel/sales/title.edit')
                        </h4>

                    <span class="pull-right">
                            <a href="{{ URL::previous()}}" style="color: white">
                                回上一頁 &nbsp; <i class="fa fa-reply"></i>
                            </a>
                         </span>
                    </div>
                    <div class="panel-body">
                        @include('admin.partials.errors')

                        <div class="row">
                            <div class="col-md-4">
                                @include('admin.channel.sales.create._selectedUser')
                            </div>
                            <div class="col-md-8">
                                {!! Form::open(['method' => 'post', 'action' => ['Admin\Channel\SalesController@store'],'class'=>'form-horizontal'])!!}
                                <input type="text" class="hidden" name="user_id" v-model="selectedUser.id" required>
                                <button type="submit" class="btn btn-danger full-width">
                                    <i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;&nbsp;確定加入
                                </button>
                                {!! Form::close() !!}
                                <hr>
                                @include('admin.channel.sales.create._userSearch')
                                <hr>
                                <div id="listContent"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop

@section('footer_scripts')
    <script type="text/javascript" src="{{  asset('assets/admin/channel/sales/salesCreate.js') }}"></script>
@stop
