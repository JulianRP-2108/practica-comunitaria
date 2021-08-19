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
                                {{-- <th>Tipo empleado</th> --}}
                                <th>Opciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                
            </div>
        </div>
    </div>
    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="exampleModalBody">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-danger" id="btnEliminarFila">Eliminar</button>
        </div>
      </div>
    </div>
  </div>

</div>

{{-- Scripts para datatable y modal --}}
@include('asignaciones.scriptIndex')

@endsection