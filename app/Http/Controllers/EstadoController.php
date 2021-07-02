<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estado;
use Illuminate\Support\Facades\Validator;

class EstadoController extends Controller
{

    // vista estados
    public function index(){
        return view('backend.paginas.configuracion.ListarEstados');
    }

    // vista tablas estado
    public function tablaEstado(){
        $estado = Estado::all();
        return view('backend.paginas.tablas.configuracion.tablaEstado',compact('estado'));
    }

    // obtener estados
    public function estadoInformacion(Request $request){
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

            if($datos = Estado::where('id', $request->id)->first()){
                return [
                    'success' => 1,
                    'estado' => $datos
                ];
            }else{
                return [
                    'success' => 2 // proceso no encontrado                   
                ];
            }
        }
    }

    // editar un estado
    public function editarEstado(Request $request){
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

            Estado::where('id', $request->id)->update(['nombre' => $request->nombre]);

            return [
                'success' => 1
            ];
        }
    }

    // agregar nuevo estado (No utilizado) 8/11/2019
    public function agregarEstado(Request $request){
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

            $estado = new Estado();
            $estado->nombre = $request->nombre;  

            if($estado->save()){
                return ['success'=>1];
            }else{
                return ['success'=>2];
            }
        }
    }
}
