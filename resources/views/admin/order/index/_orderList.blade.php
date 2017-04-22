@if(!count($orders)>0)
    @include('admin.partials._noResult')
@else
    <table class="table table-bordered">
        <thead>
        <tr>
            <th width="5%" class="text-center visible-desktop-cell">
                <sapn>
                    <input type="checkbox"
                           id="selectAll"
                           onclick="selectAllToggle(this)">
                </sapn>
            </th>
            <th width="15%" class="text-center ">訂購單號</th>
            <th width="8%" class="text-center">訂購人</th>
            <th width="10%" class="text-center">狀態</th>
            <th width="10%" class="text-center">階段</th>
            <th width="10%" class="text-center">進度</th>
            <th width="10%" class="text-center">金額</th>
            <th width="8%" class="text-center">數量</th>
            <th width="8%" class="text-center">動作</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($orders as $order)
            <tr>
                <td class="text-center visible-desktop-cell">
                    <input type="checkbox"
                           class="row-selection"
                           value="{{$order->id}}"
                            name="orderChosen[]">
                </td>

                <td class="text-center">{{$order->po_no}}</td>
                <td class="text-primary text-center">{{ $order->buyer->name }}</td>
                <td class="text-center">{!! $order->status_text!!}</td>
                <td class="text-center">{{$order->phase_text}}</td>
                <td class="text-center">{{$order->phase_status_text}}
                    @include('admin.order.index._nextActionBtn',['order'=>$order])
                </td>
                <td class="text-center"><b>{!!  $order->amount!!}</b></td>
                <td class="text-center">{!! $order->qty !!} </td>
                <td class="text-center">
                    <a onclick="fetchEditOrder({{$order->id}})" class="btn btn-xs btn-info"><span
                                class="glyphicon glyphicon-circle-arrow-right"></span> 明細</a>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    <div class="text-center">
        {!! $orders->links() !!}
    </div>

    <script>
        $(document).ready(function () {
            $('.pagination a').on('click', function (event) {
                event.preventDefault();
                if ($(this).attr('href') != '#') {
                    $('#listContent').load($(this).attr('href'));
                }
            });
        });
    </script>

@endif