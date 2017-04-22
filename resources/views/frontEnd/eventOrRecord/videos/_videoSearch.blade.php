<!-- The search bar -->
<form id="search" method="get" action="/videos">
    {{csrf_field()}}
    <div class="input-group">
        <input type="text" class="form-control" placeholder="影音搜尋:主題關鍵字" name="keyword">
        <span class="input-group-btn"><button class="btn btn-default" type="submit" style="background-color: #505662;color:white"><i class="fa fa-search "></i>&nbsp;搜尋
            </button></span>
    </div>
</form>