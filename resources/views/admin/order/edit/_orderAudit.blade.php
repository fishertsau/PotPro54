<div class="panel panel-primary ">
    <div class="panel-heading clearfix">
        <h4 class="panel-title">
            <i class="livicon" data-name="checked-on" data-size="16" data-loop="true"
               data-c="#fff" data-hc="white"></i>&nbsp;訂單審核
        </h4>
        @include('admin.order.partials._goBackToListViewBtn')
    </div>


    <div class="panel-body" style="display: flex">
        {{--When order: (1)normal, (2)in 'audit' phase, (3)needs TBP--}}
        @if(($order->status_flag=='n')
        &($order->phase=='a')
        &($order->phase_status_flag=='t'))

            <div style="flex:1">
                {{Form::open(['id'=>'acceptOrderForm', 'method'=>'post',
                'route'=>['orderNextMove','accept',$order->id]])}}
                {{Form::close()}}
                <a style="color:white"
                   onclick="acceptOrderAction({{$order->id}},this)">
                    <button class="btn btn-success full-width">
                        <span class="glyphicon glyphicon-ok"></span> 接受訂單
                    </button>
                </a>
            </div>
            &nbsp;
            <div style="flex:1">
                <a onclick="showActionForm({{$order->id}},'reject')">
                    <button class="btn btn-default full-width">
                        <span class="glyphicon glyphicon-share-alt"></span> 退回訂單
                    </button>
                </a>
            </div>
            &nbsp;
        @endif


        {{--if phase is in start or finished, don't show--}}
        @if(!($order->phase=='s')|($order->phase=='f'))
            &nbsp;

            {{--if status is normal, show this--}}
            @if($order->status_flag=='n')
                <div style="flex:1">
                    <a onclick="showActionForm({{$order->id}},'on-hold')">
                        <button class="btn btn-warning full-width">
                            <span class="glyphicon glyphicon-pause"></span> 暫停訂單
                        </button>
                    </a>
                </div>
            @endif

            {{--if status is on-hold, show this --}}
            @if($order->status_flag=='o')
                &nbsp;
                <div style="flex:1">
                    <a onclick="showActionForm({{$order->id}},'restore')">
                        <button class="btn btn-success full-width">
                            <span class="glyphicon glyphicon-ok"></span> 回復訂單
                        </button>
                    </a>
                </div>
            @endif

            {{--if status is normal or on-hold--}}
            @if(($order->status_flag=='n')|($order->status_flag=='o'))
                &nbsp;
                <div style="flex:1">
                    <a onclick="showActionForm({{$order->id}},'cancel')">
                        <button class="btn btn-danger full-width">
                            <span class="glyphicon glyphicon-remove"></span> 取消訂單
                        </button>
                    </a>
                </div>
            @endif
        @endif
    </div>
</div>