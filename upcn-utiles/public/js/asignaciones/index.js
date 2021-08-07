$(document).ready( function () {
    $('#tablaAfiliados').DataTable(
        {
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
            "order": [[ 0, "desc" ]],
            "deferRender": true
        }
    );
} );