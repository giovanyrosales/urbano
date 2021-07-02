 <!-- Main content -->
 <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">         
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>             
                <tr>
                  <th style="width: 5%">Exp</th>                 
                  <th style="width: 20%">Solicitante</th> 
                  <th style="width: 20%">Proceso</th>
                  <th style="width: 20%">Estado</th>
                  <th style="width: 10%">Fecha de ingreso</th>                 
                  <th style="width: 25%">Opciones</th>                          
                </tr>
                </thead>
                <tbody>
                @foreach($expediente as $dato)
                <tr>
                  <td>{{ $dato->exp }}</td>
                  <td>{{ $dato->solicitante }}</td>
                  <td>{{ $dato->nombreProceso }}</td>
                  <td>{{ $dato->nombreEstado }}</td>
                  <td>{{ date('d-m-Y', strtotime($dato->fecha)) }}</td>
                              
                  <td><center>
                      <button type="button" class="btn btn-info btn-xs" onclick="abrirModalEditar({{ $dato->id }})">
                      <i class="fas fa-pencil-alt" title="Editar"></i>&nbsp; Editar
                      </button>
                    @if ($dato->estadoid == 1)
                      <button type="button" class="btn btn-info btn-xs" onclick="abrirModalResolucion({{ $dato->id }})">
                      <i class="fas fa-pencil-alt" title="Resolución"></i>&nbsp; Resolución
                      </button>

                      <!-- solo puede agregar expediente -->
                      <button type="button" class="btn btn-info btn-xs" onclick="abrirModalExp({{ $dato->id }})">
                      <i class="fas fa-pencil-alt" title="Editar"></i>&nbsp; Documento
                    </button>
                    @elseif ($dato->estadoid == 2) 
                     <!-- <a target="_blank" href="{{ url('admin/generar/pdf/'.$dato->id) }}" 
                      class="btn btn-info btn-xs"> <i class="fas fa-pencil-alt" title="Ver PDF"></i>&nbsp; Ver PDF</a>  -->

                      <!-- solo puede agregar expediente y resolucion -->
                    <button type="button" class="btn btn-info btn-xs" onclick="abrirModalExpRes({{ $dato->id }})">
                      <i class="fas fa-pencil-alt" title="Editar"></i>&nbsp; Documento
                    </button> 
                    @elseif ($dato->estadoid == 3) 
                     <!--   <a target="_blank" href="{{ url('admin/generar/pdf/'.$dato->id) }}"
                      class="btn btn-success btn-xs"> <i class="fas fa-pencil-alt" title="Ver PDF"></i>&nbsp; Ver PDF</a>
                        -->
                      <!-- solo puede agregar expediente y resolucion -->
                    <button type="button" class="btn btn-info btn-xs" onclick="abrirModalExpRes({{ $dato->id }})">
                      <i class="fas fa-pencil-alt" title="Editar"></i>&nbsp; Documento
                    </button>  
                    @endif    

                  
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





   