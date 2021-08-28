@extends('layouts.layout')
@section('title','Crear Nuevo Kit')
@section('content')

<div class="card w-75 border-secondary">
    <div class="card-header" >
        <h3>Crear nuevo kit</h3>
    </div>

    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{route('kits.store')}}" method="POST">
            @csrf

            <div class="form-group row">
                <label for="nivelSelect">Nivel: </label>
                <div class="col">
                    <input class="form-control" type="text" name="nivel" id="nivelInput" required placeholder="Ej: universitario">
                </div>
            </div>

            <div class="form-group row">
                <label for="descriptionText">Descripción (Opcional)</label>

                <div class="col">
                    <textarea class="form-control" name="descripcion" id="descriptionText"  rows="10" maxlength="140"></textarea>
                </div>
            </div>

            <div class="form-group row">
                <label for="stockInput">Cantidad inicial: </label>
                <div class="col">
                    <input type="number" name="stock" id="stockInput" required min="0" step="1" class="form-control">
                </div>
            </div>

            <button class="btn btn-success" id="submitButton" type="submit">Crear</button>
        </form>
    </div>

</div>
    

@endsection