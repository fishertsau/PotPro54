<div class="form-horizontal">
@include('errors.list')

<!--手動上下架-->
    <div class="form-group">
        <label class="col-sm-2 control-label">產品編號</label>

        <div class="col-sm-10">
            <p class="form-control-static" style="font-size: larger">
                {{ $product->pn}}
            </p>
        </div>
    </div>


    <!--手動上下架-->
    <div class="form-group">
        <label class="col-sm-2 control-label">手動上下架</label>

        <div class="col-sm-8">
            {!! Form::radio('active', '1',true) !!}上架
            {!! Form::radio('active', '0') !!}下架
        </div>
    </div>
    <!--子類別-->
{{--TODO: Implement Group selection--}}
{{--<div class="form-group">--}}
{{--<label for="" class="col-sm-2 control-label">產品系列</label>--}}

{{--<div class="col-sm-3">--}}
{{--{!! Form::select('group_id', $group_list ,null, ['class'=>'form-control selectList','placeholder'=>'產品系列','id'=>'group_id']) !!}--}}
{{--</div>--}}
{{--</div>--}}


<!--產品名稱-->
    <div class="form-group">
        {!! Form::label('title', '產品名稱',['class'=>'col-sm-2 control-label']) !!}

        <div class="col-sm-8">
            {!! Form::text('title', null , ['class'=>'form-control','placeholder'=>'產品名稱','id'=>'title']) !!}
        </div>
    </div>

    <!--價格-->
    <div class="form-group">
        {!! Form::label('price', '價格',['class'=>'col-sm-2 control-label']) !!}

        <div class="col-sm-4">
            {!! Form::text('price', null , ['class'=>'form-control','placeholder'=>'價格','id'=>'price']) !!}
        </div>
    </div>

    <!--主要圖片-->
    <div class="form-group">
        {!! Form::label('body', '主要圖片',['class'=>'col-sm-2 control-label']) !!}

        <div class="col-sm-10">
            @include('partials._coverPhotoDropzone' ,
            ['id'=>$product->id,'path' =>$product->coverPhoto_path,'associatedTable'=>'products' ])
            <span class="text-danger">圖片尺寸: 400x300 (寬x高)/ 解析度: 72dpi</span>
        </div>
    </div>


    <!--產品介紹-->
    <div class="form-group">
        {!! Form::label('body', '產品介紹',['class'=>'col-sm-2 control-label']) !!}

        <div class="col-sm-10">
            {!! Form::textarea('body', null , ['class'=>'form-control','id'=>'body','cols'=>'3']) !!}
        </div>
    </div>


    <!--其他說明-->
    <div class="form-group">
        {!! Form::label('note', '其他說明',['class'=>'col-sm-2 control-label']) !!}

        <div class="col-sm-10">
            {!! Form::textarea('note', null , ['class'=>'form-control','id'=>'note','cols'=>'3']) !!}

        </div>
    </div>

    <hr/>

    <div class="form-group">
        {!! Form::label('spec', '產品規格 ',['class'=>'col-sm-2 control-label']) !!}
    </div>

    <!--長度  length-->
    <div class="form-group">
        {!! Form::label('length', '長度 ',['class'=>'col-sm-2 control-label']) !!}
        <p class="form-control-static visible-mobile-inline">公分(cm)</p>

        <div class="col-sm-2">
            {!! Form::number('length', null , ['class'=>'form-control','id'=>'length', 'min'=>0]) !!}
        </div>

        <div class="col-sm-2 visible-desktop-block">
            <p class="form-control-static">公分(cm)</p>
        </div>
    </div>

    <!--寬度  width-->
    <div class="form-group ">
        {!! Form::label('width', '寬度',['class'=>'col-sm-2 control-label']) !!}
        <p class="form-control-static visible-mobile-inline">公分(cm)</p>

        <div class="col-sm-2">
            {!! Form::number('width', null , ['class'=>'form-control','id'=>'width','min'=>0]) !!}
        </div>
        <div class="col-sm-2 visible-desktop-block">
            <p class="form-control-static">公分(cm)</p>
        </div>

    </div>

    <!--高度  height-->
    <div class="form-group">
        {!! Form::label('height', '高度',['class'=>'col-sm-2 control-label']) !!}
        <p class="form-control-static visible-mobile-inline">公分(cm)</p>

        <div class="col-sm-2">
            {!! Form::number('height', null , ['class'=>'form-control','id'=>'height','min'=>0]) !!}
        </div>
        <div class="col-sm-2 visible-desktop-block">
            <p class="form-control-static">公分(cm)</p>
        </div>

    </div>

    <!--直徑  diameter-->
    <div class="form-group">
        {!! Form::label('diameter', '直徑',['class'=>'col-sm-2 control-label']) !!}
        <p class="form-control-static visible-mobile-inline">公分(cm)</p>

        <div class="col-sm-2">
            {!! Form::number('diameter', null , ['class'=>'form-control','id'=>'diameter','min'=>0]) !!}
        </div>
        <div class="col-sm-2 visible-desktop-block">
            <p class="form-control-static">公分(cm)</p>
        </div>

    </div>


    <!--深度  depth-->
    <div class="form-group">
        {!! Form::label('depth', '深度',['class'=>'col-sm-2 control-label']) !!}
        <p class="form-control-static visible-mobile-inline">公分(cm)</p>

        <div class="col-sm-2">
            {!! Form::number('depth', null , ['class'=>'form-control','id'=>'depth','min'=>0]) !!}
        </div>
        <div class="col-sm-2 visible-desktop-block">
            <p class="form-control-static">公分(cm)</p>
        </div>

    </div>

    <!--容量  capacity-->
    <div class="form-group">
        {!! Form::label('capacity', '容量',['class'=>'col-sm-2 control-label']) !!}
        <p class="form-control-static visible-mobile-inline">公升(liter)</p>

        <div class="col-sm-2">
            {!! Form::number('capacity', null , ['class'=>'form-control','id'=>'capacity','min'=>0]) !!}
        </div>
        <div class="col-sm-2 visible-desktop-block">
            <p class="form-control-static">公升(liter)</p>
        </div>

    </div>

    <hr/>
    <!--建立日期-->
    <div class="form-group">
        {!! Form::label('created_at', '建立日期',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            <p class="form-control-static">
                {{ $product->created_at}}
            </p>
        </div>
    </div>


    <hr/>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-4">
            <a class="btn btn-danger" href="{{ url('/admin/product/product') }}">
                <i class="fa fa-times"></i> @lang('button.cancel')
            </a>
            <button type="submit" class="btn btn-success">
                <span class="glyphicon glyphicon-ok-sign"></span>&nbsp; @lang('button.save')
            </button>
        </div>

    </div>
</div>