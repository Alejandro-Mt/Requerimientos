<div class="table-responsive tab-pane fade show active" id="Our" role="tabpanel" aria-labelledby="pills-profile-tab">
  <table id="ourtickets" class="table table-striped table-bordered display text-nowrap" style="width: 100%">
    <thead>
      <tr>
        <th class="header">LISTA</th>
        <th class="header">FOLIO</th>
        <th class="header">SOLICITANTE</th>
        <th class="header">COMENTARIO</th>
        <th class="header">ESTATUS</th>
      </tr>
    </thead>
    <tbody>
      @foreach (Auth::user()->Tickets() as $registro)
      <tr>
        <td>{{$registro->id_ticket}}</td>
        <td>
          <a href={{ route('Seguimiento_Soporte',$registro->folio) }} data-bs-toggle="tooltip" data-bs-placement="auto"
            @switch( $registro->id_estatus )
              @case(1)
                class="btn btn-warning"
                @break
              @case(2)
                class="btn btn-secondary"
                @break
              @case(3)
                class="btn btn-danger"
                @break
              @case(4)
                class="btn btn-info"
                @break
              @default
                class="btn btn-dark"
            @endswitch
            title="Sistema: {{ $registro->sistema->nombre }}
            Cliente: {{ $registro->cliente->nombre }}
            Nivel: {{ $registro->estatus->nivel }}
            Estatus: {{ $registro->estatus->nombre }}
            @if($registro->incidencia)
            Incidencia: {{ $registro->incidencia->nombre }}
            @endif
            @if($registro->rCC)
              Responsable CC: {{ $registro->rCC->nombreCompleto() }}
            @endif
            @if($registro->rPIP)
              Responsable PIP: {{ $registro->rPIP->nombreCompleto() }}
            @endif
            Fecha de reporte: {{ date('d/M/Y H:i:s', strtotime($registro->fecha_reporte)) }}
          "
          >{{$registro->folio}}</a>
        </td>
        <td data-bs-toggle="tooltip" data-bs-placement="auto" title="Correo: {{ $registro->solicitante->email ?? $registro->invitado->email}},&#10;Teléfono: {{ '' }}&#10;">
          {{$registro->solicitante ? $registro->solicitante->nombreCompleto() : $registro->invitado->nombreCompleto()}}
        </td>
        <td>{{$registro->comentario->comentario}}</td>
        <td>{{$registro->estatus->nombre}}</td>
      </tr>
      @endforeach
    </tbody>
    <tfoot>
      <tr>
        <th>LISTA</th>
        <th>FOLIO</th>
        <th>SOLICITANTE</th>
        <th>COMENTARIO</th>
        <th>ESTATUS</th>
      </tr>
    </tfoot>
  </table>
</div>
<style>
  .tooltip-inner {
      background-color: black;
      box-shadow: 0px 0px 4px black;
      color: #f4f6f9;
      max-width: 100%; 
      opacity: 1 !important;
      white-space: pre-line;
      word-wrap: break-word;
      text-align: left;
  }

  .tooltip.bs-tooltip-end .tooltip-arrow::before {
    border-right-color: black
  }

  /* Define los estilos para las filas pares */
  .table-striped tbody tr:nth-child(even) {
      background-color: #D4D4D4; /* Color para las filas pares */
      color: darkgray
  }
  /* Define los estilos para las filas impares */
  .table-striped tbody tr:nth-child(odd) {
      background-color: #D4D4D4; /* Color para las filas impares */
  }
</style>