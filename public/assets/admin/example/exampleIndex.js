var vue = new Vue({
    el: 'body',
    ready: function () {
        this.setupQueryTerm();
        this.fetchExampleList();
    },
    data: {
        queryTerm: ''
    },
    methods: {
        doNewSearch: function () {
            this.fetchExampleList(queryTerm());
        },
        fetchExampleList: function (queryTerm) {
            queryTerm = (typeof queryTerm !== 'undefined') ? queryTerm : null;
            $('#listContent').load(listUrl(), queryTerm);
        },
        setupQueryTerm: function () {
            this.queryTerm = JSON.parse(this.queryTerm);
            if (this.queryTerm.keyword_by == '') {
                this.queryTerm.keyword_by = 'example_title';
            }
        },
    },
});


/**  The setting  should be changed for each case*/
function listUrl() {
    return ('example/list');
}

function queryTerm() {
    return $('#searchForm').serialize();
}


function selectAllToggle(elem) {
    $('.row-selection').prop('checked', (elem.checked) ? true : false);
}