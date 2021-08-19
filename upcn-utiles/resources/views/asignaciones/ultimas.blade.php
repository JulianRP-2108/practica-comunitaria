<!-- Kits Asignados -->
<div>
  <div class="row">
      <div class="col">
          <h4>Últimas asignaciones</h4>
      </div>
  </div>
  
  <div class="card">
      <div class="card-body">
          <div class="row">
              <div class="col">
                  <table class="table table-bordered table-striped" id="tablaAsignaciones">
                      </div>
                      <thead>
                          <tr>
                              <th>Fecha</th>
                              <th>Nombre</th>
                              <th>Apellido</th>
                              <th>DNI</th>
                              <th>Nº Hijos</th>
                              <th>Localidad</th>
                              <th>Kits asignados</th>
                          </tr>
                      </thead>
                  </table>
              </div>
              
          </div>
      </div>
  </div>
</div>

<script>
    $(document).ready(function () {
        var tabla = $('#tablaAsignaciones').DataTable( {
        ajax: {
            url: "{{route('datatable.asignaciones')}}",
            method: 'GET',
            data: {
                anio: {{$anio}}
            },
            dataSrc: 'data'
        },
        columns: [
            { data: 'created_at' },
            { data: 'nombre' },
            { data: 'apellido' },
            { data: 'dni' },
            { data: 'cantidadHijos' },
            { data: 'localidad' },
            { data: 'cantidad' },
        ],
        responsive: true,
        autoWidth: false,
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "search":         "Buscar:",
            "info":           "Mostrando _START_ a _END_ de _TOTAL_ registros",
            "infoFiltered":   "(filtrado de _MAX_ registros)",
            "zeroRecords":    "No se encontraron registros",
            "paginate": {
                "first":      "Primera",
                "last":       "Ultima",
                "next":       "Siguiente",
                "previous":   "Anterior"
            }
        },
        "deferRender": true,
        "order": [ 0, "desc" ]
    } );
    });
</script>