<form class="navbar-form navbar-left" role="search" style="color: white;margin: 0px;" action="\admin\video">
    <input type="hidden" name="_method" value="GET">

    <div class="form-group">
        <select name="status_flag" id="" title="請選擇狀態" class="form-control" style="color: black;" >
            <option value="">所有狀態</option>
            <option value="1">上架</option>
            <option value="0">下架</option>
        </select>
    </div>

    <div class="form-group">
        <input type="text" class="form-control" placeholder="標題名稱關鍵字" name="keyword">
    </div>
    <button type="submit" class="btn btn-warning">搜尋</button>
</form>