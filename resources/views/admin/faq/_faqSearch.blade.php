<form class="navbar-form navbar-left" role="search" style="color: white;margin: 0px;"
      action="\admin\video"
      id="faqSearch">
    {{csrf_field()}}
    <input type="hidden" name="_method" value="GET">
    <input type="hidden" name="newSearch" value='1'>

    <div class="form-group">
        <select name="category" id="" title="請選擇類別" class="form-control" style="color: black;">
            <option value="">所有類別</option>
            @foreach( $faqCat_list  as $category=>$title )
                <option value="{{$category}}"
                        {{($queryTerm['category']==$category)?'selected':''}}>
                    {{$title}}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <select name="status_flag" id="" title="請選擇狀態" class="form-control" style="color: black;">
            <option value="">所有狀態</option>
            <option value="1" {{($queryTerm['status_flag']==1)?'selected':''}}>上架</option>
            <option value="0" {{($queryTerm['status_flag']==0)?'selected':''}}>下架</option>
        </select>
    </div>

    <div class="form-group">
        <input type="text" class="form-control" placeholder="標題名稱關鍵字" name="keyword"
               @if(isset($queryTerm['keyword']) && !$queryTerm['keyword']=='%')
               value="{{$queryTerm['keyword']}}"
                @endif>
    </div>
    <button type="submit" class="btn btn-warning">搜尋</button>
</form>