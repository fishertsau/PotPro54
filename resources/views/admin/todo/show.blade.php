@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    @parent-@lang('todo/title.newsdetail')
@stop

@section('content')
    @include('admin.todo._contentHeader',
        ['section_title'=> '待辦事項內容'])
    <section class="content paddingleft_right15">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary ">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">
                            <i class="livicon" data-name="list-ul" data-size="16" data-loop="true"
                               data-c="#fff" data-hc="white"></i>
                            工作項目:{{ $todo->title }}
                        </h4>
                        <span class="pull-right">
                            <a href="{{ URL::previous()}}" style="color: white">
                                回上一頁 &nbsp; <i class="fa fa-reply"></i>
                            </a>
                         </span>
                    </div>
                    <br/>

                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr class="filters">
                                <th width="10%">Item</th>
                                <th width="30%">Content</th>
                            </tr>
                            </thead>
                            <tr>
                                <td>狀態</td>
                                <td>{{ $todo->status_text }}</td>
                            </tr>
                            <tr>
                                <td>工作項目</td>
                                <td>{{ $todo->title }}</td>
                            </tr>
                            <tr>
                                <td>工作內容</td>
                                <td>{{ $todo->content }}</td>
                            </tr>
                            <tr>
                                <td>指定人</td>
                                <td>{{ $todo->creator->name }}</td>
                            </tr>
                            <tr>
                                <td>負責人</td>
                                <td>{{ $todo->doer }}</td>
                            </tr>
                            <tr>
                                <td>工作紀錄人</td>
                                <td>{{ $todo->recorder->name }}</td>
                            </tr>
                            <tr>
                                <td>指定日期</td>
                                <td>{{ $todo->created_at}}</td>
                            </tr>

                            <tr>
                                <td>預計完成日</td>
                                <td>{{ $todo->expected_finish_at }}</td>
                            </tr>
                            <tr>
                                <td>實際完成日</td>
                                <td>{{ $todo->finished_at }}</td>
                            </tr>


                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop