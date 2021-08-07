@extends('layouts.layout')

@section('title','Kits entregados')

@section('content')

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-3">
                    <h4>Kits entregados por año</h4>
                </div>

                <div class="col-3">
                    <select class="form-select" name="anio" id="anio" required>
                        @for ($i = $anio-5; $i <= $anio ; $i++)
                            @if ($i == $anio)
                                <option value={{$i}} selected> {{$i}} </option>
                            @else
                                <option value={{$i}}> {{$i}} </option>
                            @endif
                        @endfor
                    </select>
                </div>
            </div>
        </div>
        
        <div class="d-flex justify-content-center">
            <div class="card-body" style="max-width: 50rem">
                <canvas id="myChart"></canvas>
            </div>
        </div>

        <div class="card-footer" id="footer"></div>
    </div>


    {{-- Chart.Js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.4.0/dist/chart.min.js"></script>
    
    
     <script>
        let myChart;
        $(document).ready(function () {
            updateChart({{$anio}});

            $('#anio').on('change', function () {
                myChart.destroy();
                updateChart($("#anio").val());
            });
        });
    </script>

    <script>
        function updateChart(anio){
            var meses = [];
            var cantidad = [];
            $.ajax({
                type: "GET",
                url: "{{route('graficoKitsEntregados')}}",
                data: {
                    anio: anio
                },
                success: function (response) {
                    $("#footer").html(
                    `En total <b> ${response.totalKits} </b> kits fueron entregados en ${anio}`
                    );
                    
                    response.asignacionesAnuales.forEach(element => {
                        meses.push(element.mes);
                        cantidad.push(element.cantidad);
                    });
                    
                    const data = {
                        labels: meses,
                        datasets: [{
                            label: 'Kits Entregados',
                            data: cantidad,
                            backgroundColor: [
                            'rgb(16, 66, 104)'
                            ],
                            hoverOffset: 4
                        }]
                    };

                    const config = {
                        type: 'bar',
                        data: data,
                    };

                    var ctx = document.getElementById('myChart').getContext('2d');
                    myChart = new Chart(ctx, config);

                }
            });
        }
    </script>

@endsection