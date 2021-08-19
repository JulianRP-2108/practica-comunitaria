@extends('layouts.layout')

@section('title','Asignaciones')

@section('content')
<div class="container">
    <div class="row text-center">
        <div class="col">
            <h2>Listado de Asignaciones</h2>
        </div>
    </div>
    <div class="row mb-2 w-75">
        <select class="form-select" name="anio" id="anio" required>
            @for ($i = $anio-5; $i <= $anio ; $i++)
                @if ($i == $anio)
                    <option value={{$i}} selected> {{$i}} </option>
                @else
                    <option value={{$i}}> {{$i}} </option>
                @endif
            @endfor
        </select>
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
                                <th>Telefono</th>
                                <th>Localidad</th>
                                <th>Nº Hijos</th>
                                <th>Kits asignados</th>
                                <th>Tipo empleado</th>
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

        var tabla = $('#tablaAsignaciones').DataTable( {
        ajax: {
            url: "{{route('datatable.asignaciones')}}",
            method: 'GET',
            data: {
                anio: $('#anio').val()
            },
            dataSrc: 'data'
        },
        columns: [
            { data: 'created_at' },
            { data: 'nombre' },
            { data: 'apellido' },
            { data: 'dni' },
            { data: 'telefono' },
            { data: 'localidad' },
            { data: 'cantidadHijos' },
            { data: 'cantidad' },
            { data: 'tipoEmpleado' }
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

@endsection