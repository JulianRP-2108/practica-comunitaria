@extends('layouts.layout')

@section('title','Afiliados')

@section('content')
<div class="container">
    <div class="row text-center">
        <div class="col">
            <h2>Listado de Afiliados</h2>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <table class="table table-bordered table-striped" id="tablaAfiliados">
                        </div>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>DNI</th>
                                <th>Email</th>
                                <th>Telefono</th>
                                <th>Localidad</th>
                                <th>Nº Hijos</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($afiliados as $afiliado)
                                <tr>
                                    <td>{{$afiliado->nombre}} </td>
                                    <td>{{$afiliado->apellido}}</td>
                                    <td>{{$afiliado->dni}}</td>
                                    <td>{{$afiliado->email}}</td>
                                    <td>{{$afiliado->telefono}}</td>
                                    <td>{{$afiliado->localidad}}</td>
                                    <td>{{$afiliado->cantidadHijos}}</td>
                                    
                                    <td>
                                        <a class="mx-2 btn btn-primary" title="Editar" href={{ route('afiliados.edit',['afiliado' => $afiliado->idAfiliado]) }}> 
                                            <i class="fa fa-user-edit fa-1x" aria-hidden="true"></i>
                                        </a>

                                        <a class="mx-2 btn btn-danger" title="Eliminar" data-toggle="modal" data-target="#delete_register{{$afiliado->idAfiliado}}" type="button">
                                            <i class="fa fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                                {{-- MODAL --}}
                                <div id="delete_register{{$afiliado->idAfiliado}}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel2">Eliminar Afiliado</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                <h4>Seguro que desea eliminar a {{$afiliado->nombre}}?</h4>
                                            </div>
                                            
                                            <form action={{ route('afiliados.destroy',['afiliado' => $afiliado->idAfiliado]) }} method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    </div>
</div>

<script src={{ asset('js/afiliados/index.js') }}></script>

@endsection