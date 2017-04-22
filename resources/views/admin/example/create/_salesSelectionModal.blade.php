<div class="modal fade" id="selectionList" tabindex="-1" role="dialog" aria-labelledby=""
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="modal-content" style="padding: 10px">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">選擇管理者:</h4>

                <div class="text-danger" >
                    <input type="text" class="hidden">
                    <p style="background: lightgoldenrodyellow;padding:5px;">
                        @{{ manager.name }}&nbsp;
                        @{{ manager.email }}&nbsp;
                        @{{ manager.tel }}
                    </p>
                </div>
            </div>

            <div class="modal-body">
                <p>搜尋條件&hellip;&nbsp;(<span class="text-danger">只能選擇有開通</span>)</p>
                <form class="navbar-form" role="search"
                      action="" method="get"
                      id="searchForm">
                    <input type="hidden" name="newSearch" value='1'>
                    <input type="text" class="hidden" name="activated" value="1">
                    <div class="form-group">
                        <select name="keyword_by" id="keyword_by" title="查詢依據" class="form-control"
                                style="color: black;">
                            <option value="user_name">名稱</option>
                            <option value="user_email">電子信箱</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="關鍵字" name="keyword">
                        <button type="reset" class="btn btn-default">重設</button>
                    </div>
                    <button class="btn btn-warning" @click.prevent='doSalesSearch'>
                        <i class="fa fa-search" aria-hidden="true"></i>&nbsp;搜尋
                    </button>
                </form>
                <hr>
                <div id="listContent"></div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i>&nbsp;取消
                </button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    <i class="fa fa-check" aria-hidden="true"></i>&nbsp;確定選擇
                </button>
            </div>
        </div>
    </div>
</div>

