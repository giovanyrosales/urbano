 <!-- Main content -->
 <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">         
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>             
                <tr>
                  <th style="width: 5%">Expediente_id</th>   
                  <th style="width: 25%">Opciones</th>                          
                </tr>
                </thead>
                <tbody>
                @foreach($bitacora as $dato)
                <tr>
                  <td>{{ $dato->expediente_id }}</td>
                              
                  <td><center>
                      <button type="button" class="btn btn-success btn-xs" onclick="abrirTablaFotos({{ $dato->id }})">
                      <i class="fas fa-pencil-alt" title="Ver Fotos"></i>&nbsp; Ver Fotos
                      </button>

                      <button type="button" class="btn btn-info btn-xs" onclick="abrirModalEditar({{ $dato->id }})">
                      <i class="fas fa-pencil-alt" title="Editar"></i>&nbsp; Editar
                      </button>

                      <button type="button" class="btn btn-danger btn-xs" onclick="abrirModalEliminar({{ $dato->id }})">
                      <i class="fas fa-trash-alt" title="Eliminar"></i>&nbsp; Eliminar
                      </button>
                    </center>
                  </td>                    
                </tr>
                @endforeach            
                </tbody>            
              </table>
            </div>          
          </div>
        </div>
      </div>
    </section>
    
  <script type="text/javascript">
    $(document).ready(function() {
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "language": {
        "info": "Mostrando _START_ a _END_ de _TOTAL_ entradas",
       
        }
      });
    });
</script>



