<div class="form-horizontal">
    <div class="form-group">
        <label for=""
               class="col-sm-2 control-label">相關使用者</label>

        <div class="col-sm-10">
            @if ($users->count() >= 1)
                <ul>
                    @foreach($users as $user)
                        <li>{{$user->name}}</li>
                    @endforeach
                </ul>
            @else
                <span class="text-primary">無使用者</span>
            @endif
        </div>
    </div>
</div>
