<div class="form-horizontal">
    <div class='form-group'>

        {!! Form::label('category', '類別',['class'=>'col-sm-2 control-label']) !!}

        <div class="col-sm-3">
            {!! Form::select( 'category' ,$permission->getCatlist() , null , ['id'=>'tag_list','class'=>'form-control tagSelect'] ) !!}
        </div>
    </div>

    <div class="form-group {{ $errors->
                                first('name', 'has-error') }}">
        <label for="title" class="col-sm-2 control-label">
            @lang('permission/form.name')
        </label>

        <div class="col-sm-5">
            <input type="text" id="name" name="name" class="form-control"
                   placeholder=@lang('permission/form.name') value="{!! old('name', $permission->
                                    name) !!}" required>
        </div>
        <div class="col-sm-4">
            {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
        </div>
    </div>
    <div class="form-group">
        <label for="description"
               class="col-sm-2 control-label">@lang('permission/form.description')</label>

        <div class="col-sm-5">
            {!! Form::text('description', null , ['class'=>'form-control','placeholder'=>'權限內容','id'=>'description','required'=>true]) !!}
        </div>
    </div>
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
</div>
