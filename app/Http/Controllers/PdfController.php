<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Expediente;
use App\Resolucion;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class PdfController extends Controller
{
   // generar pdf para resolucion reporte
   public function generarPdf($id){ // id de expediente
       
   $datosExp = Expediente::where('id', $id)->first();
    
   // obtener datos de la resolucion
   $datos = Resolucion::where('exp_id', $datosExp->id)->first();

   // saver que dia estamos
   $numSemana = [
        0 => 'domingo', 
        1 => 'lunes', 
        2 => 'martes', 
        3 => 'miercoles', 
        4 => 'jueves', 
        5 => 'viernes', 
        6 => 'sabado',
    ];

    $numMes = [       
        1 => 'enero', 
        2 => 'febrero', 
        3 => 'marzo', 
        4 => 'abril', 
        5 => 'mayo', 
        6 => 'junio',
        7 => 'julio',
        8 => 'agosto',
        9 => 'septiembre',
        10 => 'octubre',
        11 => 'noviembre',
        12 => 'diciembre'
    ];
   
    $fechaCarbon = Carbon::now('America/El_Salvador');
    $anio = $fechaCarbon->format('Y'); // anio
    $mesNum = $fechaCarbon->format('m');;// mes
    $mes = $numMes[$mesNum];

    $getDia = $fechaCarbon->dayOfWeek;
    $diaSemana = $numSemana[$getDia];
    $dia = $fechaCarbon->format('d'); //dia 
    
    $solicitante = $datosExp->solicitante;
    $direccion = $datosExp->direccion;
    /*$metros = $datosRes->metros;
    $recibo = $datosRes->recibo;  
    $serie = $datosRes->serie;*/
    // texto de resolucion
    $descripcion = $datos->comentarios;

    $view =  \View::make('pdf.resolucionReporte', compact(['diaSemana', 'dia', 'mes', 
    'anio', 'solicitante', 'direccion', 'descripcion']))->render();
    $pdf = \App::make('dompdf.wrapper');
    $pdf->loadHTML($view)->setPaper('carta', 'portrait');

    return $pdf->stream();
    
   }
  
}
 