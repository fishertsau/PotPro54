@if(!count($examples)>0)
    @include('frontEnd.partials._noResult')
@else
    <p class="title-potmaster">總筆數: {{$examples->total()}} &nbsp;頁數:{{$examples->currentPage()}}
        /{{$examples->lastPage()}}</p>
    <table class="table table-bordered table-hover table-strip" id="table" style="background: white;">
        <thead>
        <tr>
            <th width="10%" class="text-center">標題</th>
            <th width="10%" class="text-center">開通/公布</th>
            <th width="10%" class="text-center">管理者</th>
            <th width="5%" class="text-center">查看</th>
        </tr>
        </thead>
        <tbody>

        @foreach($examples as $example)
            <tr>
                <td class="text-center title-potmaster">{{$example->title}}</td>
                <td class="text-center title-potmaster">
                    {!! $example->activated_text!!}/{!! $example->published_text !!}
                </td>
                <td class="text-center title-potmaster">
                    {!! isset($example->manager) ? $example->manager->name:'<span class="text-danger">尚未設定</span>' !!}
                </td>
                <td align="center">
                    <a onclick="fetchExample({{$example->id}})">
                        <i class="fa fa-search-plus" aria-hidden="true"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="text-center">
        {!! $examples->links() !!}
    </div>

    <script>
        $(document).ready(function () {
            $('.pagination a').on('click', function (event) {
                event.preventDefault();
                if ($(this).attr('href') != '#') {
                    $('#exampleListContent').load($(this).attr('href'));
                }
            });
        });
    </script>

@endif