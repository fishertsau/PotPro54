@if(!count($groups)>0)
    @include('admin.partials._noResult')
@else
    總筆數: {{$groups->total()}} &nbsp;頁數:{{$groups->currentPage()}}/{{$groups->lastPage()}}
    <table class="table table-bordered " id="table">
        <thead>
        <tr>
            <td width="8%">id</td>
            <td width="8%">主類別</td>
            <td width="8%">子類別</td>
            <td width="10%">系列圖片</td>
            <td width="10%">系列名稱</td>
            <td width="8%" style="text-align: center">狀態</td>
            <td width="40%" class="text-left">加工配件</td>
            <th width="10%" class="text-center">動作</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($groups as $group)
            <tr>
                <td class="text-primary">{{$group->id}}</td>
                <td class="text-primary">{{$group->subCategory->groupCategory->title}}</td>
                <td class="text-primary">{{$group->subCategory->title}}</td>
                <td>
                    <img src="{{URL::asset('assets/images/cover')}}/{{ $group->coverPhoto_path=='' ? 'coverPhoto.jpg' : $group->coverPhoto_path}}"
                         style="width: 80%">
                </td>
                <td class="title-potmaster">{{$group->title}}</td>
                <td>{!! $group->active_text!!}</td>
                <td class="text-left">{!! $group->add_on_list_string !!}</td>
                <td align="center">
                    <a href="{{ route('admin.product.group.show', $group->id) }}">
                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                    </a>
                    <a href="{{ route('admin.product.group.edit', $group->id) }}">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </a>
                    @can('edit-production')
                    <a href="{{ url('admin/product/group/production/setting/'.$group->id) }}">
                        <i class="fa fa-gavel" aria-hidden="true"></i>
                    </a>
                    @endcan
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    <div class="text-center">
        {!! $groups->links() !!}
    </div>

    <script>
        $(document).ready(function () {
            $('.pagination a').on('click', function (event) {
                event.preventDefault();
                if ($(this).attr('href') != '#') {
                    $('#groupListContent').load($(this).attr('href'));
                }
            });
        });
    </script>
@endif