@if ($permissions->count() >= 1)
    <table class="table table-bordered table-hover" id="table">
        <thead>
        <tr>
            <th>類別</th>
            <th>權限名稱</th>
            <th>權限內容</th>
            <th>使用群組</th>
            <th>使用者</th>
            <th>@lang('permission/table.actions')</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($permissions as $permission)
            <tr>
                <td class="text-primary">{!! $permission->category_title !!}</td>
                <td class="text-danger">{!! $permission->name !!}</td>
                <td>{!! $permission->description !!}</td>
                <td>
                    <ul>
                        @foreach($permission->roles as $role)
                            <li>{{$role->name}}</li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    <ul>
                        @foreach($permission->getUserListWithThePermission() as $user)
                            <li> {{$user->name}}</li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    <a href="/admin/permission/{{$permission->id}}/edit">
                        <i class="livicon" data-name="edit" data-size="18" data-loop="true"
                           data-c="#428BCA" data-hc="#428BCA" title="edit role"></i>
                    </a>

                    <a href="{{ route('admin.permission.confirm-delete', $permission->id) }}""
                       data-toggle="modal" data-target="#delete_confirm">
                        <i class="livicon" data-name="remove-alt" data-size="18"
                           data-loop="true" data-c="#f56954" data-hc="#f56954"
                           title="@lang('permission/form.delete_permission')"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    @include('admin.partials._noResult')
@endif