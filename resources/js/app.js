import Vue from 'vue'
require('./bootstrap');
import Index from './components/Index'
import router from './router'


new Vue ({
    el: '#app',
    components: {
        Index
    },
    router
})
