@if(!count($newss)>0)
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <h4><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 無符合條件的最新消息!</h4>
        No any news which conforms the search criteria were found.
    </div>
@else

    總筆數: {{$newss->count()}} &nbsp;頁數:{{$newss->currentPage()}}/{{$newss->lastPage()}}
    <table class="table table-bordered " id="table">
        <thead>
        <tr class="filters">
            <th width="10%" class="text-center">位置</th>
            <th width="15%" class="text-center">標題</th>
            <th width="10%" class="text-center">狀態/熱門</th>
            <th width="15%" class="text-center">上架日期</th>
            <th width="15%" class="visible-desktop-cell">內容</th>
            <th width="10%" class="text-center">動作</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($newss as $news)
            <tr>
                <td>{{$news->location_text}}</td>
                <td class="text-danger">{{$news->title}}</td>
                <td>{!! $news->active_text!!}
                    {!! $news->hot_text !!}
                </td>

                <td><b>{!!  $news->effective_date!!}</b></td>
                <td style="text-align:left; " class="visible-desktop-cell">
                    <div style="max-height: 50px;overflow: hidden">{!! $news->body !!}</div>
                </td>

                <td align="center">
                    <a href="/admin/news/{{$news->id}}" class=""><i class="fa fa-info-circle"
                                                                    aria-hidden="true"></i></a>
                    <a href="/admin/news/{{$news->id}}/edit" class=""><i class="fa fa-pencil-square-o"
                                                                         aria-hidden="true"></i></a>
                    <a href="{{ route('admin.news.confirm-delete', $news->id) }}" data-toggle="modal"
                       data-target="#delete_confirm" title="刪除">
                        <i class="fa fa-times text-danger" aria-hidden="true"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="text-center">
        {!! $newss->links() !!}
    </div>

    <script>
        $(document).ready(function () {
            $('.pagination a').on('click', function (event) {
                event.preventDefault();
                if ($(this).attr('href') != '#') {
                    $('#newsListContent').load($(this).attr('href'));
                }
            });
        });
    </script>
@endif