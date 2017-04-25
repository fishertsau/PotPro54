@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')

    @parent - 管理系統
@stop


{{-- Page content --}}
@section('content')

    <section class="content-header">
        <h1>御鼎節能科技管理系統</h1>
        <ol class="breadcrumb">
            <li class="active">
                <a href="#">
                    <i class="livicon" data-name="home" data-size="16" data-color="#333" data-hovercolor="#333"></i>
                    首頁
                </a>
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12 ">
                <p>{{Auth::user()->name}} 您好,&nbsp;歡迎來到御鼎節能科技管理系統.</p>

                <hr>
                <p>您有以下待處理工作:</p>

                <ul style="list-style: circle">
                    @can('audit-order')
                    @if(isset($openOrderQty))
                        <li>
                            <form action="admin/order" method="get">
                                <input name="newSearch" type="text" class="hidden" value="1">

                                <input name="status_flag"
                                       type="text"
                                       class="hidden"
                                       value="n">
                                <input type="text" class="hidden"
                                       name="phase"
                                       value="a">
                                <input type="text" class="hidden"
                                       name="phase_status_flag"
                                       value="t">

                                <button class="btn btn-primary" type="submit">
                                    訂單審核 <span class="badge">{{$openOrderQty}}</span>
                                </button>
                            </form>
                        </li>
                    @endif
                    @endcan

                    @can('shipment-management')
                    @if(isset($toBeShipOrderQty))
                        <br>
                        <li>
                            <form action="admin/order" method="get">
                                <input name="newSearch" type="text" class="hidden" value="1">
                                <input name="status_flag"
                                       type="text"
                                       class="hidden"
                                       value="n">
                                <input type="text" class="hidden"
                                       name="phase"
                                       value="i">
                                <input type="text" class="hidden"
                                       name="phase_status_flag"
                                       value="t">
                                <button class="btn btn-primary" type="submit">
                                    待出貨 <span class="badge">{{$toBeShipOrderQty}}</span>
                                </button>
                            </form>
                        </li>
                    @endif
                    @endcan
                </ul>
                <br>
                <br>
                <hr/>
                <h4>系統使用紀錄</h4>
                <table class="table table-bordered">
                    <tr>
                        <td>登入時間(now:{{Carbon\Carbon::now()}})</td>
                        <td>{{Auth::user()->login_at}}</td>
                    </tr>

                    <tr>
                        <td>上次登入時間</td>
                        <td>{{session('user_last_login_at')}}</td>
                    </tr>
                    <tr>
                        <td>登入次數</td>
                        <td>{{Auth::user()->login_count}}</td>
                    </tr>

                    <tr>
                        <td>登入地點</td>
                        <td>{{Auth::user()->login_ip}}</td>
                    </tr>
                </table>

            </div>
        </div>
        <!--/row-->
    </section>

@stop


