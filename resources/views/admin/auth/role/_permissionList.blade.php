@if(isset($role->permissions))

    @if(count($role->permissions)>0)
        <ul>
            @foreach($role->permissions as $permission)
                <li> {{$permission->description}}</li>
            @endforeach
        </ul>
    @else
        <p class="text-danger">尚未設定權限</p>
    @endif

@endif