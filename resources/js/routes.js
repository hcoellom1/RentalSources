import VueRouter from 'vue-router';

import Home from './components/home.vue';
import Products from './components/Products/Products.vue';
import Cart from './components/Cart.vue';
//import Factura from './components/Factura.vue';
import Confirmation from './components/Confirmation.vue';
import PaginaNoEncontrada from './components/NoEncontrada.vue';
import Mantenimiento from './components/Mantenimiento.vue';
import Login from './components/Login.vue';
import Register from './components/Register.vue';
import Dashboard from './components/Dashboard.vue';
import MyMaquinaria from './components/MyMaquinaria.vue';
import verify from './components/verify.vue';
import { stubFalse } from 'lodash';
import { Store } from 'vuex';

//import PageTwo from './views/PageTwo.vue';

let routes = [
  {
      path: '/',
      name: 'Home',
      component: Home
  },  
  {
      path: '/Cart',
      name: 'Cart',
      component:Cart  ,
      props:true
  },
  {
      path: '/products',
      name: 'Products',
      component: Products,
      props:true
  },
  /*{
      path: '/Factura',
      name:'Factura',
      component: Factura,
      props:true,
      meta:{
        auth:false
      }
  },*/
  {
    path: '/Confirmation',
    name:'Confirmation',
    component: Confirmation,
    props:true
  },    
  {
    path: '/Login',
    name:'Login',
    component: Login,
    props:true
  },
  {
    path: '/Register',
    name:'Register',
    component: Register,
    
  },  
  {
    path: '/Dashboard/',
    name:'Dashboard',
    component: Dashboard,
    children:[{
      path:'/Mantenimiento',  
      name:"Mantenimiento",
      components:{
        b: Mantenimiento
      } 
    },
    {
      path:'/MyMaquinaria',
      name:'MyMaquinaria',
      components:{
        b: MyMaquinaria
      } 
    }], 
    meta:{
      //requiresAuth:true
      auth:true
    }
  },
  {
    path: '/verify/:token',
    name:'verify',
    component: verify,
    props:true
  },
  {
      path:"*",
      component: PaginaNoEncontrada
  }

];


function scrollBehavior(to, from, savedPosition) {
  if (to.hash && document.querySelector(to.hash)) {
    return { selector: to.hash };
  }
  if (savedPosition) {
    return savedPosition;
  }
  return false;
}

const router = new VueRouter({
  routes: routes,
  mode: 'history',
  scrollBehavior    
});



/*
router.beforeEach((to, from, next) => {
  if (to.matched.some((record) => record.meta.requiresAuth)) {
    if ( localStorage.getItem['auth_stay_signed_in'] ) {
        next('/Login');
    } 
  } else {
      next();
  }

});
*/






export default router;