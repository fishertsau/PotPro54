@if(isset($videos))
    @if(!count($videos)>0)
        <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h4><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 無符合條件的影音!</h4>
            No any video which conforms the search criteria were found.
        </div>
    @else

        總筆數: {{$videos->count()}} &nbsp;頁數:{{$videos->currentPage()}}/{{$videos->lastPage()}}
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
            @foreach ($videos as $video)
                <tr>
                    <td class="title-potmaster">{!! $video->title !!}</td>
                    <td>{!! $video->active_text !!}</td>

                    <td>{!! $video->body!!}</td>
                    <td align="center">
                        <a href="{{ route('admin.video.show', $video->id) }}">
                            <i class="livicon" data-name="info" data-size="18" data-loop="true"
                               data-c="#428BCA" data-hc="#428BCA" title="view video"></i>
                        </a>
                        <a href="{{ route('admin.video.edit', $video->id) }}">
                            <i class="livicon" data-name="edit" data-size="18" data-loop="true"
                               data-c="#428BCA" data-hc="#428BCA" title="edit video"></i>
                        </a>
                        <a href="{{ route('admin.video.confirm-delete', $video->id) }}" data-toggle="modal"
                           data-target="#delete_confirm">
                            <i class="livicon" data-name="remove-alt" data-size="18" data-loop="true"
                               data-c="#f56954" data-hc="#f56954" title="delete video"></i>
                        </a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>

        <div class="text-center">
            {!! $videos->links() !!}
        </div>

    @endif
@endif