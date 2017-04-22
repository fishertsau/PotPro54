@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    View User Details
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <!-- DropZone css-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/dropzone.css" rel="stylesheet">
    <!--end of page level css-->
@stop



{{-- Page content --}}
@section('content')
    <section class="content-header">
        <!--section starts-->
        <h1>使用者帳號</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">
                    <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                    首頁
                </a>
            </li>
            <li>
                <a href="{{ URL::route('userProfile',Auth::user()->id) }}">我的帳號</a>
            </li>
        </ol>
    </section>
    <!--section ends-->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <ul class="nav  nav-tabs ">
                    <li class="active">
                        <a href="#tab1" data-toggle="tab">
                            <i class="livicon" data-name="user" data-size="16" data-c="#000" data-hc="#000"
                               data-loop="true"></i>
                            帳戶資訊</a>
                    </li>
                    <li>
                        <a href="#tab2" data-toggle="tab">
                            <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#000"
                               data-hc="#000"></i>
                            變更密碼</a>
                    </li>
                    <li>
                        <a href="#tab3" data-toggle="tab">
                            <i class="livicon" data-name="gear" data-size="16" data-loop="true" data-c="#000"
                               data-hc="#000"></i>
                            修改個人資料
                        </a>
                    </li>

                </ul>


                <div class="tab-content mar-top" style="background-color: white">
                    <div id="tab1" class="tab-pane fade active in">
                        @include('admin.user.personal._userProfile')
                    </div>

                    <div id="tab2" class="tab-pane fade">
                        @include('admin.user.personal._changePassword')
                    </div>

                    <div id="tab3" class="tab-pane fade">
                        @include('admin.user.personal._changePersonaInfo')
                    </div>

                </div>
            </div>
        </div>
    </section>
    @stop

    {{-- page level scripts --}}
    @section('footer_scripts')
            <!-- Bootstrap WYSIHTML5 -->
{{--    <script src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" type="text/javascript"></script>--}}
    {{--<script src="{{ asset('assets/js/admin/pages/userProfile.js') }}" type="text/javascript"></script>--}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/dropzone.js"></script>
    <script type="text/javascript" src="{{ asset('assets/js/admin/myDropZoneControl.js')}}"></script>
@stop