@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    @parent-@lang('talk/title.videodetail')
@stop

@section('content')
    @include('admin.example._contentHeader',
    ['section_title'=> '節能案例清單'])
    <section class="content paddingleft_right15">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary ">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">
                            <i class="livicon" data-name="list-ul" data-size="16" data-loop="true"
                                                   data-c="#fff" data-hc="white"></i>
                            案例:{{ $example->title }}
                        </h4>
                        <span class="pull-right">
                            <a href="{{ URL::previous()}}" style="color: white">
                                回上一頁 &nbsp; <i class="fa fa-reply"></i>
                            </a>
                         </span>
                    </div>
                    <br/>

                    <div class="panel-body">
                        @include('frontEnd.eventOrRecord.examples.partials._showContent')
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop