<!-- END POPULAR POST -->
<!-- Tabbable-Panel Start -->
<h3 class="martop">最新消息</h3>

<div class="tabbable-panel">
    <!-- Tabbablw-line Start -->
    <div class="tabbable-line">
        <!-- Nav Nav-tabs Start -->
        <ul class="nav nav-tabs ">
            <li class="active">
                <a href="#tab_default_1" data-toggle="tab">
                    熱門消息</a>
            </li>
            <li>
                <a href="#tab_default_2" data-toggle="tab">
                    最新發布</a>
            </li>
        </ul>
        <!-- //Nav Nav-tabs End -->
        <!-- Tab-content Start -->
        <div class="tab-content">
            <div class="tab-pane active" id="tab_default_1">
                {{--todo: Add the hot news herer --}}
                @if( isset($hotnews))
                    @if (count($hotNewss)>0)
                        @foreach($hotNewss as $hotNews)
                            @include('frontEnd.partials._rightSideNewsItem',['news'=>$hotNews])
                        @endforeach
                    @else
                        <br/>
                        <p class="text-potmaster text-center">無熱門消息</p>
                    @endif
                @endif
            </div>

            <div class="tab-pane" id="tab_default_2">
                @if(isset($recentNewss))
                    @foreach($recentNewss as $recentNews)
                        @include('frontEnd.partials._rightSideNewsItem',['news'=>$recentNews])
                    @endforeach
                @endif
            </div>
        </div>
        <!-- //Tab-content End -->
    </div>
    <!-- //Tabbablw-line End -->
</div>
<!-- Tabbable_panel End -->