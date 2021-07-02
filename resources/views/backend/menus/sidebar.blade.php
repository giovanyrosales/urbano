
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar elevation-4 sidebar-light-danger">


  
    <!-- Brand Logo -->
    <a href="#" class="brand-link navbar-danger">
      <img src="{{ asset('/images/LOGO_2_-_copia.png') }}" alt="Admin Logo" class="brand-image img-circle elevation-3">
      <span class="brand-text" style="color:white"><strong>Panel de Control</strong></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
         <a>{{ $usuario->nombre.' '.$usuario->apellido }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
 
          <li class="nav-item">
            <a href="{{ url('/admin/inicio') }}" target="frameprincipal" class="nav-link active">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Inicio                
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('/admin/expediente/lista') }}" target="frameprincipal" class="nav-link">
              <i class="nav-icon fa fa-id-card"></i>
              <p>
                Expediente
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('/admin/bitacora/lista') }}" target="frameprincipal" class="nav-link">
              <i class="nav-icon fa fa-folder-open"></i>
              <p> 
                Bitacora
              </p>
            </a>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-file"></i>
              <p>
                Reporte
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('/admin/vista/buscar/expediente') }}" target="frameprincipal" class="nav-link active">
                  <i class="fa fa-circle" style="padding-left:15px"></i>
                  <p>Por expediente</p>
                </a>
              </li> 
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('/admin/ver/bitacora/reporte') }}" target="frameprincipal" class="nav-link active">
                <i class="fa fa-circle" style="padding-left:15px"></i>
                  <p>Por bitacora</p>
                </a>
              </li> 
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('/admin/vista/buscar/ingresos') }}" target="frameprincipal" class="nav-link active">
                <i class="fa fa-circle" style="padding-left:15px"></i>
                  <p>Ingresos</p>
                </a>
              </li> 
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-paperclip"></i>
              <p>
                Resoluciones
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('/admin/ver/resoluciones') }}" target="frameprincipal" class="nav-link active">
                <i class="fa fa-circle" style="padding-left:15px"></i>
                  <p>Entrega</p>
                </a>
              </li> 
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-cog"></i>
              <p>
                Configuración
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('/admin/proceso/lista') }}" target="frameprincipal" class="nav-link active">
                <i class="fa fa-circle" style="padding-left:15px"></i>
                  <p>Procesos</p>
                </a>
              </li> 
              <li class="nav-item">
                <a href="{{ url('/admin/estado/lista') }}" target="frameprincipal" class="nav-link active">
                <i class="fa fa-circle" style="padding-left:15px"></i>
                  <p>Estados</p>
                </a>
              </li>  
                       
            </ul>
          </li>

        </ul>
      </nav>     
    </div> 
  </aside>

