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
use DateTime;

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
        $Fecha = new DateTime($request->input('FechaReq'));
        $FechaFin = new DateTime($request->input('FechaReqFin'));
        $Departamento = $request->input('Departamento'); 
        $Direccion = $request->input('Direccion');
        $Maquinarias = json_decode($request->input('Maquinarias'),true);
        
        $idSolicitud=0;
        $TotalFactura =0;

        $diffDates = date_diff( $Fecha, $FechaFin )->format('%d');
        $totalHours = 0;

        foreach($Maquinarias as $Maqui){
            $totalHours = $Maqui["Horas_minima"]*$diffDates;

            if (  $totalHours  <= 44)
                $TotalFactura += $Maqui["Precio_x_hora"] * $totalHours;
            else if($totalHours > 44 && $totalHours <= 176)
                $TotalFactura += $Maqui["precioHoraSemana"] * $totalHours;
            else
                $TotalFactura += $Maqui["precioHoraMes"] * $totalHours;
                     
        }
                
        $idSolicitud = DB::table('Solicituds')->insertGetId(["Fecha_solicitud"=>$Fecha,
                                                             "fecha_Fin_Solicitud"=> $FechaFin,
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
                                                      $obj["Horas_minima"] * $diffDates,
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

        //Comment temporaly
        $this->sendMails($request, $idSolicitud); //Send mails for request
            
        return $idSolicitud;
        
    }
    public function show($id)
    {        
        $Solicitud = Solicitud::select('solicituds.id_solicitud',
                              'solicituds.fecha_registro',
                              'solicituds.fecha_Fin_Solicitud',
                              'solicituds.Subtotal',                                            
                              'detallesolicitud.horas',
                              'maquinarias.Nombre_maquinaria',                              
                              DB::raw('(CASE 
                                    WHEN detallesolicitud.horas <= 44 THEN maquinarias.Precio_x_hora
                                    WHEN detallesolicitud.horas > 44 AND detallesolicitud.horas <= 176 THEN maquinarias.precioHoraSemana
                                    WHEN detallesolicitud.horas > 176 THEN maquinarias.precioHoraMes
                                END) as precioHora'))
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
                      ->join('personas', 'maquinarias.Correo_electronico', '=', 'personas.Correo_Electronico')
                      ->join('detallesolicitud', 'detallesolicitud.id_maquinaria', '=', 'maquinarias.id_maquinaria')
                      ->join('solicituds','detallesolicitud.id_solicitud','=', 'solicituds.id_solicitud')
                      ->select('maquinarias.Nombre_maquinaria', 'personas.telefono', 'personas.Correo_Electronico',
                               'personas.Nombre', 'personas.apellidos','solicituds.Fecha_solicitud', 
                               'solicituds.direccionProyecto', 'detallesolicitud.Horas')
                      ->where([
                                ['personas.tipoPersona','OM'],
                                ['detallesolicitud.id_solicitud', '=', $idSolicitud]                               
                             ])
                      ->get();
        
        //Send mail to client
        /*Mail::to($request->getEmail())                        
            ->send(new MessageReceived($request, null, 'RQ', $idSolicitud));
            */
        
        //Send mail to rental
        /*
        Mail::to('rental.hn@gmail.com')                    
             ->send(new MessageReceived($request, $machines, 'IQ', $idSolicitud));*/

        //Send mail to owners machine
        /*
        foreach($machines as $machine){
            Mail::to($machine->Correo_Electronico)                    
             ->send(new MessageReceived(null, $machine, 'OM', $idSolicitud));
        }
        */
    }

    
}
