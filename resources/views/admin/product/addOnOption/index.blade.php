@extends('admin.layouts.default')

{{-- Page title --}}
@section('title')
    @parent-@lang('addOnOption/title.management')
@stop

{{-- page level styles --}}
@section('header_styles')
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/vendors/datatables/css/dataTables.bootstrap.css') }}"/>
    <link href="{{ asset('assets/css/pages/tables.css') }}" rel="stylesheet" type="text/css"/>
@stop

{{-- Page content --}}
@section('content')
    @include('admin.product.addOnOption._contentHeader',
    ['section_title'=> '加工方式清單'])

    <section class="content paddingleft_right15">
        <div class="row">
            <div class="panel panel-primary ">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title pull-left"><i class="livicon" data-name="list-ul" data-size="16"
                                                         data-loop="true" data-c="#fff" data-hc="white"></i>
                        @lang('addOnOption/title.addOnOptionlist')
                    </h4>

                    <div class="pull-right">
                        <a href="{{ route('admin.addons.index') }}" class="btn btn-success">
                            <span class="glyphicon glyphicon-circle-arrow-right"></span> 加工配件
                        </a>
                        <a href="{{ route('admin.addonOptions.create') }}" class="btn btn-sm btn-default"><span
                                    class="glyphicon glyphicon-plus"></span> @lang('button.create')</a>
                    </div>
                </div>
                <br/>

                <div class="panel-body">
                    <table class="table table-bordered " id="table">
                        <thead>
                        <tr class="filters">
                            <td width="5%" align="center">ID</td>
                            <td width="15%" align="center">加工項目</td>
                            <td width="40%" align="center">選項</td>
                            <td width="20%" align="center">說明</td>
                            <td width="10%" align="center">動作</td>
                        </tr>
                        </thead>
                        <tbody>
                        {{--todo:  implement, to list out the addon option here --}}
                        {{--@foreach ($add_on_options as $option)--}}
                            {{--<tr>--}}
                                {{--<td align="center">{{$option->id}}</td>--}}
                                {{--<td class="text-danger">{{$option->title}}</td>--}}
                                {{--<td class="text-primary">{!! $option->readable_settings !!}</td>--}}
                                {{--<td style="text-align: left">{!! $option->body !!}</td>--}}
                                {{--<td align="center">--}}
                                    {{--<a href="{{ route('admin.addonOptions.edit', $option->id) }}">--}}
                                        {{--<i class="livicon" data-name="edit" data-size="18" data-loop="true"--}}
                                           {{--data-c="#428BCA" data-hc="#428BCA" title="edit addOnOption"></i>--}}
                                    {{--</a>--}}
                                    {{--<a href="{{ route('admin.addonOptions.confirm-delete', $option->id) }}" data-toggle="modal"--}}
                                       {{--data-target="#delete_confirm">--}}
                                        {{--<i class="livicon" data-name="remove-alt" data-size="18" data-loop="true"--}}
                                           {{--data-c="#f56954" data-hc="#f56954" title="delete addOnOption"></i>--}}
                                    {{--</a>--}}
                                {{--</td>--}}
                            {{--</tr>--}}
                        {{--@endforeach--}}

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
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/jquery.dataTables.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.bootstrap.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('#table').DataTable();
        });
    </script>

    <div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="user_delete_confirm_title"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content"></div>
        </div>
    </div>

    <script>
        $(function () {
            $('body').on('hidden.bs.modal', '.modal', function () {
                $(this).removeData('bs.modal');
            });
        });
    </script>
@stop
