<!-- Kits Asignados -->
<div>
  <div class="row">
      <div class="col">
          <h4>Últimas asignaciones</h4>
      </div>
  </div>
  
  <div class="card">
      <div class="card-body">
          <div class="row">
              <div class="col">
                  <table class="table table-bordered table-striped" id="tablaAfiliados">
                      </div>
                      <thead>
                          <tr>
                              <th>Fecha</th>
                              <th>Nombre</th>
                              <th>Apellido</th>
                              <th>DNI</th>
                              <th>Nº Hijos</th>
                              <th>Localidad</th>
                              <th>Kits asignados</th>
                          </tr>
                      </thead>

                      <tbody>
                          @foreach ($asignaciones as $asignacion)
                              <tr>
                                  <td>{{$asignacion->created_at}}</td>
                                  <td>{{$asignacion->afiliado->nombre}} </td>
                                  <td>{{$asignacion->afiliado->apellido}}</td>
                                  <td>{{$asignacion->afiliado->dni}}</td>
                                  <td>{{$asignacion->afiliado->cantidadHijos}}</td>
                                  <td>{{$asignacion->afiliado->localidad}}</td>
                                  <td>{{$asignacion->cantidad}}</td>
                              </tr>
                          @endforeach
                      </tbody>
                  </table>
              </div>
              
          </div>
      </div>
  </div>
</div>

<script src={{ asset('js/asignaciones/index.js') }}></script>