<input type="text" class="hidden" v-model="queryTerm" value="{{collect($queryTerm)->toJson()}}">

<form action="/admin/order" method="get" id="orderSearchForm">
    {{csrf_field()}}
    <input type="hidden" name="newSearch" value='1'>

    <div class="row">
        <div class="col-md-3">
            <div style="margin-bottom: 10px;">
                <span>訂單狀態&nbsp;</span>
                <span @click.prevent="quickStatusSetBtnShow=!quickStatusSetBtnShow"
                      class="status-setting">
                    <button class="btn btn-xs btn-default"
                    @mouseover="quickStatusSetBtnShow=true">快速設定</button>
                    <div v-show="quickStatusSetBtnShow"
                         class="status-setting__btn-block">

                        <button class="btn btn-sm btn-warning status-setting__btn-block__btn"
                                @click.prevent="clearQueryTerm">
                            所有狀態
                        </button>
                        <button class="btn btn-sm btn-warning status-setting__btn-block__btn"
                                @click.prevent="setNeedsAudit">
                            待審核
                        </button>
                        <button class="btn btn-sm btn-warning status-setting__btn-block__btn"
                                @click.prevent="setNeedsShipping">
                            待出貨
                        </button>
                    </div>
                </span>
            </div>

            <div style="display: flex">
                <select name="status_flag"
                        class="order-selection order-status-input"
                        id="status_flag"
                        style="flex: 1"
                        v-model="queryTerm.status_flag">
                    <option value="%">狀態</option>
                    @foreach(App\Models\Order\Order::getStatusTextList() as $statusChar=>$title)
                        <option value="{{$statusChar}}">{{$title}}</option>
                    @endforeach
                </select>

                <select name="phase" class="order-selection order-status-input" id="phase" style="flex: 1"
                        v-model="queryTerm.phase">
                    <option value="%">階段</option>
                    @foreach(App\Models\Order\Order::getPhaseTextList() as $phaseChar=>$title)
                        <option value="{{$phaseChar}}">{{$title}}</option>
                    @endforeach
                </select>

                <select name="phase_status_flag" class="order-selection order-status-input" id="phase_status_flag"
                        style="flex: 1"
                        v-model="queryTerm.phase_status_flag">
                    <option value="%">進度</option>
                    @foreach(App\Models\Order\Order::getPhaseStatusTextList() as $phaseStatusChar=>$title)
                        <option value="{{$phaseStatusChar}}">{{$title}}</option>
                    @endforeach
                </select>
            </div>
        </div>


        <div class="col-md-4">
            <p>訂購日期&nbsp;
                <button class="btn btn-default btn-xs"
                        @click.prevent='clearDate'>所有日期
                </button>
            </p>

            <div style="display: flex">
                <input name="begin_since" type="date" class="order-selection date-input" style="flex: 4"
                       v-model="queryTerm.begin_since">
                <span class="text-center" style="flex: 1">~</span>


                <input name="end_until" type="date" class="order-selection date-input" style="flex: 4"
                       v-model="queryTerm.end_until">
            </div>
        </div>


        <div class="col-md-5">
            <p>查詢依據&nbsp;
                <button class="btn btn-default btn-xs" @click.prevent="clearKeyword"
                        id="clear_keyword">清除關鍵字
                </button>
            </p>

            <div style="display: flex">
                <select name="keyword_by"
                        class="order-selection"
                        style="flex: 1"
                        v-model="queryTerm.keyword_by">
                    <option value="po_no">訂單號碼</option>
                    <option value="buyer_name">訂購人</option>
                </select>


                <input name="keyword" id="keyword" type="text" class="order-selection" style="flex: 2"
                       placeholder="輸入關鍵字"
                       v-model="queryTerm.keyword">
                    <span style="flex:1">
                        <button class="btn btn-sm btn-danger full-width"
                                @click.prevent="doNewOrderSearch">
                            <span class="glyphicon glyphicon-search"></span>&nbsp; 查詢
                        </button>
                    </span>
            </div>
        </div>
    </div>
</form>