<!-- The search bar -->
<form id="search" method="get" action="/example">
    {{csrf_field()}}
    <input type="text" class="hidden" name="newSearch" value="1">
    <div class="input-group">
        <input type="text" class="form-control" placeholder="案例搜尋:案例名稱" name="keyword">
        <span class="input-group-btn"><button class="btn btn-default" type="submit" style="background-color: #505662;color:white"><i class="fa fa-search "></i>&nbsp;搜尋
            </button></span>
    </div>
</form>