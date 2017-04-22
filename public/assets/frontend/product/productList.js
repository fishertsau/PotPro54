$(function () {
    $('.productItemClose').click(function () {
        var id = this.closest(".groupSubCategory").getAttribute('groupSubCategoryId');
        var target = ".productItem[groupSubCategoryId='" + id + "']";
        $(target).hide();
    });

    $('.productItemOpen').click(function () {
        var id = this.closest(".groupSubCategory").getAttribute('groupSubCategoryId');
        var target = ".productItem[groupSubCategoryId='" + id + "']";
        $(target).show();
    });

    $("[data-action='expand-all']").click(function () {
        $('.productItem').show();
    });

    $("[data-action='collapse-all']").click(function () {
        $('.productItem').hide();
    });

});


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
                '_token': $('meta[name="csrf-token"]').attr('content'),
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


$("#menuCtrlBtn").click(function () {
    var flag = $('#menuStatusFlag');
    var newBtn;

    if (flag.hasClass('inactive')) {
        $('#group_list').slideDown(300);
        newBtn = '<i class="fa fa-minus " aria-hidden="true"></i>';
        flag.html(newBtn).toggleClass('inactive');
    }
    else {
        $('#group_list').slideUp(300);
        newBtn = '<i class="fa fa-plus" aria-hidden="true"></i>';
        flag.html(newBtn).toggleClass('inactive');
    }
});

new Vue({
    el: '#app'
});
