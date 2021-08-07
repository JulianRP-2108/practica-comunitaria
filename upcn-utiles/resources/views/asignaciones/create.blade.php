@extends('layouts.layout')
@section('title','Asignar Kits')

@section('content')

<div class="card w-75 border-secondary">
    <div class="card-header" >
        <h3>Asignar Kits</h3>
    </div>

    <div class="card-body">
            {{-- prueba ajax --}}
            <label for="dni">Ingresar dni</label>
            <input type="text" class="form-control" name="dni" id="dni" required>

            <label for="nivel">Nivel del kit</label>
            <select class="form-select" name="nivel" id="nivel" required>
                @isset($kits)
                    @foreach ($kits as $kit)
                        <option value={{$kit->id}}>Kit {{$kit->nivel}}</option>        
                    @endforeach
                    
                @endisset
            </select>

            <label for="cantidad">Cantidad</label>
            <input type="text" class="form-control" name="cantidad" id="cantidad" required>


            <div class="mt-4">
                <button id="btn1" class="btn btn-success" >Asignar</button>
            </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#btn1").click(function () {
            var dni = $("#dni").val();
            var nivel = $("#nivel").val();
            var cantidad = $("#cantidad").val();

            $.ajax(
            {
                url: "{{route('asignaciones.store') }}",
                type: "POST",
                data: {
                    dni: dni,
                    nivel: nivel,
                    cantidad: cantidad,
                },
                success: function (data) {
                    if(data['status'] == "error"){
                        Swal.fire({
                            title: 'Error',
                            text: data['message'],
                            icon: 'error',
                            // showConfirmButton: false,
                            // timer: 2000
                        });
                    }else{
                        Swal.fire({
                            title: 'Asignación de kits registrada',
                            text: `Kits ${nivel} restantes: ${data['kits restantes']}`,
                            icon: 'success',
                            // showConfirmButton: false,
                            // timer: 2000
                        });
                    }
                }
            });
        });
    });
</script>
@endsection