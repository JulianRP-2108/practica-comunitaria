@extends('layouts.layout')
@section('title','Cargar stock')
@section('content')


<div class="card w-75 border-secondary">
    <div class="card-header" >
        <h3>Cargar stock</h3>
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
        <form action="{{route('updateStock')}}" method="POST">
            @csrf

            <div class="form-group row">
                <label for="kitSelect">Seleccione el kit para modificar stock: </label>
                <div class="col">
                    <select class="form-control" name="kit" id="kitSelect" required>
                        @isset($kits)
                            <option value="-1" selected disabled>Seleccione un kit</option>
                            @foreach ($kits as $kit)
                                <option value="{{$kit->idKit}}">{{$kit->nivel}}</option>
                            @endforeach
                        @endisset
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="stockActualInput">Stock actual del kit</label>
                <div class="col">
                    <input type="text" class="form-control" name="stockActual" id="stockActualInput"  step="1" min="0" readonly>
                </div>
            </div>

            <div class="form-group row">
                <label for="cantidadAgregarInput">Cantidad a cargar</label>
                <div class="col">
                    <input type="number" class="form-control" name="cantNueva" id="cantidadAgregarInput"  required step="1" min="0">
                </div>
            </div>

            <div class="form-group row">
                <label for="stockFinal">Stock resultante</label>
                <div class="col">
                    <input type="text" class="form-control" name="stockFinal" id="stockFinalInput"   step="1" min="0" readonly>
                </div>
            </div>

            <button class="btn btn-success" id="submitButton" type="submit">Cargar</button>
        </form>
    </div>

</div>

<script>
    let kits = {!!json_encode($kits)!!};
    $('#kitSelect').on('change', function () {
        let idSelected = $('#kitSelect').val();
        kits.forEach(element => {
            if(idSelected == element.idKit){
                $('#stockActualInput').val(element.stock);
            }
        });
    });


    $('#cantidadAgregarInput').keyup(function (e) { 
        let agregados = parseInt($('#cantidadAgregarInput').val());
        let actuales = parseInt($('#stockActualInput').val());
        $('#stockFinalInput').val(agregados+actuales);
    });

</script>


    
@endsection