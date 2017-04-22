@extends('frontEnd/layouts/master2Column')

{{-- Page title --}}
@section('title')
    我的帳戶
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/salesAccount/salesAccount.css') }}">
@stop


{{-- breadcrumb --}}
@section('top')
    @include('frontEnd.partials._breadcum',['title'=>'我的帳戶','subTitle'=>''])
@stop

{{-- Page content --}}
@section('content')
    <h3 class="text-nature">經銷專區</h3>

            <!-- Container Section Strat -->
    <div class="container-fluid">

        <div class="row" style="background: #eee">
            <func-nav-list :list="funcList" :active.sync="active"></func-nav-list>

            <func-content :active="active" title="設定">
                @include('frontEnd.sales._salesSetting')
            </func-content>

            <func-content :active="active" title="訂單">
                @include('frontEnd.sales._salesOrder')
            </func-content>

            {{--<func-content :active="active" title="客戶">--}}
            {{--@include('frontEnd.sales._myClient')--}}
            {{--</func-content>--}}

            <func-content :active="active" title="案例">
            @include('frontEnd.sales._myExample')
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
        <div class="col-md-4 col-sm-4 col-xs-4 text-center"
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

    <script type="text/javascript" src="{{ asset('assets/frontend/salesAccount/salesAccount.js') }}"></script>
@stop