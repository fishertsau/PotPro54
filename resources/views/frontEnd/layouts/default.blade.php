<!DOCTYPE html>
<html>

<head>
    @include('frontEnd.layouts._globalHeadSetting')

    <title>
        @section('title')
            | 鍋教授
        @show
    </title>
    <!--global css starts-->
@include('frontEnd.layouts._globalCSS')
<!--end of global css-->

    <!--page level css-->
@yield('header_styles')
<!--end of page level css-->
</head>

<body>
<!-- Header Start -->
@include('frontEnd.layouts._mainNavbar')
<!-- //Header End -->

<!-- slider / breadcrumbs section -->
@yield('top')

<!-- Content -->
<div class="mainContent container-fluid">
    <div class="row">
        <div class="col-md-12">
            @include('partials/flash')
            @include('flash::message')

            @yield('content')
        </div>
    </div>
</div>


<!-- Footer Section Start -->
@include('frontEnd.layouts._footer')
<!-- //Footer Section End -->

@include('frontEnd.layouts._backToTop')


<!--global js starts-->
@include('frontEnd.layouts._globalJS')
<!--global js end-->

<!-- begin page level js -->
@yield('footer_scripts')
<!-- end page level js -->
</body>

</html>
