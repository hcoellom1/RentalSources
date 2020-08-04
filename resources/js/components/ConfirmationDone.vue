<template>    
    <div class="container form_stlye">
        <h1 class="h3 mb-2 text-gray-800">Nueva activación de usuario</h1>
        
        <!-- Success message -->
        <div class="alert alert-success" 
            role="alert" 
            id="success_message"
            v-if="saved">Maquinaria registrada con éxito                 
        </div>

    </div>
    
</template>

<script>

export default {
        data(){
                return{
                    verificationCode:'',
                    saved:true
                }
        },        
        mounted(){

                this.verificationCode = this.$route;
                console.log(this.verificationCode);

                /*
                //Get all locations
                axios.get('Localidad').then((Response)=>{
                     this.Localidades = Response.data;
                     
                }).catch(function(error){
                        console.log(error);
                });                

                */                        
        }

}
</script>