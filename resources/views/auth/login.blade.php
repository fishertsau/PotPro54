@extends('auth.authApp')

@section('title')
    登入 @parent
@stop


@section('content')
    <a href="/auth/socialite/facebook" class="btn btn-primary full-width"
       style="height: 3em; display: block; text-decoration: none">
                    <span style="color:white;">
                        <i class="fa fa-facebook-square fa-2x"></i>&nbsp;&nbsp;使用Facebook登入
                    </span>
    </a>
    <br/>

    <form method="POST" action="/login" class="form-horizontal">
        {!! csrf_field() !!}

        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="inputEmail3" class="col-sm-3 control-label">電子信箱</label>

            <div class="col-sm-9">
                <input type="email" name="email" value="{{ old('email') }}" class="form-control">
                @if ($errors->has('email'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif
            </div>
        </div>


        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password" class="col-sm-3 control-label">密碼</label>

            <div class="col-sm-9">
                <input type="password" name="password" id="password" class="form-control">
                @if ($errors->has('password'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
                <input type="checkbox" name="remember"> 記住我
            </div>
        </div>

        <button class="btn btn-danger full-width" style="height: 3em;" type="submit">
            <i class="fa fa-check fa-2x" aria-hidden="true"></i>&nbsp;使用電子信箱登入
        </button>

    </form>
@stop

