<!DOCTYPE html>
<html>

<head>
@include('admin.layouts._globalHeadSetting')
@include('admin.layouts._globalCSS')

<!--page level css-->
@yield('header_styles')
<!--end of page level css-->
</head>
<body class="skin-josh">

@include('admin.layouts._headerTop')

<div class="wrapper row-offcanvas row-offcanvas-left @if($left_menu_show=='yes') relative @endif" id="wrapper">
{{csrf_field()}}
<!-- Left side column. contains the logo and sidebar -->
    <aside class="left-side sidebar-offcanvas @if($left_menu_show=='no') collapse-left @endif" id="wrapper-left-side">
        <section class="sidebar ">

            <div class="page-sidebar  sidebar-nav">
                {{--@include('admin.layouts._menuTop_frequentUseItem')--}}
                <div class="clearfix"></div>
                <!-- BEGIN SIDEBAR MENU -->
            @include('admin.layouts._left_menu')
            <!-- END SIDEBAR MENU -->
            </div>
        </section>
    </aside>
    <aside class="right-side @if($left_menu_show=='no') strech @endif" id="wrapper-right-side">
        <!-- Content -->
        @include('flash::message')

        @yield('content')

        <div class="text-center" style="margin:1em 0;color:black;font-size: x-small">
            <span>系統開發與維護:曹永興 Email:fishertsau2live@gmail.com</span>
        </div>

    </aside>
    <!-- right-side -->

</div>
</body>

@include('admin.layouts._backToTopButton')
@include('admin.layouts._globalJS')

<!-- begin page level js -->
@yield('footer_scripts')
<!-- end page level js -->
</html>
