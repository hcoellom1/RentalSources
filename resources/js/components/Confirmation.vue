<template>
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
                                    <td>{{datafactura[0].id_solicitud}}</td>
                                </tr>
                                <tr>
                                    <td>Fecha de Solicitud</td>
                                    <td>{{datafactura[0].fecha_registro}}</td>
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
                                <th>Precio por hora</th>
                                <th>Horas</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for = "Factura in datafactura" :key="Factura.Nombre_Maquinaria"
                                v-bind:value="Factura.Nombre_Maquinaria">
                                <td class="w-3">{{Factura.Nombre_maquinaria}}</td>                                
                                <td class="w-3">{{$store.state.Moneda}}&nbsp;{{Factura.Precio_x_Hora}}</td>
                                <td class="w-2">{{Factura.horas}}</td>
                                <td class="w-4">{{$store.state.Moneda}}&nbsp;{{Factura.horas * Factura.Precio_x_Hora}}</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3">Sub Total</td>
                               <td>{{$store.state.Moneda}}&nbsp;{{datafactura[0].Subtotal}}</td>
                            </tr>
                            <tr>
                                <td colspan="3">Descuento</td>
                                <td>{{$store.state.Moneda}}&nbsp;0</td>
                            </tr>
                            <tr>
                                <td colspan="3">Gran Total</td>
                                <td>{{$store.state.Moneda}}&nbsp;{{datafactura[0].Subtotal}}</td>
                            </tr>
                        </tfoot>
                    </table>
             </div>
            </div> <!--Fin Document Header Factura!-->

         </div> <!--Fin Panel Factura!-->      
    </div> <!--Fin div Inicial!-->
</template>
<script type="text/javascript">
    export default {
    name :"cart",
     data(){
        return {
            datafactura:[]
        }
       },
       mounted(){
            
            if (this.$store.state.IdFactura != 0 ){
                    console.log(this.$store.state.IdFactura);                
            axios.get('api/Solicitud/'+this.$store.state.IdFactura).then((Response)=>{
                     this.datafactura = Response.data; 
                     console.log(this.datafactura);   
                     }).catch(function(error){
                         console.log(error);
                     });    
            }else{
                console.log('No hay idFactura');
            } 
                    
       },
       methods:{
            viewFactura(){
                this.$router.push({name:'Home'});
                //window.print();
            }

       }

    }
</script>