@extends('layouts.layout')

@section('title','Stock de kits')

@section('content')

    {{-- Prueba de pie chart --}}
    <div class="card">
        <div class="card-header">
            <h4> Stock de kits</h4>
        </div>
        
        <div class="d-flex justify-content-center">
            <div class="card-body" style="max-width: 25rem">
                <canvas id="myChart"></canvas>
            </div>
        </div>

        <div class="card-footer">
            Total {{ $cantKits }} Kits
        </div>
    </div>


    {{-- Chart.Js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.4.0/dist/chart.min.js"></script>
    
    
     <script>
         const data = {
            labels: [
                'Inicial',
                'Primario',
                'Secundario'
            ],
            datasets: [{
                label: 'My First Dataset',
                data: [{{ $cantInicial }}, {{ $cantPrimario }}, {{ $cantSecundario }}],
                backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)'
                ],
                hoverOffset: 4
            }]
        };

        const config = {
            type: 'pie',
            data: data,
        };

        $(document).ready(function () {
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, config);
        });
    </script>

@endsection