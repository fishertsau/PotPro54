<div class="mix category-{{$index}} col-lg-12 panel panel-default"
     data-value="{{$index+1}}">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a class="collapsed" data-toggle="collapse" data-parent="#faq"
               href="#question{{$index}}">
                <strong class="c-gray-light">{{$index+1}}.</strong>
                {{$content->description}}
                <span class="pull-right">
                    <i class="glyphicon glyphicon-plus"></i>
                </span>
            </a>
        </h4>
    </div>
    <div id="question{{$index}}" class="panel-collapse collapse">
        <div class="panel-body">
            {!! $content->body !!}
        </div>
    </div>
</div>