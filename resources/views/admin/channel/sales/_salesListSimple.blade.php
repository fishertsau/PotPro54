@if(!count($salesPersons)>0)
    @include('admin.partials._noResult')
@else

    總筆數: {{$salesPersons->count()}} &nbsp;頁數:{{$salesPersons->currentPage()}}/{{$salesPersons->lastPage()}}
    <table class="table table-bordered">
        <thead>
        <tr>
            <th class="text-center">相片</th>
            <th class="text-center">身分</th>
            <th class="text-center">名稱</th>
            <th class="text-center">選擇</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($salesPersons as $sales)
            <tr>
                <td class="text-center">相片</td>
                <td class="text-center">{!! $sales->role !!}</td>
                <td class="text-center">
                    <span class="text-primary">{!! $sales->user->name !!}</span>
                </td>
                <td class="text-center">
                    <form id="user_{{$sales->id}}"
                          class="salesInstanceForm">
                        <input type="text" class="hidden salesInstance"
                               value="{{collect($sales)->toJson()}}">
                        <button class="btn btn-default">選擇</button>
                    </form>
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

            $('.salesInstanceForm').submit(function (e) {
                e.preventDefault();
                setSelectedSales(this);
            });
        });
    </script>

@endif