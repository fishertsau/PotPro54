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
<div class="mainContent">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                @include('partials/flash')
                @include('flash::message')
                        <!-- Content -->
                @yield('content')
            </div>

            <div class="col-md-3">
                @yield('sideContent')

                @section('sidebar')
                    @include('frontEnd.partials._newsRightSide')
                @show
            </div>

        </div>
    </div>
</div>


<!-- Footer Section Start -->
@include('frontEnd.layouts._footer')
        <!-- //Footer Section End -->

{{--Back to Top button--}}
@include('frontEnd.layouts._backToTop')

        <!--global js starts-->
@include('frontEnd.layouts._globalJS')
        <!--global js end-->

<!-- begin page level js -->
@yield('footer_scripts')
        <!-- end page level js -->
</body>

</html>
