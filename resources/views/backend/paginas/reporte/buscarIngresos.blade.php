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
          
          
        </div>
      </div>
    </section>

    <!-- seccion frame -->
    <section class="content" style="display: flex; justify-content: center;">        
      <div class="col-sm-4">
        <form class="form-horizontal" id="form1">
        <div class="card card-gray">
          <div class="card-header">
            <h3 class="card-title">Buscar ingresos</h3>
          </div>
        
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label>Fecha de:</label>
                    <input type="date" id="fecha1" class="form-control">
                </div>
              </div>           
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label>Fecha hasta:</label>
                    <input type="date" id="fecha2" class="form-control">
                </div>
              </div>           
            </div>
          </div>
            <div class="card-footer">
                <button type="button" class="btn btn-info float-right" onclick="buscar()">Buscar</button>
            </div>
         </div>
      </form>
      </div>
    </section>

@extends('backend.menus.indexInferior')

  @section('content-admin-js')	

  <!-- data table -->
  <script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}" type="text/javascript"></script>
  <script src="{{ asset('plugins/datatables/dataTables.bootstrap4.js') }}" type="text/javascript"></script>
  <script src="{{ asset('plugins/toastr/toastr.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('js/axios.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('plugins/loading/loadingOverlay.js') }}" type="text/javascript"></script>

  <script src="{{ asset('plugins/ckeditor/ckeditor.js') }}" type="text/javascript"></script>

  <script type="text/javascript">	
   
 </script>

  <script>

  function buscar(){
    var fecha1 = document.getElementById('fecha1').value;
    var fecha2 = document.getElementById('fecha2').value;

    if(fecha1 === "" || fecha2 === ""){

      toastr.error('Fechas son requeridas');
      return;
    }

      window.open("{{ URL::to('admin/generar/ingresos') }}/" + fecha1 + "/" + fecha2);

  }  

  </script>



@stop