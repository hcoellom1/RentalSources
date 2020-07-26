import VueRouter from 'vue-router';

import Home from './components/home.vue';
import ProductsList from './components/Products/Products.vue';
import Cart from './components/Cart.vue';
import Factura from './components/Factura.vue';
import PaginaNoEncontrada from './components/NoEncontrada.vue';
import Mantenimiento from './components/Mantenimiento.vue';
import Login from './components/Login.vue';
import Register from './components/Register.vue';
import Dashboard from './components/Dashboard.vue';
import MyMaquinaria from './components/MyMaquinaria.vue';
import { stubFalse } from 'lodash';


//import PageTwo from './views/PageTwo.vue';

let routes = [
  {
      path: '/',
      name: 'Home',
      component: Home
  },
  {
      path: '/Products/',
      name: 'Products',
      component: ProductsList,
      props:true,
      meta:{
        auth:false
      }
  },
  {
      path: '/Cart',
      name: 'Cart',
      component: Cart,
      props:true,
      meta:{
        auth:false
      }
  },
  {
      path: '/Factura',
      name:'Factura',
      component: Factura,
      props:true,
      meta:{
        auth:false
      }
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
    meta:{
      auth:false
    }
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
      auth:true
    }
  },
  {
      path:"*",
      component: PaginaNoEncontrada
  }

];
/*
scrollBehavior: function (to) {
  if (to.hash) {
    return {
      selector: to.hash
    }
  }
}
;
*/

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

export default router;