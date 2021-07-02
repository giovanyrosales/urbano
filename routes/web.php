<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// login administrador

Route::get('/', 'Auth\LoginController@loginForm')->name('admin.login');
Route::post('/', 'Auth\LoginController@login');

Route::group(['middleware' => 'auth', 'auth.admin'], function () { 
    Route::get('admin/dashboard', 'DashboardController@index')->name('admin.dashboard');
    Route::get('admin/inicio', 'DashboardController@getInicio')->name('admin.inicio');
   
    Route::get('admin/logout', 'Auth\LoginController@logout');
    Route::post('/admin/actualizar-usuario','UserController@update');

    // panel editar usuario
    Route::get('/admin/editarusuario', 'UserController@index')->name('admin.EditarUsuario');
    Route::post('/admin/actualizar-usuario','UserController@update');

    // procesos
    Route::get('admin/proceso/lista', 'ProcesoController@index');
    Route::get('admin/tablas/proceso', 'ProcesoController@tablaProceso');
    Route::post('admin/proceso/informacion', 'ProcesoController@procesoInformacion');
    Route::post('admin/proceso/editar', 'ProcesoController@editarProceso');
    Route::post('admin/proceso/agregar', 'ProcesoController@agregarProceso');

    // estados
    Route::get('admin/estado/lista', 'EstadoController@index');
    Route::get('admin/tablas/estado', 'EstadoController@tablaEstado');
    Route::post('admin/estado/informacion', 'EstadoController@estadoInformacion');
    Route::post('admin/estado/editar', 'EstadoController@editarEstado');
    Route::post('admin/estado/agregar', 'EstadoController@agregarEstado');

    // expediente
    Route::get('admin/expediente/lista', 'ExpedienteController@index');
    Route::get('admin/tablas/expediente', 'ExpedienteController@tablaExpediente');
    Route::post('admin/expediente/informacion', 'ExpedienteController@expedienteInformacion');
    Route::post('admin/expediente/editar', 'ExpedienteController@editarExpediente');
    Route::post('admin/expediente/agregar', 'ExpedienteController@agregarExpediente');
 
    // resolucion       
    Route::post('admin/resolucion/agregar', 'ResolucionController@agregarResolucion');

    // vista para buscar resolucion
    Route::get('admin/buscar/resolucion', 'ResolucionController@index');
    Route::post('admin/resolucion/informacion', 'ResolucionController@buscarResolucion');
    Route::post('admin/resolucion/editar', 'ResolucionController@editarResolucion');

    // pdf
    Route::get('admin/generar/pdf/{id}', 'PdfController@generarPdf')->name('pdfRompimientoCalle');
 
    // bitacoras
    Route::get('admin/bitacora/lista', 'BitacoraController@index');
    Route::get('admin/tablas/bitacora', 'BitacoraController@tablaBitacora'); 
    Route::post('admin/bitacora/agregar', 'BitacoraController@agregarBitacora');
    Route::post('admin/eliminar-bitacora', 'BitacoraController@eliminarBitacora');
    Route::post('admin/bitacora/informacion', 'BitacoraController@informacionBitacora');
    Route::post('admin/bitacora/editar', 'BitacoraController@editarBitacora');

    // fotografias
    Route::get('admin/fotografia/{id}', 'BitacoraController@getFotografiaVista'); 
    Route::get('admin/tabla/fotografia/{id}', 'BitacoraController@getFotografiaTabla');
    Route::post('admin/agregar-fotografia', 'BitacoraController@nuevaFotografia');
    Route::post('admin/eliminar-fotografia', 'BitacoraController@eliminarFotografia');

    // Reportes 
        // entrega de resoluciones
    Route::get('admin/ver/resoluciones', 'ReporteController@index'); 
    Route::get('admin/tablas/resoluciones', 'ReporteController@tablaResoluciones'); 
    Route::post('admin/resolucion/entregar', 'ReporteController@entregarResolucion');
        // por expediente 
        Route::get('admin/vista/buscar/expediente', 'ReporteController@vistaBuscarExpediente'); 
        Route::post('admin/reporte/expediente', 'ReporteController@genReporteExpediente'); // buscar si existe expediente    
        Route::get('admin/expediente/pdf/{id}', 'ReporteController@generarExpedientePdf'); // generar pdf
 
        // por bitacora
        Route::get('admin/ver/bitacora/reporte', 'ReporteController@vistaVerBitacoras'); 
        Route::get('admin/tablas/bitacora/reporte', 'ReporteController@tablaBitacoraReporte'); 
        Route::get('admin/generar/pdf/bitacora/{id}', 'ReporteController@generarBitacoraPdf'); // generar pdf
     
        // por ingreso
        Route::get('admin/vista/buscar/ingresos', 'ReporteController@vistaBuscarIngresos'); 
        Route::get('admin/generar/ingresos/{id}/{id2}', 'ReporteController@genReporteIngresos'); // buscar si existe expediente    

    // guardar documento expediente
    Route::post('admin/documento/expediente', 'DocumentosController@agregarExpediente');
    // guardar documento expediente + resolucion
    Route::post('admin/documento/exp-res', 'DocumentosController@agregarExpRes');

     
});