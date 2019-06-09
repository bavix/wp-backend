import Vue from 'vue'

Nova.booting((Vue, router, store) => {
    Vue.component('index-file-field', require('./components/Tool'));
})
