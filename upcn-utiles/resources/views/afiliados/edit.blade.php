@extends('layouts.layout')
@section('title','Editar Afiliado')

@section('content')
    <div class="card w-75 border-secondary">
        <div class="card-header" >
            <h3>Editar afiliado</h3>
        </div>

        <div class="card-body">
            <form action={{ route('afiliados.update',['afiliado' => $afiliado->idAfiliado]) }} method="POST">
                @csrf
                @method('PATCH')
                
                <div class="form-group row">
                    <label for="nombre">Nombre completo del afiliado (*)</label>
                    <div class="col">
                        <input class="form-control" type="text" id="nombre" name="nombre" placeholder="Nombre" required
                        value="{{ $afiliado->nombre }}"
                        >
                    </div>

                    <div class="col">
                        <input class="form-control" type="text" id="apellido" name="apellido" placeholder="Apellido" required
                        value="{{ $afiliado->apellido }}"
                        >    
                    </div>
                </div>

                <div class="form-group row">
                    <label for="dni">Dni (*)</label>
                    <div class="col">
                        <input class="form-control" type="text" id="dni" name="dni" placeholder="Dni" required
                        value={{ $afiliado->dni }}
                        >
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email">Email</label>
                    <div class="col">
                        <input class="form-control" type="email" id="email" name="email" placeholder="ejemplo@ejemplo.com"
                        value="{{ $afiliado->email }}"
                        >
                    </div>
                </div>

                <div class="form-group row">
                    <label for="telefono">Telefono</label>
                    <div class="col">
                        <input class="form-control" type="text" id="telefono" name="telefono" placeholder="Prefijo sin el 0 y Nº sin el 15"
                        value={{ $afiliado->telefono }}
                        >
                    </div>

                </div>

                <div class="form-group row">
                    <label for="localidad">Localidad (*)</label>
                    <div class="col">
                        <input class="form-control" type="text" id="localidad" name="localidad" placeholder="Ciudad" required
                        value="{{$afiliado->localidad}}"
                        >
                    </div>
                </div>

                <div class="form-group row">
                    <label for="cantHijos">Cantidad de hijos (*)</label>
                    <div class="col">
                        <select class="form-select" name="cantHijos" id="cantHijos" required>
                            @if( $afiliado->cantidadHijos == 1 )
                                <option value="1" selected>1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            @endif

                            @if( $afiliado->cantidadHijos == 2 )
                                <option value="1">1</option>
                                <option value="2" selected>2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>    
                            @endif

                            @if( $afiliado->cantidadHijos == 3 )
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3" selected>3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            @endif

                            @if( $afiliado->cantidadHijos == 4 )
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4" selected>4</option>
                                <option value="5">5</option>
                            @endif

                            @if( $afiliado->cantidadHijos == 5 )
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5" selected>5</option>
                            @endif
                          </select>
                        
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tipo">Tipo de Empleado (*)</label>
                    <div class="col">
                        <select class="form-select" name="tipo" id="tipo" required>
                            @if( $afiliado->tipoEmpleado == 'publico' )
                                <option value="publico" selected>Empleado Público</option>
                                <option value="municipal">Empleado Municipal</option>
                            @else
                                <option value="publico">Empleado Público</option>
                                <option value="municipal" selected>Empleado Municipal</option>
                            @endif
                        </select>
                    </div>
                </div>

                <button class="btn btn-success" id="crear" type="submit">Editar</button>

            </form>
        </div>
    </div>
@endsection