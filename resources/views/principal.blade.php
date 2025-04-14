@extends('home')
@section('content')
  <!-- This Page CSS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link href="{{asset("assets/libs/flot/css/float-chart.css")}}" rel="stylesheet" />
  <link href="{{asset("assets/libs/apexcharts/dist/apexcharts.css")}}" rel="stylesheet"/>
  <!-- Start Row -->
  <div class="tab-content">
    <div id="note-full-container" class="note-has-grid row">
      @foreach ($sistemas as $solicitudes)
        <div class="col-md-3 single-note-item all-category">
          <a class="text-dark" href="{{route('Prioridad',Crypt::encrypt($solicitudes->id_sistema))}}">
            <div class="card card-body">
              <span class="side-stick"></span>
              <h5 class="note-title text-truncate w-75 mb-0">
                {{$solicitudes->nombre_s}}
                <i class="point ri-checkbox-blank-circle-fill ms-1 fs-1"></i>
              </h5>
                <p class="note-date fs-2 text-muted">
                  <span>Total de solicitudes</span>
                  <span class="badge bg-light text-dark">
                    {{$solicitudes->total}}
                  </span>
                </p>
            </div>
          </a>
        </div>
      @endforeach
    </div>
  </div>
  <!-- End Row -->
  @if(Auth::user()->usrdata->id_departamento != 35)
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="border-bottom title-part-padding">
            <h4 class="card-title mb-0">Excel</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="excel" class="table table-striped table-bordered display text-nowrap" style="width: 100%">
                <thead>
                  <tr>
                    <th class="header">LISTA</th>
                    <th class="header">FOLIO</th>
                    <th class="header">DESCRIPCIÓN</th>
                    <th class="header">TIPO</th>
                    <th class="header">ESTATUS GENERAL</th>
                    <th class="header">CLASIFICACIÓN</th>
                    <th class="header">SISTEMA</th>
                    <th class="header">RESPONSABLE DESARROLLO</th>
                    <th class="header">CLIENTE</th>
                    <th class="header">RESPONSABLE PIP</th>
                    <th class="header">IMPACTO</th>
                    <th class="header">SOLICITUD DEL CLIENTE</th>
                    <th class="header">MESA DE ALCANCE</th>
                    <th class="header">CREACIÓN SOLICITUD DE REQUERIMIENTO</th>
                    <th class="header">*DÍAS</th>
                    <th class="header">AUTORIZACIÓN DE SOLICITUD DE REQUERIMIENTO</th>
                    <th class="header">*DÍAS</th>
                    <th class="header">FECHA DE SOLICITUD A DESARROLLO</th>
                    <th class="header">*DÍAS</th>
                    <th class="header">INICIO MESAS DE TRABAJO</th>
                    <th class="header">FIN MESAS DE TRABAJO</th>
                    <th class="header">TOTAL MESAS</th>
                    <th class="header">*DIAS</th>
                    <th class="header">FECHA COMPROMISO ENTREGA DE DEFINICIÓN REQUERIMIENTO</th>
                    <th class="header">FECHA REAL DE ENTREGA DE DEFINICIÓN DE REQUERIMIENTO</th>
                    <th class="header">*DÍAS</th>
                    <th class="header">FECHA DE ENVÍO DE DEFINICIÓN</th>
                    <th class="header">*DÍAS</th>
                    <th class="header">AUTORIZACION DEFINICIÓN DE REQUERIMIENTO</th>
                    <th class="header">*DÍAS</th>
                    <th class="header">ENTREGA PLAN DE TRABAJO</th>
                    <th class="header">FECHA DE INICIO CONSTRUCCIÓN</th>
                    <th class="header">FIN CONSTRUCCIÓN</th>
                    <th class="header">*DÍAS</th>
                    <th class="header">COMPROMISO AMBIENTE PIP</th>
                    <th class="header">FECHA DE LIBERACIÓN REAL AMBIENTE A PIP</th>
                    <th class="header">*DÍAS</th>
                    <th class="header">INICIO ESPERA DE AMBIENTE PRE</th>
                    <th class="header">FIN ESPERA DE AMBIENTE PRE</th>
                    <th class="header">*DÍAS</th>
                    <th class="header">FECHA DE INICIO DE PRUEBAS (AMBIENTE PIP)</th>
                    <th class="header">*DÍAS</th>
                    <th class="header">FECHA FIN PRUEBAS</th>
                    <th class="header">*DÍAS</th>
                    <th class="header">FECHA DE IMPLEMENTACIÓN</th>
                    <th class="header">DURACIÓN TOTAL DEL PROYECTO</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($requerimientos as $registro)
                    <tr>
                      <td>{{$registro->id_registro}}</td>
                      <td><a href="{{route('Documentos',Crypt::encrypt($registro->folio))}}" style="color:rgb(85, 85, 85)">{{$registro->folio}}</a></td>
                      <td>{{$registro->descripcion}}</td>
                      <td>@if(str_contains($registro->folio, 'PR-'))Proyecto @else {{ $registro->es_emergente ? 'Emergente' : 'Normal'}}@endif</td>
