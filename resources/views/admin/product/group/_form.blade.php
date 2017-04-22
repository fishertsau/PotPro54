<div class="form-horizontal">
    @include('errors.list')

            <!--系列名稱-->
    <div class="form-group">
        {!! Form::label('title', '系列名稱',['class'=>'col-sm-2 control-label']) !!}

        <div class="col-sm-8">
            {!! Form::text('title', null , ['class'=>'form-control','placeholder'=>'系列名稱','id'=>'title','required'=>true]) !!}
            {!! $errors->first('title', '<span class="help-block text-danger">:message</span>') !!}
        </div>
    </div>

    <!--手動上下架-->
    <div class="form-group">
        <label for="" class="col-sm-2 control-label">手動上下架</label>

        <div class="col-sm-8">
            {!! Form::radio('active', '1',true) !!}上架
            {!! Form::radio('active', '0') !!}下架
        </div>
    </div>

    <!--主類別-->
    <div class="form-group">
        <label for="" class="col-sm-2 control-label">類別</label>

        <div class="col-sm-8">
            {{$group->subCategory->groupCategory->title}}/ {{$group->subCategory->title}}
        </div>
    </div>

    @can('production-config')
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
            {{--<select id="add_on_list" class="form-control" multiple="multiple"--}}
                    {{--{!! ($group->add_on_allowed)?'required':'disabled'  !!}>--}}
                {{--@foreach($add_ons as $id=>$title)--}}
                    {{--<option value="{{$id}}">{{$title}}</option>--}}
                {{--@endforeach--}}
            {{--</select>--}}

            {!! Form::select('add_on_list[]' ,
            $add_ons , null ,
            ['id'=>'add_on_list','class'=>'form-control','multiple'
            ,($group->add_on_allowed)?'required':'disabled'] ) !!}
        </div>
    </div>
    @endcan


            <!--主要圖片-->
    <div class="form-group">
        {!! Form::label('body', '主要圖片',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            @include('partials._coverPhotoDropzone' ,
                ['id'=>$group->id,
                'path' =>$group->coverPhoto_path,
                'associatedTable'=>'groups' ])
            <span class="text-danger">圖片尺寸: 400x300 (寬x高)/ 解析度: 72dpi</span>
        </div>
    </div>


    <!--產品特色-->
    <div class="form-group">
        {!! Form::label('description', '產品特色',['class'=>'col-sm-2 control-label']) !!}

        <div class="col-sm-10">
            {!! Form::textarea('description', null , ['class'=>'form-control','id'=>'description','cols'=>'3']) !!}
        </div>
    </div>

    <!--適用料理-->
    <div class="form-group">
        {!! Form::label('good_at', '適用料理',['class'=>'col-sm-2 control-label']) !!}

        <div class="col-sm-10">
            {!! Form::text('good_at', null , ['class'=>'form-control','id'=>'good_at']) !!}
        </div>
    </div>


    <!-- 一般配件 Form Input -->
    <div class="form-group">
        {{Form::label('auxiliary','一般配件',['class'=>'col-sm-2 control-label'])}}
        <div class="col-sm-10">
            {!! Form::text('auxiliary',null, ['class'=>'form-control','id'=>'auxiliary','placeholder'=>'一般配件: 豬毛刷,檸檬酸.']) !!}
        </div>
    </div>

    <!--其他說明-->
    <div class="form-group">
        {!! Form::label('note', '其他說明',['class'=>'col-sm-2 control-label']) !!}

        <div class="col-sm-10">
            {!! Form::textarea('note', null , ['class'=>'form-control','id'=>'good_at','cols'=>'3']) !!}
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