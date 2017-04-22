$(document).ready(function () {
    var Url = window.location.href + '/list';
    $('#userListContent').load(Url);
});

$("#userSearch").submit(function (e) {
    var url = window.location.href + '/list';
    var queryTerm = $(this).serialize();
    $('#userListContent').load(url, queryTerm);
    e.preventDefault(); // avoid to execute the actual submit of the form.
});


new Vue({
    el: '#app',
    data: {
        keyword: '',
    },
    methods: {
        clearKeyword: function () {
            this.keyword = '';
        }
    }
});
