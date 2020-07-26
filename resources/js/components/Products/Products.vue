<template  >
<div class="main-products" >
<div class="row"> 
  <div class="col-md-2 left-nav">
     <div class='Mod-view text-right'>
      <a class="list-icon  cursor-pointer" v-bind:class="{ 'active': layout == 'list'}" v-on:click="layout = 'list'">
          <i class="material-icons">list</i>
      </a>
      <a class="grid-icon cursor-pointer" v-bind:class="{ 'active': layout == 'grid'}" v-on:click="layout = 'grid'">
          <i class="material-icons">apps</i>
        </a>       
     </div>
     <div class = "Filters-left">
       <div id='Localidades'>
        <h6>Localidades</h6>
         <li v-for="localidades in localidades" :key="localidades.id_localidad">
            <input type="checkbox" v-on:change="GetProductos(BuscarLocalidades,BuscarTipoMaquinaria)" :id="localidades.id_localidad" :value="localidades.id_localidad" v-model="BuscarLocalidades">        
            <label>{{localidades.nombre_localidad}}</label>
         </li>               
       </div>
    <div id='Tipo_Maquinaria'>
        <h6>Tipo Maquinaria</h6>
         <li v-for="TipoMaquinaria in TipoMaquinaria" :key="TipoMaquinaria.Id_tipo_maquinaria">
            <input type="checkbox" v-on:change="GetProductos(BuscarLocalidades,BuscarTipoMaquinaria)" :id="TipoMaquinaria.Id_tipo_maquinaria" :value="TipoMaquinaria.Id_tipo_maquinaria" v-model="BuscarTipoMaquinaria">        
            <label>{{TipoMaquinaria.Tipo_maquinarias}}</label>
         </li>                
       </div>
    <div id='Tipo_Accion'>
        <h6>Acción</h6>
         <li>
            <input type="checkbox" id="Renta" value="Renta">        
            <label>Renta</label>
         </li>   
        <li>
            <input type="checkbox" id="Venta" value="Venta">        
            <label>Venta</label>
         </li>   
    </div>

     </div>
   </div>   
<div class="col-md-10" v-if="Maquinarias.length > 0">  
<div class=" ">
    <ul v-if="layout == 'grid'" class="grid">        
     <li v-for="Maquinarias in Maquinarias" :key="Maquinarias.id_maquinaria">
         <div class="product"> 
           <div class='product-body'>
              <div class='product-title'>
                      <h6>{{Maquinarias.Nombre_maquinaria}}</h6>                      
              </div>
              <div class='Ubicacion'>
                <a :href="'https://www.google.com/maps/search/?api=1'+Maquinarias.Nombre_localidad">{{Maquinarias.Nombre_localidad}}</a>
              </div>  
           <div class ='product-img'>
              <img class='zoom' :src ="Maquinarias.imagen">
            </div>         
          <div class ='product-shop'>
                <div class="price-wrap h4">
                  <span class="price">{{$store.state.Moneda}}&nbsp;{{Maquinarias.Precio_x_Hora}} </span>
                  </div> <!-- info-price-detail // -->
                  <p class="text-warning">precio/hora</p>
                  <br>
                  <p>
                    <a  class="btn btn-warning text-white" 
                    @click='AddMaquinariaLocal(Maquinarias.id_maquinaria)'> 
                     Añadir 
                    </a>
                    <a  class="btn btn-secondary" @click="MostrarDetalles(Maquinarias.id_maquinaria)">
                       Detalles
                       </a>
                  </p>
             </div>   <!--Fin Product Shop -->  
        </div><!-- Fin Product Body !-->        
      </div> <!-- Fin Product !-->                 
     </li>
    </ul>

      <ul v-if="layout == 'list'" class="list"> <!-- Modo Lista-->
        <!-- A compact view smaller photos and titles -->
        <li v-for="Maquinarias in Maquinarias" :key="Maquinarias.id_maquinaria">
          <div class ='product col-md-12'> <!--Inicio Product -->
          <div class='row product-body'>
            <div class ='product-img col-sm-3'>
              <img class='zoom' :src ="Maquinarias.imagen">
            </div>
                <div class ='product-detail col-sm-5'>
                   <div class='product-title'>
                      <h5>{{Maquinarias.Nombre_maquinaria}}</h5>
                      <a> {{Maquinarias.Nombre_localidad}}</a>
                    </div>
                        <div class='product-text'>
                         <p><br>{{Maquinarias.Detalles_maquinaria}}</p> 
                         </div>
            </div>
            <div class ='product-shop col-sm-4'>
                <div class="price-wrap h4">
                    <span class="price">{{$store.state.Moneda}}&nbsp;{{Maquinarias.Precio_x_Hora}} </span>
                  </div> <!-- info-price-detail // -->
                  <p class="text-warning">precio/hora</p>
                  <br>
                  <p>
                    <a  class="btn btn-warning text-white" 
                    @click='AddMaquinariaLocal(Maquinarias.id_maquinaria)'> 
                     Añadir 
                    </a>
                  </p>
             </div>   <!--Fin Product Shop -->  
            </div>    <!--Fin Product body -->  
        </div>      <!--Fin Product -->

        </li>
    </ul>

  </div>   <!--Fin Container--> 
