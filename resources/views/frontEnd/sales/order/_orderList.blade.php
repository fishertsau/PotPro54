@if(!count($orders)>0)
    @include('frontEnd.partials._noResult')
@else
    <p class="title-potmaster">總筆數: {{$orders->total()}} &nbsp;頁數:{{$orders->currentPage()}}/{{$orders->lastPage()}}</p>
    <table class="table table-bordered table-hover table-strip" id="table" style="background: white;">
        <thead>
        <tr>
            <th width="10%" class="text-center">單號</th>
            <th width="10%" class="text-center">狀態</th>
            <th width="10%" class="text-center">金額</th>
            <th width="10%" class="text-center">數量</th>
            <th width="5%" class="text-center">查看</th>
        </tr>
        </thead>
        <tbody>

        @foreach($orders as $order)
            <tr>
                <td class="text-center title-potmaster">{{$order->po_no}}</td>
                <td class="text-center title-potmaster">{!! $order->status_text!!}/{{$order->phase_text}}/{{$order->phase_status_text}}</td>
                <td class="text-center title-potmaster">{{$order->amount}}</td>
                <td class="text-center title-potmaster">{{$order->qty}}</td>
                <td align="center">
                    <a onclick="fetchOrder({{$order->id}})">
                        <i class="fa fa-search-plus" aria-hidden="true"></i>
                    </a>
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
                    $('#orderListContent').load($(this).attr('href'));
                }
            });
        });
    </script>

@endif