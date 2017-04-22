Vue.http.headers.common['X-CSRF-TOKEN'] =
    document.querySelector('meta[name="csrf-token"]').content;

//Vue.http.headers.common['X-CSRF-TOKEN'] =
//    document.querySelector('input[name="_token"]').value;


Vue.directive('ajax', {
    params: ['complete', 'notComplete'],
    bind: function () {
        this.el.addEventListener('submit', this.onSubmit.bind(this));
    },

    update: function () {
    },

    onSubmit: function (e) {
        e.preventDefault();
        this.vm
            .$http[this.getRequestType()](this.el.action)
            .then(this.onComplete.bind(this))
            .catch(this.onFailure.bind(this));
    },

    getRequestType: function () {
        var method = this.el.querySelector('input[name="_method"]');
        return (method ? method.value : this.el.method).toLowerCase();
    },

    onComplete: function () {
        if (this.params.complete) {
            alert(this.params.complete);
        }
    },

    onFailure: function () {
        if (this.params.notComplete) {
            alert(this.params.notComplete);
        } else {
            console.log('�ǰe����');
        }

    }
});
Vue.component('func-nav-list', {
    template: '#lc-myAccount-funcNav',
    props: ['list', 'active'],
});

Vue.component('func-nav', {
    template: '#func-nav',
    props: ['func', 'active'],
    computed: {
        navClass: function () {
            return {
                'funcNav': true,
                'funcNav-selected': this.active.title == this.func.title
            }
        },
    },
    methods: {
        setActive: function () {
            this.active = this.func;
        },
    }
});


Vue.component('func-content', {
    template: '#pm-myAccount-funcContent',
    props: ['title', 'active'],
    computed: {
        isSelected: function () {
            return this.title == this.active.title;
        }
    }
});


Vue.component('orders', {
    template: '#orders-template',
    data: function () {
        return {
            list: [],
            pagination:'123'
        };
    },
    created: function () {
        this.fetchOrderList();
    },

    methods: {
        fetchOrderList: function () {
            $.getJSON('sales/orderList', function (orders) {
                this.list = orders.orders.data;
                console.log(orders);
            }.bind(this));
        }
    }
});


//new Vue({
//    el: 'body',
//    data: {
//        funcList: [
//            {title: '設定'},
//            {title: '訂單'},
//            {title: '客戶'},
//            {title: '案例'}
//        ],
//        active: {title: '設定'},
//        orderFilterShow: false
//    }
//});

new Vue({
    el: 'body',
    data: function () {
        return {
            items: [],
            pagination: {
                total: 0, per_page: 12,
                from: 1, to: 0,
                current_page: 1
            }
        }
    },
    methods: {
        loadData: function () {
            var data = {
                paginate: this.pagination.per_page,
                page: this.pagination.current_page,
                /* additional parameters */
            };
            this.$http.get('/getData', data).then(function (response) {
                this.$set('items', response.data.data);
                this.$set('pagination', response.data.pagination);
            }, function(error) {
                // handle error
            });
        }
    },
    components: {
        pagination: require('vue-bootstrap-pagination')
    }
})