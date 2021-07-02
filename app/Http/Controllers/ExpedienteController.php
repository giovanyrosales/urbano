<?php

namespace App\Http\Controllers;

use App\Estado;
use Illuminate\Http\Request;
use App\Expediente;
use App\Procesos;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ExpedienteController extends Controller
{
    // vista index
    public function index(){
        $estado = Estado::all();
        $proceso = Procesos::all();

        return view('backend.paginas.expediente.ListarExpediente', compact(['estado', 'proceso']));
    }

    // tabla vista expedientes
    public function tablaExpediente(){
        $expediente = DB::table('expediente AS e')
        ->join('procesos AS p', 'p.id','=','e.procesos_id')
        ->join('estados AS es', 'es.id','=','e.estados_id')
        ->select('e.id', 'e.exp', 'e.estados_id AS estadoid', 'e.solicitante', 'p.nombre AS nombreProceso',
         'e.fecha', 'es.nombre AS nombreEstado')
        ->get();

        return view('backend.paginas.tablas.expediente.tablaExpediente',compact('expediente'));
    }

    // expediente informacion
    public function expedienteInformacion(Request $request){
       
        if($request->isMethod('post')){    
            
            $regla = array( 
                'id' => 'required'               
            );    
 
            $mensaje = array(
                'id.required' => 'ID es requerida',               
                );

            $validar = Validator::make($request->all(), $regla, $mensaje );

            if ($validar->fails()) 
            {
                return [
                    'success' => 0, 
                    'message' => $validar->errors()->all()
                ];
            } 

            if(Expediente::where('id', $request->id)->first()){

                $expediente = Expediente::where('id', $request->id)->first();
       
                return [
                    'success' => 1,
                    'expediente' => $expediente
                ];
            }else{
                return [
                    'success' => 2             
                ];
            }
        }
    }

    // editar expediente
    public function editarExpediente(Request $request){
        if($request->isMethod('post')){    
            
            $regla = array( 
                'id' => 'required',
                'solicitante' => 'required|max:150'
            );    

            $mensaje = array(
                'id.required' => 'ID es requerida',
                'solicitante.required' => 'Solicitante es requerido',
                'solicitante.max' => '150 caracteres maximo'               
                );

            $validar = Validator::make($request->all(), $regla, $mensaje );

            if ($validar->fails()) 
            {
                return [
                    'success' => 0, 
                    'message' => $validar->errors()->all()
                ];
            } 

            Expediente::where('id', $request->id)->update(['solicitante' => $request->solicitante,
            'correo_solicitante' => $request->correo, 'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'comentarios' => $request->comentario]);

            return [
                'success' => 1
            ];
        }
    }

    // agregar expediente
    public function agregarExpediente(Request $request){
        if($request->isMethod('post')){    
            
            $regla = array(                
                'exp' => 'required',
                'solicitante' => 'required'
            );    

            $mensaje = array(               
                'exp.required' => 'Exp es requerido',
                'solicitante.required' => 'Solicitante es requerido',
                'solicitante.max' => '150 caracteres maximo'            
                );

            $validar = Validator::make($request->all(), $regla, $mensaje );

            if ($validar->fails()) 
            {
                return [
                    'success' => 0, 
                    'message' => $validar->errors()->all()
                ];
            } 

            $fecha = Carbon::now('America/El_Salvador');

            $ex = new Expediente();
            $ex->exp = $request->exp;
            $ex->solicitante = $request->solicitante; 
            $ex->procesos_id = $request->proceso; 
            $ex->fecha = $fecha; 
            $ex->estados_id = 1; // en proceso
            $ex->correo_solicitante = $request->correo; 
            $ex->telefono = $request->telefono; 
            $ex->direccion = $request->direccion; 
            $ex->comentarios = $request->comentario; 

            if($ex->save()){
                return ['success'=>1];
            }else{
                return ['success'=>2];
            }
        }
    }
}
