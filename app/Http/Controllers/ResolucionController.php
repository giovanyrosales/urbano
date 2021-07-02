<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Resolucion;
use App\Expediente;

class ResolucionController extends Controller
{
    public function agregarResolucion(Request $request){

         if($request->isMethod('post')){    
            
            $regla = array(                
                'idExpRes' => 'required',
            );    

            $mensaje = array(               
                'idExpRes.required' => 'id expediente resolucion es requerida',
                );

            $validar = Validator::make($request->all(), $regla, $mensaje );

            if ($validar->fails()) 
            {
                return [
                    'success' => 0, 
                    'message' => $validar->errors()->all()
                ];
            } 

            DB::beginTransaction();
        
            try {

            // fecha actual
            $datos = Carbon::now('America/El_Salvador');
            $fecha = $datos->format('Y-m-d');

            // obtener exp de tabla expediente         
          
            $res = new Resolucion();
            $res->num_res = 20; //fijo para mientras
            $res->fecha_resolucion = $fecha; 
            $res->exp_id = $request->idExpRes; // identificador exp tabla expediente
            $res->monto = $request->rMonto; //*
            $res->comentarios = $request->editor1; //*
           
            $res->save();

            // actualizar estado al entregar
            Expediente::where('id', $request->idExpRes)->update(['estados_id' => '2']); // resolucion generada

            DB::commit();

            return ['success'=>1];
            }catch(\Throwable $e){
                DB::rollback();
                return ['success'=>0, 'message' => $e];   
            }
        }
    }

    // vista para buscar resolucion
    public function index(){
        return view('backend.paginas.resolucion.buscarResolucion');
    }

    public function buscarResolucion(Request $request){

        if($request->isMethod('post')){
            
            $regla = array(    
                'id' => 'required',
            );
 
            $mensaje = array(               
                'id.required' => 'id expediente resolucion es requerida',
                );

            $validar = Validator::make($request->all(), $regla, $mensaje );

            if ($validar->fails()) 
            {
                return [
                    'success' => 0, 
                    'message' => $validar->errors()->all()
                ];
            } 

            if($datos = Resolucion::where('id', $request->id)->first()){
                
                return [
                    'success' => 1,
                    'datos' => $datos
                ];
            }else{
                return [
                    'success' => 2                   
                ];
            }
        }
    } 

    // editar resolucion
    public function editarResolucion(Request $request){
        
        if($request->isMethod('post')){
            
            $regla = array(
                'res_id' => 'required'
            );

            $mensaje = array(
                'res_id.required' => 'ID resolucion es requerida'
                );

            $validar = Validator::make($request->all(), $regla, $mensaje );

            if ($validar->fails()) 
            {
                return [
                    'success' => 0, 
                    'message' => $validar->errors()->all()
                ];
            }  
                           
            Resolucion::where('id', $request->res_id)->update([
            'comentarios' => $request->editor1]);

            return [
                'success' => 1
            ];
        }
    }

    // entrega de resolucion, agregar quien recibe y su fecha

}
