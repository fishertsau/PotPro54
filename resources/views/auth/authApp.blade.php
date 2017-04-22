<!-- resources/views/auth/login.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('assets/images/companyInfo/iconLogo.png') }}">
    <script src="https://use.fontawesome.com/af37c47e72.js"></script>
    <title>
        @section('title')
            | 鍋教授
        @show
    </title>

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/app.css') }}">
    <style>
        body {
            background: #eeede8;
        }

        label, h4 {
            color: #505662;
        }

        .form-box {
            max-width: 540px;
            padding: 30px;
            margin: 0 auto;
            background: white;
        }
    </style>

</head>

<body>
<div class="container-fluid">
    <div class="row" align="center">
        <header style=" margin:20px auto 20px;">
            <a href="/" class="noDecoration">
                <div class="img">
                    <img alt="" class="img-responsive" src="{{asset('assets/images/companyInfo/brandLogo.png')}}"
                         width="25%">
                </div>
                <p class="text-nature text-center" style="margin-top: 10px">瓦斯節能專家 設備齊全 好用好賣</p>
            </a>
        </header>
    </div>

    <div class="row form-box">
        @include('partials/flash')
        @include('flash::message')

        @yield('content')
    </div>

    <br/>

    <div class="form-box">
        @include('auth._moreActions')
    </div>

</div>
<!-- /container -->

@include('auth._companyInfo')

<br/>
<br/>
<br/>
<br/>

</body>

<script src="{{ asset('assets/js/jquery-1.11.1.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}" type="text/javascript"></script>
<!--livicons-->
<script src="{{ asset('assets/js/raphael-min.js') }}"></script>
<script src="{{ asset('assets/js/livicons-1.4.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/frontend/josh_frontend.js') }}"></script>
<script src="{{asset('assets/js/app_old20160727.js')}}"></script>
</html>

