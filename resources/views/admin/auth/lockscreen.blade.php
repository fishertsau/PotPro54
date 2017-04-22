<!DOCTYPE html>
<html>

<head>
    <title>鎖定螢幕</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- global level css -->
    {{--<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet"/>--}}
    <!-- end of global level css -->
    <!-- page level css -->
    {{--<link href="{{ asset('assets/css/pages/lockscreen.css') }}" rel="stylesheet"/>--}}
    {{--<link rel="stylesheet" href="{{ asset('assets/vendors/fort.js/css/fort.css') }}"/>--}}
    <!-- end of page level css -->

    <link rel="stylesheet" href="{{ asset('assets/admin/auth/lockscreen.css') }}"/>
</head>

<body>
<div class="top">
    <div class="colors"></div>
</div>
<div class="container">
    <div class="login-container">
        <div id="output"></div>
        <div class="avatar"></div>
        <div class="form-box">
            <form method="POST" name="admin\lockscreen">
                {{csrf_field()}}
                <div class="form">
                    <p class="form-control-static">{{$user->name}}</p>
                    <input type="password" name="password" class="form-control" placeholder="個人密碼">
                    <button class="btn btn-info btn-block login" id="index" type="submit">進入系統</button>
                </div>
            </form>
            <br/>
            <a class="btn btn-success btn-block" href="/">回到首頁</a>

        </div>
    </div>
</div>
<!-- global js -->
{{--<script src="{{ asset('assets/js/jquery-1.11.1.min.js') }}" type="text/javascript"></script>--}}
<!-- Bootstrap -->
{{--<script src="{{ asset('assets/js/bootstrap.min.js') }}" type="text/javascript"></script>--}}
{{--<script src="{{ asset('assets/js/holder.js') }}"></script>--}}
<!-- end of global js -->
<!-- beginning of page level js-->
{{--<script src="{{ asset('assets/vendors/fort.js/js/fort.js') }}"></script>--}}
{{--<script src="{{ asset('assets/js/pages/lockscreen.js') }}"></script>--}}
<script src="{{ asset('assets/admin/auth/lockscreen.js') }}"></script>
<script>Fort.gradient();</script>
<!-- end of page level js-->
</body>
</html>
