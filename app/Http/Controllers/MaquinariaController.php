<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Maquinaria;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use function Psy\info;

class MaquinariaController extends Controller
{
    public function index($LocalMaquinaria)
    {   /*
        Log::debug($LocalMaquinaria);
        $MaquinariaCart =Maquinaria::whereIn('id_maquinaria',$LocalMaquinaria)->get();
        
        return response()->json([
            "MaquinariaCart"=> $MaquinariaCart
        ],200);
        */

    }

    public function getMaquinaria(Request $request){
            //$LocalMaquinaria = array_keys($request->all());
           $cart = json_decode(Request("data"));
            //$data = $request->all();           
            $MaquinariaCart = Maquinaria::select('maquinarias.id_maquinaria',
                                                 'maquinarias.Nombre_maquinaria',
                                                 'maquinarias.Precio_x_hora',
                                                 'maquinarias.Horas_minima',
                                                 'maquinarias.imagen')                                          
                                          ->whereIn('maquinarias.id_maquinaria',$cart)
                                          ->get();

            return($MaquinariaCart);                                          
            /*
            return response()
            ->json([
                "Maquinaria" => $MaquinariaCart
            ],200);
            */
    }

    
    public function create()
    {
        
    }

    /**
     * Perform store new machine in databasse
     *  */    
    public function store(Request $request)
    {                    
         $Nombre                = $request->input('nombreMaquinaria');
         $Descripcion           = $request->input('descripcionMaquinaria');
         $Precio                = $request->input('precioHoraMaquinaria');
         $PrecioSemana          = $request->input('precioMaquinaSemana');
         $PrecioMes             = $request->input('precioMaquinaMes');
         $Tipo                  = $request->input('tipoMaquinaria');
         $Localidad             = $request->input('localidadMaquinaria');
         $Accion                = $request->input('queDeseaMaquinaria');
         $imagen                = $request->get('imagen');
         $imgNombre             = $request->get('imgNombre');
         $condicionesMaquinaria = $request->input('machineConditions');
         
         $DirImagen   = ('images/').$imgNombre;

         $idNewMachine = DB::table('maquinarias')->insertGetId([
                            "Nombre_Maquinaria"=>$Nombre, 
                            "Descripcion_Maquinaria"=>$Descripcion,
                            "Disponibilidad"=>'SI',
                            "Precio_x_Hora" => $Precio,
                            "Operacion" => $Accion,
                            "Latitud" => 0,
                            "Longitud" => 0,
                            "Estado" => 'ACTIVO',
                            "Id_Localidad" => $Localidad,
                            "Identidad" => 0,
                            "Id_tipo_maquinaria" => $Tipo,
                            "Horas_Minima" => 1,
                            "Imagen" => $DirImagen,
                            "precioMes" => $PrecioMes,
                            "precioSemana" => $PrecioSemana
         ]);
                         
            
         /*'insert into maquinarias (Nombre_Maquinaria, Descripcion_Maquinaria, Disponibilidad,
                                    Precio_x_Hora,Operacion,Latitud,Longitud,Estado,
                                    Id_Localidad,Identidad,Id_tipo_maquinaria,Horas_Minima,Imagen)
                                    values(?,?,?,?,?,?,?,?,?,?,?,?,?)',
                                    [$Nombre,$Descripcion,'SI',$Precio,$Accion,
                                    0,0,'ACTIVO',$Localidad,0,$Tipo,1,$DirImagen]);*/
        
        //For each conditions checked for new machine, store in table condicionesmaquinaria
        foreach($condicionesMaquinaria as $condition ){
            DB::insert('insert into condicionesmaquinaria (codigoCondicion,codigoMaquina)
                                                           values(?,?)',
                                                          [$condition, $idNewMachine]);
        }                                   

        //Store image on disk
        if($request->get('imagen')){       
            \Image::make($request->get('imagen'))->save(public_path($DirImagen));                
            return response()->json(['success' =>  $DirImagen], 200);
        }
         
    }

    /**
     * Perform action for return all machines
     */
    public function show(Request $request)
    {
        $Localidades=($request->localidad);
        $TipoMaquinaria=($request->tipoMaquinaria);
        
        $Maquinaria = Maquinaria::select('maquinarias.id_maquinaria',
                                                 'maquinarias.Nombre_maquinaria',
                                                 'maquinarias.Precio_x_Hora',
                                                 'maquinarias.precioMes',
                                                 'maquinarias.precioSemana',
                                                 'maquinarias.Descripcion_maquinaria',
                                                 'localidads.Nombre_localidad',
                                                 'maquinarias.imagen')                               
                               ->join('localidads','maquinarias.id_localidad','=','localidads.Id_localidad')                              
                               ->whereIn('maquinarias.id_localidad',$Localidades)
                               ->whereIn('maquinarias.id_tipo_maquinaria',$TipoMaquinaria)
                               ->get();
      
        return response()->json([
            "Maquinaria" => $Maquinaria
        ],200);
        
    }

    
    public function edit($id)
    {
        
    }

   
    public function update(Request $request, $id)
    {
        
    }

   
    public function destroy($id)
    {
        
    }
}
