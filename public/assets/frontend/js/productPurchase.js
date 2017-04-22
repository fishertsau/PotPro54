function addItemToCartFromProductShow() {
    var product_id = document.getElementById("product_id").value;
    var qty = document.getElementById("product_qty").value;
    addItemToCart(qty, product_id);
}


function addItemToCartFromProductList(btn) {
    var block = btn.closest('.add-item-block');
    var product_id = btn.closest('.add-item-block').getElementsByClassName("product-id")[0].value;
    var qty = btn.closest('.add-item-block').getElementsByClassName("item-qty")[0].value;
    addItemToCart(qty, product_id);
}


function addItemToCart(qty, product_id) {
    if (!qty) {
        alert('請輸入數量!');
        return;
    }

    if (qty < 0) {
        alert('您輸入的數量是:  ' + qty + '\n' + '請輸入正確數量!');
        return;
    }

    var sendCommandTo = '/cart';
    $.ajax(
        {
            url: sendCommandTo,
            type: 'post',
            data: {
                '_token': $('input[name=_token]').val(),
                'product-id': product_id,
                'qty': qty
            },

            success: function (result) {
                alert('您選購的產品已加入購物車!');
            },

            error: function (responseTxt, statusTxt, xhr) {
                alert("Error: " + xhr.status + ": " + xhr.statusText);
            }
        }
    );
}

