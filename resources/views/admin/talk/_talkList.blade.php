@if(!count($talks)>0)
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <h4><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 無符合條件的最新消息!</h4>
        No any news which conforms the search criteria were found.
    </div>
@else
    總筆數: {{$talks->count()}} &nbsp;頁數:{{$talks->currentPage()}}/{{$talks->lastPage()}}

    <table class="table table-bordered " id="table">
        <thead>
        <tr class="filters">
            <th width="25%">標題</th>
            <th width="10%">狀態</th>
            <th width="55%">內容</th>
            <th width="20%" align="center">動作</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($talks as $talk)
            <tr>
                <td class="text-danger">{!! $talk->title !!}</td>
                <td>{!! $talk->active_text !!}</td>
                <td>{!! $talk->body!!}</td>
                <td align="center">
                    <a href="{{ route('admin.talk.show', $talk->id) }}">
                        <i class="livicon" data-name="info" data-size="18" data-loop="true"
                           data-c="#428BCA" data-hc="#428BCA" title="view talk"></i>
                    </a>
                    <a href="{{ route('admin.talk.edit', $talk->id) }}">
                        <i class="livicon" data-name="edit" data-size="18" data-loop="true"
                           data-c="#428BCA" data-hc="#428BCA" title="edit talk"></i>
                    </a>
                    <a href="{{ route('admin.talk.confirm-delete', $talk->id) }}" data-toggle="modal"
                       data-target="#delete_confirm">
                        <i class="livicon" data-name="remove-alt" data-size="18" data-loop="true"
                           data-c="#f56954" data-hc="#f56954" title="delete talk"></i>
                    </a>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    <div class="text-center">
        {!! $talks->links() !!}
    </div>
@endif