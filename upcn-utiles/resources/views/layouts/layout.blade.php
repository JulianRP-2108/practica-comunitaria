<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href={{ asset('favicon.png') }}>
    <link rel="stylesheet" href="{{ asset('css/layouts/layout.css') }}">
    
    <title>UPCN - @yield('title')</title>

    <!-- Usa Framework Boostrap en linea -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    {{-- JQuery en linea --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    {{-- Data table css--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    {{-- Para que el datatable sea responsive en cel --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.bootstrap4.min.css">
    {{-- SweetAlert --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="{{ asset('js/sidebar.js') }}"></script>
    {{-- AdminLTE 3 css--}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar-->
        <div class="border-end" id="sidebar-wrapper" style=" background-color: rgb(16, 66, 104)">
            <div class="sidebar-heading border-bottom" style="padding: 0;">
                <a href={{ route('dashboard') }} class="brand-link">
                    <img src={{ asset('navbaricon.png') }} alt="Logo UPCN" class="brand-image">
                    <span class="brand-text font-weight-bold text-light">
                        UPCN
                    </span>
                    <span>
                        <i class="text-light" style="font-size: 50%">Seccional La Pampa</i>
                    </span>
                </a>
            </div>
            
            <div class="list-group list-group-flush" >
                <a style=" background-color: rgb(16, 66, 104)" class="text-light list-group-item list-group-item-action list-group-item p-3 " href={{ route('dashboard') }}>
                    <i class="fas fa-tachometer-alt"></i>Panel Informativo
                </a>

                <a style=" background-color: rgb(16, 66, 104)" href="#menuAfiliados" class="text-light list-group-item list-group-item-action list-group-item p-3 collapsed" data-toggle="collapse" aria-expanded="false"><i class="fas fa-user"></i> <span class="hidden-sm-down">Afiliados</span> <i class="fas fa-sort-down"></i></a>
                <div class="collapse" id="menuAfiliados" data-parent="#sidebar-wrapper">
                    <a style=" background-color: rgb(16, 66, 104)" href={{ route('afiliados.index') }} class="text-info list-group-item">Listado de Afiliados </a>
                    <a style=" background-color: rgb(16, 66, 104)" href={{ route('afiliados.create') }} class="text-info list-group-item">Crear Afiliado </a>
                </div>

                <a style=" background-color: rgb(16, 66, 104)" href="#menuAsignaciones" class="text-light list-group-item list-group-item-action list-group-item p-3 collapsed" data-toggle="collapse" aria-expanded="false"><i class="fas fa-file-signature"></i> <span class="hidden-sm-down">Asignaciones</span> <i class="fas fa-sort-down"></i></a>
                <div class="collapse" id="menuAsignaciones" data-parent="#sidebar-wrapper">
                    <a style=" background-color: rgb(16, 66, 104)" href={{route('asignaciones.create')}} class="text-info list-group-item">Entregar Kit </a>
                    <a style=" background-color: rgb(16, 66, 104)" href={{ route('asignaciones.index') }} class="text-info list-group-item">Listado de Asignaciones </a>
                </div>

                <a style=" background-color: rgb(16, 66, 104)" href="#menuKits" class="text-light list-group-item list-group-item-action list-group-item p-3 collapsed" data-toggle="collapse" aria-expanded="false"><i class="fas fa-pencil-ruler"></i> <span class="hidden-sm-down">Kits escolares</span> <i class="fas fa-sort-down"></i></a>
                <div class="collapse" id="menuKits" data-parent="#sidebar-wrapper">
                    <a style=" background-color: rgb(16, 66, 104)" href="{{route('kits.create')}}" class="text-info list-group-item">Agregar Kit </a>
                    <a style=" background-color: rgb(16, 66, 104)" href="{{route('cargarStock')}}" class="text-info list-group-item">Cargar Stock </a>
                    <a style=" background-color: rgb(16, 66, 104)" href="{{route('kits.index')}}" class="text-info list-group-item">Listado de Kits </a>
                </div>

                <a style=" background-color: rgb(16, 66, 104)" href={{route('logout')}} class="text-light list-group-item list-group-item-action list-group-item p-3">
                    <i class="fas fa-sign-out-alt"></i>Cerrar Sesión
                </a>
            </div>
        </div>
        <!-- Page content wrapper-->
        <div id="page-content-wrapper">
            <!-- Top navigation-->
            <nav class="navbar navbar-light bg-light border-bottom">
                <div class="container-fluid">
                    <button class="navbar-toggler" id="sidebarToggle" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </nav>
            <!-- Page content-->
            <div class="container-fluid p-2">
                @if (session('success'))
                    <div class="alert alert-outline alert-success d-flex align-items-center" role="alert">
                        <i data-feather="alert-circle" class="mg-r-10">{{ session('success') }}</i>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-outline alert-danger d-flex align-items-center" role="alert">
                        <i data-feather="alert-circle" class="mg-r-10">{{ session('error') }}</i>
                    </div>
                @endif
                
                @yield('content')
            </div>
        </div>
    </div>


    <!-- Bootstrap core JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    {{-- DataTable JS --}}
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    {{-- Para que sea responsive en celu --}}
    <script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap4.min.js"></script>
    {{-- AdminLTE 3 JS --}}
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>
</body>
</html>