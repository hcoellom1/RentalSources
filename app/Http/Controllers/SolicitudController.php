<?php

namespace App\Http\Controllers;

use App\Maquinaria;
use App\Solicitud;
use App\Mail\MessageReceived;

use App\CustomClasses\ClientRequest;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

use SebastianBergmann\Environment\Console;

use function Psy\info;

class SolicitudController extends Controller
{

    public $request;
    
    public function index()
    {
        
    }
    public function create()
    {
        
    }

    /**
     * Save on database request, request detail, customer information
     */
    public function store(Request $request)
    {   
        $Nombres = $request->input('Nombres');
        $Apellidos = $request->input('Apellidos');
        $Telefono = $request->input('Telefono');
        $Email = $request->input('Email');
        $Fecha = $request->input('FechaReq');
        $Departamento = $request->input('Departamento'); 
        $Direccion = $request->input('Direccion');
        $Maquinarias = json_decode($request->input('Maquinarias'),true);
        
        $idSolicitud=0;
        $TotalFactura =0;

        foreach($Maquinarias as $Maqui){
            //precioHoraRow $TotalFactura+= $Maqui["Precio_x_hora"]*$Maqui["Horas_minima"];
            $TotalFactura+= $Maqui["Precio_x_hora"]*$Maqui["Horas_minima"];
        }
                
        $idSolicitud = DB::table('Solicituds')->insertGetId(["Fecha_solicitud"=>$Fecha,
                                                "Localidad"=>$Departamento,
                                              "Estado"=>"ACTIVO",
                                              "Subtotal"=>$TotalFactura,
                                              "direccionProyecto"=>$Direccion,
                                              "estadoSolicitud" => "P"]);
                                   
        foreach($Maquinarias as $obj){
            DB::insert('insert into detallesolicitud(id_solicitud,
                                                     id_maquinaria,
                                                     horas,
                                                     estado)
                                                     values(?,?,?,?)',
                                                     [
                                                      $idSolicitud,
                                                      $obj["id_maquinaria"],
                                                      $obj["Horas_minima"],
                                                      'ACTIVO'
                                                    ]);
        }
                
        DB::insert('insert into personas(Nombre,Apellidos,Telefono,Correo_Electronico,
                                         Estado,tipoPersona)
                                        values(?,?,?,?,?,?)',
                                        [$Nombres,$Apellidos,$Telefono,$Email,                                         
                                         'ACTIVO','CLI']);
    
        $request = new ClientRequest(date('Y/m/d'), 
                                     $Departamento, $Nombres.'|'.$Apellidos, 
                                     $Direccion, $Telefono, $Email);

        $this->sendMails($request, $idSolicitud); //Send mails for request
            
        return $idSolicitud;
        
    }
    public function show($id)
    {
        
        $Solicitud = Solicitud::select('solicituds.id_solicitud',
                                       'solicituds.fecha_registro',
                                       'solicituds.Subtotal',                                            
                                       'detallesolicitud.horas',
                                       'maquinarias.Precio_x_Hora',
                                       'maquinarias.Nombre_maquinaria')
                              ->Join('detallesolicitud','Solicituds.id_solicitud','=','detallesolicitud.id_solicitud')                              
                              ->Join('maquinarias','detallesolicitud.id_maquinaria','=','maquinarias.id_maquinaria')                                     
                              ->where('solicituds.id_solicitud',$id)                                     
                              ->get();


       return($Solicitud);
       
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {        
    }

    public function destroy($id)
    {        
    }


    /**
     * Function for send diferent mails
     * mail to owner machines
     * mail to rental office
     * mail to client
     */
    private function sendMails($request, $idSolicitud){
        $machines = DB::table('maquinarias')
                      ->join('personas', 'maquinarias.Identidad', '=', 'personas.Identidad')
                      ->join('detallesolicitud', 'detallesolicitud.id_maquinaria', '=', 'maquinarias.id_maquinaria')
                      ->join('solicituds','detallesolicitud.id_solicitud','=', 'solicituds.id_solicitud')
                      ->select('maquinarias.Nombre_maquinaria', 'personas.telefono', 'personas.Correo_Electronico',
                               'personas.Nombre', 'personas.apellidos','solicituds.Fecha_solicitud', 
                               'solicituds.direccionProyecto')
                      ->where('detallesolicitud.id_solicitud', '=', $idSolicitud)
                      ->get();
        
        //Send mail to client
        Mail::to($request->getEmail())                        
            ->send(new MessageReceived($request, null, 'RQ', $idSolicitud));
        
        //Send mail to rental
        Mail::to('rental.hn@gmail.com')                    
             ->send(new MessageReceived($request, $machines, 'IQ', $idSolicitud));

        //Send mail to owners machine
        foreach($machines as $machine){
            Mail::to($machine->Correo_Electronico)                    
             ->send(new MessageReceived(null, $machine, 'OM', $idSolicitud));
        }
    }

    
}
