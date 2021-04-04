<template>    
    <div class="container form_stlye">
        <h1 class="h3 mb-2 text-gray-800">Registro de Nueva Maquinaria</h1>

        <p class="mb-4">Ingrese toda la información requerida para poder registrar la maquinaria.</p>

        <p class="mb-4"><strong>**Nota: </strong> Al precio registrado por hora se le sumará un 10% por cargos servicios de rental, 
        el cual se le mostrará al usuario final**</p>

        <p v-if="errors.length" id="ErrorsLines">
            <b> Favor ingresar los siguientes campos: </b>
            <ul>
                <li v-for ="error in errors" :key="error">{{error}}</li>
            </ul>
        </p>

        <fieldset>
            <!-- Text input-->
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label class="control-label">Nombre Maquinaria</label>
                         <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                            <select class="form-control selectpicker" v-model="vrMachineName">
                                <option v-for = "MachineNames in machineNames" 
                                        :key="MachineNames.idNombreMaquina"
                                        v-bind:value="MachineNames.idNombreMaquina">
                                        {{MachineNames.nombreMaquina}}
                                </option>      
                            </select>
                        </div>
                </div>

                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label class="control-label" >Marca / Modelo</label>     
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input type="text" class="form-control" 
                           v-model="Descripcion" 
                           placeholder="Descripción de maquinaria" 
                           value="" />
                        
                    </div>
                </div>
            </div>

            <div class="form-group row"> 
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label class="control-label">Tipo Maquinaria</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                            <select class="form-control selectpicker" v-model="vrTipoMaquinaria">
                                <option v-for = "TipoMaquinaria in TipoMaquinaria" 
                                        :key="TipoMaquinaria.Id_tipo_maquinaria"
                                        v-bind:value="TipoMaquinaria.Id_tipo_maquinaria">
                                        {{TipoMaquinaria.Tipo_maquinarias}}
                                </option>      
                            </select>
                        </div>
                </div>

                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label class="control-label">Ubicación de la Maquinaria</label>
                        <div class="selectContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                                    <select class="form-control selectpicker" v-model ='vrLocalidad'>
                                        <option v-for = "Localidades in Localidades" 
                                                :key="Localidades.id_localidad"
                                                v-bind:value="Localidades.id_localidad">
                                                {{Localidades.nombre_localidad}}
                                        </option>             
                                    </select>
                            </div>
                        </div>
                </div>
            </div>   
            <!-- Text input-->

            <!-- Text Option-->
            <div class="form-group row"> 
                <div class="col-sm-6 mb-3 mb-sm-0"> 
                    <label class="control-label">Disponible Para?</label>
                    <div class="selectContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                            <select class="form-control selectpicker" v-model="QueDesea">                                
                                <option value="">-- Seleccionar --</option>
                                <option>Renta</option>
                                <option>Venta</option>     
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label class="control-label">Precio Por Hora</label>  
                        <div class="inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="number" class="form-control" 
                                        v-model="Precio_x_Hora" 
                                        placeholder="**Precio por Hora" 
                                        value="" />
                            </div>
                        </div>
                </div>
            </div>
            <!-- Text input-->
    
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label class="control-label">Precio Por Hora|Semana</label>  
                        <div class="inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input  v-model="Precio_x_semana" 
                                        placeholder="Precio por Hora|Semana" 
                                        class="form-control"  
                                        type="number" 
                                        min=1 
                                        value="">
                            </div>
                        </div>
                </div>

                <!-- Text input-->
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label class="control-label">Precio Por Hora|Mes</label>  
                        <div class="inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input  v-model="Precio_x_mes" 
                                        placeholder="Precio por Hora|Mes" 
                                        class="form-control"  
                                        type="number" 
                                        min=1 
                                        value="">                                                           
                            </div>
                        </div>
                </div>
            </div>
            <!-- Text input-->

            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label class="control-label">Horas Mínimas Para Alquiler</label>  
                        <div class="inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input  v-model="vrHorasMinimas" 
                                        placeholder="Horas Minimas" 
                                        class="form-control"  
                                        type="number" 
                                        min=1>
                            </div>
                        </div>
                </div>

                <!-- Text Image-->
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label class="control-label">Imagen Maquinaria</label>            
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                            <input class="form-control"  
                                    type="file" 
                                    accept="image/*"  
                                    v-on:change="CargarImagen"  
                                    placeholder="Cargar Imagen" 
                                    value="" />                            
                        </div>
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

            <!-- Success message -->
            <div class="alert alert-success" 
                 role="alert" 
                 id="success_message"
                 v-if="saved">Maquinaria registrada con éxito                 
            </div>

            <!-- Button -->
            <div class="text-center">      
                <div class="col-sm-12"><br>
                    <button @click="ValidarFormulario" 
                            type="submit" 
                            class="btn btn-warning col-sm-8">Guardar Maquinaria<span class="glyphicon glyphicon-send"></span>
                    </button>
                </div>
            </div>


        </fieldset>        
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
                        machineNames:[],
                        errors :[],
                        ImgMaquinaria:'',
                        Nombre :'',
                        Descripcion:'',
                        Precio_x_Hora:0,
                        Precio_x_mes:0,
                        Precio_x_semana:0,
                        vrTipoMaquinaria:'',
                        vrLocalidad:'',
                        QueDesea:'',
                        imgNombre :'',
                        saved:false,
                        email:'',
                        vrMachineName:'',
                        vrHorasMinimas:1

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
            ValidarFormulario:function (e){
                if (this.vrMachineName && 
                     this.Descripcion &&                     
                     this.vrTipoMaquinaria &&
                     this.vrLocalidad &&           
                     this.QueDesea &&
                     this.vrHorasMinimas)
                     { 
                         this.GuardarMaquinaria(); 
                     }

                     this.errors=[];

                     if (!this.vrMachineName){
                         this.errors.push('Nombre es requerido');
                         window.scrollTo(0,'ErrorsLines');  
                     }

                     if (!this.Descripcion){
                         this.errors.push('La descripción es requerida');
                         window.scrollTo(0,'ErrorsLines');                         
                     }

                     if (!this.vrTipoMaquinaria){
                         this.errors.push('El tipo de maquinaria es requerido');
                         window.scrollTo(0,'ErrorsLines');  
                     }

                      if (!this.vrLocalidad){
                         this.errors.push('La localidad es requerida');
                         window.scrollTo(0,'ErrorsLines');  
                     }
                    
                     if (!this.QueDesea){
                         this.errors.push('La acción para la cual está disponible la maquinaria es requerida');
                         window.scrollTo(0,'ErrorsLines');  
                     }

                     if(!this.vrHorasMinimas){
                         this.errors.push('Las horas mínimas por día deben ser mayor que 0');
                         window.scrollTo(0,'ErrorsLines');  
                     }

                     e.preventDefault();
            },
            GuardarMaquinaria(){
                axios.post('image/SaveMaquinaria',{
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
                    machineConditions:this.checkedConditions,
                    emailOwner:this.email,
                    machineName:this.vrMachineName,
                    horasMinimas: this.vrHorasMinimas
                }).then((response)=>{
                    console.log(response);
                    this.clearFields();
                    this.saved = true;
                }).catch(function(error){
                        console.log(error);
                });
            },
            clearFields:function (e){                
                this.ImgMaquinaria = '';
                this.imgNombre = '';
                this.Nombre = '';
                this.Descripcion = '';
                this.Precio_x_Hora = 0;
                this.Precio_x_mes = 0;
                this.Precio_x_semana = 0;
            }
        },
        mounted(){

                this.email = this.$auth.user().email;

                //Get all locations
                axios.get('Localidad').then((Response)=>{
                     this.Localidades = Response.data;
                     
                }).catch(function(error){
                        console.log(error);
                });     
                
                //Get kinds of machines
                axios.get('AllTipoMaquinaria')
                        .then((Response)=>{                    
                        this.TipoMaquinaria = Response.data;                      
                }).catch(function(error){
                        console.log(error);
                });

                //Get conditions for rent
                axios.get('Conditions')
                        .then((Response)=>{                    
                        this.Condiciones = Response.data;                      
                }).catch(function(error){
                        console.log(error);
                });

                axios.get('MachineNames')
                        .then((Response)=>{  
                        this.machineNames = Response.data;                        
                }).catch(function(error){
                        console.log(error);
                });




                
        
        }

}
</script>