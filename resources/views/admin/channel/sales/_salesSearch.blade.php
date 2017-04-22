<form class="navbar-form navbar-left" role="search" style="color: white;margin: 0px;"
      action="\admin\sales"
      id="salesSearchForm">
    {{csrf_field()}}
    <input type="hidden" name="_method" value="GET">
    <input type="hidden" name="newSearch" value='1'>


    <div class="form-group">
        <select name="activated" id="" title="請選擇狀態"
                class="form-control"
                style="color: black;"
                v-model="queryTerm.activated">
            <option value="">所有狀態</option>
            <option value="1" >開通</option>
            <option value="0" >關閉</option>
        </select>
    </div>

    <div class="form-group">
        <select name="keyword_by" id="" title="查詢依據" class="form-control" style="color: black;"
                v-model="queryTerm.keyword_by">
            <option value="user_name">名稱</option>
            <option value="user_email">Email</option>
        </select>
    </div>
    <div class="form-group">
        <input type="text" class="form-control" placeholder="輸入關鍵字" name="keyword"
               v-model="queryTerm.keyword">
    </div>
    <button type='reset' class="btn btn-default">重設</button>
    <button @click.prevent="doNewSalesSearch" class="btn btn-warning">搜尋</button>
</form>