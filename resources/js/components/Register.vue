<template>
  <div class="container form_stlye">
    <div class="row justify-content-md-center">
      <div class="col-6">
        <div class="card card-default">
          <div class="card-header headerRental">Registrarse</div>
          <div class="card-body">
            <div class="alert alert-danger" v-if="has_error && !success">
                <p v-if="error == 'registration_validation_error'">Validation Errors.</p>
                <p v-else>Error, can not register at the moment. If the problem persists, please contact an administrator.</p>
            </div>
            <form autocomplete="off" @submit.prevent="register" v-if="!success" method="post">
                <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="name" id="name" class="form__input" placeholder="Nombre Completo" v-model="name" required>
                    </div>
                 <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" id="email" class="form__input" placeholder="user@example.com" v-model="email" required>
                    </div>
                  <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" id="password" class="form__input" v-model="password" required>
                    </div>

                  <div class="form-group">
                        <label for="password_confirmation">Confirmación de Contraseña</label>
                        <input type="password" id="password_confirmation" class="form__input" v-model="password_confirmation" required>
                    </div>            
                  <div class="form-group row">
                  <button @click="register()" type="submit" class="btn_entrar col-sm-8">Crear Usuario</button>
                  <button @click="$router.push('login')" class="btn_entrar col-sm-2">Volver</button>
                  </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  export default {
    data() {
      return {
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        has_error: false,
        error: '',
        errors: {},
        success: false
      }
    },
    methods: {
      register() {
        var app = this
        this.$auth.register({
          data: {
            name: app.name,
            email: app.email,
            password: app.password,
            password_confirmation: app.password_confirmation
          },
          success: function () {
            app.success = true
            app.$router.push({name: 'login', params: {successRegistrationRedirect: true}})
          },
          error: function (res) {
            console.log(res)
            app.has_error = true
            app.error = res.response.data.error
            app.errors = res.response.data.errors || {}
          }
        })
      }
    }
  }
</script>