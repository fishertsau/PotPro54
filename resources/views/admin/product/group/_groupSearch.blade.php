<form class="navbar-form navbar-left" role="search" style="color: white;margin: 0px;"
      action="\admin\product\group\list" method="get"
      id="groupSearch">
    {{csrf_field()}}
    <input type="hidden" name="newSearch" value='1'>

    <div class="form-group">
        <select name="category" id="category" title="請選擇類別" class="form-control" style="color: black;">
            <option value="">主類別</option>
            {{--todo: implement category search --}}
            {{--@foreach($categories  as $category=>$title )--}}
                {{--<option value="{{$category}}"--}}
                        {{--{{($queryTerm['category']==$category)?'selected':''}}>--}}
                    {{--{{$title}}--}}
                {{--</option>--}}
            {{--@endforeach--}}
        </select>
    </div>

    <div class="form-group">
        <select name="sub_category" id="group_sub_category_id" title="請選擇狀態" class="form-control" style="color: black;">
            <option value="">子類別</option>
        </select>
    </div>

    <div class="form-group">
        <select name="status_flag" class="form-control" id="status_flag" style="color: black;">
            <option value="">所有</option>
            {{--todo: implement queryTerm --}}
            {{--<option value="1" {{($queryTerm['status_flag']==1)?'selected':''}}>上架</option>--}}
            {{--<option value="0" {{($queryTerm['status_flag']==0)?'selected':''}}>下架</option>--}}
        </select>
    </div>

    <div class="form-group">
        {{--todo: implement queryTerm--}}
        {{--<input type="text" class="form-control" placeholder="名稱" name="keyword"--}}
                {{--@if(isset($queryTerm['keyword']) && !$queryTerm['keyword']=='%')--}}
                {{--value="{{$queryTerm['keyword']}}"--}}
                {{--@endif>--}}
    </div>
    <button type="submit" class="btn btn-warning">搜尋</button>
</form>