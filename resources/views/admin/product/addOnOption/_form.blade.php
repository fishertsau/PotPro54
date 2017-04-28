<div class="form-horizontal">
@include('errors.list')

<!--加工方式名稱-->
    <div class="form-group">
        {!! Form::label('title', '加工方式',['class'=>'col-sm-2 control-label']) !!}

        <div class="col-sm-8">
            {{--{!! Form::text('title', null , ['class'=>'form-control','placeholder'=>'加工方式','id'=>'title']) !!}--}}
            <input type="text"
                   class="form-control"
                   name="title"
                   placeholder="加工方式"
                   value="{{$add_on_option->title}}"
                   pattern="[^\']+">
            <span class="text-danger">*不能有'</span>
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('quantity_change_allowed', '數量設定',['class'=>'col-sm-2 control-label']) !!}

        <div class="col-sm-8">
            {!! Form::radio('quantity_change_allowed', '1',true) !!}允許
            {!! Form::radio('quantity_change_allowed', '0') !!}禁止
            <span class="text-danger"> [輸入訂單時,是否允許數量的修改,若禁止,數量為1]</span>
        </div>
    </div>

    <!--加工內容-->
    <div class="form-group">
        <div class="col-sm-2">
            <label for="option" class="control-label">加工選項&nbsp;<i class="fa fa-plus-square text-primary"
                                                                   onclick="moreBlock('add-on-option-setting')"></i></label>
            <br/>
            <span class="text-danger">*不能有'</span>
        </div>

        {!! Form::hidden('settings', '') !!}

        <div class="col-sm-4">
            {{--todo: implement this --}}
            {{--@if (($newItem)  or (count($add_on_option->settings_array)<1))--}}
            {{--@include('admin.product.addOnOption._addOnOptionSettingBlock',['setting'=>''])--}}
            {{--@else--}}
            {{--@foreach($add_on_option->settings_array as $setting)--}}
            {{--@include('admin.product.addOnOption._addOnOptionSettingBlock')--}}
            {{--@endforeach--}}
            {{--@endif--}}
        </div>

    </div>


    <!--說明-->
    <div class="form-group">
        {!! Form::label('body', '說明',['class'=>'col-sm-2 control-label']) !!}

        <div class="col-sm-10">
            {!! Form::text('body', null , ['class'=>'form-control','id'=>'body']) !!}
        </div>
    </div>


    <!--建立日期-->
    <div class="form-group">
        {!! Form::label('created_at', '建立日期',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            <p class="form-control-static">
                {{ isset($noteText) ? $noteText : $add_on_option->created_at}}
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