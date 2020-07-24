<template>
<div class="container" style="margin-top:100px;margin-bottom:100px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Login</div>

                <div class="card-body">
                    
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" 
                                       class="form-control @error('email') is-invalid @enderror"
                                       v-model="email" 
                                       value="email" 
                                       required autocomplete="email" 
                                       autofocus>

                                    <span class="invalid-feedback" role="alert">
                                        <strong>Invalid mail</strong>
                                    </span>

                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       v-model="password" 
                                       required autocomplete="current-password">
                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember">

                                    <label class="form-check-label" for="remember">
                                        Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button @click="authenticateUser"
                                        class="btn btn-primary">
                                    Login
                                </button>
                            </div>
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
</template>



<script>

export default {
        data(){
                return{
                    email:'',                        
                    password:''
                }
        },
        methods:{             
            authenticateUser(){
                axios.get('api/users/loginUser',{
                    email: this.email,
                    password : this.password                    
                }).then((response)=>{
                    console.log(response.data);
                }).catch(function(error){
                        console.log(error);
                });
            }
        }
}
</script>