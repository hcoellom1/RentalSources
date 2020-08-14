<template>
<nav class="navbar navbar_first navbar-dark navbar-expand-lg fixed-top" id="mainNav">
        <div class="container">
          <router-link to="/"><a class="navbar-brand js-scroll-trigger" href="#page-top">
          <img class='logo' :src="'storage/images/Logo_Rental.png'" /></a></router-link>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id=" ">
            <ul class="navbar-nav ml-auto">
              
              <li class="nav-item">
               <router-link class="nav-link js-scroll-trigger"
               :to="{name:'Home',hash:'#Renta'}">
                Renta
               </router-link>
              </li>

              <li class="nav-item">
                <router-link class="nav-link js-scroll-trigger"
               :to="{name:'Home',hash:'#Compra'}">
                Compra
               </router-link>
              </li>

              <li class="nav-item">
                <router-link class="nav-link js-scroll-trigger"
               :to="{name:'Home',hash:'#Nosotros'}">
                Nosotros
               </router-link>
              </li>

              <li class="nav-item">
              <router-link class="nav-link js-scroll-trigger"
               :to="{name:'Home',hash:'#Contacto'}">
                Contacto
               </router-link>
              </li>

               <li class="nav-item">
                   <router-link v-if="$auth.user() != null " class="nav-link js-scroll-trigger"
                                :to="{name:'Dashboard'}">{{$auth.user().name}}</router-link>

                  <router-link v-else class="nav-link js-scroll-trigger"
                                        :to="{name:'Login'}">Login</router-link>  
                 <!--
                  <router-link class="nav-link js-scroll-trigger"
                                        :to="{name:'Login',hash:''}">Login</router-link> 
                !-->
                  
              </li>

              <li class="nav-item">
              <router-link to="/Cart">             
                  <a class="nav-link js-scroll-trigger" href="">
                    <span>Carrito
                      <i class='fa fa-shopping-cart' aria-hidden="true"></i>
                    </span>
                    <span class='CarritoCount'>( {{ $store.state.cartCount }} )</span>
                  </a>
                </router-link>
                </li>

            </ul>
          </div>
        </div>
      </nav>
</template>

<script>
export default {
name : "Header",
mounted(){
    
  /*
      if (localStorage.getItem("MaquinariaLocal")){
                        this.CarritoCount= JSON.parse(localStorage.getItem("MaquinariaLocal")).length;
                        console.log(this.CarritoCount);
      }
      */
  },
  data(){
    return{
          CarritoCount:0
    }    
  }
}
</script>