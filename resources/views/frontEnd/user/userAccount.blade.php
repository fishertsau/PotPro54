@extends('frontEnd/layouts/master2Column')

{{-- Page title --}}
@section('title')
    我的帳戶
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/userAccount/userAccount.css') }}">
@stop


{{-- breadcrumb --}}
@section('top')
    @include('frontEnd.partials._breadcum',['title'=>'我的帳戶','subTitle'=>''])
@stop

{{-- Page content --}}
@section('content')
    <input type="text" class="hidden" v-model="user" value="{{auth()->user()}}">

    <h3 class="text-nature">我的帳戶</h3>
    <!-- Container Section Strat -->

    <div class="container-fluid">
        <div class="row" style="background: #eee">
            <func-nav-list :list="funcList" :active.sync="active"></func-nav-list>

            <func-content :active="active" title="設定">
                @include('frontEnd.user._myInformation')
            </func-content>

            <func-content :active="active" title="收藏">
                @include('frontEnd.user._myCollection')
            </func-content>

            <func-content :active="active" title="我的店">
                @include('frontEnd.user.myShop._myShop')
            </func-content>

            <func-content :active="active" title="其他">
                @include('frontEnd.user._myService')
            </func-content>
        </div>
    </div>

    <br/>
    <template id="pm-myAccount-funcContent">
        <div class="col-md-12 col-sm-12 col-xs-12"
             v-show="isSelected">
            <slot></slot>
        </div>
    </template>

    <template id="lc-myAccount-funcNav">
        <func-nav v-for="func in list" :func="func" :active.sync="active"></func-nav>
    </template>

    <template id="func-nav">
        <div class="col-md-3 col-sm-3 col-xs-3 text-center"
             :class="navClass"
             transition='nav'
        @mouseover="setActive()"
        >
        @{{ func.title }}
        </div>
    </template>
    @stop

    {{-- page level scripts --}}
    @section('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/frontend/userAccount/userAccount.js') }}"></script>
@stop