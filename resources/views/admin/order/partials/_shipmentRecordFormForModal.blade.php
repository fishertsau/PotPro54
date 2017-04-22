<form action="/admin/order/nextMove/order_shipped/{{$order->id}}" method="post">
    {{csrf_field()}}

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-nature" id="myModalLabel"><i class="fa fa-truck" aria-hidden="true"></i>&nbsp;出貨紀錄</h4>
        <h5>訂單號碼: <span class="text-primary">{{$order->po_no}}</span></h5>
        <h5>訂購人: <span class="text-primary">{{$order->buyer->name}}</span></h5>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12" style="display: block;">
                <div class="form-group ui-draggable-handle" style="position: static;">
                    <label for="shipper">
                        送貨人</label>
                    <select class="form-control" name="shipper" id="shipper" required>
                        <option value="新竹貨運">新竹貨運</option>
                        <option value="大榮貨運">大榮貨運</option>
                        <option value="中華郵政">中華郵政</option>
                        <option value="業務配送">業務配送</option>
                        <option value="客戶自取">客戶自取</option>
                        <option value="其他">其他</option>
                    </select>
                    <p class="help-block">請選擇送貨人</p>
                </div>

                <div class="form-group ui-draggable-handle" style="position: static;">
                    <label >
                        銷貨單號</label>
                    <input type="text" class="form-control" name="sales_slip_no" id="sales_slip_no" placeholder="銷貨單號">

                    <p class="help-block">請輸入銷貨單號</p>
                </div>

                <div class="form-group ui-draggable-handle" style="position: static;">
                    <label >
                        貨物追蹤碼</label>
                    <input type="text" class="form-control" name="tracking_no" id="tracking_no" placeholder="貨物追蹤碼">

                    <p class="help-block">請輸入貨物追蹤碼</p>
                </div>
                <div class="form-group ui-draggable-handle" style="position: static;">
                    <label for="">
                        出貨日</label>
                    <input type="date" class="form-control" name="shipped_at" id="shipped_at" placeholder="出貨日"
                           required>

                    <p class="help-block">請輸入出貨日</p>
                </div>
                <div class="form-group ui-draggable-handle" style="position: static;">
                    <label for="input-text-4">
                        附註</label>
                    <input type="text" class="form-control" name="note" id="note" placeholder="附註">

                    <p class="help-block">請輸入附註</p>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><span
                    class="glyphicon glyphicon-remove"></span> 取消
        </button>
        <button type="submit" class="btn btn-large btn-danger"><span class="glyphicon glyphicon-ok"></span> 確定送出
        </button>
    </div>
</form>