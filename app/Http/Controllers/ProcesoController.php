<?php

namespace App\Http\Controllers;

use App\Procesos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProcesoController extends Controller
{
    public function index(){
        return view('backend.paginas.configuracion.ListarProcesos');
    }

    public function tablaProceso(){
        $proceso = Procesos::all();
        return view('backend.paginas.tablas.configuracion.tablaProceso',compact('proceso'));
    }

    public function procesoInformacion(Request $request){
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

            if($datos = Procesos::where('id', $request->id)->first()){
                return [
                    'success' => 1,
                    'proceso' => $datos
                ];
            }else{
                return [
                    'success' => 2 // proceso no encontrado                   
                ];
            }
        }
    }

    public function editarProceso(Request $request){
        if($request->isMethod('post')){    
            
            $regla = array( 
                'id' => 'required',
                'nombre' => 'required|max:250'
            );    

            $mensaje = array(
                'id.required' => 'ID es requerida',
                'nombre.required' => 'Nombre es requerido',
                'nombre.max' => '250 caracteres maximo'               
                );

            $validar = Validator::make($request->all(), $regla, $mensaje );

            if ($validar->fails()) 
            {
                return [
                    'success' => 0, 
                    'message' => $validar->errors()->all()
                ];
            } 

            Procesos::where('id', $request->id)->update(['nombre' => $request->nombre]);

            return [
                'success' => 1
            ];
        }
    }

    public function agregarProceso(Request $request){
        if($request->isMethod('post')){    
            
            $regla = array(                
                'nombre' => 'required|max:250'
            );    

            $mensaje = array(               
                'nombre.required' => 'Nombre es requerido',
                'nombre.max' => '250 caracteres maximo'               
                );

            $validar = Validator::make($request->all(), $regla, $mensaje );

            if ($validar->fails()) 
            {
                return [
                    'success' => 0, 
                    'message' => $validar->errors()->all()
                ];
            } 

            $proceso = new Procesos();
            $proceso->nombre = $request->nombre;  

            if($proceso->save()){
                return ['success'=>1];
            }else{
                return ['success'=>2];
            }
        }
    }
}
