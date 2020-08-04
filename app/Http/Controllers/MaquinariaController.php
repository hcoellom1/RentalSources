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
        $cart = json_decode(Request("data"));
            
        $MaquinariaCart = Maquinaria::select('maquinarias.id_maquinaria',
                                             'maquinarias.Nombre_maquinaria',
                                             'maquinarias.Precio_x_hora',
                                             'maquinarias.precioHoraMes',
                                             'maquinarias.precioHoraSemana',
                                             'maquinarias.Horas_minima',
                                             'maquinarias.imagen')                                          
                                          ->whereIn('maquinarias.id_maquinaria',$cart)
                                          ->get();

        return($MaquinariaCart);                                          
             
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
         $emailOwner            = $request->input('emailOwner');
         
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
                            "precioHoraMes" => $PrecioMes,
                            "precioHoraSemana" => $PrecioSemana,
                            "Correo_Electronico" => $emailOwner
         ]);
                 
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
                                                 'maquinarias.precioHoraMes',
                                                 'maquinarias.precioHoraSemana',
                                                 'maquinarias.Descripcion_maquinaria',
                                                 'localidads.Nombre_localidad',
                                                 'maquinarias.imagen')                               
                               ->join('localidads','maquinarias.id_localidad','=','localidads.Id_localidad')                              
                               ->whereIn('maquinarias.id_localidad',$Localidades)
                               ->whereIn('maquinarias.id_tipo_maquinaria',$TipoMaquinaria)
                               ->get();
      
        return ($Maquinaria);
        
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

    public function showMyMaquinaria($mailOwner)
    {
    
        $Maquinaria = Maquinaria::select('maquinarias.id_maquinaria',
                                         'maquinarias.Nombre_maquinaria',
                                         'maquinarias.Descripcion_maquinaria',
                                         'tipo_maquinarias.Tipo_maquinarias',
                                         'maquinarias.Operacion',
                                         'localidads.Nombre_localidad',
                                         'maquinarias.Precio_x_Hora',
                                         'maquinarias.precioHoraSemana',
                                         'maquinarias.precioHoraMes')                               
                               ->join('localidads','maquinarias.id_localidad','=','localidads.Id_localidad')
                               ->join('tipo_maquinarias','maquinarias.Id_tipo_maquinaria','=','tipo_maquinarias.Id_tipo_maquinaria')
                               ->where('maquinarias.Correo_Electronico',$mailOwner)                               
                               ->get();                               
                 
        return($Maquinaria);
    }
}
