@if(!count($todos)>0)
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <h4><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 無符合條件的待辦事項!</h4>
        No any todo which conforms the search criteria were found.
    </div>
@else

    總筆數: {{$todos->count()}} &nbsp;頁數:{{$todos->currentPage()}}/{{$todos->lastPage()}}
    <table class="table table-bordered " id="table">
        <thead>
        <tr class="filters">
            <th width="10%" class="text-center">狀態</th>
            <th width="10%" class="text-center">工作事項</th>
            <th width="10%" class="text-center">負責人</th>
            <th width="10%" class="text-center">指派人
                /記錄人
            </th>
            <th width="10%" class="text-center">登記日期</th>
            <th width="10%" class="text-center">預計完成</th>
            <th width="10%" class="text-center">實際完成</th>
            <th width="10%" class="visible-desktop-cell">內容</th>
            <th width="10%" class="text-center">動作</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($todos as $todo)
            <tr>
                <td class="text-center">{{$todo->status_text}}</td>
                <td class="text-primary">{{$todo->title}}</td>
                <td class="text-center">{{ $todo->doer}}</td>
                <td>{{$todo->creator->name}}/{{$todo->recorder_name}}</td>
                <td>{{ $todo->created_at}}</td>
                <td>{{ $todo->expected_finish_at}}</td>
                <td>{{ $todo->finished_at}}</td>
                <td>{{$todo->content}}</td>
                <td align="center">
                    @if($todo->status !== 'open')
                        <a href="/admin/todo/{{$todo->id}}" class="btn btn-sm btn-default">
                            查看</a>
                    @endif

                    @if($todo->status == 'open')
                        <a href="/admin/todo/{{$todo->id}}/edit" class="btn btn-sm btn-warning">
                            修改</a>
                        <a href="/admin/todo/command/{{$todo->id}}/done" class="btn btn-success btn-sm">完成</a>
                        <a href="/admin/todo/command/{{$todo->id}}/pending" class="btn btn-danger btn-sm">暫停</a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="text-center">
        {!! $todos->links() !!}
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