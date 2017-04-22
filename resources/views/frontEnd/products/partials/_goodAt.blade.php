{{--適用料理--}}
@if(! $group->good_at=='')
    <hr/>
    <h5 class="title-potmaster"><i class="fa fa-square"></i>&nbsp;適用料理</h5>
    <p class="text-potmaster"><i class="fa fa-check"></i>&nbsp;
        {{$group->good_at}}
    </p>
@endif