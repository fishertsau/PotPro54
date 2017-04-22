@if(!count($examples)>0)
    @include('admin.partials._noResult')
@else
    總筆數: {{$examples->total()}} &nbsp;頁數:{{$examples->currentPage()}}/{{$examples->lastPage()}}
    <table class="table table-bordered " id="table">
        <thead>
        <tr>
            <th width="5%" class="text-center">
                <input type="checkbox"
                       id="selectAll"
                       onclick="selectAllToggle(this)"></th>
            <th width="25%" class="text-center">標題</th>
            <th width="20%" class="text-center">熱門/開通/上下架</th>
            <th width="20%" class="text-center">管理者/編輯者</th>
            <th width="15%" class="text-center">動作</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($examples as $example)
            <tr>
                <td class="text-center">
                    <input type="checkbox"
                           class="row-selection"
                           value="{{$example->id}}"
                           name="exampleChosen[]">
                </td>
                <td class="text-primary text-center">{!! $example->title !!}</td>
                <td class="text-center">{!! $example->hot_text !!}/&nbsp;
                    {!! $example->activated_text !!}/&nbsp;
                    {!! $example->published_text !!}
                </td>
                <td class="text-center">
                    {!! isset($example->manager) ? $example->manager->name:'<span class="text-danger">尚未設定</span>' !!}/
                    {!! isset($example->editor) ? $example->editor->name:'<span class="text-danger">尚未設定</span>' !!}
                </td>
                <td align="center">
                    @can('see-example')
                    <a href="{{ route('admin.example.show', $example->id) }}">
                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                    </a>
                    @endcan

                    @can('edit-example')
                    <a href="{{ route('admin.example.edit', $example->id) }}">
                        <i class="fa fa-pencil-square-o"
                           aria-hidden="true"></i>
                    </a>

                    <a href="{{ route('admin.example.confirm-delete', $example->id) }}" data-toggle="modal"
                       data-target="#delete_confirm">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </a>
                    @endcan
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
                    $('#listContent').load($(this).attr('href'));
                }
            });
        });
    </script>
@endif