@if(count($role->users)>0)
    <ul>
        @foreach($role->users as $user)
            <li class="text-potmaster">{{ $user->name }}({{$user->email}}) </li>&nbsp;
        @endforeach
    </ul>
@else
    <span class="text-danger">尚無群組成員</span>
@endif