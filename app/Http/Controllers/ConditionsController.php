<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class ConditionsController extends Controller
{
    //
    public function show(){
        $conditions = DB::table('condicionesrenta')
                        ->select('condicionesrenta.codigoCondicion', 'condicionesrenta.descripcion')                        
                        ->where('condicionesrenta.estatus', '=', 'A')
                        ->get();

        return response()->json($conditions);
    }

}
