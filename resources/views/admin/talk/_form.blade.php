<div class="form-horizontal">
    @include('errors.list')

    <div class="form-group">
        <div class="col-md-offset-2 col-md-9">
            <button id="SubmitBtn" class="btn btn-success full-width" type="submit"><span
                        class="glyphicon glyphicon-ok-sign"></span>&nbsp;送出儲存
            </button>
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

    <!--標題-->
    <div class="form-group">
        {!! Form::label('title', '標題',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::text('title', null , ['class'=>'form-control','placeholder'=>'標題','id'=>'title']) !!}
        </div>
    </div>

    <!--主要圖片-->
    <div class='form-group'>
        {!! Form::label('', '主要圖片',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-8">
            @include('partials._coverPhotoDropzone' ,
                    ['id'=>$talk->id,
                    'path' =>$talk->coverPhoto_path,
                    'associatedTable'=>'talks' ])
        </div>
    </div>

    <!--活動地點-->
    <div class="form-group">
        {!! Form::label('location', '活動地點',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('location', null , ['class'=>'form-control','placeholder'=>'活動地點','id'=>'location']) !!}
        </div>
    </div>


    <!--主辦單位-->
    <div class="form-group">
        {!! Form::label('organizer', '主辦單位',['class'=>'col-sm-2 control-label']) !!}

        <div class="col-sm-10">
            {!! Form::textarea('organizer', null, array('class' => 'textarea form-control', 'rows'=>'5', 'style'=>'style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"')) !!}
            連結網站:
            {!! Form::text('organizer_url', null , ['class'=>'form-control','placeholder'=>'網站連結','id'=>'organizer_url']) !!}
        </div>
    </div>

    <!--執行單位-->
    <div class="form-group">
        {!! Form::label('execute_org', '執行單位',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            <div class='box-body pad'>
                {!! Form::textarea('execute_org', null, array('class' => 'textarea form-control', 'rows'=>'5', 'style'=>'style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"')) !!}
            </div>
            連結網站:
            {!! Form::text('execute_org_url', null , ['class'=>'form-control','placeholder'=>'網站連結','id'=>'organizer_url']) !!}
        </div>
    </div>

    <!--協辦單位-->
    <div class="form-group">
        {!! Form::label('assist_org', '協辦單位',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            <div class='box-body pad'>
                {!! Form::textarea('assist_org', null, array('class' => 'textarea form-control', 'rows'=>'5', 'style'=>'style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"')) !!}
            </div>
            連結網站:
            {!! Form::text('assist_org_url', null , ['class'=>'form-control','placeholder'=>'網站連結','id'=>'organizer_url']) !!}
        </div>
    </div>


    <!-- 關鍵字 Tag \Form Multiple Select  -->
    <div class='form-group'>

        {!! Form::label('tag_list', '關鍵字',['class'=>'col-sm-2 control-label']) !!}

        <div class="col-sm-10">

            {!! Form::select( 'tag_list[]' ,$tags , null , ['id'=>'tag_list','class'=>'form-control tagSelect','multiple'] ) !!}

        </div>

    </div>

    <!-- 講師/主辦人 Tag \Form Multiple Select  -->
    <div class='form-group'>

        {!! Form::label('speaker_id', '講師/主辦人',['class'=>'col-sm-2 control-label']) !!}

        <div class="col-sm-10">
            {!! Form::select( 'speaker_id' ,['1'=>'張三豐','2'=>'胡鐵花'] , null , ['id'=>'speaker_id','class'=>'form-control'] ) !!}
            <p class="form-control-static text-danger">系統自動放入講師清單 以供選擇</p>
        </div>
    </div>

    <!--活動日期-->
    <div class="form-group">

        {!! Form::label('', '活動日期',['class'=>'col-sm-2 control-label']) !!}

        <div class="col-md-7">
            <div class="input-group">
                {!! Form::input('date','held_on',null, ['class'=>'form-control']) !!}
            </div>
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
                {{ isset($noteText) ? $noteText : $talk->created_at}}
            </p>
        </div>
    </div>

    <!--建立人-->
    <div class="form-group">
        <label for="" class="col-sm-2 control-label">建立人</label>

        <div class="col-sm-5">
            <p class="form-control-static">{{ isset($noteText) ? $noteText : $talk->user->full_name }}</p>
        </div>
    </div>

    <!-現場圖片-->
    <div class="form-group">
        <label class="col-sm-2 control-label">現場圖片</label>

        <div class="col-sm-10">
            <div class="row">
                <!-- HTML heavily inspired by http://blueimp.github.io/jQuery-File-Upload/ -->
                    <span class="btn btn-warning fileinput-button dz-clickable">
                        <i class="glyphicon glyphicon-plus"></i>
                        <span>新增圖片</span>
                    </span>

                <div id="dropZoneUpload"
                     data-url="/photos/Talk/{{$talk->id}}"
                     class="dropzone">
                </div>

                @foreach($talk->photos as $photo)
                    @include('partials._photo')
                @endforeach
            </div>
        </div>
    </div>
</div>