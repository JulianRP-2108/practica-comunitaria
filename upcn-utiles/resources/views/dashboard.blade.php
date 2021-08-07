@extends('layouts.layout')

@section('title','Inicio')

@section('content')

    <div class="row">
        <h2>Panel Informativo</h2>
    </div>

    <div class ="row my-3" >

        <div class="col-4">
            <div class="small-box bg-info">
                <div class="inner">
                <h3>{{ $cantAfiliados }}</h3>

                <p>Afiliados</p>
                </div>
                <div class="icon">
                <i class="fas fa-user-plus"></i>
                </div>
                <a href={{route('afiliados.index')}} class="small-box-footer">
                Más información <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-4">
            <div class="small-box bg-success">
                <div class="inner">
                <h3>{{$kitsAsignados}}</h3>

                <p>Kits Entregados 2021</p>
                </div>
                <div class="icon">
                <i class="fas fa-chart-bar"></i>
                </div>
                <a href={{ route('kitsEntregados') }} class="small-box-footer">
                Más información <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-4">
            <div class="small-box bg-danger">
                <div class="inner">
                <h3>{{ $stockKits }}</h3>

                <p>Stock de Kits</p>
                </div>
                <div class="icon">
                <i class="fas fa-chart-pie"></i>
                </div>
                <a href={{ route('stock') }} class="small-box-footer">
                Más información <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>


    @include('asignaciones.index')

@endsection