<<<<<<< HEAD
                      <td>{{$registro->estatus->titulo}}</td>
=======
                      <td>{{$registro->pausado ? 'POSPUESTO' : $registro->estatus->titulo}}</td>
>>>>>>> versionprod
                      <td>@if($registro->clase) {{$registro->clase->clase}}@endif</td>
                      <td>{{$registro->sistema->nombre_s}}</td>
                      <td>@if($registro->rdes) {{$registro->rdes->getFullnameAttribute()}}@endif</td>
                      <td>{{$registro->cliente->nombre_cl}}</td>
                      <td>{{$registro->rpip->getFullnameAttribute()}}</td>
                      <td>
                        @if($registro->levantamiento)
                          @switch($registro->levantamiento->prioridad)
                            @case(1)
                              BAJA
                              @break
                            @case(2)
                              MEDIA
                              @break
                            @case(3)
                              ALTA
                              @break
                            @default
                              SIN DEFINIR
                              @break
                          @endswitch
                        @else
                          SIN DEFINIR  
                        @endif
                      </td>
                      <td>
                        {{
                          date('d-m-20y',strtotime($registro->solicitud ? $registro->solicitud->created_at : $registro->created_at))
                        }}
                      </td>
                      <td>@if($registro->mesasA()){{date('d-m-20y',strtotime($registro->mesasA()->fecha_mesa))}} @endif</td>
                      <td>@if($registro->levantamiento) {{date('d-m-20y',strtotime($registro->levantamiento->created_at))}} @endif</td>
                      <td>
                        {{$registro->CalcDias(
                          ($registro->solicitud ? $registro->solicitud->created_at : $registro->created_at),
                          ($registro->levantamiento ? $registro->levantamiento->created_at : null)
                        )}}
                      </td>
                      <td>@if($registro->levantamiento) {{$registro->levantamiento->fechaaut ? date('d-m-20y',strtotime($registro->levantamiento->fechaaut)) : ''}} @endif</td>
                      <td>
                        {{$registro->CalcDias(
                          ($registro->levantamiento ? $registro->levantamiento->updated_at : NULL),
                          ($registro->levantamiento ? $registro->levantamiento->fechaaut : NULL)
                        )}}
                      </td>
                      <td>@if($registro->levantamiento) {{$registro->levantamiento->fechades ? date('d-m-20y',strtotime($registro->levantamiento->fechades)) : ''}} @endif</td><!-- fechades-->
                      <td>
                        {{$registro->CalcDias(
                          ($registro->levantamiento ? $registro->levantamiento->fechaaut : NULL),
                          ($registro->levantamiento ? $registro->levantamiento->fechades : NULL)
                        )}}
                      </td>
                      <!-- Obtener la fecha de la primera mesa -->
                      <td>@if($registro->primeraMesa()){{date('d-m-20y',strtotime($registro->primeraMesa()->fecha_mesa))}} @endif</td>
                      
                      <!-- Obtener la fecha de la última mesa -->
                      <td>@if($registro->ultimaMesa()){{date('d-m-20y',strtotime($registro->ultimaMesa()->fecha_mesa))}} @endif</td>
                      
                      <!-- Obtener el total de mesas -->
                      <td>{{$totalMesas = $registro->mesasT()->count();}}</td><td>
                        {{$registro->CalcDias(
                          ($registro->primeraMesa() ? $registro->primeraMesa()->fecha_mesa : NULL),
                          ($registro->ultimaMesa() ? $registro->ultimaMesa()->fecha_mesa : NULL)
                        )}}
                      </td>
                      <td>@if($registro->defReq) {{$registro->defReq->fechaCompReqC ? date('d-m-20y',strtotime($registro->defReq->fechaCompReqC)) : ''}} @endif</td>
                      <td>@if($registro->defReq) {{$registro->defReq->fechaCompReqR ? date('d-m-20y',strtotime($registro->defReq->fechaCompReqR)) : ''}} @endif</td>
                      <td>
                        {{$registro->CalcDias(
                          ($registro->defReq ? $registro->defReq->fechaCompReqC : NULL),
                          ($registro->defReq ? $registro->defReq->fechaCompReqR : NULL)
                        )}}
                      </td>
                      <td>@if($registro->defReq) {{$registro->defReq->updated_at ? date('d-m-20y',strtotime($registro->defReq->updated_at)) : ''}} @endif</td>
                      <td>
                        {{$registro->CalcDias(
                          ($registro->defReq ? $registro->defReq->fechaCompReqR : NULL),
                          ($registro->defReq ? $registro->defReq->fechaCompReqR : NULL)
                        )}}
                      </td>
                      <td>@if($registro->levantamiento) {{$registro->levantamiento->fecha_def ? date('d-m-20y',strtotime($registro->levantamiento->fecha_def)) : ''}} @endif</td>
                      <td>
                        {{$registro->CalcDias(
                          ($registro->defReq ? $registro->defReq->fechaCompReqR : NULL),
                          ($registro->levantamiento ? $registro->levantamiento->fecha_def : NULL)
                        )}}
                      </td>
                      <td>@if($registro->plan) {{$registro->plan->fechaCompReqR ? date('d-m-20y',strtotime($registro->plan->fechaCompReqR)) : ''}} @endif</td>
                      <td>@if($registro->plan) {{$registro->plan->fechaCompReqR ? date('d-m-20y',strtotime($registro->plan->fechaCompReqR)) : ''}} @endif</td>
                      <td>@if($registro->construccion) {{$registro->construccion->fechaCompReqR ? date('d-m-20y',strtotime($registro->construccion->fechaCompReqR)) : ''}} @endif</td>
                      <td>
                        {{$registro->CalcDias(
                          ($registro->plan ? $registro->plan->fechaCompReqR : NULL),
                          ($registro->construccion ? $registro->construccion->fechaCompReqR : NULL)
                        )}}
                      </td>
                      <td>@if($registro->liberacion) {{$registro->liberacion->fecha_lib_a ? date('d-m-20y',strtotime($registro->liberacion->fecha_lib_a)) : ''}} @endif</td>
                      <td>@if($registro->liberacion) {{$registro->liberacion->fecha_lib_r ? date('d-m-20y',strtotime($registro->liberacion->fecha_lib_r)) : ''}} @endif</td>
                      <td>
                        {{$registro->CalcDias(
                          ($registro->liberacion ? $registro->liberacion->fecha_lib_a : NULL),
                          ($registro->liberacion ? $registro->liberacion->fecha_lib_r : NULL)
                        )}}
                      </td>
                      <td>@if($registro->pausaPre()) {{$registro->pausaPre()->created_at}} @endif</td>
                      <td>@if($registro->pausaPre()) {{$registro->pausaPre()->updated_at}} @endif</td>
                      <td>
                        {{$registro->CalcDias(
                          ($registro->pausaPre() ? $registro->pausaPre()->created_at : NULL),
                          ($registro->pausaPre() ? $registro->pausaPre()->updated_at : NULL)
                        )}}
                      </td>
                      <td>@if($registro->liberacion) {{$registro->liberacion->inicio_p_r ? date('d-m-20y',strtotime($registro->liberacion->inicio_p_r)) : ''}} @endif</td>
                      <td>
                        {{$registro->CalcDias(
                          ($registro->liberacion ? $registro->liberacion->fecha_lib_r : NULL),
                          ($registro->liberacion ? $registro->liberacion->inicio_p_r : NULL)
                        )}}
                      </td>
                      <td>@if($registro->liberacion) {{$registro->liberacion->inicio_lib ? date('d-m-20y',strtotime($registro->liberacion->inicio_lib)) : ''}} @endif</td>
                      <td>
                        {{$registro->CalcDias(
                          ($registro->liberacion ? $registro->liberacion->inicio_p_r : NULL),
                          ($registro->liberacion ? $registro->liberacion->inicio_lib : NULL)
                        )}}
                      </td>
                      <td>@if($registro->implementacion) {{$registro->implementacion->f_implementacion ? date('d-m-20y',strtotime($registro->implementacion->f_implementacion)) : ''}} @endif</td>
                      <td>
                        {{$registro->CalcDias(
                          ($registro->solicitud ? $registro->solicitud->created_at : $registro->created_at),
                          ($registro->implementacion ? $registro->implementacion->f_implementacion : NULL)
                        )}}
                      </td>
                    </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th class="header">LISTA</th>
                    <th class="header">FOLIO</th>
                    <th class="header">DESCRIPCIÓN</th>
                    <th class="header">TIPO</th>
                    <th class="header">ESTATUS GENERAL</th>
                    <th class="header">CLASIFICACIÓN</th>
                    <th class="header">SISTEMA</th>
                    <th class="header">RESPONSABLE DESARROLLO</th>
                    <th class="header">CLIENTE</th>
                    <th class="header">RESPONSABLE PIP</th>
                    <th class="header">IMPACTO</th>
                    <th class="header">SOLICITUD DEL CLIENTE</th>
                    <th class="header">MESA DE ALCANCE</th>
                    <th class="header">CREACIÓN SOLICITUD DE REQUERIMIENTO</th>
                    <th class="header">*DÍAS</th>
                    <th class="header">AUTORIZACIÓN DE SOLICITUD DE REQUERIMIENTO</th>
                    <th class="header">*DÍAS</th>
                    <th class="header">FECHA DE SOLICITUD A DESARROLLO</th>
                    <th class="header">*DÍAS</th>
                    <th class="header">INICIO MESAS DE TRABAJO</th>
                    <th class="header">FIN MESAS DE TRABAJO</th>
                    <th class="header">*TOTAL MESAS</th>
                    <th class="header">*DIAS</th>
                    <th class="header">FECHA COMPROMISO ENTREGA DE DEFINICIÓN REQUERIMIENTO</th>
                    <th class="header">FECHA REAL DE ENTREGA DE DEFINICIÓN DE REQUERIMIENTO</th>
                    <th class="header">*DÍAS</th>
                    <th class="header">FECHA DE ENVÍO DE DEFINICIÓN</th>
                    <th class="header">*DÍAS</th>
                    <th class="header">AUTORIZACION DEFINICIÓN DE REQUERIMIENTO</th>
                    <th class="header">*DÍAS</th>
                    <th class="header">ENTREGA PLAN DE TRABAJO</th>
                    <th class="header">FECHA DE INICIO CONSTRUCCIÓN</th>
                    <th class="header">FIN CONSTRUCCIÓN</th>
                    <th class="header">*DÍAS</th>
                    <th class="header">COMPROMISO AMBIENTE PIP</th>
                    <th class="header">FECHA DE LIBERACIÓN REAL AMBIENTE A PIP</th>
                    <th class="header">*DÍAS</th>
                    <th class="header">INICIO ESPERA DE AMBIENTE PRE</th>
                    <th class="header">FIN ESPERA DE AMBIENTE PRE</th>
                    <th class="header">*DÍAS</th>
                    <th class="header">FECHA DE INICIO DE PRUEBAS (AMBIENTE PIP)</th>
                    <th class="header">*DÍAS</th>
                    <th class="header">FECHA FIN PRUEBAS</th>
                    <th class="header">*DÍAS</th>
                    <th class="header">FECHA DE IMPLEMENTACIÓN</th>
                    <th class="header">DURACIÓN TOTAL DEL PROYECTO</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endif
  <!-- Row Starts -->
  <div class="row">
    <div class="col-lg-8 d-flex align-items-stretch">
      <div class="card w-100">
        <div class="card-body">
          <div class="d-md-flex">
            <h4 class="card-title">
              <span class="lstick d-inline-block align-middle"></span>
              Recuento de requerimientos
            </h4>
            <!--<ul class="list-inline mb-0 ms-auto">
              <li class="list-inline-item">
                <h6 class="text-success">
                  <i class="ri-checkbox-blank-circle-fill align-middle fs-4 font-10 me-2"></i>
                  Site A view
                </h6>
              </li>
              <li class="list-inline-item">
                <h6 class="text-info">
                  <i class="ri-checkbox-blank-circle-fill align-middle fs-4 font-10 me-2"></i>
                  Site B view
                </h6>
              </li>
            </ul>-->
          </div>
          <!--<div class="text-center mt-2">
            <div class="btn-group" role="group" aria-label="Basic example">
              <button type="button" class=" btn btn-sm btn-outline-secondary shadow-sm me-0 fs-2">
                PAGEVIEWS
              </button>
              <button type="button" class="btn btn-sm btn-outline-secondary shadow-sm fs-2">
                REFERRALS
              </button>
            </div>
          </div>-->
          <div id="Website-Visit" class="position-relative mt-4" style="height: 400px; width: 100%"></div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 d-flex align-items-stretch">
      <div class="card w-100">
        <div class="card-body">
          <h4 class="card-title">
            <span class="lstick d-inline-block align-middle"></span>
            Requerimientos
          </h4>
          <div id="Visit-Separation" style="height: 290px; width: 100%" class="d-flex justify-content-center align-items-center"></div>
          <table class="table v-middle fs-3 mb-1 d-none">
            <tr>
              <td class="font-weight-medium border-0">Sistema</td>
              <td class="font-weight-medium border-0">Abierto</td>
              <td class="font-weight-medium border-0">Cerrado</td>
            </tr>
            @foreach($SxR as $datos)
              <tr id="tr{{$loop->iteration-1}}">
                <td id="w{{$loop->iteration-1}}" class="visit">{{$datos->nombre_s}}</td>
                  <td class="text-end font-weight-medium border-0 visit-total">
                    {{$datos->total}}
                  </td>
                  @foreach ($cerrado as $close)
                    @if($close->nombre_s == $datos->nombre_s)
                    <td id="c{{$loop->parent->iteration-1}}" class="text-end font-weight-medium border-0 visit-closed">
                      {{$close->total}}
                    </td>
                    @endif
                  @endforeach
              </tr>
            @endforeach
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- Row ends -->
  
  <script>
    $(document).ready(function () {
      $('#excel').DataTable({
        dom: "Bfrtip",
        buttons: ["copy", "csv", "excel", "pdf", "print",
        {
          text: 'GSheets',
          className: 'buttons-GSheets',
          action: function ( e, dt, button, config ) {
            var data = dt.buttons.exportData();
            exportToSheets(data);
          }
        }],
        scrollY: 350,
        scrollX: true,
        paging: false,
      });
      $(".buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel, .buttons-GSheets").addClass("btn btn-primary mr-1");
      
      function exportToSheets(data) {
        $.ajax({
          headers: { 'X-CSRF-TOKEN': "{{csrf_token()}}" },
          type: "POST",
          url: "gsheets",
          data: { data: data },
          success: function (response) {
            if (response && response.fileId) {
              var spreadsheetLink = "https://docs.google.com/spreadsheets/d/" + response.fileId;

              // Abre la URL de Google Sheets en una nueva pestaña
              var newTab = window.open(spreadsheetLink, '_blank');
              
              if (newTab) {
                newTab.focus();
              } else {
                console.log("El navegador bloqueó la apertura de una nueva pestaña.");
              }
            } else {
              console.log("No se recibió un fileId válido en la respuesta.");
            }
          },
          error: function (error) {
            console.log("Error en la solicitud AJAX:", error);
          }
        });
      }
    });
  </script>
  <!-- Custom JavaScript -->
  <script src="{{asset("assets/libs/apexcharts/dist/apexcharts.min.js")}}">
  </script>
  <!-- Chart JS -->
  <script>
    var total = new Array();
    var total_r = $('.visit-total').text().split('\n');
    const out = total_r.map(str => str.trim());
    for( var i = 0; i < out.length; i++ ){
      if ( out[ i ] ){
        total.push( parseInt(out[ i ]) );
      }
    }
    for( var j = 0; j < total.length; j++ ){
      if(typeof  $('#c'+j).attr('id') == 'undefined'){
        $('.v-middle tr#tr'+j).append(
          $('<td>', {
            'id':'c'+j,
            'class': 'text-end font-weight-medium border-0 visit-closed',
            'text':'0'
          })
        )
      }
    }
  </script>
  <script src="{{asset("assets/js/pages/dashboards/dashboard1.js")}}"></script>
  
@endsection
