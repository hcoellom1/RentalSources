import VueRouter from 'vue-router';
import Home from './components/home.vue';
import ProductsList from './components/Products/Products.vue';
import Cart from './components/Cart.vue';
import Factura from './components/Factura.vue';
import PaginaNoEncontrada from './components/NoEncontrada.vue';
import Confirmation from './components/Confirmation.vue';
import Mantenimiento from './components/Mantenimiento.vue';
import Login from './components/Login.vue';


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
        props:true 
    },
    {
        path: '/Cart',
        name: 'Cart',
        component: Cart,
        props:true
    },
    {
        path: '/Factura',
        name:'Factura',
        component: Factura,
        props:true
    },
    {
      path: '/Confirmation',
      name:'Confirmation',
      component: Confirmation,
      props:true
    },
    {
      path: '/Mantenimiento',
      name:'Mantenimiento',
      component: Mantenimiento,
      props:true
    },
    {
      path: '/Login',
      name:'Login',
      component: Login,
      props:true
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