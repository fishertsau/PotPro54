<div class="form-horizontal">
    <!--手動上下架-->
    <div class="form-group">
        <label for="" class="col-sm-2 control-label">手動上下架</label>

        <div class="col-sm-8">
            {!! Form::radio('active', '1',true) !!}上架
            {!! Form::radio('active', '0') !!}下架
        </div>
    </div>

    <!--熱門-->
    <div class="form-group">
        <label for="" class="col-sm-2 control-label">熱門</label>

        <div class="col-sm-8">
            {!! Form::radio('hot', '1',true) !!}是
            {!! Form::radio('hot', '0') !!}否
        </div>
    </div>


    <!--類別選擇-->
    <div class="form-group">
        <label for="location" class="col-sm-2 control-label">類別</label>

        <div class="col-sm-8">
            @foreach(App\Models\Faq::getCatList() as $catNumber=>$title)
                {!! Form::radio('category', $catNumber) !!}{{$title}}
            @endforeach
        </div>
    </div>


    <!--標題-->
    <div class="form-group">
        {!! Form::label('title', '標題',['class'=>'col-sm-2 control-label']) !!}

        <div class="col-sm-8">
            {!! Form::text('title', null , ['class'=>'form-control','placeholder'=>'標題','id'=>'title']) !!}
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
                @if(isset($isNew))
                    {{ $isNew  ? '*系統自動設定' : $faq->created_at}}
                @else
                    {{$faq->created_at}}
                @endif
            </p>
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