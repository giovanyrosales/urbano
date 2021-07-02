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
            <h1>Reporte de Bitacoras</h1>
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
      var ruta = "{{ URL::to('admin/tablas/bitacora/reporte') }}";
      $('#tablaDatatable').load(ruta);
    });
  </script>


  <script>


  </script>



@stop