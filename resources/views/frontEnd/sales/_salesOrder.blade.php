<div>

    @include('frontEnd.sales.order._orderFilter')

    <div id="orderListContent"
         class="app-orderContent"
         v-show="orderListShow">
    </div>

    <div v-show="!orderListShow" class="app-orderContent">
        <button class="btn btn-primary full-width"
        @click="orderListShow=true">
        <i class="fa fa-reply" aria-hidden="true"></i>&nbsp;
        返回訂單清單
        </button>
        <br/>
        <br/>
        <div style="background: lightgoldenrodyellow;padding:8px;" v-show="hasOrder">
            <button class="btn btn-danger full-width"
                    v-show="activeOrder.cancellable_by_sales"
                    onclick="showCancelConfirmModal()">
                <i class="fa fa-times" aria-hidden="true"></i>&nbsp;
                取消訂單
            </button>
            <p class="text-danger">取消訂單:</p>
            <ul class="text-danger" style="list-style: circle">
                <li>訂單未審核,可自行取消.</li>
                <li>審核後若須更改,請洽公司.</li>
            </ul>
        </div>

        <div id="orderContent"></div>
    </div>

</div>

<div class="modal fade" tabindex="-1" role="dialog" id="confirmCancelOrderModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-danger">
                    <i class="fa fa-times" aria-hidden="true"></i>&nbsp;取消訂單
                </h4>
            </div>
            <div class="modal-body">
                <p class="title-potmaster">訂單取消後無法更改</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">放棄</button>
                <button type="button" class="btn btn-danger" onclick="cancelActiveOrder()">確認</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
