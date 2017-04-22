<style>
    #group_list {
        background: lightgoldenrodyellow;
    }
</style>

<div id="group_list" class="container-fluid" style="display: none">
    <div class="row" style="border: 1px solid lightgrey;border-top: 0px">
        @foreach($groupCategories_forSelection as $index=>$groupCategory)
            <div class="col-md-3 col-sm-4 col-xs-4">
                @if($index==0) <a href="\group"><h4 class="text-danger">所有系列</h4>@endif
                    <a href="\group?category={{$groupCategory->id}}">
                        <h4 class="text-nature">{{$groupCategory->title}}</h4>
                    </a>
                    @foreach($groupCategory->groupSubCategories as $groupSubCategory)
                        <a href="\group?subcategory={{$groupSubCategory->id}}">
                            <p><i class="fa fa-circle text-nature"
                                  aria-hidden="true"></i>
                                {{$groupSubCategory->title}}
                            </p>
                        </a>
                        @foreach($groupSubCategory->groups as $group)
                            <a href="\group\{{$group->slug}}">
                                <p>{{$group->title}}</p>
                            </a>
                @endforeach
                @endforeach
            </div>
        @endforeach
    </div>
</div>