import Vue from 'vue'
require('./bootstrap');
import Index from './components/Index'
import router from './router'
import PrimeVue from 'primevue/config';
import 'primevue/resources/themes/saga-blue/theme.css';
import 'primevue/resources/primevue.min.css';
import 'primeicons/primeicons.css';
import ConfirmationService from 'primevue/confirmationservice';

Vue.use(PrimeVue);
Vue.use(ConfirmationService);

new Vue ({
    el: '#app',
    components: {
        Index
    },
    router
})
