<?php

namespace App\Http\Controllers;

use App\Noticia;
use App\Programa;
use App\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Visitors;
use Carbon\Carbon;

class DashboardController extends Controller
{
    // vista index
    public function index()
    { 
        $idusuario =  auth()->user()->id;
        $usuario =  DB::table('users')->where('id', $idusuario)->first();
        return view('backend.index', compact(['usuario']));
    }

    // vista de datos en el index
    public function getInicio(){

        $date = Carbon::now('America/El_Salvador');
        $date = $date->format('Y');

        // expediente pendiente de resolucion del anio actual
        $expediente = DB::table('expediente AS e')     
        ->where('e.estados_id', 1)
        ->whereYear('e.fecha', $date)
        ->count();

        // ingresos totales del presente anio
        $lista = DB::table('procesos AS p')  
        ->select('p.id', 'p.nombre')
        ->get();
            
            foreach ($lista as $pro) {

                // total expediente por cada proceso
                $toexp = DB::table('expediente AS e')
                ->select('e.procesos_id', 'e.id')
                ->whereYear('e.fecha', $date) // presente anio
                ->where('e.procesos_id', $pro->id)
                ->get();
            
                $resultado = 0;
                $monto = 0;
                // recorrer cada expediente para ver si tiene resolucion
                foreach($toexp as $t){
                    $tores = DB::table('resoluciones AS r')
                    ->where('r.exp_id', $t->id)
                    ->get();

                    $contar = count($tores);
                    $resultado=$resultado+$contar;

                    $m = collect($tores)->sum('monto');
                    $monto = $monto+$m;
                }
                $pro->monto = $monto;
            }
                
            $totalMonto = collect($lista)->sum('monto');

        // resoluciones sin entregar
        $resSinEntregar = DB::table('expediente AS e')
        ->join('resoluciones AS r', 'r.exp_id','=','e.id')
        ->where('e.estados_id', 2) // resolucion generada pero no entregada
        ->count();
           
        return view('backend.paginas.inicio', compact(['expediente', 'totalMonto', 'resSinEntregar']));
    }
}
