<form class="navbar-form navbar-left" role="search" style="color: white;margin: 0px;"
      action="\admin\user\list" method="get"
      id="userSearch">
    {{csrf_field()}}
    <input type="hidden" name="newSearch" value='1'>

    <div class="form-group">
        <select name="active" id="active" title="請選擇狀態" class="form-control" style="color: black;">
            <option value="">所有狀態</option>
            <option value="1">正常</option>
            <option value="0">停用</option>
        </select>
    </div>

    <div class="form-group">
        <select name="keyword_by" id="keyword_by" title="查詢依據" class="form-control" style="color: black;">
            <option value="name" @if($queryTerm['keyword_by']=='name') selected @endif>姓名</option>
            <option value="email" @if($queryTerm['keyword_by']=='email') selected @endif>電子信箱</option>
        </select>
    </div>

    <div class="form-group">
        <input type="text" class="form-control" placeholder="關鍵字" name="keyword"
               @if(isset($queryTerm['keyword']) && $queryTerm['keyword'] !=='%')
               value="{{$queryTerm['keyword']}}"
                @endif
                v-model="keyword">
        <button type="reset" class="btn btn-default" @click.prevent="clearKeyword">重設</button>
    </div>
    <button type="submit" class="btn btn-warning">搜尋</button>
</form>