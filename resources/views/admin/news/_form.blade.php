<div class="form-horizontal">
    @include('errors.list')

            <!--手動上下架-->
    <div class="form-group">
        <label for="" class="col-sm-2 control-label">手動上下架</label>

        <div class="col-sm-8">
            {!! Form::radio('active', '1',true) !!}上架
            {!! Form::radio('active', '0') !!}下架
        </div>
    </div>

    <hr/>

    <!--熱門消息-->
    <div class="form-group">
        <label for="" class="col-sm-2 control-label">熱門消息</label>

        <div class="col-sm-8">
            {!! Form::radio('hot', '1',true) !!}是
            {!! Form::radio('hot', '0') !!}否
        </div>
    </div>

    <!--上架日期-->
    <div class="form-group">

        {!! Form::label('', '上架日期',['class'=>'col-sm-2 control-label']) !!}

        <div class="col-md-5">
            <i class="fa fa-check-square-o"></i>&nbsp;永遠上架:
            {!! Form::radio('effective_forever', '1',null,['class'=>'effectiveForeverSetting']) !!}是
            {!! Form::radio('effective_forever', '0',true,['class'=>'effectiveForeverSetting']) !!}否

            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">從</span>
                <input type="date" name="effective_from" id="effective_from"
                       value="{{ isset($todayText) ? $todayText : $news->effective_from}}"
                       class="form-control">
                <span class="input-group-addon" id="basic-addon1">至</span>
                <input type="date" name="effective_until" id="effective_until"
                       value="{{ isset($todayText) ? $todayText : $news->effective_until}}"
                       class="form-control">
            </div>
        </div>

    </div>


    <!--標題-->

    <div class="form-group">
        {!! Form::label('title', '標題',['class'=>'col-sm-2 control-label']) !!}

        <div class="col-sm-10">
            {!! Form::text('title', null , ['class'=>'form-control','placeholder'=>'標題','id'=>'title']) !!}
        </div>
    </div>


    <!--位置選擇-->
    <div class="form-group">
        <label for="location" class="col-sm-2 control-label">位置</label>

        <div class="col-sm-8">
            @foreach(App\Models\Marketing\News::getLocationList() as $locIndex=>$title)
                {!! Form::radio('location', $locIndex) !!}{{$title}}
            @endforeach
        </div>
    </div>
    <!--主要圖片-->
    <div class='form-group'>
        {!! Form::label('', '主要圖片',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            @include('partials._coverPhotoDropzone' ,[
                    'id'=>$news->id,
                    'path' =>$news->coverPhoto_path,
                    'associatedTable'=>'newss' ])
            <p class="note">建議畫素:(1)最新消息: 400x300,  (2)首頁廣告: 1,280x768, (3)關於鍋教授: 700x265</p>
        </div>
    </div>

    <!--說明-->
    <div class="form-group">
        {!! Form::label('body', '內容',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::textarea('body', null, array('class' => 'textarea form-control', 'rows'=>'5', 'style'=>'style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"')) !!}
        </div>
    </div>

    <!--建立日期-->
    <div class="form-group">
        {!! Form::label('created_at', '建立日期',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            <p class="form-control-static">
                {{ isset($noteText) ? $noteText : $news->created_at}}
            </p>
        </div>
    </div>

    <!--修改人-->
    <div class="form-group">
        <label for="" class="col-sm-2 control-label">建立人</label>

        <div class="col-sm-5">
            <p class="form-control-static">{{ isset($noteText) ? $noteText : $news->user->name }}</p>
        </div>
    </div>

    <hr/>
    <div class="form-group">
        <div class="col-md-offset-3 col-md-9">
            <button id="SubmitBtn" class="btn btn-success full-width" type="submit"><span
                        class="glyphicon glyphicon-ok-sign"></span>&nbsp;送出儲存
            </button>
        </div>
    </div>
</div>