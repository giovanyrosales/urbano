<!DOCTYPE html>
<html lang="es">

<head>
  <title>Panel de control</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- libreria fuentes adminlte3 -->
  <link href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}" type="text/css" rel="stylesheet" />
  <!-- libreria estilos adminlte3 -->
  <link href="{{ asset('css/backend/adminlte3/adminlte.min.css') }}" type="text/css" rel="stylesheet" />
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <link href="{{ asset('css/backend/adminlte3/dataTables.bootstrap4.css') }}" type="text/css" rel="stylesheet" />
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

</head>

<body class="hold-transition sidebar-mini">
  

  <!-- Main content -->
  <div class="wrapper"> 
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-12">
          <div class="col-sm-6">
          <button type="button" class="btn btn-success" title="Nuevo Expediente" onclick="verExpediente()">
              Nuevo Expediente
            </button>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Resumen</li>
            </ol>
          </div>
        </div>
      </div>
    </div> 

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-4 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $expediente }}</h3>

                <p>Expediente pendiente de resolución</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-paper"></i>
              </div>
              <a class="small-box-footer"><i class="icon ion-pie-graph"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
              <h3>${{ $totalMonto }}</h3>

                <p>Ingresos totales del presente año</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-briefcase"></i>
              </div>
              <a class="small-box-footer"><i class="icon ion-pie-graph"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $resSinEntregar }}</h3>

                <p>Resoluciones sin entregar</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-paper"></i>
              </div>
              <a class="small-box-footer"><i class="icon ion-pie-graph"></i></a>
            </div>
          </div>
      
        </div>
    
      </div>
    </section>
  </div>


  <!-- libreria jquery -->
  <script src="{{ asset('plugins/jquery/jquery.min.js') }}" type="text/javascript"></script>
  <!-- libreria bootstrap4 -->
  <script src="{{ asset('plugins/bootstrap/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
  <!-- libreria adminlte3 -->
  <script src="{{ asset('js/backend/adminlte3/adminlte.min.js') }}" type="text/javascript"></script>
  <!-- ChartJS -->
  <script src="{{ asset('js/backend/adminlte3/Chart.min.js') }}"></script>

  @yield('content-admin-js')
  <script>

</script>
<script>

function verExpediente(){
  window.location.href="{{ url('/admin/expediente/lista') }}";
}

  </script>
</body>

</html>