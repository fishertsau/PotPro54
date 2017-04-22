<div class="form-horizontal">
{{--@include('errors.list')--}}

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

    <!-- Tag \Form Multiple Select  -->
    <div class='form-group'>
        {!! Form::label('tag_list', '關鍵字',['class'=>'col-sm-2 control-label']) !!}

        <div class="col-sm-10">
            @if(isset($tags))
                {!! Form::select( 'tag_list[]' ,$tags , null , ['id'=>'tag_list','class'=>'form-control','multiple'] ) !!}
            @endif
        </div>
    </div>


    <!--YouTube link-->
    <div class="form-group">
        {!! Form::label('youtube_url', 'YouTubeURL',['class'=>'col-sm-2 control-label']) !!}

        <div class="col-sm-8">
            @if(isset($video->youtube_url))
                <iframe width="50%" src="{!! $video->youtube_url!!}" frameborder="0"
                        allowfullscreen="">
                </iframe>
            @endif
            {!! Form::text('youtube_url', null , ['class'=>'form-control','placeholder'=>'YouTube連結位置','id'=>'youtube_url']) !!}
        </div>
    </div>


    <!-- 使用設備  -->
    <div class='form-group'>

        {!! Form::label('', '使用設備',['class'=>'col-sm-2 control-label']) !!}

        <div class="col-sm-10">
            <p class="text-danger">使用設備的功能要做上去</p>
        </div>
    </div>

    <!--說明-->
    <div class="form-group">
        {!! Form::label('body', '內容',['class'=>'col-sm-2 control-label']) !!}

        <div class="col-sm-10">
            {!! Form::textarea('body', null , ['class'=>'form-control','id'=>'body']) !!}
        </div>
    </div>


    <!--建立日期-->
    <div class="form-group">
        {!! Form::label('created_at', '建立日期',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            <p class="form-control-static">
                {{isset($video->created_at)? $video->created_at:'自動產生'}}
            </p>
        </div>
    </div>

    <!--修改人-->
    <div class="form-group">
        <label for="" class="col-sm-2 control-label">建立人</label>

        <div class="col-sm-5">
            <p class="form-control-static">
                {{isset($video->user->full_name)? $video->user->full_name:'自動產生'}}
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

