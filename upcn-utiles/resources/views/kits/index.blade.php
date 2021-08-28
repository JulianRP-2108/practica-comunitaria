@extends('layouts.layout')
@section('title','Kits')
@section('content')

<div class="container">
    <div class="row text-center">
        <div class="col">
            <h2>Listado de Kits</h2>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <table class="table table-bordered table-striped" id="tablaKits">
                        </div>
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Nivel</th>
                                <th>Descripción</th>
                                <th>Stock</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($kits as $kit)
                                <tr>
                                    <td>{{$kit->idKit}} </td>
                                    <td>{{$kit->nivel}}</td>
                                    <td>{{$kit->descripcion}}</td>
                                    <td>{{$kit->stock}}</td>
                                    {{-- opciones --}}
                                    <td>
                                        <a class="mx-2 btn btn-primary" title="Editar" href={{ route('kits.edit',['kit' => $kit->idKit]) }}> 
                                            <i class="fa fa-user-edit fa-1x" aria-hidden="true"></i>
                                        </a>

                                        <a class="mx-2 btn btn-danger" title="Eliminar" data-toggle="modal" data-target="#delete_register{{$kit->idKit}}" type="button">
                                            <i class="fa fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                                {{-- MODAL --}}
                                <div id="delete_register{{$kit->idKit}}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel2">Eliminar Kit</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                <h4>Seguro que desea eliminar el kit {{$kit->nivel}}?</h4>
                                            </div>
                                            
                                            <form action={{ route('kits.destroy',['kit' => $kit->idKit]) }} method="POST">
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

<script src={{ asset('js/kits/index.js') }}></script>

@endsection