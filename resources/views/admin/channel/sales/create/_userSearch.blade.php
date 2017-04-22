<h4>搜尋使用者</h4>

<form class="navbar-form" role="search"
      action="" method="get"
      id="searchForm">
    {{csrf_field()}}
    <input type="hidden" name="newSearch" value='1'>

    <div class="form-group">
        <select name="keyword_by" id="keyword_by" title="查詢依據" class="form-control"
                style="color: black;">
            <option value="name">姓名</option>
            <option value="email">電子信箱</option>
        </select>
    </div>

    <div class="form-group">
        <input type="text" class="form-control" placeholder="關鍵字" name="keyword">
        <button type="reset" class="btn btn-default">重設</button>
    </div>
    <button class="btn btn-warning" @click.prevent='doUserSearch'>
        <i class="fa fa-search" aria-hidden="true"></i>&nbsp;搜尋
    </button>
</form>