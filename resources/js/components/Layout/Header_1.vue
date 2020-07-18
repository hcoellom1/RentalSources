<template>
<nav class="navbar navbar_two text-white navbar-expand-lg fixed-top fixed-top-2" >
        <div class="container">
                     <div class="form-inline">
                                <div class="col-md-4 form-group">
                                    <label class="col-form-label" for="que_buscas">¿Donde? </label>
                                <select class="select" v-model="$store.state.itemLocalidad" v-on:change="itemLocalidad($store.state.itemLocalidad)">
                                <option v-for = "Localidades in Localidades" :key="Localidades.id_localidad"
                                v-bind:value="Localidades.id_localidad">
                                {{Localidades.nombre_localidad}}
                                </option>          
                                </select>    
                                </div>
                                <div class="col-md-3 form-group">
                                        <label class="col-form-label" for="que_buscas">¿Qu&eacute; buscas? </label>                                
                                <select class="select" v-model="$store.state.itemTipoMaquinaria" v-on:change="itemTipoMaquinaria($store.state.itemTipoMaquinaria)">
                                <option v-for = "TipoMaquinaria in TipoMaquinaria" :key="TipoMaquinaria.Id_tipo_maquinaria"
                                v-bind:value="TipoMaquinaria.Id_tipo_maquinaria">
                                {{TipoMaquinaria.Tipo_maquinarias}}
                                </option>          
                                </select>  
                                    </div>
                            <div class="col-md-3 form-group">
                                    <label class="col-form-label" for="que_buscas">¿Qué deseas? </label>
                                    <select class="select" id="select_buscas" data-style="btn-inverse">
                                            <option value="Volqueta" selected>Rentar</option>
                                            <option value="Camion"> Comprar</option>
                                        </select>     
                                </div>
                          <router-link :to="{name:'Products',
                                        query:{idLocalidad:$store.state.itemLocalidad,
                                               idTipomaquinaria:$store.state.itemTipoMaquinaria}}" >
                            <button type="button" class="btn btn-warning text-white btn-sm">Buscar</button>
                            </router-link> 
                            <!-- <router-link :to="`/Products/${this.selectLocalidad}`">
                            <button type="button" class="btn btn-warning text-white btn-sm">Buscar</button>
                            </router-link> !-->
                    </div>

          </div>
    </nav>
    </template>

<script>

export default {
        data(){
                return{
                        Localidades:[],
                        TipoMaquinaria:[],
                        selectLocalidad:'',
                        selectTipoMaquinaria:''
                }
        },
        mounted(){

                 axios.get('api/Localidad').then((Response)=>{
                     this.Localidades = Response.data;
                     
                }).catch(function(error){
                        console.log(error);
                });     
                
                 axios.get('api/AllTipoMaquinaria')
                        .then((Response)=>{
                    
                        this.TipoMaquinaria = Response.data;
                      
                }).catch(function(error){
                        console.log(error);
                });
        
        },
        methods:{
                

                itemLocalidad(id_localidad){
                     this.$store.commit('SaveItemlocalidad',id_localidad); 
                                         
                },

                itemTipoMaquinaria(Id_tipo_maquinaria){
                     this.$store.commit('SaveitemTipoMaquinaria',Id_tipo_maquinaria); 
                                         
                }


        }

}
</script>