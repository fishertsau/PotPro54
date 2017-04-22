@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    @parent-@lang('example/title.management')
@stop

{{-- page level styles --}}
@section('header_styles')
    <link href="{{ asset('assets/admin/example/exampleIndex.css') }}" rel="stylesheet" type="text/css"/>
@stop

{{-- Page content --}}
@section('content')
    @include('admin.example._contentHeader',
    ['section_title'=> '節能案例清單'])


    <section class="content paddingleft_right15">
        @include('admin.example._exampleSearch')
        <br>

        <div class="row">
            <div class="panel panel-primary ">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title pull-left"><i class="livicon" data-name="list-ul" data-size="16"
                                                         data-loop="true" data-c="#fff" data-hc="white"></i>
                        @lang('example/title.examplelist')
                    </h4>

                    <div class="pull-right">
                        @can('edit-example')
                        <a href="{{ route('admin.example.create') }}" class="btn btn-sm btn-default"><span
                                    class="glyphicon glyphicon-plus"></span> @lang('button.create')</a>
                        @endcan
                    </div>
                </div>

                <div class="panel-body" id="listContent">
                </div>
            </div>
        </div>
        <!-- row-->
    </section>
@stop

{{-- Body Bottom confirm modal --}}
@section('footer_scripts')

    <div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby=""
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

    <script type="text/javascript" src="{{ asset('assets/admin/example/exampleIndex.js') }}"></script>

@stop
