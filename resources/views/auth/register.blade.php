@extends('auth.authApp')

@section('title')
    註冊 @parent
@stop

@section('content')
    <a href="/login" class="btn btn-success full-width"
       style="height: 3em; display: block;">
                <span class="text-white">
                     <i class="fa fa-share-square-o fa-2x"></i>&nbsp;&nbsp;已有帳號&nbsp;要登入
                </span>
    </a>


    <hr/>
    <a href="/auth/socialite/facebook" class="btn btn-primary full-width"
       style="height: 3em; display: block;">
                <span class="text-white">
                     <i class="fa fa-facebook-square fa-2x"></i>&nbsp;&nbsp;Facebook快速註冊
                </span>
    </a>
    <br/>

    <p class="text-center">或是</p><br>

    <form method="POST" action="/register" class="form-horizontal">
        {!! csrf_field() !!}

        <div class="form-group {{ $errors->first('email', 'has-error') }}">
            <label for="inputEmail3" class="col-sm-4 control-label title-potmaster">電子信箱</label>

            <div class="col-sm-8">
                <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
            </div>
        </div>

        <div class="form-group {{ $errors->first('first_name', 'has-error') }}">
            <label for="first_name" class="col-sm-4 control-label  title-potmaster">使用者名稱</label>

            <div class="col-sm-8">
                <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
            </div>
        </div>


        <div class="form-group {{ $errors->first('password', 'has-error') }}">
            <label for="password" class="col-sm-4 control-label  title-potmaster">密碼</label>

            <div class="col-sm-8">
                <input type="password" name="password" class="form-control" required>
                {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                <p class="title-potmaster">*至少6個英文或數字</p>

            </div>
        </div>

        <div class="form-group {{ $errors->first('password_confirmation', 'has-error') }}">
            <label for="password_confirmation" class="col-sm-4 control-label  title-potmaster">確認密碼</label>

            <div class="col-sm-8">
                <input type="password" name="password_confirmation" class="form-control" required>
                {!! $errors->first('password_confirmation', '<span class="help-block">:message</span>') !!}
                <p class="title-potmaster">*與密碼相同</p>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-8">
                <div class="checkbox">
                    <label>
                        <input type="checkbox"
                               name="agreed"
                               value="agreed"
                               @if (old('agreed')=="agreed") checked @endif)
                               required>
                        我已經閱讀並同意鍋教授 &nbsp;<a href="terms/sign-up" target="_blank" class="text-danger" style="color:green;">服務條款</a>
                        {!! $errors->first('agreed', '<span class="help-block">:message</span>') !!}
                    </label>
                </div>
            </div>
        </div>

        <button type='submit' class="btn btn-danger full-width" style="height: 3em;">
            <i class="fa fa-check fa-2x" aria-hidden="true"></i>&nbsp;使用Email註冊
        </button>
    </form>
@stop