@if ($roles->count() >= 1)

    <table class="table table-bordered" id="table">
        <thead>
        <tr>
            <th class="text-center">類別</th>
            <th class="text-center">群組</th>
            <th class="text-center">群組說明</th>
            <th class="text-center">擁有權限</th>
            <th class="text-center">@lang('role/table.actions')</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($roles as $role)
            @if($role->name!='superAdmin' | (Auth::user()->isSuperAdmin()))
                <tr>
                    <td class="text-primary" align="center">{!! $role->category_title !!}</td>
                    <td class="text-danger" align="center">{!! $role->name !!}</td>
                    <td>{!! $role->description !!}</td>
                    <td>
                        <ul>
                            @foreach($role->permissions as $permission)
                                <li> {{$permission->description}}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td align="center">
                        <a href="/admin/role/{{$role->id}}/edit">
                            <i class="livicon" data-name="edit" data-size="18" data-loop="true"
                               data-c="#428BCA" data-hc="#428BCA" title="edit role"></i>
                        </a>
                    </td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>
@else
    @include('admin.partials._noResult')
@endif