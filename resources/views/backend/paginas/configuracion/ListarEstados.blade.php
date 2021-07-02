@extends('backend.menus.indexSuperior')
 
@section('content-admin-css')
    <link href="{{ asset('css/backend/adminlte3/adminlte.min.css') }}" type="text/css" rel="stylesheet" /> 
    <!-- data table -->
    <link href="{{ asset('css/backend/adminlte3/dataTables.bootstrap4.css') }}" type="text/css" rel="stylesheet" /> 
    <!-- mensaje toast -->
    <link href="{{ asset('plugins/toastr/toastr.min.css') }}" type="text/css" rel="stylesheet" />

@stop

  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-3">
            <h1>Lista de Estados</h1>
          </div>
          <div class="col-sm-2">
         <!-- <button type="button" onclick="abrirModalAgregar()" class="btn btn-success btn-sm">
          <i class="fas fa-pencil-alt"></i>
          Nuevo Estado
        </button> -->
          </div>
        </div>
      </div>
    </section>

    <!-- seccion frame -->
    <section class="content">
      <div class="container-fluid">
        <div class="card card-gray">
          <div class="card-header">
            <h3 class="card-title">Tabla de Estados</h3>           
          </div>
       
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div id="tablaDatatable"></div>
              </div>			
			      </div>	
		     </div>		 
		    </div>	
	    </div>	 
	  </section>
    
    <!-- modal agregar nuevo estado-->
    <div class="modal fade" id="modalAgregar">
        <div class="modal-dialog">
          <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Nuevo Estado</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="formulario">
              <div class="card-body">
                <div class="row">  
                  <div class="col-sm-12"> 
                   
                    <div class="form-group">
                      <label>Nombre</label>
                      <input type="text" class="form-control" id="nombre" maxlength="100" placeholder="Nombre Estado">
                    </div>                  
                  </div>            
                </div>  
              </div>
            </form>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" onclick="guardarEstado()">Guardar</button>
          </div>
          
        </div>        
      </div>      
    </div>


	 <!-- modal editar estado -->
   <div class="modal fade" id="modalEditar">
        <div class="modal-dialog">
          <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Nuevo Estado</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="formulario">
              <div class="card-body">
                <div class="col-sm-12">  
                    <div class="form-group">
                      <label>Nombre</label>
                      <input type="hidden" id="eId">
                      <input type="text" class="form-control" id="eNombre" maxlength="250" placeholder="Nombre Estado">
                    </div>   
                </div> 
              </div>
            </form>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" onclick="editarEstado()">Guardar</button>
          </div>
          
        </div>        
      </div>      
    </div>

	
@extends('backend.menus.indexInferior')

  @section('content-admin-js')	

  <!-- data table -->
  <script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}" type="text/javascript"></script>
  <script src="{{ asset('plugins/datatables/dataTables.bootstrap4.js') }}" type="text/javascript"></script>
  <script src="{{ asset('plugins/toastr/toastr.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('js/axios.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('plugins/loading/loadingOverlay.js') }}" type="text/javascript"></script>

  <script src="{{ asset('plugins/ckeditor/ckeditor.js') }}" type="text/javascript"></script>



 <!-- incluir tabla --> 
  <script type="text/javascript">	
    $(document).ready(function(){    
      var ruta = "{{ URL::to('admin/tablas/estado') }}";   
      $('#tablaDatatable').load(ruta);
    });
 </script>

  <script>

  // *
  function abrirModalAgregar(){               
      $('#modalAgregar').modal('show'); 
    }

  // guardar nuevo estado *
  function guardarEstado(){

      var nombre = document.getElementById('nombre').value;
      var retorno = validaciones(nombre);

      if(retorno){

        var spinHandle = loadingOverlay().activate(); 
              
        let formData = new FormData();
        formData.append('nombre', nombre);

        axios.post('/admin/estado/agregar', formData, {  
          })
          .then((response) => {	
            loadingOverlay().cancel(spinHandle); 
            mensajeResponse(response);
          })
          .catch((error) => {         
            loadingOverlay().cancel(spinHandle);
            toastr.error('Error del servidor');               
        }); 
      } 
  }

  // mensaje cuando guardamos estado nuevo *
  function mensajeResponse(valor){
    if(valor.data.success == 1){
      toastr.success('Nuevo estado creado');
      $('#modalAgregar').modal('hide');             
      var ruta = "{{ URL::to('admin/tablas/estado') }}";   
      $('#tablaDatatable').load(ruta);
    }else if(valor.data.success == 2){
      toastr.error('Error, Estado no creado');
    }else{   
      toastr.error('Error de validacion');
    }
  }
    
    // validar antes de agregar estado *
  function validaciones(nombre){

      if(nombre === ''){
          toastr.error('Nombre es requerido');
          return false;
      }
    
      return true;     
  } 

  // abre el modal para editar el estado *
  function abrirModalEditar(id){
    
    spinHandle = loadingOverlay().activate();
    axios.post('/admin/estado/informacion',{
      'id': id  
        })
        .then((response) => {	
          loadingOverlay().cancel(spinHandle); 
          if(response.data.success = 1){
         
            $('#modalEditar').modal('show');
            $('#eNombre').val(response.data.estado.nombre);
            $('#eId').val(response.data.estado.id);
          }else{ 
            toastr.error('Estado no encontrado'); 
          }
        })
        .catch((error) => {
          loadingOverlay().cancel(spinHandle); 
          toastr.error('Error del servidor');    
    });
  }

  // editar estado *
  function editarEstado(){
            
      var id = document.getElementById('eId').value;
      var nombre = document.getElementById('eNombre').value;

      var retorno = validacionesEditar(nombre);
    
      if(retorno){
          var spinHandle = loadingOverlay().activate();         
          
          var formData = new FormData();
          formData.append('id', id);
          formData.append('nombre', nombre);      
  
          axios.post('/admin/estado/editar', formData, {        
          })
          .then((response) => {	     
            loadingOverlay().cancel(spinHandle);
            mostrarMensajeEditar(response);           
          })
          .catch((error) => {          
            loadingOverlay().cancel(spinHandle);
            toastr.error('Error del servidor');             
        }); 
      }            
  }
        
  // mensajes segun el servidor *
  function mostrarMensajeEditar(valor) {          
      if (valor.data.success == 1) { 
          $('#modalEditar').modal('hide');             
          var ruta = "{{ URL::to('admin/tablas/estado') }}";
          $('#tablaDatatable').load(ruta);   
          toastr.success('Estado actualizado');          
      }else {
          toastr.error('Error al editar estado'); 
      }
  }
        
  // validar antes de editar *
  function validacionesEditar(nombre){           
      
      if(nombre === ''){
          toastr.error('Nombre es requerido'); 
          return false;
      }

      return true;
  } 


  </script>



@stop