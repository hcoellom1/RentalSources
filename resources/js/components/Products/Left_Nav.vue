<template>
    <div class="col-md-2 left-nav">
    <a class="list-icon" v-bind:class="{ 'active': layout == 'list'}" v-on:click="layout = 'list'">list</a>
    <a class="grid-icon" v-bind:class="{ 'active': layout == 'grid'}" v-on:click="layout = 'grid'">grid</a>   
   </div>
</template>
<script>
export default {
  data(){
    
    return{
         
          layout:'grid'
    }
      
  }
 
}

</script>
 <!-- <router-link to="/">
     <a href="#" class="button-previous ml-5">‹</a>
     </router-link> !-->
    