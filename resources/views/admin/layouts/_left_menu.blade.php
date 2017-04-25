<ul id="menu" class="page-sidebar-menu">
    {{--首頁--}}
    <li {!! (Request::is('admin') ? 'class="active"' : '') !!}>
        <a href="{{ route('dashboard') }}">
            <i class="livicon" data-name="home" data-size="18" data-c="#F89A14" data-hc="#F89A14"
               data-loop="true"></i>
            <span class="title">個人首頁</span>
        </a>
    </li>

    @can('system-config')
        {{--系統設定--}}
        <li {!! (Request::is('admin/systemConfig') || Request::is('admin/systemConfig/*') ? 'class="active"' : '') !!}>
            <a href="{{ URL::to('admin/systemConfig') }}">
                <i class="livicon" data-name="list-ul" data-size="18" data-c="#418BCA" data-hc="#418BCA"
                   data-loop="true"></i>
                <span class="title">系統設定</span>
            </a>
        </li>
    @endcan

    {{--待辦事項--}}
    <li {!! (Request::is('admin/todo') || Request::is('admin/todo/*') ? 'class="active"' : '') !!}>
        <a href="{{ URL::to('admin/todo') }}">
            <i class="livicon" data-name="list-ul" data-size="18" data-c="#F89A14" data-hc="#F89A14"
               data-loop="true"></i>
            <span class="title">待辦事項</span>
        </a>
    </li>


    @can('edit-siteContent')
        {{--內容設定--}}
        <li {!! (Request::is('admin/siteContent/*') ? 'class="active"' : '') !!}>
            <a href="#">
                <i class="livicon" data-name="desktop" data-size="18" data-c="#67C5DF" data-hc="#67C5DF"
                   data-loop="true"></i>
                <span class="title">內容管理</span>
                <span class="fa arrow"></span>
            </a>
            <ul class="sub-menu">
                <li {!! (Request::is('admin/siteContent/aboutUs/*')  ? 'class="active" id="active"' : '') !!}>
                    <a href="{{ URL::to('admin/siteContent/aboutUs/edit') }}">
                        <i class="fa fa-angle-double-right"></i>
                        關於我們
                    </a>
                </li>
                <li {!! (Request::is('admin/siteContent/lifeGasSaving/*') ? 'class="active" id="active"' : '') !!}>
                    <a href="{{ URL::to('admin/siteContent/lifeGasSaving/edit') }}">
                        <i class="fa fa-angle-double-right"></i>
                        日常瓦斯節能
                    </a>
                </li>
                <li {!! (Request::is('admin/siteContent/gasSavingDesignPrinciple/*') ? 'class="active" id="active"' : '') !!}>
                    <a href="{{ URL::to('admin/siteContent/gasSavingDesignPrinciple/edit') }}">
                        <i class="fa fa-angle-double-right"></i>
                        節能鍋原理
                    </a>
                </li>
            </ul>
        </li>
    @endcan


    @can('see-order')
        {{--訂單管理--}}
        <li {!! (Request::is('admin/order') || Request::is('admin/order/*') ? 'class="active"' : '') !!}>
            <a href="/admin/order">
                <i class="livicon" data-name="piggybank" data-size="18" data-c="#EF6F6C" data-hc="#EF6F6C"
                   data-loop="true"></i>
                <span class="title">訂單管理</span>
            </a>
        </li>
    @endcan

    {{--營運分析--}}
    <li {!! (Request::is('admin/report') || Request::is('admin/report/*') ? 'class="active"' : '') !!}>
        <a href="#">
            <i class="livicon" data-name="linechart" data-size="18" data-c="#67C5DF" data-hc="#67C5DF"
               data-loop="true"></i>
            <span class="title">營運報表</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li>
                <a href="#">
                    <i class="fa fa-angle-double-right"></i>
                    月報表
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-angle-double-right"></i>
                    日報表
                </a>
            </li>
        </ul>
    </li>

    {{--通路管理--}}
    <li {!! (Request::is('admin/sales') || Request::is('admin/sales/*') ? 'class="active"' : '') !!}>
        <a href="/admin/sales">
            <i class="livicon" data-name="flag" data-size="18" data-c="#F89A14" data-hc="#F89A14"
               data-loop="true"></i>
            <span class="title">通路管理</span>
        </a>
    </li>


    {{--訊息管理--}}
    <li>
        <a href="#">
            <i class="livicon" data-name="sky-dish" data-size="18" data-c="#EF6F6C" data-hc="#EF6F6C"
               data-loop="true"></i>
            <span class="title">訊息管理</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li>
                <a href="#">
                    <i class="fa fa-angle-double-right"></i>
                    發送訊息給通路
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-angle-double-right"></i>
                    發送訊息給客戶
                </a>
            </li>
        </ul>
    </li>


    @can('service-management')
        {{--客服管理--}}
        <li {!! (Request::is('faq') || Request::is('faq/*') ? 'class="active"' : '') !!}>
            <a href="#">
                <i class="livicon" data-name="help" data-size="18" data-c="#6CC66C" data-hc="#6CC66C"
                   data-loop="true"></i>
                <span class="title">客服管理</span>
                <span class="fa arrow"></span>
            </a>
            <ul class="sub-menu">
                <li {!! (Request::is('admin/faq') ? 'class="active" id="active"' : '') !!}>
                    <a href="{{ URL::to('admin/faq') }}"><i class="fa fa-angle-double-right"></i>常見問題管理</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-angle-double-right"></i>各項條款</a>
                </li>
            </ul>
        </li>
    @endcan

    @can('example-management')
        {{--案例管理--}}
        <li {!! (Request::is('admin/example') || Request::is('admin/example/*') ? 'class="active"' : '') !!}>
            <a href="/admin/example">
                <i class="livicon" data-name="camera" data-size="18" data-c="#67C5DF" data-hc="#67C5DF"
                   data-loop="true"></i>
                <span class="title">案例管理</span>
            </a>
        </li>
    @endcan



    @can('marketing-management')
        {{--行銷管理--}}
        <li {!! ( Request::is('admin/news') || Request::is('admin/news/*')  ||
        Request::is('admin/video') || Request::is('admin/video/*') ||
        Request::is('admin/talk') || Request::is('admin/talk/*')
        ? 'class="active"' : '') !!}>
            <a href="#">
                <i class="livicon" data-name="magic" data-size="18" data-c="#F89A14" data-hc="#F89A14"
                   data-loop="true"></i>
                <span class="title">行銷管理</span>
                <span class="fa arrow"></span>
            </a>

            <ul class="sub-menu">
                <li {!! (Request::is('admin/news') || Request::is('admin/news/*') ? 'class="active" id="active"' : '') !!}>
                    <a href="{{ URL::to('admin/news') }}">
                        <i class="fa fa-angle-double-right"></i>
                        消息與廣告
                    </a>
                </li>
                <li {!! (Request::is('admin/video') || Request::is('admin/video/*') ? 'class="active" id="active"' : '') !!}>
                    <a href="{{ URL::to('admin/video') }}">
                        <i class="fa fa-angle-double-right"></i>
                        影音管理
                    </a>
                </li>
                <li {!! (Request::is('admin/talk') || Request::is('admin/talk/*') ? 'class="active" id="active"' : '') !!}>
                    <a href="{{ URL::to('admin/talk') }}">
                        <i class="fa fa-angle-double-right"></i>
                        演講與推廣
                    </a>
                </li>
            </ul>
        </li>
    @endcan


    {{--@can('product-management')--}}
        {{--產品管理--}}
        <li {!! ( Request::is('admin/product/group') || Request::is('admin/product/group/*') ||
            Request::is('admin/product/product') || Request::is('admin/product/product/*')
        ? 'class="active"' : '')
            !!}>
            <a href="#">
                <i class="livicon" data-name="bulb" data-size="18" data-c="#6CC66C" data-hc="#6CC66C"
                   data-loop="true"></i>
                <span class="title">產品管理</span>
                <span class="fa arrow"></span>
            </a>
            <ul class="sub-menu">
                <li {!! (Request::is('admin/product/group') || Request::is('admin/product/group/*') ? 'class="active" id="active"' : '') !!}>
                    <a href="{{ URL::to('admin/product/group') }}">
                        <i class="fa fa-angle-double-right"></i>
                        系列產品
                    </a>
                </li>
                <li {!! (Request::is('admin/product/product') || Request::is('admin/product/product/*') ? 'class="active" id="active"' : '') !!}>
                    <a href="{{ route('admin.products.index') }}">
                        <i class="fa fa-angle-double-right"></i>
                        單一產品
                    </a>
                </li>
            </ul>
        </li>
    {{--@endcan--}}

    {{--@can('production-config')--}}
        {{--生產設定--}}
        <li {!! ( Request::is('admin/product/production/group/setting')||
            Request::is('admin/product/addOn') || Request::is('admin/product/addOn/*') ||
            Request::is('admin/product/addOnOption') || Request::is('admin/product/addOnOption/*')
        ? 'class="active"' : '')
            !!}>
            <a href="#">
                <i class="livicon" data-name="hammer" data-size="18" data-c="#EF6F6C" data-hc="#EF6F6C"
                   data-loop="true"></i>
                <span class="title">生產設定</span>
                <span class="fa arrow"></span>
            </a>
            <ul class="sub-menu">
                <li {!! (Request::is('admin/product/addOn') || Request::is('admin/product/addOn/*') ? 'class="active" id="active"' : '') !!}>
                    <a href="{{ URL::to('admin/product/addOn') }}">
                        <i class="fa fa-angle-double-right"></i>
                        加工配件
                    </a>
                </li>

                <li {!! (Request::is('admin/product/addOnOption') || Request::is('admin/product/addOnOption/*') ? 'class="active" id="active"' : '') !!}>
                    <a href="{{ URL::to('admin/product/addOnOption') }}">
                        <i class="fa fa-angle-double-right"></i>
                        加工方式
                    </a>
                </li>
            </ul>
        </li>
    {{--@endcan--}}


    @can('user-management')
        {{--使用者管理--}}

        <li {!! (Request::is('admin/user') || Request::is('admin/user/*') ? 'class="active"' : '') !!}>
            <a href="/admin/user">
                <i class="livicon" data-name="user" data-size="18" data-c="#6CC66C" data-hc="#6CC66C"
                   data-loop="true"></i>
                <span class="title">使用者管理</span>
            </a>
        </li>
    @endcan


    @can('role-management')
        {{--群組管理--}}
        <li {!! (Request::is('admin/role') || Request::is('admin/role/*') ? 'class="active"' : '') !!}>
            <a href="#">
                <i class="livicon" data-name="users" data-size="18" data-c="#418BCA" data-hc="#418BCA"
                   data-loop="true"></i>
                <span class="title">群組管理</span>
                <span class="fa arrow"></span>
            </a>

            <ul class="sub-menu">
                @can('see-role')
                    <li {!! (Request::is('admin/role') ? 'class="active" id="active"' : '') !!}>
                        <a href="{{ URL::to('admin/role') }}">
                            <i class="fa fa-angle-double-right"></i>
                            群組清單
                        </a>
                    </li>
                @endcan

                @can('create-role')
                    <li {!! (Request::is('admin/role/create') ? 'class="active" id="active"' : '') !!}>
                        <a href="{{ URL::to('admin/role/create') }}">
                            <i class="fa fa-angle-double-right"></i>
                            新增群組
                        </a>
                    </li>
                @endcan
            </ul>
        </li>
    @endcan


    @if(Auth::check())
        {{--todo: to implement if  super admin check is necessary --}}
        {{--@if(Auth::user()->isSuperAdmin())--}}
            {{--權限管理--}}
            <li {!! (Request::is('admin/permission') || Request::is('admin/permission/create') || Request::is('admin/permission/*') ? 'class="active"' : '') !!}>
                <a href="#">
                    <i class="livicon" data-name="key" data-size="18" data-c="#EF6F6C" data-hc="#EF6F6C"
                       data-loop="true"></i>
                    <span class="title">使用權限</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li {!! (Request::is('admin/permission') ? 'class="active" id="active"' : '') !!}>
                        <a href="{{ URL::to('admin/permission') }}">
                            <i class="fa fa-angle-double-right"></i>
                            權限清單
                        </a>
                    </li>
                    <li {!! (Request::is('admin/permission/create') ? 'class="active" id="active"' : '') !!}>
                        <a href="{{ URL::to('admin/permission/create') }}">
                            <i class="fa fa-angle-double-right"></i>
                            新增權限
                        </a>
                    </li>
                </ul>
            </li>
        {{--@endif--}}
    @endif
</ul>