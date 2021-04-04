<template>
    
    <section id="SearchSection" >
               
                  <!-- Slide Two - Set the background image for this slide in the line below -->
                  <img id="background-image" src="https://webcdn.agroptima.com/wp-content/uploads/2019/11/07122810/iStock-1160723757.jpg">
                    <div class="Search container">
                     <h2 class="text-color-rental"> Somos Rental Maquinaria</h2>                     
                     <h5 class="text-color-rental">Encuentra maquinaria y equipo para rentar </h5> 
                      
          <form class="my-2 my-lg-0 navbar-form">
            <div class="input-group input-group-search mx-auto">
               <div class="input-group-prepend">
                  <select class="select" v-model="$store.state.itemLocalidad" v-on:change="itemLocalidad($store.state.itemLocalidad)" >
                                <option v-for = "Localidades in Localidades" :key="Localidades.id_localidad"
                                v-bind:value="Localidades.id_localidad">
                                {{Localidades.nombre_localidad}}
                                </option>          
                                </select>
               </div>
               <input type="search" class="form-control" placeholder="Ingrese el nombre de la maquinaria" aria-label="Search" aria-describedby="search-button-addon" required>
               <div class="input-group-append">
                  <button class="btn btn-success" type="submit" id="search-button-addon">&#128269;</button>
               </div>
            </div>
         </form>
    </div>
                
    </section>

</template>

<script>
export default {
name :"Header_1",
        data(){
                return{
                        Localidades:[],
                        TipoMaquinaria:[],
                        selectLocalidad:'',
                        selectTipoMaquinaria:''
                }
        },
        mounted()
                {
                 axios.get('/Localidad')
                        .then((Response) =>{
                        this.Localidades = Response.data;                     
                }).catch(function(error){
                        console.log('Error grave en Header_1');
                });     
                
                /*
                 axios.get('/AllTipoMaquinaria')
                        .then((Response)=>{                    
                        this.TipoMaquinaria = Response.data;                      
                }).catch(function(error){
                        console.log(error);
                });
                */
        
        },
        methods:{
                
              /*
                itemLocalidad(id_localidad){
                     this.$store.commit('SaveItemlocalidad',id_localidad);                                          
                },

                itemTipoMaquinaria(Id_tipo_maquinaria){
                     this.$store.commit('SaveitemTipoMaquinaria',Id_tipo_maquinaria);                                          
                }

              */
        }

}
</script>