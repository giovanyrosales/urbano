<?php

namespace App\Http\Controllers;

use App\DocumentoExpediente;
use App\DocumentoResolucion;
use App\Resolucion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DocumentosController extends Controller
{
    // agregar documento expediente
    public function agregarExpediente(Request $request){
        if($request->isMethod('post')){  
           
            $regla = array( 
                'idDoc' => 'required',                
                'docExp' => 'required|mimes:pdf'                
            );

            $mensaje = array(
                'idDoc.required' => 'id expediente es requerio',             
                'docExp.required' => 'documento es requerida',      
                'docExp.mimes' => 'documento permitido es .PDF',        
                );

            $validar = Validator::make($request->all(), $regla, $mensaje );

            if ($validar->fails())
            {
                return [
                    'success' => 0, 
                    'message' => $validar->errors()->all()
                ];
            } 
  
            // generar nombre para la imagen
            $cadena = Str::random(15);
            $tiempo = microtime(); 
            $union = $cadena.$tiempo; 
            // quitar espacios vacios
            $nombrePDF = str_replace(' ', '_', $union);

            $avatar = $request->file('docExp'); 

            $extension = '.'.$avatar->getClientOriginalExtension();        
            $nombreUrl = $nombrePDF.$extension;
                            
            $upload = Storage::disk('expediente')->put($nombreUrl, \File::get($avatar));
          
           if($upload){               
         
                DocumentoExpediente::create(['expediente_id'=>$request->idDoc,
                'url'=> $nombreUrl]);
                return [
                    'success' => 1 
                ];              

           }else{
               return [
                   'success' => 2 
               ];
           }
        }
    }

    // agregar documento exp + res
    public function agregarExpRes(Request $request){
        if($request->isMethod('post')){   

            // verificar si trae documento expediente
            if($request->hasFile('docExp2')){

                $regla = array( 
                    'idDoc' => 'required',               
                    'docExp2' => 'required|mimes:pdf'               
                );

                $mensaje = array(
                    'idDoc.required' => 'id expediente es requerio',             
                    'docExp2.required' => 'documento es requerido',      
                    'docExp2.mimes' => 'documento permitido es .PDF',        
                    );

                $validar = Validator::make($request->all(), $regla, $mensaje );

                if ($validar->fails()){
                    return [
                        'success' => 0, 
                        'message' => $validar->errors()->all()
                    ];
                } 

                // generar nombre para la imagen
                $cadena = Str::random(15);
                $tiempo = microtime(); 
                $union = $cadena.$tiempo; 
                // quitar espacios vacios
                $nombrePDF = str_replace(' ', '_', $union);

                $avatar = $request->file('docExp2');

                $extension = '.'.$avatar->getClientOriginalExtension();        
                $nombreUrl = $nombrePDF.$extension;
                                
                $upload = Storage::disk('expediente')->put($nombreUrl, \File::get($avatar));
                
                if($upload){               
                
                        DocumentoExpediente::create(['expediente_id'=>$request->idDoc,
                        'url'=> $nombreUrl]);                             

                }else{
                    return [
                        'success' => 2 
                    ];
                }
            }

            // verificar si trae documento resolucion
            if($request->hasFile('docRes')){


                $regla = array( 
                    'idDoc' => 'required',               
                    'docRes' => 'required|mimes:pdf'               
                );
    
                $mensaje = array(
                    'idDoc.required' => 'id expediente es requerio',             
                    'docRes.required' => 'documento es requerido',      
                    'docRes.mimes' => 'documento permitido es .PDF',        
                    );
    
                $validar = Validator::make($request->all(), $regla, $mensaje );
    
                if ($validar->fails()){
                    return [
                        'success' => 0, 
                        'message' => $validar->errors()->all()
                    ];
                } 

                // generar nombre para la imagen
                $cadena = Str::random(15);
                $tiempo = microtime(); 
                $union = $cadena.$tiempo; 
                // quitar espacios vacios
                $nombrePDF = str_replace(' ', '_', $union);

                $avatar = $request->file('docRes');

                $extension = '.'.$avatar->getClientOriginalExtension();        
                $nombreUrl = $nombrePDF.$extension;
                                
                $upload = Storage::disk('resolucion')->put($nombreUrl, \File::get($avatar));
                
                if($upload){     
                    
                    // sacar id de resolucion con el id del expediente asociado
                    $dato = Resolucion::where('exp_id', $request->idDoc)->first();
                    $idRes = $dato->id;
                  
                    DocumentoResolucion::create(['resoluciones_id'=> $idRes,
                        'url'=> $nombreUrl]);                   

                }else{
                    return [
                        'success' => 2 
                    ];
                }
            }

            return [
                'success' => 1 
            ]; 
        }
    }


}
