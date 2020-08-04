require('./bootstrap');

import routes from './routes.js';
import store from './store.js';
import Vue from 'vue';
import auth from './auth.js';
import MainApp from'./components/Main.vue';
import Dashboard from'./components/Dashboard.vue';

import VueRouter from 'vue-router';
import Vuex from 'vuex';
import VueAxios from 'vue-axios';
import 'es6-promise/auto';
import axios from 'axios';
import VueAuth from '@websanova/vue-auth';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import vSelect from 'vue-select';  


window.Vuex = Vuex;
window.Vue  = Vue;

Vue.component('v-select', vSelect);
Vue.use(Vuex);
Vue.use(VueSweetalert2);


Vue.router = routes;
Vue.use(VueRouter);

Vue.use(VueAxios, axios);

//axios.defaults.baseURL = 'http://127.0.0.1:8000';
axios.defaults.baseURL = 'http://127.0.0.1:8000/api/';
//axios.defaults.baseURL = `${process.env.MIX_APP_URL}/api/`
Vue.use(VueAuth, auth)

//Vue.component('Nav-Inicial', require('./components/Nav/Menu_Inicial.vue')); 
const app = new Vue({
    el: '#app',
    store:new Vuex.Store(store),
    router: routes,
    components:{
        MainApp,
        Dashboard
    }
    
});
