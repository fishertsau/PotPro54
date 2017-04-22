<div class="form-horizontal">
    @include('errors.list')
            <!--配件名稱-->
    <div class="form-group">
        {!! Form::label('title', '配件名稱',['class'=>'col-sm-2 control-label']) !!}

        <div class="col-sm-8">
            {!! Form::text('title', null , ['class'=>'form-control','placeholder'=>'配件名稱','id'=>'title','required'=>'true']) !!}
        </div>
    </div>

    <!--  Form Input -->
    <div class="form-group">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-10">
            @include('admin.product.addOn.partials._note')
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('quantity_change_allowed', '數量設定',['class'=>'col-sm-2 control-label']) !!}


        <div class="col-sm-8">
            {!! Form::radio('quantity_change_allowed', '1',true,['class'=>'quantity_change']) !!}允許
            {!! Form::radio('quantity_change_allowed', '0',false,['class'=>'quantity_change']) !!}禁止
            <span class="text-danger"> [輸入設定時,是否允許數量的修改,若禁止,數量為1]</span>
        </div>
    </div>

    <!--主要圖片-->
    <div class="form-group">
        {!! Form::label('', '主要圖片',['class'=>'col-sm-2 control-label']) !!}

        <div class="col-sm-8">
            @include('partials._coverPhotoDropzone' ,
        ['id'=>$add_on->id,
        'path' =>$add_on->coverPhoto_path,
        'associatedTable'=>'add_ons' ])
        </div>
    </div>


    <!-- 加工選項 Tag \Form Multiple Select  -->
    <div class='form-group'>
        <label for="option" class="col-sm-2 control-label">
            加工選項&nbsp;
            <i class="fa fa-plus-square text-primary"
               onclick="moreBlock('add-on-option')"></i>
            <br/>
            @include('admin.product.addOn.partials._showNoteToggleBtn')
        </label>


        <div class="col-sm-10">

            <table width="100%" class="table table-hover table-nomargin table-striped formTable">
                <thead>
                <tr>
                    <td width="12%">選配</td>
                    <td width="10%">編號</td>
                    <td width="20%">加工選項</td>
                    <td width="20%" class="text-left">設定</td>
                    <td width="18%" class="visible-desktop-cell">附註</td>
                    <td width="8%">刪除</td>
                </tr>
                </thead>

                <tbody>
                @if ( count($add_on->options) < 1)
                    @include('admin.product.addOn._addOnOptionBlock',['newItem'=>true])
                @else
                    @foreach($add_on->options as $selected_option)
                        @include('admin.product.addOn._addOnOptionBlock')
                    @endforeach
                @endif
                <tr>
                    <td colspan="6"><span class="text-danger">*每個編號都要不同,且只能有英文與數字,一定不能有'['或']'</span></td>
                </tr>
                </tbody>
            </table>
            <hr/>
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
                {{ isset($noteText) ? $noteText : $add_on->created_at}}
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