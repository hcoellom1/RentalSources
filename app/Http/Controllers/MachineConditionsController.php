<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class MachineConditionsController extends Controller
{
    //

    public function show($idMachine)
    {
        
        $machineConditions = DB::table('condicionesrenta')
                                ->select('descripcion')                                                     
                                ->join('condicionesmaquinaria', 'condicionesrenta.codigocondicion', '=', 'condicionesmaquinaria.codigocondicion')
                                ->where('condicionesmaquinaria.codigomaquina', '=', $idMachine)
                                ->get();

        return response()->json([
                                "Conditions" => $machineConditions
                                ],200);

    }
}
