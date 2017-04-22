<div class="form-horizontal">
    @include('errors.list')

            <!--系列名稱-->

    <!--主類別-->
    <div class="form-group">
        <label for="" class="col-sm-2 control-label">類別</label>

        <div class="col-sm-8">
            {{$group->subCategory->groupCategory->title}}/{{$group->subCategory->title}}
        </div>
    </div>


    <!-- 加工選項 Tag \Form Multiple Select  -->
    <div class='form-group'>
        {!! Form::label('add_on_list', '可加工',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::radio('add_on_allowed', '1',true) !!}可加工
            {!! Form::radio('add_on_allowed', '0') !!}不可加工
        </div>
    </div>


    <!-- 加工選項 Tag \Form Multiple Select  -->
    <div class='form-group'>
        {!! Form::label('add_on_list', '加工選項',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::select( 'add_on_list[]' ,$add_ons , null , ['id'=>'add_on_list','class'=>'form-control','multiple'
            ,($group->add_on_allowed)?'required':'disabled'] ) !!}
        </div>
    </div>

    <!--主要圖片-->
    <div class="form-group">
        {!! Form::label('body', '主要圖片',['class'=>'col-sm-2 control-label']) !!}

        <div class="col-sm-10">
            <?php $photoPath = $group->coverPhoto_path==''?"coverPhoto.jpg": $group->coverPhoto_path; ?>
            <img class="full-width" style="max-width: 40%" src="{{URL::asset('assets/images/cover')}}/{{ $photoPath }}">
        </div>
    </div>


    <!--建立日期-->
    <div class="form-group">
        {!! Form::label('created_at', '建立日期',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            <p class="form-control-static">
                {{ $group->created_at}}
            </p>
        </div>
    </div>

    <hr/>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-4">
            <a class="btn btn-danger" href="{{ url('/admin/product/group') }}">
                <i class="fa fa-times"></i> @lang('button.cancel')
            </a>
            <button type="submit" class="btn btn-success">
                <span class="glyphicon glyphicon-ok-sign"></span>&nbsp; @lang('button.save')
            </button>
        </div>
    </div>
</div>