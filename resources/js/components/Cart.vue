<template>

<div>   <!--Inicio main--> 

<div class="container margin-app" v-if="$store.state.cartCount > 0" >  
 <div class="container mb-4 form">
  <div class ="row form-register"> <!-- Inicio Register-->
    <div class="col-12 form-detail-client">      
        
        <div class="page-header">
            <h5>Nuevo registro de solicitud</h5>      
        </div>

        <p v-if="errors.length" id="ErrorsLines">
            <b> Favor ingresar los siguientes campos: </b>
            <ul>
                <li v-for ="error in errors" :key="error">{{error}}</li>
            </ul>
        </p>
    <form>
        <div class="form-group row">
            <div class="col-sm-6">
                <label for="nombres">Nombres:</label>
                <input type="text" v-model="Nombres" class="form-control" placeholder="Nombres*" value="" required/>
            </div>
            <div class="col-sm-6">
                <label for="Apellidos">Apellidos:</label>
                <input type="text" v-model="Apellidos" class="form-control" placeholder="Apellidos *" value="" />
            </div>
        </div> 

        <div class="form-group row">
            <div class="col-sm-6">
                <label for="Telefono">Tel&eacute;fono:</label>
                <input type="number" v-model="Telefono" class="form-control" placeholder="Teléfono*" value="" />
            </div>

            <div class="col-sm-6">   <!-- Inicio form-right -->            
                <label for="Email">Correo Electr&oacute;nico:</label>
                <input type="email" v-model="Email" class="form-control" placeholder="ejemplo@ejemplo.com*" value="" />
            </div>
        </div>
 
        <div class="form-group row">
                
                <div class="col-sm-6">
                    <label for="rtn">Fecha Inicio Solicitud:</label>
                    <input type="date" 
                           class="form-control" value=""                           
                           v-model="FechaReq" 
                           v-on:change="checkDate()"/>
                </div>

                <div class="col-sm-6">
                    <label for="rtn">Fecha Fin Solicitud:</label>
                    <input type="date" 
                           class="form-control" value=""                           
                           v-model="FechaReqFin" 
                           v-on:change="checkDate()"/>
                </div>

        </div>  


        <div class="form-group row">
                <div class="col-sm-6">
                    <label for="Direccion">Ubicaci&oacute;n del proyecto:</label>
                    <input type="textarea" v-model="Direccion" class="form-control" placeholder="Dirección donde necesitará la maquinaria*" value="" />
                </div>
        </div>  

        </form>

     </div> <!-- Fin columan registro-->     
</div> <!-- Fin Register-->

    <div class="row cart">
        <div class="col-12 shopping-cart">
            <div class="page-header">
                <h4> Detalles de la solicitud</h4>      
            </div>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Maquinaria</th>
                            <th scope="col" class="text-center">Horas</th>
                            <th scope="col" class="text-right">Precio * hora</th>
                            <th scope="col" class="text-right">Subtotal</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(MaquinariaLocals,index) in MaquinariaLocal" :key="MaquinariaLocals.id_maquinaria">                            
                            <td>{{MaquinariaLocals.Nombre_maquinaria}}</td>
                            <td><input v-model.number="horasMinimas[index]" 
                                       type = "number"
                                       min = 1
                                       max  = 500  step=1
                                       class="form-control" 
                                       value="">
                            </td>
                                       
                            <td class="text-right">{{$store.state.Moneda}}                                
                                  <input type="number" 
                                       class="text-right"                                        
                                       v-model.number="precioHoraRow[index]"
                                       readonly> 
                            </td>                              
                            <td class="text-right">{{$store.state.Moneda}}
                                <input  type="number" 
                                        class="text-right" 
                                        v-model.number="subtotalRow[index]"
                                        readonly >
                            </td>
                            <td class="text-right">
                                <button class="btn btn-sm btn-danger"  
                                        @click.prevent="removeFromCart(MaquinariaLocals.id_maquinaria,index)">
                                    Eliminar
                                <i class="fa fa-trash"></i>
                                </button>
                            </td>
                         </tr>                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="text-right" colspan="3"><strong>Sub Total</strong></td>                            
                            <td class="text-right"><strong>{{$store.state.Moneda}}&nbsp;{{Number (Number(subTotalGeneral)).toFixed(2)}}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-right" colspan="3"><strong>Descuento</strong></td>                            
                            <td class="text-right"><strong>{{$store.state.Moneda}}&nbsp;0</strong></td>
                        </tr>
                        <tr>
                            <td class="text-right" colspan="3"><strong>ISV</strong></td>                            
                            <td class="text-right"><strong>{{$store.state.Moneda}}&nbsp;{{ Number( Number(subTotalGeneral) * 0.15 ).toFixed(2)  }}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-right" colspan="3"><strong>Total</strong></td>                            
                            <td class="text-right"><strong>{{$store.state.Moneda}}&nbsp;{{ Number( Number(subTotalGeneral) * 1.15).toFixed(2)  }}</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        
            <div class="col mb-2">                
                <label>**Observe que el precio por hora cambia dependiendo de la cantidad</label>                            
            </div>
        
        
        <div class="col mb-2">
            <div class="row">
                <div class="col-sm-12  col-md-6">
                  <router-link to="/Products"><button class="btn btn-block btn-light">Continuar Buscando</button> </router-link>
                </div>
                <div class="col-sm-12 col-md-6 text-right">
                    <button @click="ValidarFormulario" class="btn btn-lg btn-block btn-warning text-white text-uppercase">Solicitar Cotizaci&oacute;n</button>
                </div>
            </div>
        </div>
    </div>
  </div>  
</div>  <!--Fin main--> 

<div class="main-products no-encontrado" v-else>
      <div class='container'>
        <div class='text-center'>
          <h2>Tu carrito est&aacute; Vac&iacute;o</h2>
        </div>             
      </div>
 </div>
 <Footer/>
</div>
</template>

<script>
import Header from "./Layout/Header.vue";
import Header_1 from "./Layout/Header_1.vue";
import Footer from "./Layout/Footer.vue";
export default {
    components:{
        Header,
        Header_1,
        Footer
    },

    name :"cart",
     data(){
        return {
            MaquinariaLocal:[],
            saveMaquinaria:[],            
            errors :[],
            Localidades:[],
            storageMaquinaria:[],
            Nombres:null,
            Apellidos:null,
            Identidad:null,
            Telefono:null,
            Email:null,
            Direccion:null,
            selectLocalidad:null,        
            Rtn:null,
            FechaReq:new Date().toISOString().slice(0,10),
            FechaReqFin:new Date().toISOString().slice(0,10),            
            totalHorasMinimas:0
        }
    },
    mounted(){
            axios.get('Localidad').then((Response)=>{
                this.Localidades = Response.data;     
            }).catch(function(error){
                console.log(error);
            });

         // Obteniendo Id de los productos agregados al carrito en localStorage
             this.storageMaquinaria = localStorage.getItem('MaquinariaLocal');                                  

            if (this.storageMaquinaria != null) {
        // Se envian los ids de la maquinaria para obtener la otra información        
                 axios.post('ProductsCart',{data:this.storageMaquinaria})
                 .then((Response)=>{                         
                     // se almacena la informacion en un objeto de maquinariaLocal                 
                    this.MaquinariaLocal=Response.data;   
                }).catch(function(error){
                    console.log(error);
                });
            }else {
                console.log('No hay nada');
            };

    },
    computed:{        
        subtotalRow(){
                return this.MaquinariaLocal.map((MaquinariaLocals)=>{                    
                    var horasMinimaSelected = 0;

                    if(this.FechaReq<=this.FechaReqFin){
                        var fi = new Date(this.FechaReq);
                        var ff = new Date(this.FechaReqFin);
                    
                        var contdias = Math.round((ff-fi))/(1000*60*60*24);                    
                        contdias = (contdias == 0 ? 1 : contdias);

                        horasMinimaSelected = Number(contdias) * Number(MaquinariaLocals.Horas_minima) ;                    
                    }


                    if(horasMinimaSelected <= 44){
                       return Number( horasMinimaSelected * MaquinariaLocals.Precio_x_hora);
                    }else if (horasMinimaSelected > 44 && horasMinimaSelected <= 176){
                        return Number(horasMinimaSelected * MaquinariaLocals.precioHoraSemana);
                    }else{
                        return Number(horasMinimaSelected * MaquinariaLocals.precioHoraMes);
                    }

                });
            },
        precioHoraRow()
        {
            return this.MaquinariaLocal.map((MaquinariaLocals)=>{
                if(MaquinariaLocals.Horas_minima <= 44){
                    return Number(MaquinariaLocals.Precio_x_hora);
                }else if (MaquinariaLocals.Horas_minima > 44 && MaquinariaLocals.Horas_minima <= 176){
                    return Number(MaquinariaLocals.precioHoraSemana);
                }else{
                    return Number(MaquinariaLocals.precioHoraMes);
                }
            });           
                
        },
        subTotalGeneral() 
        {
          return this.MaquinariaLocal.reduce((total,MaquinariaLocals) => {
                var horasMinimaSelected = 0;

                if(this.FechaReq<=this.FechaReqFin){
                    var fi = new Date(this.FechaReq);
                    var ff = new Date(this.FechaReqFin);
                    
                    var contdias = Math.round((ff-fi))/(1000*60*60*24);                    
                    contdias = (contdias == 0 ? 1 : contdias);

                    horasMinimaSelected = Number(contdias) * Number(MaquinariaLocals.Horas_minima) ;                    
                }


            if(horasMinimaSelected <= 44){
                return total + Number( horasMinimaSelected * MaquinariaLocals.Precio_x_hora);
            }else if (horasMinimaSelected > 44 && horasMinimaSelected <= 176){
                return total + Number( horasMinimaSelected * MaquinariaLocals.precioHoraSemana);
            }else{
                return total + Number( horasMinimaSelected * MaquinariaLocals.precioHoraMes );
            }

          }, 0);
        },
        horasMinimas(){
            return this.MaquinariaLocal.map((MaquinariaLocals)=>{
                
                if(this.FechaReq<=this.FechaReqFin){
                    var fi = new Date(this.FechaReq);
                    var ff = new Date(this.FechaReqFin);
                    
                    var contdias = Math.round((ff-fi))/(1000*60*60*24);                    
                    contdias = (contdias == 0 ? 1 : contdias);

                    return Number( Number(contdias) * Number(MaquinariaLocals.Horas_minima) );
                    
                }

            });
        }
            
    },
    methods:{
            removeFromCart(idmaquinariaremove,index){
                this.$swal({
                    title:'Estas seguro de eliminar?',
                    type:'warning',
                    showCancelButton:true,
                    confirmButtonColor:'#d33',
                    cancelButtonColor: '#919191'             
                }).then((result)=>{
                    if (result.value){
                        this.$swal('Eliminada',
                                   'Maquinaria Eliminada',
                                   'success')

                        this.$store.commit('removeFromCart',idmaquinariaremove);
                        this.MaquinariaLocal.splice(index,1);
                    }
                });
            },

            ValidarFormulario:function (e){
                if (this.Nombres && 
                     this.Apellidos &&                     
                     this.Telefono &&
                     this.Email &&                    
                     this.Direccion && (this.FechaReq <= this.FechaReqFin))
                     {                         
                        this.GuardarFormulario();                        
                     }

                     this.errors=[];

                     if (!this.Nombres){
                         this.errors.push('Nombre es requerido');
                         window.scrollTo(0,'ErrorsLines');  
                     }

                     if (!this.Apellidos){
                         this.errors.push('Apellidos es requerido');
                         window.scrollTo(0,'ErrorsLines');                         
                     }

                     if (!this.Telefono){
                         this.errors.push('Telefono es requerido');
                         window.scrollTo(0,'ErrorsLines');  
                     }

                      if (!this.Email){
                         this.errors.push('Email es requerido');
                         window.scrollTo(0,'ErrorsLines');  
                     }
                    
                     if (!this.Direccion){
                         this.errors.push('Dirección es requerido');
                         window.scrollTo(0,'ErrorsLines');  
                     }
                     
                     if (this.FechaReq > this.FechaReqFin){
                         this.errors.push('La fecha final no debe ser menor que la fecha inicial');
                         window.scrollTo(0,'ErrorsLines');  
                     }
                     e.preventDefault();
            },
            
            GuardarFormulario(){                 
              const idfactura=0;
              axios.post('SaveCart',{
                    Nombres: this.Nombres,
                    Apellidos :this.Apellidos,
                    Telefono:  this.Telefono,
                    Email:      this.Email,
                    FechaReq:    this.FechaReq,
                    FechaReqFin: this.FechaReqFin,                    
                    Departamento: this.$store.state.itemLocalidad,
                    Direccion: this.Direccion,
                    Maquinarias : JSON.stringify(this.MaquinariaLocal)                    
                }).then((response)=>{
                    console.log(this.MaquinariaLocal);
                    this.$store.state.IdFactura = response.data;    
                    this.$store.commit('DeleteLocalStorage'); //limpio el localStorage (carrito)                
                    this.$router.push({name:'Confirmation'});       
                }).catch(function(error){
                    console.error(error);
                });
             
               
            }, 
            
            checkDate: function(evt){
                
                var today = new Date().toISOString().slice(0,10);                

                if ( this.FechaReq < today )
                    this.FechaReq = new Date().toISOString().slice(0,10);
                else if (this.FechaReq > this.FechaReqFin)
                    evt.preventDefault();
                                     
                if ( this.FechaReqFin < today )
                    this.FechaReqFin = new Date().toISOString().slice(0,10);
                else if(this.FechaReqFin < this.FechaReq)
                    evt.preventDefault();
            },
            
            isNumber: function(evt) {
                evt = (evt) ? evt : window.event;
                var charCode = (evt.which) ? evt.which : evt.keyCode;
                if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46   ) {
                    evt.preventDefault();
                } else {
                    return true;
            }
    }

  }    
}
</script>