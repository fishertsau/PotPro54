@extends('frontEnd/layouts/master2Column')

{{-- Page title --}}
@section('title')
    加入經銷商
    @parent
    @stop


    {{-- breadcrumb --}}
    @section('top')
    @include('frontEnd.partials._breadcum',['title'=>'加入經銷商'])
    @stop

    {{-- Page content --}}
    @section('content')
            <!-- Container Section Strat -->

    <div>
        <br/>
        <h4 class="text-danger"><i class="fa fa-users fa-2x"></i>&nbsp;經銷業務招募中</h4>
        <ul>
            <li><p class="text-primary">接受完整專業瓦斯節能訓練,
                    並通過鍋教授瓦斯節能認證,即可成為鍋教授經銷商,跟我們一起賺錢</p></li>
        </ul>
        <button class="btn btn-danger full-width" style="color: white" id="gotoNext">
            <i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;申請加入經銷商
        </button>
        <hr/>
        <h4 class="text-danger"><i class="fa fa-caret-right"></i>&nbsp;為甚麼要成為鍋教授經銷商?</h4>
        <ul style="list-style: circle">
            <li><span class="text-primary">讓你賺錢</span></li>
            <ul style="list-style: disc" class="title-potmaster">
                <li>未來賺錢趨勢：瓦斯節能</li>
                <li>客人唯一選擇：鍋教授</li>
                <li>產品多與服務全：賺錢容易</li>
            </ul>
            <li><span class="text-primary">幫你賺錢</span></li>
            <ul style="list-style: disc" class="title-potmaster">
                <li>品牌經營 名聲大 客人喜歡 你好賣</li>
                <li>幫你在全國官網打廣告</li>
            </ul>
            <li><span class="text-primary">輕鬆賺錢</span></li>
            <ul style="list-style: disc" class="title-potmaster">
                <il>網路訂購 讓你隨時都可以接單</il>
                <il>會員管理 讓你服務輕鬆 客人滿意 長期賺錢</il>
            </ul>
        </ul>

        <hr/>
        <h4 class="text-danger"><i class="fa fa-caret-right"></i>&nbsp;如何成為鍋教授經銷商?</h4>
        <ol>
            <li class="text-primary">申請加入經銷商</li>
            <ul style="list-style: disc" class="title-potmaster">
                <li>註冊會員</li>
                <li>填申請表</li>
            </ul>
            <li class="text-primary">基本條件審核</li>
            <ul style="list-style: disc" class="title-potmaster">
                <li>個人基本資料</li>
            </ul>
            <li class="text-primary"><span class="text-primary">瓦斯節能訓練</span></li>
            <ul style="list-style: disc" class="title-potmaster">
                <li>專業瓦斯節能課程</li>
            </ul>
            <li class="text-primary"><span class="text-primary">取得鍋教授節能認證</span></li>
            <li class="text-primary"><span class="text-primary">簽訂經銷合約</span></li>
            <ul style="list-style: disc" class="title-potmaster">
                <li>正式成為鍋教授經銷商</li>
            </ul>
        </ol>

        <br/><br/><br/>
    </div>



    <!--modal : The confirm info is put here.-->
    <div class="modal fade" id="showInput" tabindex="-1" role="dialog" aria-labelledby="">
        <div class="modal-dialog" role="document">
            <form action="becomeReseller" method="post">
                {{csrf_field()}}
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><b>請確認您的個人資料是否正確</b></h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label navRWDStyle title-potmaster">姓名</label>

                                <div class="col-sm-10">
                                    <p class="form-control-static navRWDStyle">
                                        {{--{!!  showOrWarning(Auth::user()->name)!!}--}}
                                    </p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label navRWDStyle title-potmaster">地址</label>

                                <div class="col-sm-10">
                                    <p class="form-control-static navRWDStyle">
                                        {{--{!!  showOrWarning(Auth::user()->address)!!}--}}
                                    </p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label navRWDStyle title-potmaster">聯絡電話</label>

                                <div class="col-sm-10">
                                    <p class="form-control-static navRWDStyle">
                                        {{--{!!  showOrWarning($currentUser->tel)!!}--}}
                                    </p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label navRWDStyle title-potmaster"></label>

                                <div class="col-sm-10">
                                    <p class="note">*請填寫完整資料,以方便我們聯絡您!</p>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <a href="/my-account" class="nav-function">
                            <button type="button" class="btn btn-primary">
                                修改/填寫個人資料
                            </button>
                        </a>
                        <button type="submit" class="btn btn-danger">申請加入經銷商</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script>
        $(function () {
            //控制下一步驟確認
            $("#gotoNext").click(function () {
                $('#showInput').modal();
            });
        });
    </script>
@stop