@if(!count($salesPersons)>0)
    @include('admin.partials._noResult')
@else

    總筆數: {{$salesPersons->count()}} &nbsp;頁數:{{$salesPersons->currentPage()}}/{{$salesPersons->lastPage()}}
    <table class="table table-bordered ">
        <thead>
        <tr>
            <th class="text-center">狀態</th>
            <th class="text-center">身分</th>
            <th class="text-center">名稱</th>
            <th class="text-center">折數(%)</th>
            <th class="text-center">編輯</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($salesPersons as $sales)
            <tr>
                <td class="text-center">{!! $sales->activated_text !!}</td>
                <td class="text-center">{!! $sales->role !!}</td>
                <td class="text-center">{!! $sales->user->name !!}</td>
                <td class="text-center">{!! $sales->discount_rate !!}</td>
                <td class="text-center">
                    <a href="{{ route('admin.sales.show', $sales->id) }}" class=""><i class="fa fa-info-circle"
                                                                    aria-hidden="true"></i></a>
                    <a href="{{ route('admin.sales.edit', $sales->id) }}" class=""><i class="fa fa-pencil-square-o"
                                                                         aria-hidden="true"></i></a>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    <div class="text-center">
        {!! $salesPersons->links() !!}
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