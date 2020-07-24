<template>    
    <div class='container' style="margin-top:200px">

         <div class="container mb-4 form">
             <div class="page-header">
                <h3>Agregar Nueva Maquinaria:</h3>      
            </div>            

            <div class="form-group row">
            
                <div class="col-sm-6">
                    <label for="Nombre">Nombre Maquinaria:</label>
                    <input type="text" class="form-control" 
                           v-model="Nombre" 
                           placeholder="**Nombres" 
                           value="" />
                </div>
                
                <div class="col-sm-6">
                    <label for="Descripcion">Descripción:</label>
                    <input type="text" class="form-control" 
                           v-model="Descripcion" 
                           placeholder="**Descripción de maquinaria" 
                           value="" />            
                </div> 

            </div>


            <div class="form-group row">    

                <div class="col-sm-6">
                    <label for="Nombre">Precio por hora:</label>
                    <input type="number" class="form-control" 
                           v-model="Precio_x_Hora" 
                           placeholder="**Precio por Hora" 
                           value="" />
                </div>
        
                <div class="col-sm-6">
                    <label for="Imagen">Imagen:</label>
                    <input type="file" accept="image/*"  
                           v-on:change="CargarImagen" 
                           class="form-control" 
                           placeholder="Cargar Imagen" 
                           value="" />
                </div>   
        
            </div>

            <div class="form-group row">
                <div class="col-sm-6">
                    <label for="Nombre">Precio por semana:</label>
                    <input type="number" class="form-control" 
                    v-model="Precio_x_semana" 
                    placeholder="**Precio por semana" 
                    value="" />
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-6">
                    <label for="Nombre">Precio por mes:</label>
                    <input type="number" class="form-control" 
                           v-model="Precio_x_mes" 
                           placeholder="**Precio por semana" 
                           value="" />
                </div>
            </div>

            <div class="form-group row">   
                <div class="col-sm-6">
                    <label class="col-form-label" for="que_buscas">Tipo Maquinaria </label>                                
                    <select class="select" v-model="vrTipoMaquinaria" >
                        <option v-for = "TipoMaquinaria in TipoMaquinaria" 
                                :key="TipoMaquinaria.Id_tipo_maquinaria"
                                v-bind:value="TipoMaquinaria.Id_tipo_maquinaria">
                                {{TipoMaquinaria.Tipo_maquinarias}}
                        </option>       
                    </select>
                </div>

                <div class="col-sm-6">
                    <label class="col-form-label" for="que_buscas">Ubicación</label>
                    <select class="select"  v-model ='vrLocalidad'>
                        <option v-for = "Localidades in Localidades" 
                                :key="Localidades.id_localidad"
                                v-bind:value="Localidades.id_localidad">
                            {{Localidades.nombre_localidad}}
                        </option>          
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-6">    
                    <label class="col-form-label" for="que_buscas">¿Disponible para? </label>
                    <select class="select" data-style="btn-inverse" v-model="QueDesea">
                        <option >Venta</option>
                        <option >Rentar</option>
                    </select>   
                </div>
            </div>

            <fieldset>
                <legend><h5>Condiciones de renta:</h5></legend>
                <div class="form-group row">                    
                    <div class="form-group form-check" v-for="condition in Condiciones" v-bind:key="condition.codigoCondicion">
                        <label class="col-form-label" :for="condition.codigoCondicion">{{ condition.descripcion }}
                            <input  type="checkbox" 
                                    v-model="checkedConditions" 
                                    :id="condition.codigoCondicion" 
                                    :value="condition.codigoCondicion">
                        </label>                                        
                    </div>
                </div>
            </fieldset>
            

            <div class="col-sm-6 text-right">
                <button @click="GuardarMaquinaria" 
                        class="btn btn-lg btn-block btn-warning text-white text-uppercase">
                        Guardar Maquinaria                        
                </button>
            </div>

         </div>

    </div>
</template>

<script>

export default {
        data(){
                return{
                        Localidades:[],
                        TipoMaquinaria:[],
                        Condiciones:[],
                        checkedConditions:[],
                        ImgMaquinaria:'',
                        Nombre :'',
                        Descripcion:'',
                        Precio_x_Hora:0,
                        Precio_x_mes:0,
                        Precio_x_semana:0,
                        vrTipoMaquinaria:'',
                        vrLocalidad:'',
                        QueDesea:'',
                        imgNombre :''

                }
        },
        methods:{
             CargarImagen(e) {
                let files = e.target.files || e.dataTransfer.files;
                let fileData = e.target.files[0];               
                this.imgNombre = fileData.name
                
                if (!files.length)
                    return;
                this.CrearImagen(files[0]);
            },
            CrearImagen(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.ImgMaquinaria = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            GuardarMaquinaria(){
                axios.post('api/image/SaveMaquinaria',{
                    imagen: this.ImgMaquinaria,
                    imgNombre : this.imgNombre,
                    nombreMaquinaria:this.Nombre,
                    descripcionMaquinaria:this.Descripcion,
                    precioHoraMaquinaria:this.Precio_x_Hora,
                    precioMaquinaMes:this.Precio_x_mes,
                    precioMaquinaSemana:this.Precio_x_semana,
                    tipoMaquinaria:this.vrTipoMaquinaria,
                    localidadMaquinaria:this.vrLocalidad,
                    queDeseaMaquinaria:this.QueDesea,
                    machineConditions:this.checkedConditions
                }).then((response)=>{
                    console.log(response);
                }).catch(function(error){
                        console.log(error);
                });
            }
        },
        mounted(){

                //Get all locations
                axios.get('api/Localidad').then((Response)=>{
                     this.Localidades = Response.data;
                     
                }).catch(function(error){
                        console.log(error);
                });     
                
                //Get kinds of machines
                axios.get('api/AllTipoMaquinaria')
                        .then((Response)=>{                    
                        this.TipoMaquinaria = Response.data;                      
                }).catch(function(error){
                        console.log(error);
                });

                //Get conditions for rent
                axios.get('api/Conditions')
                        .then((Response)=>{                    
                        this.Condiciones = Response.data;                      
                }).catch(function(error){
                        console.log(error);
                });
        
        }

}
</script>