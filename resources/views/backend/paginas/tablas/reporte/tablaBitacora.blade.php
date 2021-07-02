 <!-- Main content -->
 <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">         
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>             
                <tr>
                  <th style="width: 15%">Expediente</th>  
                  <th style="width: 50%">Solicitante</th>   
                  <th style="width: 25%">Opciones</th>                          
                </tr>
                </thead>
                <tbody>
                @foreach($bitacora as $dato)
                <tr>
                  <td>{{ $dato->exp }}</td>
                  <td>{{ $dato->solicitante }}</td>
                              
                  <td><center>
                  <a target="_blank" href="{{ url('admin/generar/pdf/bitacora/'.$dato->id) }}"
                      class="btn btn-success btn-xs"> <i class="fas fa-pencil-alt" title="Reporte"></i>&nbsp; Reporte</a>                   
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



