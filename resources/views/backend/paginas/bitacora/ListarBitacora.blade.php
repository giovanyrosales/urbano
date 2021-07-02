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
            <h1>Lista de Bitacoras</h1>
          </div>
          <div class="col-sm-2">
          <button type="button" onclick="abrirModalAgregar()" class="btn btn-success btn-sm">
          <i class="fas fa-pencil-alt"></i>
          Nueva Bitacora
        </button>     
          </div>
        </div>
      </div>
    </section>

    <!-- seccion frame -->
    <section class="content">
      <div class="container-fluid">
        <div class="card card-gray">
          <div class="card-header">
            <h3 class="card-title">Tabla Bitacora</h3>           
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

       <!-- modal agregar nueva bitacora -->
    <div class="modal fade" id="modalAgregar">
        <div class="modal-dialog">
          <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Nueva Bitacora</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="formulario">
              <div class="card-body">
                <div class="row">  
                
                    <!-- id del expediente -->
                    <div class="form-group" style="width:100%">
                      <label>ID Expediente</label>
                      <input type="text" class="form-control" id="idexp" name="idexp" placeholder="" >
                    </div>                  
                               
                    <div class="form-group" style="width:100%">
                      <label>Imagenes</label>
                      <!-- imagen -->
                      <input type="file" class="form-control" id="logo" name="logo[]" multiple accept="image/jpeg, image/jpg" />
                    </div>

                  <div class="form-group" style="width:100%">
                    <label style="color:#191818">Comentarios</label>
                    <br>
                    <textarea id="editor1"  class="form-control" name="editor1" rows="4" cols="50"></textarea>
                  </div> 


                </div> 
              </div>
            </form>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" id="btnGuardar" onclick="guardarBitacora()">Guardar</button>
          </div>          
        </div>        
      </div>      
    </div>


   <!-- modal editar comentario de bitacora -->
   <div class="modal fade" id="modalEditar">
        <div class="modal-dialog">
          <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Editar Bitacora</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="formulario2">
              <div class="card-body">
                <div class="row">  
                
                    <!-- id del expediente -->                  
                  <input type="hidden" class="form-control" id="idexpE">

                  <div class="form-group" style="width:100%">
                    <label style="color:#191818">Comentarios</label>
                    <br>
                    <textarea id="editor2"  class="form-control" name="editor2"  rows="4" cols="50"></textarea>
                  </div> 
             

                </div> 
              </div>
            </form>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" id="btnGuardar" onclick="editarBitacora()">Guardar</button>
          </div>          
        </div>        
      </div>      
    </div>
      
    <div class="modal fade" id="modalEliminarBitacora">
      <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Eliminar Bitacora</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
            </div>
                  <div class="modal-body">
                    <input type="hidden" id="idDF"/> <!-- id de la bitacora para borrarlo-->                           
                  </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>             
              <button class="btn btn-danger" id="btnBorrar" type="button" onclick="borrarBitacora()">Borrar</button>
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
      var ruta = "{{ URL::to('admin/tablas/bitacora') }}";   
      $('#tablaDatatable').load(ruta);
    });

  
 </script>


  <script>

    function abrirModalAgregar(){
      document.getElementById("formulario").reset();
      $('#modalAgregar').modal('show'); 
    }

  // guardar nueva bitacora
  function guardarBitacora(){

    var idexp = document.getElementById('idexp').value;    
    var imagen = document.getElementById('logo'); 
    var retorno = validaciones(idexp, imagen);
    var editor1 = document.getElementById('editor1').value;   

    if(retorno){        
        var spinHandle = loadingOverlay().activate(); 

        let formData = new FormData();
        formData.append('idexp', idexp);
        formData.append('editor1', editor1);

        var files = imagen.files;
        for (var i = 0; i < files.length; i++){
            var file = files[i];
            
            // Add the file to the request.
            formData.append('imagen[]', file, file.name);
        }

        axios.post('/admin/bitacora/agregar', formData, {  
            })
            .then((response) => {	
               
            loadingOverlay().cancel(spinHandle);    
            mensajeResponse(response);
            })
            .catch((error) => {
            loadingOverlay().cancel(spinHandle); 
            toastr.error('Error', 'Datos incorrectos!');               
        }); 
    } 
}

    // mensaje cuando guardamos slider
    function mensajeResponse(valor){
        if(valor.data.success == 1){
            toastr.success('Guardado', 'Bitacora creada!');
            $('#modalAgregar').modal('hide'); 
            var ruta = "{{ URL::to('admin/tablas/bitacora') }}";   
            $('#tablaDatatable').load(ruta);
        }else if(valor.data.success == 2){
            toastr.error('ID expediente no encontrado');
        }else{
            // error en validacion en servidor
            toastr.error('Error', 'Datos incorrectos!');
        }
    }

    // validar antes de agregar 
    function validaciones(idexp, imgFile){            
        if(imgFile.files && imgFile.files[0]){ // si agrego imagenes
            var files = imgFile.files;
            for (var i = 0; i < files.length; i++){
                var file = files[i];

                if (!file.type.match('image/jpeg|image/jpeg')){
                toastr.error('Error', 'Formatos de imagen validos unicamente .jpg .jpeg');
                return false;
                break;
                }  
            }        
        }

        if(idexp === ''){
            toastr.error('ID expediente es requerido');
            return false;
        } 
        return true;
    } 

  // ver tabla de fotos
  function abrirTablaFotos(id){
    window.location.href="{{ url('/admin/fotografia') }}/"+id;
  }
 
  // abre el modal para eliminar slider
  function abrirModalEliminar(id){
    $('#modalEliminarBitacora').modal('show');
    $('#idDF').val(id);
  }

  // enviar peticion para borrar el slider
  function abrirModalEditar(id){
   
    spinHandle = loadingOverlay().activate();

    axios.post('/admin/bitacora/informacion',{
      'id': id
        }) 
        .then((response) => {	
          loadingOverlay().cancel(spinHandle);
          if(response.data.success == 1){
          
            $('#modalEditar').modal('show');
            $('#idexpE').val(response.data.info.id);
            $('#editor2').val(response.data.info.observaciones);
          
          }else{
            toastr.error('Error al obtener datos');  
          }       
        })
        .catch((error) => {
          loadingOverlay().cancel(spinHandle);
          toastr.error('Error');               
    });
  }
 
  function editarBitacora(){

      var id = document.getElementById('idexpE').value;
      var editor2 = document.getElementById('editor2').value;
      spinHandle = loadingOverlay().activate();
      var formData = new FormData();
      formData.append('id', id);
      formData.append('editor2', editor2);

      axios.post('/admin/bitacora/editar', formData, {
      })
      .then((response) => {
        loadingOverlay().cancel(spinHandle);

        if(response.data.success == 1){
          $('#modalEditar').modal('hide');
          toastr.success('Guardado');
        }
        else{
          toastr.error('Error al editar');
        }
      })
      .catch((error) => {          
        loadingOverlay().cancel(spinHandle);
        toastr.error('Error al editar');             
    });       
  }

  function borrarBitacora(){

      var id = document.getElementById('idDF').value;    

      var formData = new FormData();
      formData.append('id', id);
      spinHandle = loadingOverlay().activate();
      axios.post('/admin/eliminar-bitacora', formData, {
      })
      .then((response) => {
        loadingOverlay().cancel(spinHandle);
          
        if(response.data.success == 1){
          $('#modalEliminarBitacora').modal('hide');
          toastr.success('Eliminado');
        }
        else{
          toastr.error('Error al eliminar');
        }
      })
      .catch((error) => {          
        loadingOverlay().cancel(spinHandle);
        toastr.error('Error');             
    });      

  }
    

  </script>



@stop