@extends('admin.layouts.default')

{{-- Page title --}}
@section('title')
    @parent-@lang('addOn/title.management')
@stop

{{-- page level styles --}}
@section('header_styles')
    {{--<link rel="stylesheet" type="text/css"--}}
    {{--href="{{ asset('assets/vendors/datatables/css/dataTables.bootstrap.css') }}"/>--}}
    {{--<link href="{{ asset('assets/css/pages/tables.css') }}" rel="stylesheet" type="text/css"/>--}}
@stop

{{-- Page content --}}
@section('content')
    @include('admin.product.addOn._contentHeader',
    ['section_title'=> '加工配件清單'])

    <section class="content paddingleft_right15">
        <div class="row">
            <div class="panel panel-primary ">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title pull-left"><i class="livicon" data-name="list-ul" data-size="16"
                                                         data-loop="true" data-c="#fff" data-hc="white"></i>
                        @lang('addOn/title.addOnlist')
                    </h4>

                    <div class="pull-right">
                        <a href="{{ url('admin/product/addOnOption') }}" class="btn btn-success">
                            <span class="glyphicon glyphicon-circle-arrow-right"></span> 加工方式
                        </a>
                        <a href="{{ route('admin.addons.create') }}" class="btn btn-sm btn-default"><span
                                    class="glyphicon glyphicon-plus"></span> @lang('button.create')</a>
                    </div>
                </div>
                <br/>

                <div class="panel-body">
                    <table class="table table-bordered " id="table">
                        <thead>
                        <tr class="filters">
                            <td width="5%" align="center">ID</td>
                            <td width="15%" align="center">標題</td>
                            <td width="50%" align="center">內容</td>
                            <td width="10%" align="center">動作</td>
                        </tr>
                        </thead>
                        <tbody>

                        @if(isset($add_ons))
                            @foreach ($add_ons as $add_on)
                                <tr>
                                    <td align="center">{{$add_on->id}}</td>
                                    <td class="text-danger">{{$add_on->title}}</td>
                                    <td class="text-left">
                                        @foreach($add_on->options as $option)
                                            <a href="/admin/product/addOnOption/{{$option->pivot->add_on_option_id}}/edit"
                                               title="{{$option->settings_string}}">
                                                {{$option->pivot->no}}:{{$option->title}}</a>
                                        @endforeach
                                        {!! $add_on->option_list !!}</td>
                                    <td align="center">
                                        <a href="{{ route('admin.product.addOn.show', $add_on->id) }}">
                                            <i class="livicon" data-name="info" data-size="18" data-loop="true"
                                               data-c="#428BCA" data-hc="#428BCA" title="view addOn"></i>
                                        </a>
                                        <a href="{{ route('admin.product.addOn.edit', $add_on->id) }}">
                                            <i class="livicon" data-name="edit" data-size="18" data-loop="true"
                                               data-c="#428BCA" data-hc="#428BCA" title="edit addOn"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- row-->
    </section>
@stop

{{-- Body Bottom confirm modal --}}
@section('footer_scripts')
    {{--<script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/jquery.dataTables.js') }}"></script>--}}
    {{--<script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.bootstrap.js') }}"></script>--}}

    {{--<script>--}}
    {{--$(document).ready(function () {--}}
    {{--$('#table').DataTable();--}}
    {{--});--}}
    {{--</script>--}}

    <div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="user_delete_confirm_title"
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
@stop
