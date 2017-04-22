Vue.http.headers.common['X-CSRF-TOKEN'] =
    document.querySelector('meta[name="csrf-token"]').content;

//Vue.http.headers.common['X-CSRF-TOKEN'] =
//    document.querySelector('input[name="_token"]').value;


Vue.directive('ajax', {
    params: ['complete'],
    bind: function () {
        console.log(this.params);
        this.el.addEventListener('submit', this.onSubmit.bind(this));
    },

    update: function () {
    },

    onSubmit: function (e) {
        e.preventDefault();
        this.vm
            .$http[this.getRequestType()](this.el.action)
            //.then(this.onComplete.bind(this), this.onFailure.bind(this));
            .then(this.onComplete.bind(this))
            .catch(this.onFailure.bind(this));
    },

    getRequestType: function () {
        var method = this.el.querySelector('input[name="_method"]').value;
        return (method ? method : this.el.method).toLowerCase();
    },

    onComplete: function () {
        if (this.params.complete) {
            alert(this.params.complete);
        }
    },

    onFailure: function () {
        console.log('job failed');
    }
});


new Vue({
    el: '#app',
    data: {
        msg: 'A good restart',
        testId: 5
    }
});
//# sourceMappingURL=vueAjaxFormDirective.js.map
