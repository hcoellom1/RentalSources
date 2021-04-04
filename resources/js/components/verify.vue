<template>
	<div class="container-fluid">
		<div class="main-content bg-success text-center">
			<div class="col-md-4 text-center company__info">

				<img src="/storage/images/Logo_Rental.png" class="logo">
			</div>
			<div class="col-md-8 col-xs-12 col-sm-12 login_form">

				<div class="container-fluid">					
					
					<div>
						<p>{{  message }}</p>
              <a class="nav-item" href="#">
               <router-link 
               :to="{name:'Login'}">
                Iniciar Sesión
               </router-link>
              </a>                          
					</div>

          <div>  
             <a class="nav-item" href="#">
               <router-link 
               :to="{name:'Home'}">
                Ir a página de Inicio
               </router-link>
              </a>
         </div>
				</div>
			</div>
		</div>
	</div>


</template>

<script>
  export default {
    name:'Login',
    token:'',    
    
    data() {
      return {
        logeado: null,
        message:'',
        success:false
      }
    },
    mounted() {
         this.token=this.$route.params.token;
        
       axios.get('verify/'+this.token)
                    .then((response) => {
                      this.message = 'Su cuenta ha sido activada satisfactoriamente';
                    }).catch(function(error){
                      this.message = 'Su cuenta ha no sido activada satisfactoriamente, contacte al administrador'                      
                      console.log(error);
                    });            
    },
    methods: {

    }
  }
</script>