/*展開設定*/
$('.expand-add-on-setting').click(function (e) {
    $('.add-on-setting').hide();
    var index = $(this).attr('add-on-index');
    addOnSettingRow(index).show();
});

/*關閉設定*/
$('.close-add-on-setting').click(function (e) {
    $('.add-on-setting').hide();
    var index = $(this).attr('add-on-index');
    addOnSettingRow(index).hide();
});


function addOnSettingRow(index) {
    var addOnSettingRow = '.add-on-setting[add-on-index=' + "'" + index + "']";
    return $(addOnSettingRow);
}

/*加工設定值*/
$('.setting-input').change(function () {
    $('#'+ $(this).attr('target-setting')).val($(this).val());
});
