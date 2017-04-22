@foreach($groupSubCategories as $groupSubCategory)
    <h3 class="text-nature">{{$groupSubCategory->title}}</h3>
    <div class="row">
        @include('frontEnd.products.group._listByGroup')
    </div>
@endforeach