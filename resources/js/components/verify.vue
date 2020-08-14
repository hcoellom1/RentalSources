<template>
<div>
        Se ha autentifacado el correctamente.

</div>
</template>

<script>
  export default {
    name:'Login',
    token:'',
    data() {
      return {
        logeado: null
      }
    },
    mounted() {
         this.token=this.$route.params.token;
        console.log(this.token);
       axios.get('verify/'+this.token)
                    .then((response) => {
                        console.log(response.data);
                    }).catch(function(error){
                          console.log(error);
                    });            
    },
    methods: {

    }
  }
</script>