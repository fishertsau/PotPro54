$(document).ready(function () {
    var Url = window.location.href + '/list';
    $('#listContent').load(Url);
});

$("#todoSearch").submit(function (e) {
    var url = window.location.href + '/list';
    var queryTerm = $(this).serialize();
    $('#listContent').load(url, queryTerm);
    e.preventDefault(); // avoid to execute the actual submit of the form.
});


//$('#all_date').click(function (e) {
//    $('.date-input').val('');
//    e.preventDefault(); // avoid to execute other action.
//});
//
//
//$('#clear_keyword').click(function (e) {
//    $('#keyword').val('');
//    e.preventDefault(); // avoid to execute other action.
//});
//
//
//$('#all_status').click(function (e) {
//    $('.news-status-input').val('');
//    e.preventDefault(); // avoid to execute other action.
//});
//
//$('#all_location').click(function (e) {
//    $('.news-location-input').val('');
//    e.preventDefault(); // avoid to execute other action.
//});