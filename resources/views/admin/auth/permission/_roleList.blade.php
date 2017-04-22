@if ($permission->roles()->count() >= 1)
    <div class="form-horizontal">
        <div class="form-group">
            <label for=""
                   class="col-sm-2 control-label">相關群組</label>

            <div class="col-sm-10">
                <ul class="list-group">
                    @foreach($permission->roles as $role)
                        <li class="list-group-item">{{$role->name}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif