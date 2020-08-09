<template>
  <div>
      <Header/>

  <div class="container Factura">
  
        
        <div class="alert alert-success" role="alert">          
          <h4 class="alert heading">Solicitud Confirmada</h4>          
          <p>Su solicitud se ha ingresado correctamente, gracias por preferirnos.</p>
       </div>

        <div class="panel-heading">
                <span class="panel-title">Seguir buscando</span> <!-- Numero de Factura !-->
            <div class='Acciones'>
                <a class="grid-icon cursor-pointer" v-on:click="viewFactura()">
                    <i class=material-icons>print</i>
                </a>
            </div>
        </div>

        <div class="panel-body">
            <div class="document">
                <div class="row">
                    
                    <div class="col-6 col-offset-12">
                         <table class="document-summary">
                            <tbody>
                                <tr>
                                    <td colspan="2">
                                        <span class="document-title">Detalle de Solicitud</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Número Solicitud</td>                                    
                                    <td>{{idSolicitudGet}}</td>
                                </tr>
                                <tr>
                                    <td>Fecha inicio de renta: </td>
                                    <td>{{ fechaSolicitudGet }}</td>
                                </tr>
                                
                                <tr>
                                    <td>Fecha final de renta:</td>
                                    <td> {{ fechaFinSolicitudGet }} </td>
                                </tr>
                                                         
                            </tbody>
                        </table>
                    </div> <!--Fin Tabla Derecha!-->


              </div> <!--Fin Row Header Factura!-->
              <br>
              <div class="document-body">
                   <table class="table document-table">
                        <thead>
                            <tr>
                                <th>Maquinaria</th>
                                <th>Horas</th>
                                <th>Precio por hora</th>                                
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for = "Factura in datafactura" :key="Factura.Nombre_Maquinaria"
                                v-bind:value="Factura.Nombre_Maquinaria">
                                <td class="w-3">{{Factura.Nombre_maquinaria}}</td>
                                <td class="w-2">{{Factura.horas}}</td>
                                <td class="w-3">{{$store.state.Moneda}}&nbsp;{{ Factura.precioHora }}</td>
                                <td class="w-4">{{$store.state.Moneda}}&nbsp;{{ Factura.horas * Factura.precioHora }}</td>                                
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3">Sub Total</td>                                
                                <td>{{$store.state.Moneda}}&nbsp;{{ subTotalCalculated }}</td>
                                
                            </tr>
                            <tr>
                                <td colspan="3">Descuento</td>
                                <td>{{$store.state.Moneda}}&nbsp;0</td>
                            </tr>
                            <tr>
                                <td colspan="3">ISV</td>
                                <td>{{$store.state.Moneda}}&nbsp;{{ impuesto }}</td>
                            </tr>
                            <tr>
                                <td colspan="3">Gran Total</td>
                                <td>{{$store.state.Moneda}}&nbsp;{{ totalGeneral  }}</td>
                            </tr>
                        </tfoot>
                    </table>
             </div>
            </div> <!--Fin Document Header Factura!-->

         </div> <!--Fin Panel Factura!-->      
    </div> <!--Fin div Inicial!-->

    </div>
</template>

<script type="text/javascript">

import Header from "./Layout/Header.vue";
import Header_1 from "./Layout/Header_1.vue";
import Footer from "./Layout/Footer.vue";

    export default {
        components:{
            Header,
            Header_1,
            Footer
    },

    name :"confirmation",
     data(){
        return {
            datafactura:[],
            subTotalCalculated:0,
            impuesto:0,
            totalGeneral:0,
            idSolicitudGet: ' ',
            fechaSolicitudGet: ' ',
            fechaFinSolicitudGet: ' ',
            totalHorasSolicitadas: 0
        }
       },
       mounted(){
            
            if (this.$store.state.IdFactura != 0 ){
                    console.log(this.$store.state.IdFactura);                
                    axios.get('Solicitud/'+this.$store.state.IdFactura).then((Response)=>{
                         this.datafactura = Response.data;                          
                         
                         this.subTotalCalculated = this.datafactura[0].Subtotal;
                         this.idSolicitudGet  =  this.datafactura[0].id_solicitud;

                         this.fechaSolicitudGet = new Date(this.datafactura[0].fecha_registro).toISOString().slice(0,10); 
                         this.fechaFinSolicitudGet = new Date(this.datafactura[0].fecha_Fin_Solicitud).toISOString().slice(0,10);
                         
                         this.impuesto = Number ( Number(this.subTotalCalculated) * 0.15);
                         this.totalGeneral = Number( Number(this.impuesto) + Number(this.subTotalCalculated) ).toFixed(2);
                         
                    }).catch(function(error){
                         console.log('No hay datos en factura');
                         console.log(error);
                     });    
            }else{
                console.log('No hay idFactura');
                this.$router.push({name:'Home'});
            } 
                    
       },
       methods:{
            viewFactura(){
                //this.$router.push({name:'Home'});
                window.print();
            }

       }

    }
</script>