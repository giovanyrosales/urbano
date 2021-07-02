<?php

namespace App\Http\Controllers;

use App\Bitacora;
use App\Expediente;
use App\FotoBitacora;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\DB;

class BitacoraController extends Controller
{
    // vista de lista de bitacoras
    public function index(){
        return view('backend.paginas.bitacora.ListarBitacora');
    }

    // tabla lista de bitacoras
    public function tablaBitacora(){
        $bitacora = Bitacora::all();        
        return view('backend.paginas.tablas.bitacora.tablaBitacora',compact('bitacora'));
    }
 
    // agregar nueva bitacora
    public function agregarBitacora(Request $request){
        if($request->isMethod('post')){
          
            $regla = array( 
                'idexp' => 'required'
            );

            $mensaje = array(
                'idexp.required' => 'ID expediente es requerio'               
                );

            $validar = Validator::make($request->all(), $regla, $mensaje );

            if ($validar->fails()) 
            {
                return [
                    'success' => 0, 
                    'message' => $validar->errors()->all()
                ];
            }
         
            if($e = Expediente::where('exp', $request->idexp)->first()){
                
                $idbitacora = Bitacora::insertGetId([
                    'expediente_id'=>$e->id, 'observaciones' => $request->editor1]);
                
                if($request->hasFile('imagen')){
                    foreach($request->file('imagen') as $img){

                        $cadena = Str::random(15);
                        $tiempo = microtime(); 
                        $union = $cadena.$tiempo;
                        $nombre = str_replace(' ', '_', $union);
                        
                        $ancho = Image::make($img)->width(); //obtener ancho de cada imagen
        
                        $extension = '.'.$img->getClientOriginalExtension();
                        $nombreFoto = $nombre.$extension;
        
                        if($img->getSize() <= 1000000 || $ancho <= 1280){                                 
                           Storage::disk('bitacora')->put($nombreFoto, \File::get($img)); 
                        }else{   
                           $image = Image::make($img)->resize(1280, 900);
                           Storage::disk('bitacora')->put($nombreFoto, (string) $image->encode());
                        }  
                        
                        // insertar nombre fotografia
                        FotoBitacora::create(['bitacora_id'=>$idbitacora,
                                            'url'=>$nombreFoto]);
                    }
                }
                
                    return ['success' => 1];
            }else{
                return ['success' => 2];
            }
        }
    }

    // obtener vista lista de fotografias
    public function getFotografiaVista($idfoto){     
        return view('backend.paginas.fotografias.ListarFotografiasBitacora', compact('idfoto'));
    }

    // tabla de lista fotografias
    public function getFotografiaTabla($idfoto){
     
        $fotografia = FotoBitacora::where('bitacora_id', $idfoto)->get();
        return view('backend.paginas.tablas.fotografia.tablaFotografia', compact('fotografia'));
    }
 
    // agregar nueva fotografia
    public function nuevaFotografia(Request $request){
        if($request->isMethod('post')){

            $regla = array( 
                'id' => 'required',
                'imagen' => 'required',
                'imagen.*' => 'image|mimes:jpg,jpeg',
            );

            $mensaje = array(
                'id.required' => 'ID es requerido',
                'imagen.required' => 'La imagen es requerida',
                'imagen.image' => 'El archivo debe ser una imagen',
                'imagen.mimes' => 'Formato validos .jpeg .jpg',
                'imagen.*.required' => 'Array de imagenes requeridos',
                'imagen.*.mimes' => 'Array de imagenes formato valido .jpg .jpeg',
                );

            $validar = Validator::make($request->all(), $regla, $mensaje);

            if ($validar->fails()) {
                return [
                    'success' => 0,
                    'message' => $validar->errors()->all()
                ];
            }

            foreach ($request->file('imagen') as $img) {
                $cadena = Str::random(15);
                $tiempo = microtime();
                $union = $cadena.$tiempo;
                $nombre = str_replace(' ', '_', $union);
                
                $ancho = Image::make($img)->width(); //obtener ancho de cada imagen

                $extension = '.'.$img->getClientOriginalExtension();
                $nombreFoto = $nombre.$extension;

                if ($img->getSize() <= 1000000 || $ancho <= 1280) {
                    Storage::disk('bitacora')->put($nombreFoto, \File::get($img));
                } else {
                    $image = Image::make($img)->resize(1280, 900);
                    Storage::disk('bitacora')->put($nombreFoto, (string) $image->encode());
                }
                
                // insertar nombre fotografia
                FotoBitacora::create(['bitacora_id'=>$request->id,
                                    'url'=>$nombreFoto]);
            }

            return [
                'success' => 1
            ];
        }
    }

    // informacion de una bitacora
    public function informacionBitacora(Request $request){
       
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

            if(Bitacora::where('id', $request->id)->first()){

                $info = Bitacora::where('id', $request->id)->first();
       
                return [
                    'success' => 1,
                    'info' => $info
                ];
            }else{
                return [
                    'success' => 2             
                ];
            }
        }
    }

    // editar bitacora
    public function editarBitacora(Request $request){
        if($request->isMethod('post')){    
            
            $regla = array( 
                'id' => 'required'               
            );    
 
            $mensaje = array(
                'id.required' => 'ID del expediente es requerida',               
                );

            $validar = Validator::make($request->all(), $regla, $mensaje );

            if ($validar->fails()) 
            {
                return [
                    'success' => 0, 
                    'message' => $validar->errors()->all()
                ];
            } 
            
            Bitacora::where('id', $request->id)->update(['observaciones' => $request->editor2]);

            return [
                'success' => 1,
            ];
        }
    }

    // eliminar fotografia
    public function eliminarFotografia(Request $request){
        if ($request->isMethod('post')) {
            $regla = array(
                'id' => 'required'
            );

            $mensaje = array(
                'id.required' => 'ID es requerida',
                );

            $validar = Validator::make($request->all(), $regla, $mensaje);

            if ($validar->fails()) {
                return [
                    'success' => 0,
                    'message' => $validar->errors()->all()
                ]; 
            }

            if ($dato = FotoBitacora::where('id', $request->id)->first()) {
                if (Storage::disk('bitacora')->exists($dato->url)) {
                    Storage::disk('bitacora')->delete($dato->url);
                }
    
                FotoBitacora::where('id', $request->id)->delete();
                
                return [
                    'success' => 1,
                ];
            } else {
                return [
                    'success' => 2,
                ];
            }
        }
    }  
    
    // eliminar bitacora
    public function eliminarBitacora(Request $request){
        if ($request->isMethod('post')) {
            $regla = array(
                'id' => 'required'
            );

            $mensaje = array(
                'id.required' => 'ID es requerida',
                );

            $validar = Validator::make($request->all(), $regla, $mensaje);

            if ($validar->fails()) {
                return [
                    'success' => 0,
                    'message' => $validar->errors()->all()
                ];
            }

        
            if(Bitacora::where('id', $request->id)->first()){              

                // borrar imagen
                $ruta = FotoBitacora::where('bitacora_id', $request->id)->get();

                foreach($ruta as $dato){

                    if(Storage::disk('bitacora')->exists($dato->url)){
                        Storage::disk('bitacora')->delete($dato->url);                                
                    }
                }
                
                // borrar datos de tabla
                FotoBitacora::where('bitacora_id', $request->id)->delete();

                // borrar bitacora
                Bitacora::where('id', $request->id)->delete();
                              
                return [
                    'success' => 1 // bitacora eliminada              
                ];
            }else{
                return [
                    'success' => 2 // bitacora no encontrado                   
                ];
            }
        }
    }
}
