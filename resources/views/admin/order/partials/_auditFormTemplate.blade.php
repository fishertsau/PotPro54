<form action="/admin/order/nextMove/{{$action}}/{{$order->id}}" method="post">
    {{csrf_field()}}

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
        @if($danger)
            <h4 class="modal-title text-danger">
                <span class="glyphicon glyphicon-share-alt"></span>&nbsp;{{$actionTitle}}
            </h4>
        @else
            <h4 class="modal-title text-success" id="myModalLabel">
                <span class="glyphicon glyphicon-ok"></span>&nbsp;回復訂單
            </h4>
        @endif
        <h5>訂單號碼: <span class="text-primary">{{$order->po_no}}</span></h5>
        <h5>訂購人: <span class="text-primary">{{$order->buyer->name}}</span></h5>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12" style="display: block;">
                <div class="form-group ui-draggable-handle">
                    <label for="shipper">
                        審核人: {{auth()->user()->name}}</label>
                </div>

                <div class="form-group ui-draggable-handle">
                    <label for="input-text-4">
                        說明</label>
                    <input type="text" class="form-control" name="comments" id="comments" placeholder="輸入原因或說明">
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
