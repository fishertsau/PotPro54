@if(count($group->add_ons)>0)
    <hr style="margin:10px 0px;"/>
    <div class="row">
        <div class="col-md-2 col-sm-12 col-xs-12">
            <h4 class="text-nature">加工配件</h4>
        </div>
        <div class="col-md-10 col-sm-12 col-xs-12">
            <div class="row">
                @foreach($group->add_ons as $add_on)
                    <div class="col-md-3 col-sm-4 col-xs-4">
                        <img class="full-width"
                             src="{{URL::asset('assets/images/cover')}}/{{$add_on->coverPhoto_path}}">

                        <p class="title-potmaster">{{$add_on->title}}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif