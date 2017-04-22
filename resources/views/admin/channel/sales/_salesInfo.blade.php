<!-- 名稱 Form Input -->
<div class="form-group">
    {{Form::label('name','名稱',['class'=>'col-sm-3 control-label'])}}
    <div class="col-sm-9">
        <p class="form-control-static text-primary">{{$sales->user->name}}</p>
    </div>
</div>

<!--  Form Input -->
<div class="form-group">
    {{Form::label('tel','電話',['class'=>'col-sm-3 control-label'])}}
    <div class="col-sm-9">
        <p class="form-control-static text-primary">{{$sales->user->tel}}</p>
    </div>
</div>

<!--  Form Input -->
<div class="form-group">
    {{Form::label('tel','電子信箱',['class'=>'col-sm-3 control-label'])}}
    <div class="col-sm-9">
        <p class="form-control-static text-primary">{{$sales->user->email}}</p>
    </div>
</div>

<!--建立日期-->
<div class="form-group">
    {!! Form::label('created_at', '建立日期',['class'=>'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
        <p class="form-control-static">
            @if(isset($isNew))
                {{ $isNew  ? '*系統自動設定' : $faq->created_at}}
            @else
                {{$sales->created_at}}
            @endif
        </p>
    </div>
</div><?php
