<div class="form-horizontal">
    <!--工作項目-->
    <div class="form-group">
        {!! Form::label('title', '工作項目',['class'=>'col-sm-2 control-label']) !!}

        <div class="col-sm-8">
            {!! Form::text('title', null , ['class'=>'form-control','placeholder'=>'工作項目','id'=>'title','required'=>true]) !!}
        </div>
    </div>

    <!--內容-->
    <div class="form-group">
        {!! Form::label('content', '內容',['class'=>'col-sm-2 control-label']) !!}

        <div class="col-sm-8">
            {!! Form::textarea('content', null , ['class'=>'form-control','placeholder'=>'內容','id'=>'content']) !!}
        </div>
    </div>

    <!--負責人-->
    <div class="form-group">
        {!! Form::label('doer', '負責人',['class'=>'col-sm-2 control-label']) !!}

        <div class="col-sm-8">
            {!! Form::text('doer', null , ['class'=>'form-control','placeholder'=>'負責人','id'=>'doer','required'=>true]) !!}
        </div>
    </div>

    <!--預計完成日-->
    <div class="form-group">
        {!! Form::label('expected_finish_at', '預計完成日',['class'=>'col-sm-2 control-label']) !!}

        <div class="col-sm-8">
            {!! Form::date('expected_finish_at', null , ['class'=>'form-control','id'=>'expected_finish_at']) !!}
        </div>
    </div>


    <div class="form-group">
        <div class="col-md-offset-2 col-md-8">
            <button id="SubmitBtn" class="btn btn-success full-width" type="submit"><span
                        class="glyphicon glyphicon-ok-sign"></span>&nbsp;送出
            </button>
        </div>
    </div>

</div>