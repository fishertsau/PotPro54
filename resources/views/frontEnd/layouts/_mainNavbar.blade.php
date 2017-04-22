<header>
    <!-- Icon Section Start -->
    <div class="icon-section">
        <div class="container">
            <ul class="list-inline">
                <li>
                    <a href="contactUs">
                        <i class="livicon" data-name="mail" data-size="18" data-loop="true"
                           data-c="#fff" data-hc="#fff"></i>
                    </a>
                </li>

                <li>
                    <a href="https://www.facebook.com/www0982500599/?fref=ts">
                        <i class="livicon" data-name="facebook"
                           data-size="18" data-loop="true"
                           data-c="#fff"
                           data-hc="#757b87"></i>
                    </a>
                </li>

                <li class="pull-right">
                    <ul class="list-inline icon-position">
                        <li>
                            <i class="livicon" data-name="home" data-size="18" data-loop="true"
                               data-c="#fff" data-hc="#fff"></i>
                            <label class="hidden-xs"><span class="text-white">
                                   台中市烏日區五光路復光六巷141號
                                </span></label>
                        </li>
                        <li>
                            <i class="livicon" data-name="phone" data-size="18" data-loop="true"
                               data-c="#fff" data-hc="#fff"></i>
                            <label class="hidden-xs"><span class="text-white">04-3507 9900
                                </span></label>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!-- //Icon Section End -->

    <!-- Nav bar Start -->
    <nav class="navbar navbar-default container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse">
                    <span>
                        <a href="#">
                            <i class="livicon" data-name="responsive-menu" data-size="25" data-loop="true"
                               data-c="#757b87" data-hc="#ccc"></i>
                        </a>
                    </span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}"><img
                        src="{{ asset('assets/images/companyInfo/brandLogo.png') }}" alt="logo" class="logo_position"
                        style="height: 50px;">
            </a>
        </div>
        <div class="collapse navbar-collapse" id="collapse">
            <ul class="nav navbar-nav navbar-right">
                <li {!! (Request::is('/') ? 'class="active"' : '') !!}>
                    <a href="{{ route('home') }}">首頁</a>
                </li>

                <li class="dropdown {!! (Request::is('group') || Request::is('product') ? 'active' : '') !!}">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> 節能產品</a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ URL::to('group') }}">產品展示</a></li>
                        <li><a href="{{ URL::to('product') }}">產品清單</a></li>
                    </ul>
                </li>

                <li {!! (Request::is('example') || Request::is('example/*') ? 'class="active"' : '') !!}>
                    <a href="{{ URL::to('example') }}">節能案例</a>
                </li>

                <li class="dropdown {!! (Request::is('lifeGasSaving') || Request::is('gasSavingPrinciple') || Request::is('video') || Request::is('talk')  ? 'active' : '') !!}">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> 節能資訊</a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ URL::to('lifeGasSaving') }}">日常瓦斯節能</a></li>
                        <li><a href="{{ URL::to('gasSavingDesignPrinciple') }}">節能鍋原理</a></li>
                        <li><a href="{{ URL::to('video') }}">影音專區</a></li>
                        <li><a href="{{ URL::to('talk') }}">演講與推廣</a></li>
                    </ul>
                </li>

                <li class="dropdown {!! (Request::is('faq') || Request::is('contactUs')||Request::is('news') || Request::is('news/*') ? 'active' : '') !!}">
                    <a id="showCustomerServiceSelection" href="#" class="dropdown-toggle" data-toggle="dropdown"> 客戶服務</a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ URL::to('news') }}">最新消息</a></li>
                        <li><a href="{{ URL::to('faq') }}">常見問題</a></li>
                        <li><a id="showContactUsForm" href="{{ URL::to('contactUs') }}">聯絡我們</a></li>
                    </ul>
                </li>

                {{--based on anyone login or not display menu items--}}
                @if ( Auth::check() )
                    <li class="dropdown {!! (Request::is('my-account') || Request::is('my-account/*') ? 'active' : '') !!}">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="text-nature" style="font-size: 14px">{{Auth::user()->name}}</span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            @can('use-system')
                                <li><a href="{{ URL::to('admin') }}"> <i class="fa  fa-laptop"></i> 管理系統</a></li>
                            @endcan
                            <li class="{{ (Request::is('my-account') ? 'class=active' : '') }}">
                                <a href="{{ URL::to('my-account') }}"> <i class="fa  fa-user"></i> 我的帳戶</a></li>
                            @can('behave-sales')
                                <li><a href="/sales"> <i class="fa  fa-users"></i> 經銷專區</a></li>
                            @endcan
                            <li>
                                <form action="/logout" method="post">
                                    {{csrf_field()}}
                                    <a href="#" onclick="this.parentNode.submit()">
                                        <i class="fa  fa-sign-out"></i>
                                        登出</a>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @can('behave-sales')
                        <li><a href="/cart" title="購物車"> <i class="fa  fa-shopping-cart"></i></a></li>
                    @endcan
                @else
                    <li><a href="{{ URL::to('login') }}"><i
                                    class="fa fa-sign-in"></i>&nbsp;登入</a>
                    </li>
                    <li><a href="{{ URL::to('register') }}">註冊</a>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
    <!-- Nav bar End -->
</header>