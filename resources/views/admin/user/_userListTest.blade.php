@if(!count($users)>0)
    @include('admin.partials._noResult')
@else

    <div class="text-center">
        {!! $users->links() !!}
    </div>
    總筆數: {{$users->count()}} &nbsp;頁數:{{$users->currentPage()}}/{{$users->lastPage()}}
    <table class="table table-bordered" id="table">
        <thead>
        <tr>
            <th class="text-center">姓名</th>
            <th class="text-center">電子郵件</th>
            <th class="text-center">狀態</th>
            <th class="text-center">群組</th>
            <th class="text-center">建立日期</th>
            <th class="text-center">編輯</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{!! $user->name !!}</td>
                <td>{!! $user->email !!}</td>
                <td>{{$user->active_text}}/<br/>
                    <span class="text-danger">{{$user->verified_text}}</span>
                </td>
                <td>
                    <ul>
                        @foreach($user->roles as $role)
                            <li> {{$role->name}}</li>
                        @endforeach
                    </ul>
                </td>
                <td>{!! $user->created_at->diffForHumans() !!}</td>
                <td>
                    {{--<a href="{{route('admin.user.show', $user->id)}} "><i class="fa fa-info-circle"--}}
                                                                          {{--aria-hidden="true"></i></a>--}}


                    <a href="{{ route('admin.user.edit', $user->id) }}"><i class="fa fa-pencil-square-o"
                                                                           aria-hidden="true"></i></a>

                    @if ((Auth::user()->id != $user->id))
                        <a href="{{ route('confirm-delete/user', $user->id) }}" data-toggle="modal"
                           data-target="#delete_confirm"><i class="fa fa-times text-danger" aria-hidden="true"></i></a>
                    @endif
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
                    $('#userListContent').load($(this).attr('href'));
                }
            });
        });
    </script>
@endif