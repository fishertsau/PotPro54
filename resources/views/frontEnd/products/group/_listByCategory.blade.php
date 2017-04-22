@foreach($groupCategories as $index => $groupCategory)
    <?php $firstRow = ($index == 0) ? true : false;   ?>

    {!! (!($firstRow)?'<hr/>':'') !!}

    <h3 class="title-potmaster">{{$groupCategory->title}}</h3>
    @include('frontEnd.products.group._listBySubCategory',['groupSubCategories'=>$groupCategory->groupSubCategories])
@endforeach