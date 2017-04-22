@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    @lang('admin/channel/sales/title.management')
    @parent
@stop

{{-- Page content --}}
@section('content')
    @include('admin.channel.sales._contentHeader',
   ['section_title'=> '通路清單'])

    <input type="text"
           class="hidden"
           v-model="queryTerm"
           value="{{collect($queryTerm)->toJson()}}">

    <section class="content paddingleft_right15">
        <div class="row">

            <div class="panel panel-primary ">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title pull-left">
                        <i class="livicon" data-name="list-ul" data-size="16"
                                                         data-loop="true" data-c="#fff" data-hc="white"></i>
                        通路清單
                    </h4>

                    <div class="pull-right">
                        @include('admin.channel.sales._salesSearch')
                        <a href="{{ route('admin.sales.create') }}" class="btn btn-sm btn-default"><span
                                    class="glyphicon glyphicon-plus"></span> @lang('button.create')</a>
                    </div>
                </div>
                <br/>

                <div class="panel-body" id="listContent">
                </div>
            </div>
        </div>
        <!-- row-->
    </section>
@stop

{{-- Body Bottom confirm modal --}}
@section('footer_scripts')

    <script type="text/javascript" src="{{  asset('assets/admin/channel/sales/salesIndex.js') }}"></script>

@stop
