<div style="padding: 5px;">
    @if(!$user->verified)
            @include('frontEnd.user.partials._unVerifiedAlert')
    @endif
    {!! Form::model($user, ['method' => 'PATCH', 'route' => ['user.update', $user->id],'class'=>'form-horizontal']) !!}
    <br/>
    @include('errors.list')
    {{--<div class="form-group">--}}
        {{--<label for="" class="col-sm-3 control-label title-potmaster">目前所在縣市</label>--}}

        {{--<div class="col-sm-6">--}}
            {{--<p class="form-control-static title-potmaster">台北市 <span class="note">(需做功能)</span></p>--}}
        {{--</div>--}}
    {{--</div>--}}

    <div class="form-group">
        {!! Form::label('name', '姓名',['class'=>'col-sm-2 control-label title-potmaster']) !!}
        <div class="col-sm-5">
            {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'姓名', 'required'=>true]) !!}
            <p class="note">請填寫真實姓名</p>
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('zip', '郵遞區號',['class'=>'col-sm-2 control-label title-potmaster']) !!}

        <div class="col-sm-3">
            {!! Form::text('zip',null,['class'=>'form-control','placeholder'=>'郵遞區號']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('address', '地址',['class'=>'col-sm-2 control-label title-potmaster']) !!}

        <div class="col-sm-10">
            {!! Form::text('address',null,['class'=>'form-control','placeholder'=>'地址']) !!}
        </div>
    </div>

    <!-- Tel Form Input -->
    <div class="form-group">
        {{Form::label('tel','連絡電話:',['class'=>'col-sm-2 control-label title-potmaster'])}}
        <div class="col-sm-5">
            {!! Form::tel('tel',null, ['class'=>'form-control','id'=>'tel','placeholder'=>'聯絡電話','required'=>true]) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('email', '電子信箱',['class'=>'col-sm-2 control-label title-potmaster']) !!}

        <div class="col-sm-6">
            {!! Form::text('email',null,['class'=>'form-control','placeholder'=>'電子信箱','required'=>true]) !!}
            <p class="note">*電子郵件若有更改,電子信箱需重新認證</p>

        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-success">儲存更新</button>
        </div>
    </div>
    {!! Form::close() !!}

</div>