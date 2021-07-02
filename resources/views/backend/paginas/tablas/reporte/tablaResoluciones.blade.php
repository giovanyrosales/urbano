 <!-- Main content -->
 <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">         
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>             
                <tr>
                  <th style="width: 17%">Solicitante</th>                 
                  <th style="width: 17%">Fecha Resolución</th> 
                  <th style="width: 8%">Exp.</th>
                  <th style="width: 8%">Monto</th>
                  <th style="width: 15%">Fecha Entrega</th>  
                  <th style="width: 20%">recibe</th>                 
                  <th style="width: 15%">Opciones</th>                          
                </tr>
                </thead>
                <tbody>
                @foreach($resoluciones as $dato)
                <tr>
                  <td>{{ $dato->solicitante }}</td>
                  <td>{{ date('d-m-Y', strtotime($dato->fecha_resolucion)) }}</td>                 
                  <td>{{ $dato->expCorrelativo }}</td>
                  <td>{{ $dato->monto }}</td>
                  <td>{{ date('d-m-Y', strtotime($dato->fecha)) }}</td>
                  <td>{{ $dato->recibe }}</td>
                              
                  <td><center>                    
                        
                    @if ($dato->estadoid == 2) 

                    <button type="button" class="btn btn-info btn-xs" onclick="abrirModalEditar({{ $dato->id }})">
                      <i class="fas fa-pencil-alt" title="Editar"></i>&nbsp; Editar
                    </button>

                    <button type="button" class="btn btn-info btn-xs" onclick="abrirModalEntrega({{ $dato->id }})">
                      <i class="fas fa-pencil-alt" title="Entrega"></i>&nbsp; Entrega
                    </button>
                    @elseif ($dato->estadoid == 3)
                    <a target="_blank" href="{{ url('admin/generar/pdf/'.$dato->idExp) }}"
                      class="btn btn-success btn-xs"> <i class="fas fa-pencil-alt" title="Ver PDF"></i>&nbsp; Ver PDF</a>
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





   