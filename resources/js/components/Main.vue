<template>
  
  <div>

    

    <transition>
      <router-view :key="$route.fullPath" class="view one"></router-view>
    </transition>            
    
  </div>

</template>

<script>
/*Imports Navs To Headers */ 
import Header from "./Layout/Header.vue";
import Header_1 from "./Layout/Header_1.vue";
import Footer from "./Layout/Footer.vue";
export default {
    name : 'Main-App',
    components:{Header,
                Header_1,
                Footer
               },
    mounted() {
      const anchor = this.$router.currentRoute.hash;
      this.$nextTick(() => {
        if (anchor && document.querySelector(anchor)) {
          location.href = anchor;
        }
      });
    }
}
</script>