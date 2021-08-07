@extends('layouts.layout')
@section('title','Crear Afiliado')

@section('content')
    <div class="card w-75 border-secondary">
        <div class="card-header" >
            <h3>Crear nuevo afiliado</h3>
        </div>

        <div class="card-body">
            <form action={{route('afiliados.store')}} method="POST">
                @csrf

                <div class="form-group row">
                    <label for="nombre">Nombre completo del afiliado (*)</label>
                    <div class="col">
                        <input class="form-control" type="text" id="nombre" name="nombre" placeholder="Nombre" required>
                    </div>

                    <div class="col">
                        <input class="form-control" type="text" id="apellido" name="apellido" placeholder="Apellido" required>    
                    </div>
                </div>

                <div class="form-group row">
                    <label for="dni">Dni (*)</label>
                    <div class="col">
                        <input class="form-control" type="text" id="dni" name="dni" placeholder="Dni" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email">Email</label>
                    <div class="col">
                        <input class="form-control" type="email" id="email" name="email" placeholder="ejemplo@ejemplo.com">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="prefijo">Telefono</label>
                    <div class="col">
                        <input class="form-control" type="text" id="prefijo" name="prefijo" placeholder="Prefijo sin el 0">
                    </div>

                    <div class="col">
                        <input class="form-control" type="text" id="telefono" name="telefono" placeholder="Numero de telefono sin el 15">    
                    </div>
                </div>

                <div class="form-group row">
                    <label for="localidad">Localidad (*)</label>
                    <div class="col">
                        <input class="form-control" type="text" id="localidad" name="localidad" placeholder="Ciudad" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="cantHijos">Cantidad de hijos (*)</label>
                    <div class="col">
                        <select class="form-select" name="cantHijos" id="cantHijos" required>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="3">4</option>
                            <option value="3">5</option>
                          </select>
                        
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tipo">Tipo de Empleado (*)</label>
                    <div class="col">
                        <select class="form-select" name="tipo" id="tipo" required>
                            <option value="publico">Empleado Público</option>
                            <option value="municipal">Empleado Municipal</option>
                        </select>
                    </div>
                </div>

                <button class="btn btn-success" id="crear" type="submit">Crear</button>

            </form>
        </div>
    </div>
@endsection