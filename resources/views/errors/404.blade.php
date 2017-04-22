<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>400 錯誤訊息 | 鍋教授</title>

    <link rel="icon" href="{{ asset('assets/images/companyInfo/iconLogo.png') }}">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- global level css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!-- end of globallevel css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/custom.css') }}">

    <link href="{{ asset('assets/css/admin/my.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/404.css') }}"/>

    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">

    <!-- end of page level styles-->
</head>

<body>

<div style="background-color: #00a88e">
    <br/>

    <div id="mainFrame" style="margin: auto;padding: 30px;background-color: #d9d9d9;border:solid #5b5b5b 20px;
        border-radius: 5%;">
        <div class="text-center text-nature">
            <i class="fa fa-circle " aria-hidden="true"></i> &nbsp;
            <h2 class="text-center text-nature" style="display: inline">
                Error
            </h2>
            <i class="fa fa-circle" aria-hidden="true"></i>
        </div>


        <div id="animate" class="row">
            <div class="number text-nature">404</div>
        </div>

        <div class="hgroup">
            <h3 class="title-potmaster">您要找的資料或是頁面無法找到</h3>
        </div>
    </div>
    <br/>
</div>


<div class="text-center" style="padding-top: 20px; background-color: #5b5b5b">

    <a href="{{ route('home') }}">
        <button type="button" class="btn button-alignment btn-nature">回到首頁</button>
    </a>

    <a href="{{URL::previous()}}">
        <button type="button" class="btn button-alignment btn-nature">回上一頁</button>
    </a>

    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
</div>


<!-- global js -->
<script src="{{ asset('assets/js/jquery-1.11.1.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}" type="text/javascript"></script>
<!--livicons-->
<script src="{{ asset('assets/vendors/livicons/minified/raphael-min.js') }}"></script>
<script src="{{ asset('assets/vendors/livicons/minified/livicons-1.4.min.js') }}"></script>
<!-- end of global js -->
<!-- begining of page level js-->
<script src="{{ asset('assets/js/frontend/404.js') }}"></script>
<!-- end of page level js-->
</body>
</html>