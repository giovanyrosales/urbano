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
            <h1>Lista de Expedientes</h1>
          </div>
          <div class="col-sm-2">
          <button type="button" onclick="abrirModalAgregar()" class="btn btn-success btn-sm">
          <i class="fas fa-pencil-alt"></i>
          Nuevo Expediente
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
            <h3 class="card-title">Tabla de Expedientes</h3>           
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
    
   <!-- modal agregar nuevo expediente -->
   <div class="modal fade" id="modalAgregar">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Nuevo Expediente</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="formAgregar">
          <div class="modal-body">         
              <div class="form-group">
                  <label style="color:#191818">Exp</label>
                  <br>
                  <input id="exp" disabled type="text" class="form-control" required></label>
              </div>  
              
              <div class="form-group">
                  <label style="color:#191818">Solicitante</label>
                  <br>
                  <input id="solicitante" type="text" class="form-control" maxlength="150" required></label>
              </div>  
  
              <div class="form-group">
                  <label style="color:#191818">Proceso</label>
                  <br>
                  <div>
                  <select class="form-control" id="proceso">
                    @foreach($proceso as $item)
                      <option value="{{$item->id}}">{{$item->nombre}}</option>
                    @endforeach
                  </select>
                  </div>
              </div>  

              <div class="form-group">
                  <label style="color:#191818">Correo eléctronico</label>
                  <br>
                  <input id="correo" type="email" maxlength="150" class="form-control"></label>
              </div> 

              <div class="form-group">
                  <label style="color:#191818">Teléfono</label>
                  <br>
                  <input id="telefono" maxlength="150" type="text" class="form-control"></label>
              </div> 

              <div class="form-group">
                  <label style="color:#191818">Dirección</label>
                  <br>
                  <input id="direccion" maxlength="350" type="text" class="form-control"></label>
              </div> 

              <div class="form-group">
                  <label style="color:#191818">Comentarios</label>
                  <br>
                  <textarea class="form-control" id="comentario" rows="4" >            
                  </textarea>
              </div> 

          </div>
        </form>
        <div class="modal-footer float-right">
          <button type="button" class="btn btn-primary" onclick="guardarExpediente()">Guardar</button>
        </div>
      </div>      
    </div>        
  </div>

   <!-- modal editar expediente -->
   <div class="modal fade" id="modalEditar">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Editar Expediente</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="formAgregar">
          <div class="modal-body">  
              
              <div class="form-group">
                  <label style="color:#191818">Solicitante</label>
                  <br>
                  <input id="eId" type="hidden"></label>
                  <input id="eSolicitante" type="text" class="form-control" maxlength="150" required></label>
              </div>  

              <div class="form-group">
                  <label style="color:#191818">Correo eléctronico</label>
                  <br>
                  <input id="eCorreo" type="email" maxlength="150" class="form-control"></label>
              </div> 

              <div class="form-group">
                  <label style="color:#191818">Teléfono</label>
                  <br>
                  <input id="eTelefono" maxlength="150" type="text" class="form-control"></label>
              </div> 

              <div class="form-group">
                  <label style="color:#191818">Dirección</label>
                  <br>
                  <input id="eDireccion" maxlength="350" type="text" class="form-control"></label>
              </div> 

              <div class="form-group">
                  <label style="color:#191818">Comentarios</label>
                  <br>
                  <textarea class="form-control" id="eComentario" rows="4" >            
                  </textarea>
              </div> 

          </div>
        </form>
        <div class="modal-footer float-right">
          <button type="button" class="btn btn-primary" onclick="editarExpediente()">Guardar</button>
        </div>
      </div>      
    </div>        
  </div>

     <!-- modal agregar resolucion -->
  <div class="modal fade" id="modalAgregarRes">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Agregar Resolución</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="formAgregarResolucion">
          <div class="modal-body">  

            
          
              <div class="form-group">
                  <label style="color:#191818">Monto</label>
                  <br>
                  <input id="idExpRes" type="hidden"></label>  <!-- id del expediente para obtener num_exp en controller -->
                  <input id="rMonto" maxlength="7" type="number" step=".01" class="form-control"></label>
              </div> 

              <!-- observaciones -->
              
              <div class="form-group">
                  <label style="color:#191818">Resolución</label>
                  <br>
                  <textarea id="editor1"  class="form-control" name="editor1"></textarea>
              </div> 
            

          </div>
        </form>
        <div class="modal-footer float-right">
          <button type="button" class="btn btn-primary" onclick="agregarResolucion()">Guardar</button>
        </div>
      </div>      
    </div>        
  </div>

  <!-- modal agregar documentos solo expediente -->
  <div class="modal fade" id="modalDocExpediente">
        <div class="modal-dialog">
          <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Nuevo Documento</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form id="formExp">
           <div class="modal-body"> 
              <div class="form-group">
                <div>
                    <label>Documento Expediente</label>
                </div>
                <br>
                <div class="col-md-10">
                  <input type="hidden" id="idDoc">
                  <input type="file" id="docExp" accept="application/pdf" />
              </div>
            </div>  
          </div>         
          </form>

        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>             
          <button class="btn btn-primary" id="btnGuardar" type="button" onclick="agregarDocExpediente()">Guardar</button>
        </div>
      </div>      
    </div>        
  </div>
  
   <!-- modal agregar documentos expediente y resolucion -->
   <div class="modal fade" id="modalDocExpedienteRes">
        <div class="modal-dialog">
          <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Nuevo Documento</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

        <div class="modal-body"> 
          <form id="formExpRes">
              <div class="form-group">
                  <div>
                      <label>Documento Expediente</label>
                  </div>
                  <br>
                  <div class="col-md-10">
                    <input type="hidden" id="idDoc2">
                    <input type="file" id="docExp2" accept="application/pdf" />
                  </div>
              </div>
              
              <div class="form-group">
                  <div>
                      <label>Documento Resolución</label>
                  </div>
                  <br>
                  <div class="col-md-10">
                    <input type="file" id="docRes" accept="application/pdf" />
                  </div>
              </div>  
          </form>
        </div>
          
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>             
          <button class="btn btn-primary" id="btnGuardar" type="button" onclick="agregarDocExpedienteRes()">Guardar</button>
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
      var ruta = "{{ URL::to('admin/tablas/expediente') }}";   
      $('#tablaDatatable').load(ruta);
    });

    CKEDITOR.replace('editor1'); 
 </script>

  <script>

  // *
  function abrirModalAgregar(){   
    $('#exp').val('10');            
    $('#modalAgregar').modal('show'); 
  }
  
  // guardar nuevo expediente *
  function guardarExpediente(){

      var exp = document.getElementById('exp').value;
      var solicitante = document.getElementById('solicitante').value;
      var proceso = document.getElementById('proceso').value;
      var correo = document.getElementById('correo').value;
      var telefono = document.getElementById('telefono').value;
      var direccion = document.getElementById('direccion').value;
      var comentario = document.getElementById('comentario').value;
  
      var retorno = validaciones(solicitante);

      if(retorno){

        var spinHandle = loadingOverlay().activate(); 
              
        let formData = new FormData();
        formData.append('exp', exp);
        formData.append('solicitante', solicitante);
        formData.append('proceso', proceso);
        formData.append('correo', correo);
        formData.append('telefono', telefono);
        formData.append('direccion', direccion);
        formData.append('comentario', comentario);

        axios.post('/admin/expediente/agregar', formData, {  
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

  // mensaje cuando guardamos expediente nuevo *
  function mensajeResponse(valor){
    if(valor.data.success == 1){
      toastr.success('Nuevo expediente creado');
      $('#modalAgregar').modal('hide');             
      var ruta = "{{ URL::to('admin/tablas/expediente') }}";   
      $('#tablaDatatable').load(ruta);
      document.getElementById("formAgregar").reset();
    }else if(valor.data.success == 2){
      toastr.error('Error al crear el expediente');
    }else{   
      toastr.error('Error de validacion');
    }
  }
     
    // validar antes de agregar expediente *
  function validaciones(nombre){

      if(nombre === ''){
          toastr.error('Solicitante es requerido');
          return false;
      }
    
      return true;     
  } 

  // abre el modal para editar el expediente *
  function abrirModalEditar(id){
    
    spinHandle = loadingOverlay().activate();
    axios.post('/admin/expediente/informacion',{
      'id': id  
        })
        .then((response) => {	
          console.log(response);
          loadingOverlay().cancel(spinHandle); 
          if(response.data.success = 1){
            
            $('#eId').val(response.data.expediente.id);
            $('#eSolicitante').val(response.data.expediente.solicitante);
            $('#eCorreo').val(response.data.expediente.correo_solicitante);
            $('#eTelefono').val(response.data.expediente.telefono);
            $('#eDireccion').val(response.data.expediente.direccion);
            $('#eComentario').val(response.data.expediente.comentarios);

            $('#modalEditar').modal('show');
            
            
          }else{ 
            toastr.error('Estado no encontrado'); 
          }
        })
        .catch((error) => {
          console.log(error)
          loadingOverlay().cancel(spinHandle); 
          toastr.error('Error del servidor');    
    });
  }

  // editar expediente *
  function editarExpediente(){
            
      var id = document.getElementById('eId').value;
      var solicitante = document.getElementById('eSolicitante').value;
      var correo = document.getElementById('eCorreo').value;
      var telefono = document.getElementById('eTelefono').value;
      var direccion = document.getElementById('eDireccion').value;
      var comentario = document.getElementById('eComentario').value;

      var retorno = validacionesEditar(solicitante);
    
      if(retorno){
          var spinHandle = loadingOverlay().activate();         
          
          var formData = new FormData();
          formData.append('id', id);
          formData.append('solicitante', solicitante);
          formData.append('correo', correo);
          formData.append('telefono', telefono);
          formData.append('direccion', direccion);
          formData.append('comentario', comentario);     
  
          axios.post('/admin/expediente/editar', formData, {        
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
          var ruta = "{{ URL::to('admin/tablas/expediente') }}";   
          $('#tablaDatatable').load(ruta);   
          toastr.success('Expediente actualizado');          
      }else {
          toastr.error('Error al editar expediente'); 
      }
  }
        
  // validar antes de editar *
  function validacionesEditar(solicitante){           
      
      if(solicitante === ''){
          toastr.error('Solicitante es requerido'); 
          return false;
      }

      return true;
  } 

  // abrir modal para agregar resolucion *
  function abrirModalResolucion(id){
    $('#idExpRes').val(id);
    $('#modalAgregarRes').modal('show'); 
  }

  // agregar nueva resolucion *
  function agregarResolucion(){
      var id = document.getElementById('idExpRes').value;
      var monto = document.getElementById('rMonto').value;

      var editor1 = CKEDITOR.instances.editor1.getData();  
     
    
      var spinHandle = loadingOverlay().activate(); 
      let formData = new FormData();
      formData.append('idExpRes', id);
      formData.append('rMonto', monto);
      formData.append('editor1', editor1);
    

      axios.post('/admin/resolucion/agregar', formData, {  
        })
        .then((response) => {	
          loadingOverlay().cancel(spinHandle); 
          mensajeResolucion(response);
        })
        .catch((error) => {         
          loadingOverlay().cancel(spinHandle);
          toastr.error('Error del servidor');               
      });      
  }

  function mensajeResolucion(response){
    if (response.data.success == 1) { 
          $('#modalAgregarRes').modal('hide');    
          document.getElementById("formAgregarResolucion").reset();        
          var ruta = "{{ URL::to('admin/tablas/expediente') }}";   
          $('#tablaDatatable').load(ruta);   
          toastr.success('Resolución creada');          
      }else {
          toastr.error('Error al crear resolución'); 
      }
  }

  function abrirModalExp(id){
    $('#idDoc').val(id);
    document.getElementById("formExp").reset();
    $('#modalDocExpediente').modal('show');
  }

  function abrirModalExpRes(id){
    $('#idDoc2').val(id);
    document.getElementById("formExpRes").reset();
    $('#modalDocExpedienteRes').modal('show');
  }
 
  // agregar documento solo expediente
  function agregarDocExpediente(){
    var idExp = document.getElementById("idDoc").value;
    var docExp = document.getElementById("docExp");
    var retorno = validarDocExp(docExp);
    
    if(retorno){
      var spinHandle = loadingOverlay().activate();      
            
      let formData = new FormData();    
      formData.append('idDoc', idExp); 
      formData.append('docExp', docExp.files[0]);   

      axios.post('/admin/documento/expediente', formData, {  
        })
        .then((response) => {	
          loadingOverlay().cancel(spinHandle); 
          if(response.data.success == 1){
          $('#modalDocExpediente').modal('hide');
          toastr.success('Documentos agregados'); 
          }else{
            toastr.error('Error al subir archivos');
          }
        })
        .catch((error) => {
         
          loadingOverlay().cancel(spinHandle);
          toastr.error('Error del servidor');               
        }); 
    }
  }

  // validar el archivo sea pdf
  function validarDocExp(docExp){
    
   // solo si hay documento agregado  
   if(docExp.files && docExp.files[0]){ // si trae documento
      if (!docExp.files[0].type.match('application/pdf')){      
        toastr.error('Documento debe ser PDF');
        return false;       
      } 
    }
    else{
      toastr.error('Documento expediente es requerido');
      return false;
    }

    return true;
  }

  // agregar documento expediente y resoluciones
  function agregarDocExpedienteRes(){
    var idExp = document.getElementById("idDoc2").value;
    var docExp = document.getElementById("docExp2");
    var docRes = document.getElementById("docRes");
   
    var retorno = validarArchivos(docExp, docRes);
    
    if(retorno){ 

      var spinHandle = loadingOverlay().activate(); 
      let formData = new FormData();
      formData.append('idDoc', idExp);
      formData.append('docExp2', docExp.files[0]);
      formData.append('docRes', docRes.files[0]);

      axios.post('/admin/documento/exp-res', formData, {
        })
        .then((response) => {	
          loadingOverlay().cancel(spinHandle); 
          if(response.data.success == 1){
            $('#modalDocExpedienteRes').modal('hide');
            toastr.success('Documentos agregados'); 
          }else{
            toastr.error('Error al subir archivos'); 
          }
        })
        .catch((error) => {
         
          loadingOverlay().cancel(spinHandle);
          toastr.error('Error del servidor'); 
        }); 
    }
  }

  // validar que mande al menos un documento
  function validarArchivos(docExp, docRes){
    var contador = 0;
    if(docExp.files && docExp.files[0]){
      contador ++;
    }

    if(docRes.files && docRes.files[0]){
      contador ++;
    }

    if(contador > 0){
      return true;
    }else{
      toastr.error('Agregar un documento'); 
      return false;
    }
  }

  </script>



@stop