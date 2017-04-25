@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    @parent-@lang('group/title.groupdetail')
@stop

@section('content')
    @include('admin.product.group._contentHeader',
        ['section_title'=> '系列產品內容'])
    <section class="content paddingleft_right15">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary ">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">
                            <i class="livicon" data-name="list-ul" data-size="16" data-loop="true"
                               data-c="#fff" data-hc="white"></i>
                            系列產品: {{ $group->title }}
                        </h4>
                        <span class="pull-right">
                            <a href="{{ URL::previous()}}" style="color: white">
                                回上一頁 &nbsp; <i class="fa fa-reply"></i>
                            </a>
                         </span>
                    </div>
                    <br/>

                    <div class="panel-body">
                        <div style="max-width: 300px">
                            <img src="{{URL::asset('assets/images/cover')}}/{{ $group->coverPhoto_path=='' ? 'coverPhoto.jpg' : $group->coverPhoto_path}}"
                                 style="width: 80%">
                        </div>

                        <hr/>
                        <h3>加工配件設定</h3>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>選用</th>
                                <th>加工配件</th>
                                <th>單位數量</th>
                                <th>附註</th>
                                <th>編輯</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($group->add_ons))
                                @foreach($group->add_ons as $add_on)
                                    <tr>
                                        <td> {!! Form::checkbox('chosen[]',true) !!}</td>
                                        <td>{{$add_on->title}}</td>
                                        <td>@if($add_on->quantity_change_allowed)
                                                <input type="number" class="form-control" placeholder="單位數量">
                                            @else
                                                <p class="static-control">1</p>
                                            @endif
                                        </td>
                                        <td>Note</td>
                                        <td>
                                            <button>show</button>&nbsp;&nbsp;
                                            <button>hide</button>
                                        </td>
                                    </tr>
                                    <tr style="display: none">
                                        <td colspan="5">
                                            <div class="form-horizontal">
                                                <!--主要圖片-->
                                                <div class="form-group">
                                                    {!! Form::label('', '配件圖示',['class'=>'col-sm-2 control-label']) !!}
                                                    <div class="col-sm-8">
                                                        <img src="{{URL::asset('assets/images/cover')}}/{{ $add_on->coverPhoto_path=='' ? 'coverPhoto.jpg' : $add_on->coverPhoto_path}}"
                                                             style="width: 80%">
                                                    </div>
                                                </div>

                                                <table class="full-width table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th style="width:8%" class="text-center">選擇</th>
                                                        <th style="width:8%" class="text-center">編號</th>
                                                        <th style="width:20%" class="text-center">加工選項</th>
                                                        <th style="width:30%" class="text-center">設定</th>
                                                        <th style="width:24%" class="text-center">附註</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($add_on->options as $option)
                                                        <tr>
                                                            <td class="text-center">
                                                                @if($option->pivot->optionable)
                                                                    <input type="checkbox" name="" value="">
                                                                @else
                                                                    <p>-</p>
                                                                @endif
                                                            </td>
                                                            <td class="text-center">{{$option->pivot->no}}</td>
                                                            <td class="text-center">{{$option->title}}</td>
                                                            <td>
                                                                @if($option->quantity_change_allowed)
                                                                    <div class="input-group input-group-sm">
                                                                        <input type="number" class="form-control"
                                                                               placeholder="數量">
                                                                        <span class="input-group-addon"
                                                                              style="font-size: small">{{$option->settings_array[0]}}</span>
                                                                    </div>
                                                                @else
                                                                    @foreach($option->settings_array as $setting)
                                                                        <input type="radio" name="{{$option->title}}"
                                                                               value="{{$setting}}"> {{$setting}}
                                                                    @endforeach
                                                                @endif
                                                            </td>
                                                            <td><input type="text" placeholder="附註"
                                                                       class="form-control">
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop