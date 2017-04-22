Vue.component('alertbox', {
    template: '#alert-temp',
    props: ['type'],
    data: function () {
        return {
            show: true
        }
    },
    computed: {
        classAlert: function () {
            return {
                'alert': true,
                'alert--success': this.type == 'success',
                'alert--error': this.type === 'error'
            }
        }
    }
});


new Vue({
    el: '#app',
    data: {
        test: 'wholeNewWorld'
    }
});
//# sourceMappingURL=vueElixirBrowserify.js.map
