$(document).ready(function () {
    $('#add_on_list').select2({
        placeholder: '選擇加工項目'
    });
});

$("[name='add_on_allowed']").on('change', function () {
    $('#add_on_list').
        prop("disabled", $(this).val() == 0).
        prop("required", $(this).val() == 1);

    if($(this).val() == 0){
        $('#add_on_list').select2("val","");
    }
});