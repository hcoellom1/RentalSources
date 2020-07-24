/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

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
window.Vue = require('vue');

Vue.component('v-select', vSelect);
Vue.use(VueRouter);
Vue.use(Vuex);
Vue.use(VueSweetalert2);



/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 

const app = new Vue({
    el: '#app',
});
*/
const app = new Vue({
    el: '#app',
    store:new Vuex.Store(store),
    router:router,
    components:{
        MainApp
    }
    
});