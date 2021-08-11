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
         $(document).ready(function () {
            $.ajax({
                type: "GET",
                url: '{{route('stockGrafico')}}',
                success: function (response) {
                    let labels = [];
                    let stock = [];

                    response.forEach(kit => {
                        labels.push(kit['nivel']);
                        stock.push(kit['stock']);
                    });

                    const data = {
            labels: labels,
            datasets: [{
                label: 'Stock de kits',
                data: stock,
                backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)',
                'rgb(102, 0, 102)',
                'rgb(0, 255, 255)',
                'rgb(255, 0, 255)',
                ],
                hoverOffset: 4
            }]
        };

        const config = {
            type: 'pie',
            data: data,
        };

        // $(document).ready(function () {
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, config);


                }
            });



         
        });
    </script>

@endsection