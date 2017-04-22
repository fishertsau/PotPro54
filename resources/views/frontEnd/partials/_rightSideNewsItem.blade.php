<div>
    <div class="media">
        <div class="media-left tab col-sm-6 col-md-12 col-xs-12">
            <a href="#">
                <img class="media-object img-responsive"
                     src="{{ asset('assets/images/cover')}}/{{$news->coverPhoto_path}}" alt="image">
            </a>
        </div>
    </div>
    <h4 class="title-potmaster">{{$news->title}}</h4>

    <div style="max-height: 100px;overflow: hidden;">
        {!! $news->body !!}
    </div>

    <div class="text-right ">
        <a href="/news/{{$news->slug}}"><span class="text-danger">
                                <i class="fa fa-arrow-circle-right"></i>&nbsp;看更多</span></a>
    </div>
</div>
<br/>