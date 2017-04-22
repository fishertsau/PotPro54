@foreach($groupSubCategory->groups as $group )
    <div class="col-md-3 col-sm-6 col-xs-6">
        @include('frontEnd.components._productThumbnail',['item'=>$group,'model'=>'group'])
    </div>
@endforeach