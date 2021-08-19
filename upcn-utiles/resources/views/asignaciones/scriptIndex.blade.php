<script>
    $(document).ready(function () {
        //Inicializacion de la tabla
        var tabla = $('#tablaAsignaciones').DataTable( {
        ajax: {
            url: "{{route('datatable.asignaciones')}}",
            method: 'GET',
            data: {
                anio: $('#anio').val()
            },
            dataSrc: 'data'
        },
        rowId: 'idAsignacion',
        columns: [
            { data: 'created_at' },
            { data: 'nombre' },
            { data: 'apellido' },
            { data: 'dni' },
            { data: 'telefono' },
            { data: 'localidad' },
            { data: 'cantidadHijos' },
            { data: 'cantidad' },
            // { data: 'tipoEmpleado' },
            { defaultContent: '<div class="d-flex justify-content-center"> <button type="button" ' + 
            'class="btn btn-danger" id="btnEliminar" data-toggle="modal" data-target="#exampleModsal"> <i class="fa fa-trash-alt"></i>' +
            '</button> </div>'
            },
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

        //Cuando cambia el select
        $('#anio').on('change', function () {
            $.ajax({
                type: "GET",
                url: "{{route('datatable.asignaciones')}}",
                data: {
                    anio: $("#anio").val()
                },
                success: function (response) {
                    // console.log(response);
                    tabla.clear().rows.add(response.data).draw();
                }
            });

        });

        //dispara el modal
        $('#tablaAsignaciones tbody').on( 'click', '#btnEliminar', function () {
            $('#exampleModal').modal('show');

            var id = tabla.row( $(this).parents('tr') ).id();
            let data = tabla.row( $(this).parents('tr') ).data();
            // let data = tabla.row(this).data();
            // console.log(id);
            console.log(data);

            $('#exampleModalLabel').text('Seguro que desea eliminar esta asignación?');
            $('#exampleModalBody').html('<div>' +
                'Nombre: <b>' + data.nombre + ' ' + data.apellido + '</b>' +
                '<br>Kits asignados: <b>' + data.cantidad + '</b>' +
                '<br>Fecha: <b>' + data.created_at + '</b>' +
                '</div>'
            );
            //elimina asignacion
            $('#btnEliminarFila').click(function (e) {
                $.ajax({
                    type: "DELETE",
                    url: `/asignaciones/${id}`,
                    success: function (response) {
                        $('#exampleModal').modal('hide');
                        //recarga la tabla
                        $.ajax({
                            type: "GET",
                            url: "{{route('datatable.asignaciones')}}",
                            data: {
                                anio: $("#anio").val()
                            },
                            success: function (response) {
                                // console.log(response);
                                tabla.clear().rows.add(response.data).draw();
                            }
                        });
                    }
                });
            });
            
        });


    });
</script>