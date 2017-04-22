{{--加工配件--}}
<hr/>
<h5 class="title-potmaster"><i class="fa fa-square"></i>&nbsp;加工配件</h5>

<p class="text-potmaster">
    @if(count($group->add_ons)>0)
        @foreach($group->add_ons as $add_on)
            <i class="fa fa-caret-right" aria-hidden="true"></i>&nbsp;{{$add_on->title}}
        @endforeach
    @else
        <i class="fa fa-check"></i>此系列產品無加工配件
    @endif
</p>