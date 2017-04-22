var vue = new Vue({
    el: 'body',
    ready: function () {
        this.setupQueryTerm();
        this.fetchOrderList();
    },
    data: {
        listShow: true,
        quickStatusSetBtnShow:false,
        queryTerm: ''
    },
    methods: {
        doNewOrderSearch: function () {
            this.fetchOrderList(queryTerm());
            this.turnToListView();
        },
        fetchOrderList: function (queryTerm) {
            queryTerm = (typeof queryTerm !== 'undefined') ? queryTerm : null;
            console.log(orderListUrl());
            $('#listContent').load(orderListUrl(), queryTerm);
        },
        turnToOrderView: function () {
            this.listShow = false;
        },
        turnToListView: function () {
            this.listShow = true;
        },
        clearDate: function () {
            this.queryTerm.begin_since = '';
            this.queryTerm.end_until = '';
        },
        clearStatus: function () {
            this.queryTerm.status_flag = '%';
            this.queryTerm.phase = '%';
            this.queryTerm.phase_status_flag = '%';
        },
        clearKeyword: function () {
            this.queryTerm.keyword = '';
        },
        setupQueryTerm: function () {
            this.queryTerm = JSON.parse(this.queryTerm);
            if (this.queryTerm.keyword == '%') {
                this.queryTerm.keyword = '';
            }
            if (this.queryTerm.keyword_by == '%') {
                this.queryTerm.keyword_by = 'po_no';
            }
        },
        clearQueryTerm: function () {
            this.clearStatus();
            this.clearDate();
            this.clearKeyword();
        },
        setNeedsAudit:function ()
        {
            this.clearDate();
            this.clearKeyword();
            this.queryTerm.status_flag='n';
            this.queryTerm.phase='a';
            this.queryTerm.phase_status_flag='t';
        },
        setNeedsShipping:function ()
        {
            this.clearDate();
            this.clearKeyword();
            this.queryTerm.status_flag='n';
            this.queryTerm.phase='i';
            this.queryTerm.phase_status_flag='t';
        }
    }
});


//function fetchOrder(orderId) {
//    $('#orderContent').load(orderUrl(orderId));
//    vue.turnToOrderView();
//}

function fetchEditOrder(orderId) {
    $('#orderContent').load(orderEditUrl(orderId));
    vue.turnToOrderView();
}


function orderEditUrl(orderId) {
    return '/admin/order/' + orderId + '/edit';
}


//function orderUrl(orderId) {
//    return window.location.href + '/' + orderId;
//}

function orderListUrl() {
    //can i just get the uri, and not the parameter
    //return window.location.href + '/list';
    return '/admin/order/list';
}


function queryTerm() {
    return $('#orderSearchForm').serialize();
}


function selectAllToggle(elem) {
    $('.row-selection').prop('checked', (elem.checked) ? true : false);
}

function outputOrderToExcel() {
    var chosenOrderListString = getChosenOrderList().toString();

    if (chosenOrderListString == '') {
        return;
    }

    saveListStringToFormInput(chosenOrderListString);
    $('#generateExcelForm').submit();
}


function saveListStringToFormInput(idListString) {
    $('#idList').val(idListString);
}


function getChosenOrderList() {
    var chosenList = $(".row-selection:checked");

    var chosenListId = new Array();
    for (var i = 0; i < chosenList.length; i++) {
        chosenListId[i] = chosenList[i].getAttribute('value');
    }
    return chosenListId;
}


function showActionForm(order_id, action) {
    $('#modal-content').load(actionUrl(order_id, action));
    $('#entry_form').modal();
}


function actionUrl(order_id, action) {
    return window.location.href +
        '/nextMove' + '/' + action + '/' + order_id;
}


function acceptOrderAction() {
    $('#acceptOrderForm').submit();
}


