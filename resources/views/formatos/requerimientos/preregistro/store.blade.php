@extends('home')
@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <table id="excel" class="table table-striped table-bordered display text-nowrap" style="width: 100%">
                <thead>
                  <tr>
                    <th class="header">Estatus</th>
                    <th class="header">Folio</th>
                    <th class="header">Titulo</th>
                    <th class="header">Descripción</th>
                    <th class="header">Cliente</th>
                    <th class="header">Solicitante</th>
                    <th class="header">Correo</th>
                    <th class="header">Sistema</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($solicitudes as $solicitud)
                    <tr>
                      <td>
                        @foreach ($estatus as $e)
                          @if ($solicitud->id_estatus == $e->id_estatus)
                            @if($solicitud->id_estatus == 20)
                              <div class="btn-group-vertical" role="group" aria-label="Vertical button group">  
                                <div class="btn-group" role="group">
                                    <button id="est{{$loop->iteration}}" type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <span id="{{$solicitud->folio}}act" class="badge bg-light-warning text-warning font-weight-medium actualiza">
                                        {{$e->titulo}}
                                      </span>
                                    </button>
                                    @if(Auth::user()->id_area <> 3)
                                    <div class="dropdown-menu" aria-labelledby="est{{$loop->iteration}}">
                                        <a id="{{$solicitud->folio}}" class="dropdown-item rechazar">RECHAZAR</a>
                                    </div>
                                    @endif
                                </div>
                              </div>
                            @elseif($solicitud->id_estatus == 22)
                              <button type="button" class="w-100 btn text-dark">
                                <span class="badge bg-light-danger text-danger font-weight-medium">
                                  {{$e->titulo}}
                                </span>
                              </button>
                            @elseif($solicitud->id_estatus == 21)
                              <button type="button" class="w-100 btn text-dark">
                                <span class="badge bg-light-success text-success font-weight-medium">
                                  {{$e->titulo}}
                                </span>
                              </button>
                            @endif
                          @endif
                        @endforeach
                      </td>
                      <td>
                        @if ($solicitud->id_estatus == 20 and Auth::user()->id_area <> 3)
                          <a href="{{route('NR',$solicitud->folio)}}" class="fw-bold link">{{$solicitud->folio}}</a>
                        @else
                          @if ($solicitud->folior == null)
                            <a class="fw-bold link">{{$solicitud->folio}}</a> 
                          @else
                            <a href="{{route('Documentos',Crypt::encrypt($solicitud->folior))}}" class="fw-bold link">{{$solicitud->folior}}</a> 
                          @endif
                        @endif
                      </td>
                      <td>
                          @if($solicitud->adjunto == 'si')
                            <i class="feather-sm" data-feather="paperclip"></i>
                            <a href="{{route('AA',$solicitud->folio)}}" class="font-weight-medium link">{{$solicitud->descripcion}}</a>
                          @else
                            <a class="font-weight-medium link">{{$solicitud->descripcion}}</a>
                          @endif
                      </td>
                      <td>{{$solicitud->planteamiento}}</td>
                      <td>
                        @foreach ($clientes as $cliente)
                          @if($solicitud->id_cliente == $cliente->id_cliente)
                            {{$cliente->nombre_cl}}
                          @endif
                        @endforeach
                      </td>
                      <td>{{$solicitud->solicitante}}</td>
                      <td>{{$solicitud->correo}}</td>
                      <td>
                        @foreach ($sistemas as $sistema)
                          @if($solicitud->id_sistema == $sistema->id_sistema)
                            {{$sistema->nombre_s}}
                          @endif
                        @endforeach
                      </td>
                    </tr>
                    <!-- BEGIN MODAL -->
                    <div class="modal" id="estatus{{$loop->iteration}}">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header d-flex align-items-center">
                            <h4 class="modal-title"><strong>Rechazar solicitud</strong></h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <strong>Una vez rechazado no se podra recuperar la informacion de esta solicitud</strong>
                          </div>
                          <div class="modal-feed text-center">
                            <button type="submit" name='adjunto' value="true" class="btn btn-success waves-effect waves-light text-white">
                              <a style="color:white"> Si</a>
                            </button>
                            <button type="submit" name='adjunto' value="false" class="btn btn-danger waves-effect waves-light text-white">
                              <a style="color:white"> No</a>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End Modal -->
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>Estatus</th>
                    <th>Folio</th>
                    <th>Titulo</th>
                    <th>Descripción</th>
                    <th>Cliente</th>
                    <th>Solicitante</th>
                    <th>Correo</th>
                    <th>Sistema</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>  
    </div>
  </div>
  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('.rechazar').on('click', function(e) {
        e.preventDefault();
        var name = $(this).attr('id');
        var parent = $('#'+name+'act');
        console.log(parent.text().replace(/\s+/g, ''))
        $.ajax({
          headers:{'X-CSRF-TOKEN' : "{{csrf_token()}}"},
          type: "POST",
          url: "preregistro.rechazo."+name, 
          success: function(response) {
            parent.removeClass("bg-light-warning text-warning");
            parent.addClass("bg-light-danger text-danger");
            parent.text("RECHAZADO");
          }          
        });
      });                 
    });    
  </script>
   <script>
    $(document).ready(function () {
      $('#excel').DataTable({
      //  dom: "Bfrtip",
      //  buttons: ["copy", "csv", "excel", "pdf", "print"],
          scrollY: 400,
          scrollX: true,
          "order": [[0, 'desc']]
      });
      //$(".buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel").addClass("btn btn-primary mr-1");
    });
  </script>
@endsection