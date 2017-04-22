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

