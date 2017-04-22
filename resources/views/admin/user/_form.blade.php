<div class="form-horizontal">

    {{--姓名--}}
    <div class="form-group">
        <label for="name"
               class="col-sm-2 control-label">@lang('user/form.name')</label>

        <div class="col-sm-5">
            {!! Form::text('name', null , ['class'=>'form-control','placeholder'=>'姓名','id'=>'name','required'=>true]) !!}
        </div>
    </div>


    <!--手動停用-->
    <div class="form-group">
        <label for="" class="col-sm-2 control-label">手動停止</label>

        <div class="col-sm-8">
            {!! Form::radio('active', '1',true) !!}正常
            {!! Form::radio('active', '0') !!}停止
        </div>
    </div>

    {{--電子郵件--}}
    <div class="form-group">
        <label for="Email"
               class="col-sm-2 control-label">電子郵件</label>

        <div class="col-sm-10">
            {!! Form::text('email', null , ['class'=>'form-control','placeholder'=>'電子郵件','id'=>'name','required'=>true]) !!}
        </div>
    </div>

    {{--使用者群組設定--}}
    <div class="form-group">
        <label for="role_list"
               class="col-sm-2 control-label">群組設定</label>

        <div class="col-sm-10">
            @foreach($roleList as $roleCat=>$roleListForCat)
                <li class="title-potmaster">{{$roleCat}}</li>
                @foreach($roleListForCat as $id => $role)
                    {{--Show the 'superAdmin' option when the auth user is a superAdmin--}}
                    @if($role!='superAdmin' | (Auth::user()->isSuperAdmin()))
                        <input type="checkbox" value="{{$id}}"
                               name="role_list[]"
                               @if($userOwnedRoleIds->contains($id))
                               checked
                                @endif
                                >
                        {{$role}} &nbsp;
                    @endif
                @endforeach
                <hr/>
            @endforeach

        </div>
    </div>


    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-4">
            <a class="btn btn-danger" href="/admin/user">
                @lang('button.cancel')
            </a>
            <button type="submit" class="btn btn-success">
                @lang('button.save')
            </button>
        </div>
    </div>


    <hr/>

    {{--所屬群組--}}
    <div class="form-group">
        <label for="description"
               class="col-sm-2 control-label">所屬群組</label>

        <div class="col-sm-10">
            <ul>
                @foreach($user->roles as $role)
                    <li>{{$role->name}}</li>
                @endforeach
            </ul>
        </div>
    </div>

    {{--擁有權限--}}
    <div class="form-group">
        <label for="description"
               class="col-sm-2 control-label">擁有權限</label>

        <div class="col-sm-10">
            <ul>
                @foreach($user->ownsPermission() as $permission)
                    <li>{{$permission->description}}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
