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
            <h1>Lista de Resoluciones</h1>
          </div>     
        </div>
      </div>
    </section>

    <!-- seccion frame -->
    <section class="content">
      <div class="container-fluid">
        <div class="card card-gray">
          <div class="card-header">
            <h3 class="card-title">Tabla de Resoluciones</h3>           
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
    
    <!-- generar entrega -->
    <div class="modal fade" id="modalEntrega">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Generar entrega</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="frmEntrega">
          <div class="modal-body"> 
          
              <div class="form-group">
                  <label style="color:#191818">Recibe</label>
                  <br>
                  <input id="idEntrega" type="hidden"></label>  
                  <input id="recibeEntrega" maxlength="150" type="text" class="form-control"></label>
              </div> 
             
              <div class="form-group">
                  <label style="color:#191818">Fecha de entega</label>
                  <br>                 
                  <input id="fechaEntrega" type="date" class="form-control"></label>
              </div>

          </div>
        </form>
        <div class="modal-footer float-right">
          <button type="button" class="btn btn-primary" onclick="agregarEntrega()">Guardar</button>
        </div>
      </div>      
    </div>        
  </div>

  <div class="modal fade" id="modalEditar">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Editar Resolución</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="formEditar">
          <div class="modal-body">   

            <div class="form-group">
                <label style="color:#191818">Descripción</label>
                <br>
                <input type="hidden" id="idres">
                <textarea id="editor1"  class="form-control" name="editor1"></textarea>
            </div> 
            
          </div>
        </form>
        <div class="modal-footer float-right">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary" onclick="guardarResolucion()">Guardar</button>
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
      var ruta = "{{ URL::to('admin/tablas/resoluciones') }}";   
      $('#tablaDatatable').load(ruta);
    });

    CKEDITOR.replace('editor1'); 
 </script>

  <script>

  function abrirModalEntrega(id){ //id de resolucion

    $('#idEntrega').val(id);
    $('#modalEntrega').modal('show'); 

  }

  function agregarEntrega(){

      var id = document.getElementById('idEntrega').value;
      var recibe = document.getElementById('recibeEntrega').value;
      var fecha = document.getElementById('fechaEntrega').value;

      if(fecha == null || fecha == ""){
        toastr.error('Agregar fecha');
        return;
      }
    
      var spinHandle = loadingOverlay().activate();
      let formData = new FormData();
      formData.append('id', id);
      formData.append('recibe', recibe);
      formData.append('fecha', fecha);
   
      axios.post('/admin/resolucion/entregar', formData, {  
        })
        .then((response) => {	 
          loadingOverlay().cancel(spinHandle); 
          console.log(response);
          if (response.data.success == 1) {

          $('#modalEntrega').modal('hide');
          var ruta = "{{ URL::to('admin/tablas/resoluciones') }}";  
          $('#tablaDatatable').load(ruta);

          // abrir pdf
          window.open("{{ URL::to('admin/generar/pdf') }}/"+ response.data.exp);
         
          }else {
              toastr.error('Resolución no encontrada'); 
          }

        })
        .catch((error) => {         
          loadingOverlay().cancel(spinHandle);
          toastr.error('Error');               
      }); 
  }
 
  function abrirModalEditar(id){

    var spinHandle = loadingOverlay().activate(); 

    axios.post('/admin/resolucion/informacion',{
    'id': id  
        })
        .then((response) => {	
        loadingOverlay().cancel(spinHandle); 
       
            if(response.data.success == 1){
            
                $('#modalEditar').modal('show');
                $('#idres').val(response.data.datos.id); //id de la resolucion
                CKEDITOR.instances['editor1'].setData(response.data.datos.comentarios);
            }else{ 
                toastr.error('Resolución no encontrado'); 
            }
        })
        .catch((error) => {
        loadingOverlay().cancel(spinHandle); 
        toastr.error('Error');   
    });
  }

  function guardarResolucion(){

    var idres = document.getElementById('idres').value;   
    var editor1 = CKEDITOR.instances.editor1.getData();

    if(editor1 == null || editor1 == ""){
      toastr.error('Agregar descripción');
      return;
    } 

    var spinHandle = loadingOverlay().activate(); 
            
    let formData = new FormData();
    formData.append('res_id', idres); 
    formData.append('editor1', editor1);

    axios.post('/admin/resolucion/editar', formData, {  
        })
        .then((response) => {          
        loadingOverlay().cancel(spinHandle);    
        if(response.data.success == 1){
          $('#modalEditar').modal('hide');
          toastr.success('Actualizado'); 
        }else{
          toastr.error('Error al modificar datos'); 
        }
        })
        .catch((error) => {
        loadingOverlay().cancel(spinHandle); 
        toastr.error('Error', 'Datos incorrectos!');               
    });      
  }



  </script>


@stop