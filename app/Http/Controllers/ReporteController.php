<?php

namespace App\Http\Controllers;

use App\Bitacora;
use App\Estado;
use Illuminate\Http\Request;
use App\Expediente;
use App\FotoBitacora;
use App\Procesos;
use App\Resolucion;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DateTime;
use Mpdf\Tag\Select;
use Fpdf\Fpdf;

class ReporteController extends Controller
{

    public function index(){        
        return view('backend.paginas.reporte.ListarResoluciones');
    }
 
    public function tablaResoluciones(){
        
        $resoluciones = DB::table('expediente AS e')  
        ->join('estados AS es', 'es.id','=','e.estados_id')
        ->join('resoluciones AS r', 'r.exp_id','=','e.id')
        ->select('e.estados_id AS estadoid', 'e.solicitante', 'e.exp AS expCorrelativo', 'r.id', 'e.id AS idExp', 'r.num_res', 'r.fecha_resolucion',
        'r.exp_id', 'r.monto', 'r.fecha', 'r.recibe')
        ->get();

        return view('backend.paginas.tablas.reporte.tablaResoluciones',compact('resoluciones'));
    }
 
    public function entregarResolucion(Request $request){

        if($request->isMethod('post')){    
            
            $regla = array( 
                'id' => 'required'               
            );    

            $mensaje = array('id.required' => 'ID de resolucion');

            $validar = Validator::make($request->all(), $regla, $mensaje);

            if ($validar->fails()) 
            {
                return [
                    'success' => 0, 
                    'message' => $validar->errors()->all()
                ];
            }  

            if($re = Resolucion::where('id', $request->id)->first()){
                  
                // actualizar datos
                Resolucion::where('id', $request->id)->update(['recibe' => $request->recibe,
               'fecha' => $request->fecha]);
              
               // cambiar estado a 3
               Expediente::where('id', $re->exp_id)->update(['estados_id' => '3']);

               $ex = Expediente::where('id', $re->exp_id)->first();
                   
               return ['success' => 1, 'exp' => $ex->id];

            }else{
                return ['success' => 2 ]; // id de resolucion no encontrado
            }
        } 
    }

    // retornar vista para buscar expediente
    public function vistaBuscarExpediente(){
        return view('backend.paginas.reporte.buscarExpediente');
    }

     // retornar vista para buscar ingresos
     public function vistaBuscarIngresos(){
        return view('backend.paginas.reporte.buscarIngresos');
    }

    // generar reporte de expediente
    public function genReporteExpediente(Request $request){

        if($request->isMethod('post')){    
            
            $regla = array( 
                'id' => 'required'   // # de expediente            
            );    

            $mensaje = array('id.required' => '# de expediente es requerido');

            $validar = Validator::make($request->all(), $regla, $mensaje);

            if ($validar->fails()) 
            {
                return [
                    'success' => 0, 
                    'message' => $validar->errors()->all()
                ];
            }  

            
            if($exp =Expediente::where('exp', $request->id)->first()){
                return [
                    'success' => 1,  # de expediente no encontrado
                    'id' => $exp->id
                ];
            }else{
                return [
                    'success' => 2  # de expediente no encontrado
                ];
            }

        }
    }

    // mostrar reporte de expediente PDF
    public function generarExpedientePdf($id){ //id expediente

        $dato = DB::table('expediente AS e')
        ->join('estados AS es', 'es.id','=','e.estados_id')
        ->join('procesos AS p', 'p.id','=','e.procesos_id')
        ->select('e.exp', 'e.solicitante', 'p.nombre AS nombreProceso', 
        'e.fecha', 'es.nombre AS nombreEstado', 'e.correo_solicitante AS correo',
        'e.telefono', 'e.direccion', 'e.comentarios')
        ->where('e.id', $id)
        ->first();
        
        $exp = $dato->exp; 
        $solicitante = $dato->solicitante;
        $nombreProceso = $dato->nombreProceso;
        $fecha = $dato->fecha;
        $nombreEstado = $dato->nombreEstado;
        $correo = $dato->correo;
        $telefono = $dato->telefono;
        $direccion = $dato->direccion;
        $comentarios = $dato->comentarios;

        $view =  \View::make('pdf.expedienteReporte', compact(['exp', 'solicitante', 'nombreProceso', 
        'fecha', 'nombreEstado', 'correo', 'telefono', 'direccion', 'comentarios']))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);

        return $pdf->stream();
    }

    public function vistaVerBitacoras(){
        return view('backend.paginas.reporte.ListarBitacora');
    }

    public function tablaBitacoraReporte(){
        
        $bitacora = DB::table('expediente AS e')
        ->join('bitacora AS b', 'b.expediente_id','=','e.id')
        ->select('b.id', 'e.exp', 'e.solicitante')       
        ->get();

        return view('backend.paginas.tablas.reporte.tablaBitacora',compact('bitacora'));
    }
    
    public function generarBitacoraPdf($id){

        $bitacora = DB::table('bitacora AS b')
        ->join('fotos_bitacora AS f', 'f.bitacora_id','=','b.id')
        ->select('f.url')
        ->where('b.id', $id)
        ->get();

        $bi2 = DB::table('expediente AS e')
        ->join('bitacora AS b', 'b.expediente_id','=','e.id')
        ->select('b.id', 'e.exp', 'e.solicitante', 'b.observaciones', 'e.exp')
        ->where('b.id', $id)
        ->first();

        $solicitante = $bi2->solicitante;
        $comentario = $bi2->observaciones;
        $expediente = $bi2->exp;

        $view =  \View::make('pdf.bitacoraReporte', compact(['bitacora', 'solicitante', 'comentario', 'expediente']))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view)->setPaper('carta', 'portrait');

        return $pdf->stream();
    }

    public function genReporteIngresos($fecha1, $fecha2){
            
            $ini = $fecha1;
            $fin = $fecha2;

                // obtener todos los procesos
                $lista = DB::table('procesos AS p')    
                ->select('p.id', 'p.nombre')
                ->get();            
            
                foreach ($lista as $pro) {

                    // total expediente por cada proceso
                    $toexp = DB::table('expediente AS e')
                    ->select('e.procesos_id', 'e.id')
                    ->whereBetween('e.fecha', [$ini, $fin])
                    ->where('e.procesos_id', $pro->id)
                    ->get();

              
                        $pro->expTotal = count($toexp); // total expediente                              
                    
                
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
                    $pro->resTotal = $resultado;
                    $pro->monto = $monto;         
                }
            
                
                $totalMonto = collect($lista)->sum('monto');
                $expTotal = collect($lista)->sum('expTotal');
                $resTotal = collect($lista)->sum('resTotal');

                $f1 = date("d/m/Y", strtotime($fecha1));
                $f2 = date("d/m/Y", strtotime($fecha2));

                $view =  \View::make('pdf.ingresoReporte', compact(['lista', 'f1', 'f2', 'expTotal', 'resTotal', 'totalMonto']))->render();
                $pdf = \App::make('dompdf.wrapper');
                $pdf->loadHTML($view)->setPaper('carta', 'portrait');

                return $pdf->stream();

        
    }

}
