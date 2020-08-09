<template>	<!-- Main Content -->
	<div class="container-fluid">
		<div class="main-content bg-success text-center">
			<div class="col-md-4 text-center company__info">
				<span class="company__logo"><h2><span class="fa fa-android"></span></h2></span>
				<img src="storage/images/Logo_Rental.png" class="logo">
			</div>
			<div class="col-md-8 col-xs-12 col-sm-12 login_form">

        <div class="alert alert-danger" v-if="has_error && !success">
                <p v-if="error == 'registration_validation_error'">Validation Errors.</p>
                <p v-else>{{ errorMessage  }}</p>
        </div>

				<div class="container-fluid">
					<div class="row">
						<h2>Iniciar Sesión</h2>
					</div>
					<div class="row">
						<!--<form autocomplete="off" @submit.prevent="login" method="post"> !-->
                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" id="email" class="form__input" 
                               placeholder="user@example.com" 
                               v-model="correo" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" id="password" class="form__input" v-model="contrasenia" required>
                    </div>
                    <button type="submit" @click="validateFields()" class="btn_entrar" >Entrar</button>
              <!--  </form>!-->
					</div>
					<div class="row">
						<p>¿No tienes una cuenta? 
              <a class="nav-item" href="#">
               <router-link 
               :to="{name:'Register'}">
                Registrate Aquí
               </router-link>
              </a>              
            </p>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
  export default {
    name:'Login',
    data() {
      return {
        contrasenia: null,
        correo: null,
        success :false,        
        has_error: false,
        error:'',
        errorMessage :''
      }
    },
    mounted() {
      //
    },
    methods: {

      validateFields(){        
        if (!this.correo){
          this.has_error = true;
          this.errorMessage = 'El correo es requerido';
        }else if(!this.contrasenia){
          this.has_error = true;
          this.errorMessage = 'La contrasenia es requerido';
        }else{

          this.has_error = false;
          this.errorMessage = ' ';
          this.authenticateLogin();
        }

      },

      authenticateLogin() {
        // get the redirect object
        //var redirect = this.$auth.redirect()
        var app = this
        this.$auth.login({
          data: {
            email: app.correo,
            password: app.contrasenia
          },
          success: function() {            
            console.log("Exitoso");
            app.success = true;            
            app.$router.push( {path: 'Dashboard'}).catch((err) => {
               console.info(err.message);
            });               
            
          },
          error: function(error) {            
            console.log('cagada:' + error);
            app.errorMessage = 'El usuario no existe';
            app.has_error = true;
          },
          rememberMe: true,
          fetchUser: true
        })
      }
    }
  }
</script>