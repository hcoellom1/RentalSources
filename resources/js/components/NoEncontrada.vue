<template>
<div>
<Header/>
<Header_1/>  
<div >
  <div class="main-products no-encontrado">
      <div class='container'>
        <div class='text-center'>
          <h2>¡Houston! Tenemos problemas</h2>
        </div>             
      </div>
 </div>
</div>
<Footer/>  
</div>  
</template>

<script>

import Header from "./Layout/Header.vue";
import Header_1 from "./Layout/Header_1.vue";
import Footer from "./Layout/Footer.vue";

export default {
  name:'Products',
  components:{
        Header,
        Header_1,
        Footer
  }
 } 
</script>