<input type="text" class="hidden" v-model="queryTerm" value="{{collect($queryTerm)->toJson()}}">

<form action="/admin/example" method="get" id="searchForm">
    {{csrf_field()}}
    <input type="hidden" name="newSearch" value='1'>

    <div class="row">
        <div class="col-md-6">
            <div style="margin-bottom: 10px;">
                <span>案例狀態&nbsp;</span>
            </div>

            <div style="display: flex">
                <select name="hot" class="form-control" id="hot"
                        style="flex: 1"
                        v-model="queryTerm.hot">
                    <option value="%">(熱門)所有</option>
                    <option value="1">熱門</option>
                    <option value="0">非熱門</option>
                </select>

                <select name="activated"
                        class="form-control"
                        id="activated"
                        style="flex: 1"
                        v-model="queryTerm.activated">
                    <option value="%">(開通)所有</option>
                    <option value="1">已開通</option>
                    <option value="0">未開通</option>
                </select>

                <select name="published" class="form-control" id="published" style="flex: 1"
                        v-model="queryTerm.published">
                    <option value="%">(上架)所有</option>
                    <option value="1">上架</option>
                    <option value="0">下架</option>
                </select>


            </div>
        </div>


        <div class="col-md-6">
            <p>查詢依據&nbsp;
                <button class="btn btn-default btn-xs" type="reset"
                        id="clear_keyword">清除設定
                </button>
            </p>

            <div style="display: flex">
                <select name="keyword_by"
                        class="form-control"
                        style="flex: 2"
                        v-model="queryTerm.keyword_by">
                    <option value="example_title">案例標題</option>
                    <option value="manager_name">管理者名稱</option>
                    <option value="editor_name">編輯者名稱</option>
                </select>


                <input name="keyword"
                       id="keyword"
                       type="text"
                       class="form-control"
                       style="flex: 3"
                       placeholder="輸入關鍵字"
                       v-model="queryTerm.keyword">
                    <span style="flex:2">
                        <button class="btn btn-danger full-width"
                                @click.prevent="doNewSearch">
                            <span class="glyphicon glyphicon-search"></span>&nbsp; 查詢
                        </button>
                    </span>
            </div>
        </div>
    </div>
</form>