</div>
<div class="main-products no-encontrado" v-else>
      <div class='container'>
        <div class='text-center'>
          <h2>Lo sentimos no hemos encontrado nada en tu búsqueda</h2>
        </div>             
      </div>
</div>
</div> <!-- Fin Row Details --> 
<Footer/>
</div> <!-- Main Product !-->


</template>

<script>

import Header from "../Layout/Header.vue";
import Header_1 from "../Layout/Header_1.vue";
import Footer from "../Layout/Footer.vue";

import { parse } from 'path';
import { WSASERVICE_NOT_FOUND } from 'constants';
export default {
  name:'Products',
  components:{
        Header,
        Header_1,
        Footer
  },
  mounted(){
      axios.post('Products',{
                            localidad:this.BuscarLocalidades,
                            tipoMaquinaria:this.BuscarTipoMaquinaria})
                    .then((response) => {
                        this.Maquinarias = response.data.Maquinaria;
                        console.log(this.Maquinarias);
                    }).catch(function(error){
                      console.log(error);
                    });
  },
  created(){
     axios.get('Localidad').then((Response)=>{
                     this.localidades = Response.data;      
                     }).catch(function(error){
                        console.log(error);
                     });;
  
     axios.get('AllTipoMaquinaria').then((Response)=>{
                     this.TipoMaquinaria = Response.data;    
                     }).catch(function(error){
                        console.log(error);
                     });
  

  },
  methods:{

    GetProductos(BuscarLocalidades,BuscarTipoMaquinaria){
      
     axios.post('Products',{localidad:this.BuscarLocalidades,
                                 tipoMaquinaria:this.BuscarTipoMaquinaria})
                    .then((response) => {
                        this.Maquinarias = response.data.Maquinaria
                    });
                   
    },

    LocalidadSeleccionada(idLocalidad){
      /*console.log(idLocalidad);*/
      /*console.log(this.$store.state.itemLocalidad);*/
        if (idLocalidad == this.$store.state.itemLocalidad){                  
          return "checkSelected";
        }else{
          return false;
        }
         ;
    },
    
      AddMaquinariaLocal(idmaquinarialocal){
           let ValidateMaquinaria =localStorage.getItem('MaquinariaLocal');
           let found =-1;
            
            //Validar si se encuentran maquinarias dentro de localstorage
            if (ValidateMaquinaria !=null){
              found = ValidateMaquinaria.indexOf(idmaquinarialocal);
            }
          
            // si la maquinaria ya esta agregada en el localstorage
          if (found>=0){
              this.$swal('No Agregado','Maquinaria ya se encuentra en el carrito','warning');
            }
            else
            {
            this.$store.commit ('saveCartLocal',idmaquinarialocal);  
            this.$swal('Agregado al Carrito','Maquinaria Agregada','success');                
            }
         
      },

      // Looking for rental machine conditions
      MostrarDetalles(idMaquinaria){          
          axios.get('MachineConditions/'+ idMaquinaria)
                     .then((response) => {this.Conditions = response.data.Conditions;  
                                          
                     let detailConditions = '<ul>';
                     let countConditions = this.Conditions.length;

                     for(var i = 0; i<countConditions; i++){
                        detailConditions = detailConditions + '<li>' + this.Conditions[i].descripcion + '</li>';                  
                     } 

                     detailConditions = detailConditions + '</ul>';
                     
                     // Modal con
                     this.$swal({
                                html:detailConditions,
                                title:'Condiciones de Renta'});

                     }).catch(function(error){
                       console.log(error);
                     });
              
    }      

  },
  data(){
    
    return{
          Maquinarias:[],
          MaquinariasLocal:[],
          localidades:[],
          TipoMaquinaria:[],          
          BuscarLocalidades:[this.$store.state.itemLocalidad],
          BuscarTipoMaquinaria:[this.$store.state.itemTipoMaquinaria],
          BuscarMaquinarias:[],
          BuscarAccion:[],
          Message:'',
          layout:'grid',
          Moneda:this.$store.state.Moneda, 
          Conditions:[]
    }
      
  }
}
</script>