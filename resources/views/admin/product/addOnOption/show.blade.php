@extends('admin.layouts.default')

{{-- Page title --}}
@section('title')
    @parent-@lang('news/title.newsdetail')
@stop

@section('content')
    @include('admin.news._contentHeader',
        ['section_title'=> '消息廣告內容'])
    <section class="content paddingleft_right15">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary ">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">
                            <i class="livicon" data-name="list-ul" data-size="16" data-loop="true"
                                                   data-c="#fff" data-hc="white"></i>
                            加工方式:{{ $add_on_option->title }}
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
                            <tr>
                                <td>id</td>
                                <td>{{ $add_on_option->id }}</td>
                            </tr>
                            <tr>
                                <td>title</td>
                                <td>{{ $add_on_option->title }}</td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop