

require('./bootstrap');

import router from './routes.js';
import store from './store.js';
import VueRouter from 'vue-router';
import Vuex from 'vuex';
import MainApp from'./components/Main.vue';
import VueAxios from 'vue-axios';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import vSelect from 'vue-select';


window.Vuex = Vuex;
window.Vue = require('vue'); // requiring the Vue


Vue.component('v-select', vSelect);
Vue.use(VueRouter);
Vue.use(Vuex);
Vue.use(VueSweetalert2);

//Vue.component('Nav-Inicial', require('./components/Nav/Menu_Inicial.vue')); 

const app = new Vue({
    el: '#app',
    store:new Vuex.Store(store),
    router:router,
    components:{
        MainApp
    }
    
});
