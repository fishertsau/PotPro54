<form action="{{$action}}"
      method="{{ $method }}"
      id="app-keywordSearchForm">
    <div class="input-group app-searchBox">
        <input id="app-search-keyword"
               class="form-control"
               placeholder="{{$hint}}"
               name="keyword">
        <span class="input-group-btn">
            <span class="btn btn-default searchBox__btn"
                  onclick="doKeywordSearch(this)">
                <i class="fa fa-search "></i>&nbsp;搜尋
            </span>
        </span>
    </div>
</form>

<script>
function doKeywordSearch(el) {
    var keyword = $('#app-search-keyword').val();

    if (keyword == '') {
        alert('請輸入搜尋條件!');
        el.preventDefault();
    }
    document.getElementById("app-keywordSearchForm").submit();
}
</script>