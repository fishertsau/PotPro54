<div class="breadcum">
    <div class="container" style="display:flex;">
        <div style="flex:9;">
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}"> <i class="livicon icon3 icon4" data-name="home" data-size="18"
                                                      data-loop="true" data-c="#3d3d3d" data-hc="#3d3d3d"></i>首頁
                    </a>
                </li>
                <li>
                    <i class="livicon icon3" data-name="angle-double-right" data-size="18" data-loop="true"
                       data-c="#01bc8c"
                       data-hc="#01bc8c"></i>
                    <a href="#">{{$title}}</a>
                </li>

                @if(isset($subTitle))
                    <li>
                        <i class="livicon icon3" data-name="angle-double-right" data-size="18" data-loop="true"
                           data-c="#01bc8c"
                           data-hc="#01bc8c"></i>
                        <a href="#">{{$subTitle}}</a>
                    </li>
                @endif


            </ol>
        </div>

        @include('frontEnd.partials._breadcrumbRight')
    </div>

</div>