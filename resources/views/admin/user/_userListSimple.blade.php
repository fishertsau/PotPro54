@if(!count($users)>0)
    @include('admin.partials._noResult')
@else

    總筆數: {{$users->count()}} &nbsp;頁數:{{$users->currentPage()}}/{{$users->lastPage()}}
    <table class="table table-bordered table-responsive" id="table" style="width: 100%">
        <thead>
        <tr>
            <th class="text-center" width="20%">姓名/電子郵件</th>
            <th class="text-center visible-desktop-block" width="40%">電子郵件</th>
            <th class="text-center" width="20%">狀態</th>
            <th class="text-center" width="20%">選擇</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{!! $user->name !!}/<br/></td>
                <td class="visible-desktop-block">{!! $user->email !!}</td>
                <td>{{$user->active_text}}/<br/>
                    <span class="text-danger">{{$user->verified_text}}</span>
                </td>
                <td class="text-center">
                    <form id="user_{{$user->id}}"
                          class="userInstanceForm">
                        <input type="text" class="hidden userInstance"
                                value="{{collect($user)->toJson()}}">
                        <button class="btn btn-default">選擇</button>
                    </form>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
    <div class="text-center">
        {!! $users->links() !!}
    </div>

    <script>
        $(document).ready(function () {
            $('.pagination a').on('click', function (event) {
                event.preventDefault();
                if ($(this).attr('href') != '#') {
                    $('#listContent').load($(this).attr('href'));
                }
            });

            $('.userInstanceForm').submit(function (e) {
                e.preventDefault();
                setSelectedUser(this);
            });
        });
    </script>
@endif