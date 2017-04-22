<div class="form-horizontal">
    <div class='form-group'>

        {!! Form::label('category', '類別',['class'=>'col-sm-2 control-label']) !!}

        <div class="col-sm-3">
            {!! Form::select( 'category' ,$role->getCatlist() , null , ['id'=>'tag_list','class'=>'form-control tagSelect'] ) !!}
        </div>
    </div>

    <div class="form-group {{ $errors->
                                first('name', 'has-error') }}">
        <label for="title" class="col-sm-2 control-label">
            @lang('role/form.name')
        </label>

        <div class="col-sm-5">
            <input type="text" id="name" name="name" class="form-control"
                   placeholder=@lang('role/form.name') value="{!! old('name', $role->
                                    name) !!}" required>
        </div>
        <div class="col-sm-4">
            {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
        </div>
    </div>

    {{--群組內容--}}
    <div class="form-group">
        <label for="description"
               class="col-sm-2 control-label">@lang('role/form.description')</label>

        <div class="col-sm-5">
            {!! Form::text('description', null , ['class'=>'form-control','placeholder'=>'群組內容','id'=>'description','required'=>true]) !!}
        </div>
    </div>

    <hr/>
    <div class="form-group">
        <label for="description"
               class="col-sm-2 control-label">權限設定</label>

        <div class="col-sm-10">
            <ul>
                @foreach($permissionList as $permissionCat=>$permissionListForCat)
                    <li class="title-potmaster">{{$permissionCat}}</li>
                    @foreach($permissionListForCat as $permission)
                        <input type="checkbox" value="{{$permission->id}}"
                               name="permission_list[]"
                               @if($rolePermissionList->contains($permission->id))
                               checked
                                @endif
                                >
                        {{$permission->description}} &nbsp;
                    @endforeach
                    <hr/>
                @endforeach
            </ul>
        </div>
    </div>
    <br/>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-4">
            <a class="btn btn-danger" href="#">
                @lang('button.cancel')
            </a>
            <button type="submit" class="btn btn-success">
                @lang('button.save')
            </button>
        </div>
    </div>


    <hr/>
    <div class="form-group">
        <label for="description"
               class="col-sm-2 control-label">現有權限</label>

        <div class="col-sm-10">
            @include('admin.auth.role._permissionList')
        </div>
    </div>

    <div class="form-group">
        <label for="description"
               class="col-sm-2 control-label">群組成員</label>

        <div class="col-sm-10">
            @include('admin.auth.role._userList')
        </div>
    </div>
</div>
