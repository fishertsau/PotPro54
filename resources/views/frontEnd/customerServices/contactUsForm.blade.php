@extends('frontEnd/layouts/master2Column')

{{-- Page title --}}
@section('title')
    節能產品
    @parent
    @stop


    {{-- breadcrumb --}}
    @section('top')
    @include('frontEnd.partials._breadcum',['title'=>'客戶服務','subTitle'=>'聯絡我們'])
    @stop

    {{-- Page content --}}
    @section('content')
            <!-- Container Section Strat -->

    <h3 class="text-nature">&nbsp;<i class="fa fa-pencil"></i>&nbsp;聯絡我們</h3>

    <hr/>

    <p class="text-potmaster"><i class="fa fa-caret-right"></i>&nbsp;請留下您的聯絡資料與事宜內容,我們會盡快與您聯絡!</p>

    <p class="text-potmaster"><i class="fa fa-caret-right"></i>&nbsp;若需要任何瓦斯節能產品與服務,您也可聯絡服務據點!</p>

    <hr/>
    {!! Form::open(['method'=>'post','route'=>'sendContactUsForm',
    'name'=>'ContactForm','class'=>'form-horizontal','id'=>'contactUsForm']) !!}

    <div class="form-group">
        <label for="contact" class="col-sm-2 control-label">聯絡人</label>

        <div class="col-sm-3">
            <input name="contact" type="text" class="form-control" id="" placeholder="聯絡人" required>
        </div>
    </div>

    <div class="form-group">
        <label for="email" class="col-sm-2 control-label">電子信箱</label>

        <div class="col-sm-5">
            <input name='email' type="email" class="form-control" id="email" placeholder="電子信箱">
        </div>
    </div>

    <div class="form-group">
        <label for="tel" class="col-sm-2 control-label">連絡電話</label>

        <div class="col-sm-3">
            <input name="phone" type="tel" class="form-control" id="tel" placeholder="連絡電話">
        </div>
    </div>

    <div class="form-group">
        <label for="topic" class="col-sm-2 control-label">主要事宜</label>

        <div class="col-sm-3">
            <input name="topic" type="text" class="form-control" id="topic" placeholder="主要事宜" required
                   value="@{{ thisTopic }}">
        </div>
        <div class="col-sm-7">
            <label class="radio-inline">
                <input type="radio" name="regarding" id="regarding1" value="合作提案" v-model="thisTopic"> <span
                        class="text-potmaster">合作提案</span>
            </label>
            <label class="radio-inline">
                <input type="radio" name="regarding" id="regarding2" value="節能系統規劃" v-model="thisTopic"><span
                        class="text-potmaster">節能系統規劃</span>
            </label>
            <label class="radio-inline">
                <input type="radio" name="regarding" id="regarding3" value="演講上課邀請" v-model="thisTopic"> <span
                        class="text-potmaster">演講上課邀請</span>
            </label>
            <label class="radio-inline">
                <input type="radio" name="regarding" id="regarding4" value="其他" v-model="thisTopic"><span
                        class="text-potmaster"> 其他</span>
            </label>
        </div>
    </div>

    <div class="form-group">
        <label for="content" class="col-sm-2 control-label">內容</label>

        <div class="col-sm-6">
            <textarea name="content" id="content" class="form-control"
                      placeholder="留言內容" rows="5" cols="100" required></textarea>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-success full-width">送出</button>
        </div>
    </div>

    {!! Form::close() !!}

    @stop

    {{-- page level scripts --}}
    @section('footer_scripts')
            <!-- Vue.js-->
    <script src="{{ asset('assets/js/frontend/contactUs.js') }}"></script>
@stop
