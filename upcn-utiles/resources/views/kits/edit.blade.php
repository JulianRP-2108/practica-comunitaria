@extends('layouts.layout')
@section('title','Editar Kit')

@section('content')
    <div class="card w-75 border-secondary">
        <div class="card-header" >
            <h3>Editar kit</h3>
        </div>

        <div class="card-body">
            <form action={{ route('kits.update',['kit' => $kit->idKit]) }} method="POST">
                @csrf
                @method('PATCH')
                
                <div class="form-group row">
                    <label for="nivel">Nivel del kit (*)</label>
                    <div class="col">
                        <input class="form-control" type="text" id="nivel" name="nivel" placeholder="nivel" required
                        value="{{ $kit->nivel }}"
                        >
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="descripcion">Descripcion del kit (*)</label>
                    <div class="col">
                        <textarea type=text name="descripcion" id="descripcion" cols="30" rows="5" required>{{ $kit->descripcion }}</textarea>
                    </div>
                </div>

                <button class="btn btn-success" id="editar" type="submit">Editar</button>

            </form>
        </div>
    </div>
@endsection