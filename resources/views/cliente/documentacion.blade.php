@extends('home')
@section('content')
<!-- Incluir complemento -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link href="{{asset("assets/extra-libs/toastr/dist/build/toastr.min.css")}}" rel="stylesheet" />
  <script src="{{asset("assets/extra-libs/toastr/dist/build/toastr.min.js")}}"></script>
  @if(Cookie::has('rechazo'))
    <script>
      $(document).ready(function(){
        toastr.error(
          "{{ Cookie::get('rechazo') }}",
          "¡Guardado!",
          { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 2000 }
        );
      });
    </script>
  @endif
  @if (Cookie::has('autorizado'))
    <script>
      $(document).ready(function(){
        toastr.success(
          "{{ Cookie::get('autorizado') }}",
          "¡Guardado!",
          { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 2000 }
        );
      });
    </script>
  @endif  
  @if (session('fail'))
    <input class="d-none" id="fail" value="{{ session('fail') }}">
    <script>
      $(document).ready(function(){
        toastr.error(
          $("#fail").val(),
          "Error!",
          { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 2000 }
        );
      });
    </script>
  @endif
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body wizard-content">
          <div class="form-group row">
            <div class="col-md-6">
              <div class="form-control d-flex justify-content-between align-items-center">
                <span id="folio">{{$registros->folio}}</span>
                <a class="btn btn-info text-white font-weight-lighter {{Auth::user()->usrdata->puesto->jerarquia}} @if(Auth::user()->usrdata->puesto->jerarquia < '3') d-none @endif" data-bs-toggle="modal" data-bs-target="#registro-modal">
                  <i data-feather="edit-2" class="feather-sm" style="width: 8px; height: 8px;"></i>
                </a>
                @include('formatos.requerimientos.desplegables.registro')
              </div>
            </div>
            <div class="col-md-6">
              <div id="descripcion" class="form-control d-flex justify-content-between align-items-center">
                <span>{{$registros->descripcion}}</span>
              </div>
            </div>
          </div>
          <div class="progress mt-3">
            <div class="progress-bar progress-bar-striped progress-bar-animated {{ $registros->pausa ?  'bg-cyan': 'bg-danger'}}"
              style="width:{{$registros->estatus->posicion*100/($estatus->count()-10)}}%"
              >
            </div>
          </div>
          <div class="d-flex no-block align-items-center">
            <div class="ms-start col-3">
              <span @if($pausa->pausa == 2) class="text-danger" @endif>
                {{ floor($registros->estatus->posicion * 100 / ($estatus->count() - 10)) }}%
                @if($pausa->pausa == 2)Motivo: {{$pausa->motivo}} @else Avance @endif
              </span>
            </div>
            <div class="ms-auto col-6 row justify-content-center text-center">
              <div class="col-sm-3">
                  <span class="">
                      <i class="feather-sm me-2" data-feather="calendar"></i>
                      <i>{{$registros->CalcDias($regitros->solicitud->created_at ?? $registros->created_at, $registros->implementacion->f_implementacion ?? now())}}</i>
                  </span>
                  <div class="text-center">
                      <strong>Total de días</strong>
                  </div>
              </div>
              <div class="col-sm-3 text-danger">
                  <span class="d-flex align-items-center justify-content-center">
                    <i class="feather-sm me-2" data-feather="alert-circle"></i>
                    <i>{{$registros->diasPospuesto()->pospuesto}}</i>
                  </span>
                  <div class="text-center">
                      <strong>Días pospuesto</strong>
                  </div>
              </div>
              <div class="col-sm-3 text-success">
                  <span class="d-flex align-items-center justify-content-center">
                      <i class="feather-sm me-2" data-feather="check-circle"></i>
                      <i>{{$registros->CalcDias($regitros->solicitud->created_at ?? $registros->created_at, $registros->implementacion->f_implementacion ?? now()) - $registros->diasPospuesto()->pospuesto}}</i>
                  </span>
                  <div class="text-center">
                      <strong>Días activo</strong>
                  </div>
              </div>
            </div>
            <div class="ms-auto col-3 text-end">
              @if($pausa->pausa == 2)
                <span class="text-danger">POSPUESTO</span>
              @else
                <span>{{$registros->estatus->titulo}}</span>
              @endif
            </div>
          </div>
        </div>
      </div>
      <div class="card">
        <!-- Card -->
        <!-- Start row -->
        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="d-flex no-block align-items-center">
                    <h4 class="card-title">Avance</h4>
                    <a class="ms-auto text-dark">
                      <strong>
                        @switch($registros->estatus->posicion)
                          @case(6)
                            @if(is_null($registros->levantamiento->fechades) || $registros->levantamiento->impacto == 3)
                                DESARROLLO
                            @elseif($registros->levantamiento->impacto == 2)
                                DESARROLLO/PIP
                            @else
                                PIP
                            @endif
                            @break
                          @case(7)
                          @case(8)
                          @case(9)
                            DESARROLLO
                            @break
                          @case(10)
                            TESTING
                            @break
                          @default
                            PIP
                        @endswitch
                      </strong>
                    </a>
                    <a href={{route('Prioridad',Crypt::encrypt($registros->id_sistema))}} class="ms-auto">
                      <i class="" data-feather="corner-down-left"></i>
                    </a>
                  </div>
                </div>
                <div id="data">
                  <ul class="feeds ps-0">
                    @if ($registros->estatus->posicion > 1)
                      <div class="feed-item mb-2 py-2 pe-3 ps-4">
                        <div class="border-start border-2 border-danger d-md-flex">
                          <div class="d-flex align-items-start">
                            <a class="ms-3 btn btn-light-danger text-danger btn-circle fs-5 d-flex align-items-center justify-content-center flex-shrink-0">
                              <i data-feather="file-text" class="feather-sm"></i>
                            </a>
                            <div class="ms-3">
                              <span class="text-dark font-weight-medium">LEVANTAMIENTO</span>
                              @foreach ($estatus as $limite)
                                @if(($limite->posicion < 6) and ($limite->posicion != NULL))
                                  <div class="justify-content ms-2 ps-4 ps-md-0 d-md-flex">
                                    <span class="fs-2 text-muted">
                                      @if($registros->levantamiento && $limite->posicion == 5)
                                        @if($registros->levantamiento->fechaaut == NULL)
                                          <a class="text-danger"> Enviado a autorizar a {{$registros->levantamiento->autorizador->getFullnameAttribute()}}</a>
                                        @else
                                          <a class="text-success"> Autorizado por {{$registros->levantamiento->autorizador->getFullnameAttribute()}}</a>
                                          @endif
                                      @else 
                                        {{$limite->titulo}}
                                      @endif
                                    </span>
                                    <div class="position-absolute end-0">
                                      <span class="fs-2 text-muted">
                                        @switch($limite->posicion)
                                          @case(1)
                                            @if($registros->solicitud)
                                              {{date("d/M/y",strtotime($registros->solicitud->created_at))}}
                                            @endif
                                            @break
                                          @case(2)
                                            @if($registros->created_at)
                                              {{date("d/M/y",strtotime($registros->created_at))}}
                                            @endif
                                            @break
                                          @case(3)
                                            @if($registros->levantamiento)
                                              {{date("d/M/y",strtotime($registros->levantamiento->created_at))}}
                                            @endif
                                            @break
                                          @case(4)
                                            @if($registros->levantamiento)
                                              {{date("d/M/y",strtotime($registros->levantamiento->created_at))}}
                                            @endif
                                            @break
                                          @case(5)
                                            @if($registros->levantamiento && $registros->levantamiento->fechaaut)
                                              <a class="text-success">{{date("d/M/y",strtotime($registros->levantamiento->fechaaut))}}</a>
                                            @elseif($registros->levantamiento && !$registros->levantamiento->fechaaut)
                                              <a class="text-danger">{{date("d/M/y",strtotime($registros->levantamiento->updated_at))}}</a>
                                            @endif
                                            @break
                                          @default   
                                            <!--{ {date("d/M/y",strtotime($registros->correo))}}-->
                                            @break  
                                        @endswitch
                                      </span>
                                    </div>
                                  </div>
                                  @foreach($registros->pausa as $retraso)
                                    @if($retraso->estatus && $limite->titulo == $retraso->estatus->titulo)
                                      <div class="justify-content ms-2 ps-4 ps-md-0 d-md-flex">
                                        <span class="fs-2 text-muted">
                                          <a class="text-danger">{{$retraso->desfase->motivo}}</a>
                                        </span>
                                        <div class="position-absolute end-0">
                                          <span class="fs-2 text-muted">
                                            <p class="text-danger">Días pospuesto @if($retraso->pausa == 2)
                                              {{$registros->CalcDias($retraso->created_at, now())}} 
                                              @else 
                                              {{$registros->CalcDias($retraso->created_at, $retraso->updated_at)}}
                                              @endif
                                            </p>
                                          </span>
                                        </div>
                                      </div>
                                    @endif
                                  @endforeach
                                @endif
                              @endforeach
                              @foreach($registros->pausa as $retrasodesc)
                                @if(!$retrasodesc->id_estatus)
                                <div class="justify-content ms-2 ps-4 ps-md-0 d-md-flex">
                                  <span class="fs-2 text-muted">
                                    <a class="text-danger">{{'DESCONOCIDO'}}</a>
                                  </span>
                                  <div class="position-absolute end-0">
                                    <span class="fs-2 text-muted">
                                      <p class="text-danger">Días pospuesto @if($retrasodesc->pausa == 2)
                                        {{$registros->CalcDias($retrasodesc->created_at, now())}} 
                                        @else 
                                        {{$registros->CalcDias($retrasodesc->created_at, $retrasodesc->updated_at)}}
                                        @endif
                                      </p>
                                    </span>
                                  </div>
                                </div>
                                @endif
                              @endforeach
                            </div>
                          </div>
                          <div class="position-absolute end-0">
                            <a class="text-danger">
                              <strong>
                                {{$registros->CalcDias($registros->solicitud->created_at ?? $registros->created_at, $registros->levantamiento->fechaaut ?? $registros->defReq->fechaCompReqR ?? now())}} Días
                              </strong> / 
                              {{ min($registros->estatus->posicion, 5) }} de 5
                            </a>                          
                          </div>
                        </div>
                      </div>
                    @endif
                    @if ($registros->estatus->posicion > 6)
                      <div class="feed-item mb-2 py-2 pe-3 ps-4">
                        <div class="border-start border-2 border-info d-md-flex">
                          <div class="d-flex align-items-start">
                            <a class="ms-3 btn btn-light-info text-info btn-circle fs-5 d-flex align-items-center justify-content-center flex-shrink-0">
                              <i data-feather="settings" class="feather-sm"></i>
                            </a>
                            <div class="ms-3">
                              <span class="text-dark font-weight-medium">CONSTRUCCIÓN</span>
                              @foreach ($estatus as $limite)
                                @if(($limite->posicion > 5) and ($limite->posicion < 10) and ($limite->posicion != NULL))
                                  <div class="justify-content ms-2 ps-4 ps-md-0 d-md-flex">
                                    <span class="fs-2 text-muted">{{$limite->titulo}}</span>
                                    <div class="position-absolute end-0">
                                      <span class="fs-2 text-muted">
                                        @switch($limite->posicion)
                                          @case(6)
                                            @if($registros->defReq)
                                              {{date("d/M/y",strtotime($registros->levantamiento->fechaaut ?? $registros->defReq->fechaCompReqR))}}
                                            @endif
                                            @break
                                          @case(7)
                                            @if($registros->plan)
                                              <!--{date("d/M/y",strtotime($registros->construccion->fechaCompReqR))}}-->
                                            @endif
                                            @break
                                          @case(8)
                                            @if($registros->plan)
                                              {{date("d/M/y",strtotime($registros->plan->fechaCompReqR))}}
                                            @endif
                                            @break
                                          @case(9)
                                            @if($registros->construccion)
                                              {{date("d/M/y",strtotime($registros->construccion->fechaCompReqR))}}
                                            @endif
                                            @break
                                          @default 
                                        @endswitch
                                      </span>
                                    </div>
                                  </div>  
                                  @foreach($registros->pausa as $retraso)
                                    @if($retraso->estatus && $limite->titulo == $retraso->estatus->titulo)
                                      <div class="justify-content ms-2 ps-4 ps-md-0 d-md-flex">
                                        <span class="fs-2 text-muted">
                                          <a class="text-danger">{{$retraso->desfase->motivo}}</a>
                                        </span>
                                        <div class="position-absolute end-0">
                                          <span class="fs-2 text-muted">
                                            <p class="text-danger">Días pospuesto @if($retraso->pausa == 2)
                                              {{$registros->CalcDias($retraso->created_at, now())}} 
                                              @else 
                                              {{$registros->CalcDias($retraso->created_at, $retraso->updated_at)}}
                                              @endif
                                            </p>
                                          </span>
                                        </div>
                                      </div>
                                    @endif
                                  @endforeach
                                  @if($registros->estatus->posicion == 7 && $limite->posicion == 6 && ($archivos->contains(fn($archivo) => stripos($archivo->url, 'Flujo') !== false || stripos($archivo->url, 'Prototipo') !== false)))
                                    <div class="justify-content ms-2 ps-4 ps-md-0 d-md-flex">
                                      <span class="fs-2 text-muted">
                                        <a class="text-warning">Archivo enviado a desarrollo</a>
                                      </span>
                                    </div>
                                  @elseif($registros->estatus->posicion == 7 && $limite->posicion == 6)
                                    <div class="justify-content ms-2 ps-4 ps-md-0 d-md-flex">
                                      <span class="fs-2 text-muted">
                                        <a class="text-danger">En espera de Flujo o Prototipo</a>
                                      </span>
                                    </div>
                                  @endif
                                @endif
                              @endforeach
                            </div>
                          </div>
                          <div class="position-absolute end-0">
                            <a class="text-info">
                              <strong>
                                {{$registros->CalcDias($registros->levantamiento->fechaaut ?? $registros->defReq->fechaCompReqR, $registros->construccion->fechaCompReqR ?? now())}} Días
                              </strong> / 
                              {{ min($registros->estatus->posicion, 3) }} de 3
                            </a>   
                          </div>
                        </div>
                      </div>
                    @endif
                    @if ($registros->estatus->posicion > 9)
                      <div class="feed-item mb-2 py-2 pe-3 ps-4">
                        <div class="border-start border-2 border-success d-md-flex">
                          <div class="d-flex align-items-start">
                            <a class="ms-3 btn btn-light-success text-success btn-circle fs-5 d-flex align-items-center justify-content-center flex-shrink-0">
                              <i data-feather="check-circle" class="feather-sm"></i>
                            </a>
                            <div class="ms-3">
                              <span class="text-dark font-weight-medium">LIBERACIÓN</span>
                              @foreach ($estatus as $limite)
                                @if(($limite->posicion > 9) and ($limite->posicion < 12) and ($limite->posicion != NULL))
                                  <div class="justify-content ms-2 ps-4 ps-md-0 d-md-flex">
                                    <span class="fs-2 text-muted">{{$limite->titulo}}</span>
                                    <div class="position-absolute end-0">
                                      <span class="fs-2 text-muted">
                                        @if($registros->liberacion && $registros->liberacion->fecha_lib_r && $limite->posicion == 10)
                                          {{date("d/M/y",strtotime($registros->liberacion->fecha_lib_r))}}
                                        @elseif($registros->liberacion && $registros->liberacion->inicio_lib && $limite->posicion == 11)
                                          {{date("d/M/y",strtotime($registros->liberacion->inicio_lib))}}
                                        @endif
                                      </span>
                                    </div>
                                  </div>
                                  @foreach($registros->pausa as $retraso)
                                    @if($retraso->estatus && $limite->titulo == $retraso->estatus->titulo)
                                      <div class="justify-content ms-2 ps-4 ps-md-0 d-md-flex">
                                        <span class="fs-2 text-muted">
                                          <a class="text-danger">{{$retraso->desfase->motivo}}</a>
                                        </span>
                                        <div class="position-absolute end-0">
                                          <span class="fs-2 text-muted">
                                            <p class="text-danger">Días pospuesto @if($retraso->pausa == 2)
                                              {{$registros->CalcDias($retraso->created_at, now())}} 
                                              @else 
                                              {{$registros->CalcDias($retraso->created_at, $retraso->updated_at)}}
                                              @endif
                                            </p>
                                          </span>
                                        </div>
                                      </div>
                                    @endif
                                  @endforeach
                                  @if(($limite->posicion == 11))
                                    @if($datosRonda = $registros->liberacion ? $registros->liberacion->obtenerDatosRonda($registros->folio) : '')
                                      <div class="justify-content ms-2 ps-4 ps-md-0 d-md-flex">
                                        <span class="fs-2 text-info">RONDAS</span>
                                        <div class="position-absolute end-0">
                                          <span class="fs-2 text-info">{{$datosRonda->ronda}}
                                          </span>
                                        </div>
                                      </div>
                                      <div class="justify-content ms-2 ps-4 ps-md-0 d-md-flex">
                                        <span class="fs-2 text-info">{{'TOTAL DE PRUEBAS'}}</span>
                                        <div class="position-absolute end-0">
                                          <span class="fs-2 text-info">
                                            @if($registros->liberacion)
                                            {{$datosRonda->aprobadas + $datosRonda->rechazadas}}
                                            @endif
                                          </span>
                                        </div>
                                      </div>
                                    @endif
                                  @endif
                                @endif
                              @endforeach
                            </div>
                          </div>
                          <div class="position-absolute end-0">
                            <a class="text-success"><strong>
                              {{$registros->CalcDias($registros->construccion->fechaCompReqR,$registros->liberacion->inicio_lib ?? now())}} Días</strong> / @if ($registros->estatus->posicion > 9) 1 @else {{$registros->estatus->posicion - 9}} @endif de 1</a>
                          </div>
                        </div>
                      </div>
                    @endif
                    @if ($registros->estatus->posicion > 12)
                      <div class="feed-item mb-2 py-2 pe-3 ps-4">
                        <div class="border-start border-2 border-orange d-md-flex">
                          <div class="d-flex align-items-start">
                            <a class="ms-3 btn btn-light-warning text-orange btn-circle fs-5 d-flex align-items-center justify-content-center flex-shrink-0">
                              <i data-feather="users" class="feather-sm"></i>
                            </a>
                            <div class="ms-3">
                              <span class="text-dark font-weight-medium">
                                IMPLEMENTACIÓN
                              </span>
                              @foreach ($estatus as $limite)
                                @if(($limite->posicion == 12) and ($limite->posicion != NULL))
                                  <div class="justify-content ms-2 ps-4 ps-md-0 d-md-flex">
                                    <span class="fs-2 text-muted">{{$limite->titulo}}</span>
                                    <div class="position-absolute end-0">
                                      <span class="fs-2 text-muted">
                                        @if($registros->implementacion)
                                          {{date("d/M/y",strtotime($registros->implementacion->f_implementacion))}}
                                        @endif
                                      </span>
                                    </div>
                                  </div>
                                  
                                  @foreach($registros->pausa as $retraso)
                                    @if($retraso->estatus && $limite->titulo == $retraso->estatus->titulo)
                                      <div class="justify-content ms-2 ps-4 ps-md-0 d-md-flex">
                                        <span class="fs-2 text-muted">
                                          <a class="text-danger">{{$retraso->desfase->motivo}}</a>
                                        </span>
                                        <div class="position-absolute end-0">
                                          <span class="fs-2 text-muted">
                                            <p class="text-danger">Días pospuesto @if($retraso->pausa == 2)
                                              {{$registros->CalcDias($retraso->created_at, now())}} 
                                              @else 
                                              {{$registros->CalcDias($retraso->created_at, $retraso->updated_at)}}
                                              @endif
                                            </p>
                                          </span>
                                        </div>
                                      </div>
                                    @endif
                                  @endforeach
                                @endif
                              @endforeach
                            </div>
                          </div>
                          <div class="position-absolute end-0">
                            <a class="text-orange">
                              <strong>
                                {{$registros->CalcDias($registros->liberacion->inicio_lib, $registros->implementacion->f_implementacion ?? now())}} Días</strong> / @if ($registros->estatus->posicion > 10) 1 @else {{$registros->estatus->posicion - 10}} @endif de 1
                            </a>
                          </div>
                        </div>
                      </div>
                    @endif
                  </ul>
                </div>
                @if(Auth::user()->usrdata->id_departamento != 35)
                  <div class="position-absolute">
                    @if (($registros->id_estatus <> 18) && ($registros->id_estatus <> 14))
                      @if ($pausa->pausa == '2')
                        <a class="justify-content-center btn btn-rounded btn-light-success text-success align-items-center" data-bs-toggle="modal" data-bs-target="#estle">
                          <i class="feather-sm" data-feather="play"></i>
                        </a>
                      @else
                        <a class="justify-content-center btn btn-rounded btn-light-danger text-danger align-items-center" data-bs-toggle="modal" data-bs-target="#estle">
                          <i class="feather-sm" data-feather="pause"></i>
                        </a>
                      @endif
                      @if((Auth::user()->id_puesto == 7 || Auth::user()->id_area == 12) && ($registros->estatus->posicion == 7 || $registros->estatus->posicion == 8))
                        <a class="justify-content-center btn btn-rounded btn-light-info text-info align-items-center" data-bs-toggle="modal" data-bs-target="#Soporte">
                          <i class="feather-sm" data-feather="edit"></i>
                        </a>
                      @endif  
                    @endif
                  </div>
                  <div class="position-absolute end-0">
                    @if($pausa->pausa == 0) 
                      @switch($registros->estatus->posicion)
                        @case(3)
                          @if(Auth::user()->usrdata->id_departamento == '21' || Auth::user()->usrdata->id_puesto == '7')
                            <a href="{{route('Mesa',Crypt::encrypt($registros->folio))}}" id="btn" type="button" class="btn btn-outline-orange">Mesa de alcance</a>
                            <a href="{{route('Formato',Crypt::encrypt($registros->id_registro))}}" id="btn" type="button" class="btn btn-outline-purple">Llenar Solicitud</a>
                          @endif
                        @break
                        @case(4)
                          @if(Auth::user()->usrdata->id_departamento == '21' || Auth::user()->usrdata->id_puesto == '7')
                            <a href="{{route('Enviar',Crypt::encrypt($registros->folio))}}" id="btn" type="button" class="btn btn-outline-purple">Enviar Reporte</a>
                          @endif
                        @break
                        @case(5)
                          @if(Auth::user()->usrdata->id_departamento == '21' || Auth::user()->usrdata->id_puesto == '7')
                            <a href="{{route('Levantamiento',Crypt::encrypt($registros->id_registro))}}" type="button" class="btn btn-outline-cyan">Revisión de Datos</a>
                            @if($registros->levantamiento->fechaaut)
                              <a href="{{route('Enviar',Crypt::encrypt($registros->folio))}}" id="btn" type="button" class="btn btn-outline-purple">Confirmación</a>
                            @endif
                          @endif
                        @break
                        @case(6)
                          <a href="{{route('Mesa',Crypt::encrypt($registros->folio))}}" id="btn" type="button" class="btn btn-outline-orange">Mesa de trabajo</a>
                          @if(!$registros->id_tester)
                            @if((Auth::user()->usrdata->id_departamento == '21' || Auth::user()->usrdata->id_departamento == '37' || Auth::user()->usrdata->id_puesto == '7'))
                              <button id="btn" type="button" class="btn btn-outline-orange" data-bs-toggle="modal" data-bs-target="#Tester">Asignar tester</button> 
                            @endif
                          @endif
                          @if($registros->levantamiento->impacto == 1)
                            @if(Auth::user()->usrdata->id_departamento == '21' || Auth::user()->usrdata->id_puesto == '7')
                              <a href="{{route('Planeacion',Crypt::encrypt($registros->folio))}}" id="btn" type="button" class="btn btn-outline-purple">Planeación</a>
                            @endif
                          @elseif($registros->levantamiento->impacto == 3)
                            @if(Auth::user()->usrdata->id_departamento == '14' || Auth::user()->usrdata->id_puesto == '7')
                              <a href="{{route('Planeacion',Crypt::encrypt($registros->folio))}}" id="btn" type="button" class="btn btn-outline-purple">Planeación</a>
                            @endif
                          @elseif($registros->levantamiento->impacto == 2)
                            <a href="{{route('Planeacion',Crypt::encrypt($registros->folio))}}" id="btn" type="button" class="btn btn-outline-purple">Planeación</a>
                          @elseif($registros->levantamiento->fechades == NULL)
                            @if(Auth::user()->usrdata->id_departamento == '14' || Auth::user()->usrdata->id_puesto == '7')
                            <button id="btn" type="button" class="btn btn-outline-purple" data-bs-toggle="modal" data-bs-target="#impacto">Clase</button> 
                            @endif
                          @endif
                        @break
                        @case(7)
                          @if(Auth::user()->usrdata->id_departamento == '21' || Auth::user()->usrdata->id_puesto == '7')
                            <a data-bs-toggle="modal" data-bs-target="#Auto2" type="button" class="btn btn-outline-purple">Enviar Flujo a desarrollo</a>
                          @endif
                          @if(Auth::user()->usrdata->id_departamento == '14' || Auth::user()->usrdata->id_puesto == '7')
                              @if ($flujo)
                                <a data-bs-toggle="modal" data-bs-target="#Flujo" type="button" class="btn btn-outline-orange">Autorizar flujo</a>
                              @endif
                          @endif
                        @break
                        @case(8)
                          @if(Auth::user()->usrdata->id_departamento == '14' || Auth::user()->usrdata->id_puesto == '7') 
                            @if($registros->levantamiento->fecha_def == null)
                              <a href="{{route('Mesa',Crypt::encrypt($registros->folio))}}" id="btn" type="button" class="btn btn-outline-orange">Mesa de trabajo</a>
                              @if($registros->levantamiento->impacto == 1)
                                @if(Auth::user()->usrdata->id_departamento == '21' || Auth::user()->usrdata->id_puesto == '7')
                                  <a href="{{route('Planeacion',Crypt::encrypt($registros->folio))}}" id="btn" type="button" class="btn btn-outline-purple">Cambiar Definición</a>
                                @endif
                              @elseif($registros->levantamiento->impacto == 3)
                                @if(Auth::user()->usrdata->id_departamento == '14' || Auth::user()->usrdata->id_puesto == '7')
                                  <a href="{{route('Planeacion',Crypt::encrypt($registros->folio))}}" id="btn" type="button" class="btn btn-outline-purple">Cambiar Definición</a>
                                @endif
                              @elseif($registros->levantamiento->impacto == 2)
                                <a href="{{route('Planeacion',Crypt::encrypt($registros->folio))}}" id="btn" type="button" class="btn btn-outline-purple">Cambiar Definición</a>
                              @endif
                            @else
                              <a href="{{route('Analisis',Crypt::encrypt($registros->folio))}}" id="btn" type="button" class="btn btn-outline-purple">Plan de trabajo</a>
                            @endif
                          @endif
                        @break
                        @case(9)
                          @if ($registros->levantamiento->fechades == null)
                            <button id="btn" type="button" class="btn btn-outline-purple" data-bs-toggle="modal" data-bs-target="#Auto2">Cargar autorización</button> 
                          @elseif(Auth::user()->usrdata->id_departamento == '14' || Auth::user()->usrdata->id_puesto == '7')
                            <a href="{{route('Construccion',Crypt::encrypt($registros->folio))}}" id="" type="button" class="btn btn-outline-purple">Construcción</a>
                          @endif
                        @break
                        @case(10)
                          @if($registros->id_tester)
                            @if(Auth::user()->usrdata->id_departamento == '21' || Auth::user()->usrdata->id_departamento == '37' || Auth::user()->usrdata->id_puesto == '7')
                              <a href="{{route('PruebasTesting',Crypt::encrypt($registros->folio))}}" id="btn" type="button" class="btn btn-outline-purple">Pruebas Testing</a>
                            @endif
                          @else
                            @if((Auth::user()->usrdata->id_departamento == '21' || Auth::user()->usrdata->id_departamento == '37' || Auth::user()->usrdata->id_puesto == '7'))
                              <button id="btn" type="button" class="btn btn-outline-orange" data-bs-toggle="modal" data-bs-target="#Tester">Asignar tester</button> 
                            @endif
                          @endif
                        @break
                        @case(11)
                          @if(Auth::user()->usrdata->id_departamento == '21' || Auth::user()->usrdata->id_puesto == '7')
                            <a href="{{route('Liberacion',Crypt::encrypt($registros->folio))}}" id="btn" type="button" class="btn btn-outline-purple">Liberación</a>
                          @endif
                        @break
                        @case(12)
                          @if(Auth::user()->usrdata->id_departamento == '21' || Auth::user()->usrdata->id_puesto == '7')
                            <a href="{{route('Implementacion',Crypt::encrypt($registros->folio))}}" id="btn" type="button" class="btn btn-outline-purple">Implementación</a>
                          @endif
                        @break
                        @case(18)
                      @endswitch <!--(Auth::user()->usrdata->id_departamento == '37' || Auth::user()->usrdata->id_puesto == '7')-->
                      @if((Auth::user()->usrdata->id_departamento == '21' || Auth::user()->usrdata->id_puesto == '7') && ($registros->estatus->posicion > 6 && $registros->levantamiento->fecha_def) && $registros->estatus->posicion < 9 && !$registros->rtest)
                        <button id="btn" type="button" class="btn btn-outline-orange" data-bs-toggle="modal" data-bs-target="#Tester">Asignar tester</button> 
                      @endif
                    @endif
                  </div>
                @endif
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="card">
              <div class="row">
                <div class="col-md-12">
                  <!-- ---------------------
                  start Drag & Drop Event
                  ---------------- -->
                    <div class="row">
                      <div class="col-lg-12">
                          <div class="card-body calender-sidebar">
                            <div id="calendar"></div>
                          </div>
                      </div>
                    </div>
                  <!-- ---------------------
                  end Drag & Drop Event
                  ---------------- -->
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- End row -->
      </div>
    </div>
      
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">  
          <div class="row">
            <div class="col-xl-2 col-md-6 col-lg-10 d-flex align-items-center border-bottom">
              <h4 class="card-title">
                @if ($link)
                  <a href="{{$link->evidencia}}" class="text-dark" target="_blank">
                    <span class="lstick d-inline-block align-middle"></span>
                    <strong>{{ __('DOCUMENTACIÓN') }}</strong>
                  </a>
                @else
                  <a data-bs-toggle="modal" data-bs-target="#link" class="text-dark">
                    <span class="lstick d-inline-block align-middle"></span>
                    <strong>{{ __('DOCUMENTACIÓN') }}</strong>
                  </a>
                @endif
              </h4>
            </div>
            @if(Auth::user()->usrdata->id_departamento != 35)
              <div class="col-xl-2 col-md-6 col-lg-2 d-flex align-items-center border-bottom">
                <!--<button type="button" class="btn waves-effect waves-light btn-outline-info">
                  <a href="{{route('RD',Crypt::encrypt($registros->folio))}}">
                    <i class="feather-sm" data-feather="file-text"></i>
                  </a>
                </button>-->
                <button type="button" class="btn waves-effect waves-light btn-outline-info">
                  <a data-bs-toggle="modal" data-bs-target="#link">
                    <i class="feather-sm" data-feather="link"></i>
                  </a>
                </button>
                <button id="upload" type="button" class="btn waves-effect waves-light btn-outline-success">
                  <a data-bs-toggle="modal" data-bs-target="#Adjuntos">
                    <i class="feather-sm" data-feather="upload-cloud"></i>
                  </a>
                </button>
              </div>
            @endif
            <div class="col-md-12">
              @foreach($archivos as $archivo)
                @if (!Str::contains($archivo->url, 'extra') && !Str::contains($archivo->url, 'COMPLEMENTOS'))
                  <form id="{{$loop->iteration}}" method="POST" enctype="multipart/form-data" id="myAwesomeDropzone">
                    <div class="d-flex align-items-center">
                      <div class="icon"><i class="feather-sm" data-feather="file"></i></div>
                      @if (Str::contains($archivo->url, 'Definición de requerimiento'))
                        <h6 class="modal-title col-sm-10">
                          <a data-bs-toggle="tooltip" data-bs-placement="right" title="@foreach ($def_ver as $version)Archivo: {{ pathinfo($version->url, PATHINFO_FILENAME) }} Creado en: {{ $version->created_at->format('Y-m-d H:i:s')}}.&#10; @endforeach">
                            <strong>{{ pathinfo($archivo->url, PATHINFO_FILENAME) }}</strong>
                            <i class="feather-sm me-2" data-feather="info"></i>
                          </a>
                        </h6>
                      @else
                        <h6 class="modal-title col-sm-10">
                          <strong>{{pathinfo($archivo->url, PATHINFO_FILENAME)}}</strong>
                        </h6>
                      @endif                 
                      <a class="btn waves-effect waves-light btn-outline-info col-sm-auto" href="{{asset("$archivo->url")}}">
                        <i class="feather-sm" data-feather="download-cloud"></i>
                      </a>
                      @if(Auth::user()->usrdata->id_departamento != 35)
                        <a id="{{$archivo->id}}" class="btn waves-effect waves-light btn-outline-danger delete">
                          <i class="feather-sm" data-feather="trash-2"></i>
                        </a>
                      @endif
                    </div>
                  </form> 
                @endif
              @endforeach
              @if($formatos <> 0)
                <div class="d-flex align-items-center">
                  <div class="icon">
                    <i class="feather-sm" data-feather="file"></i>
                  </div> 
                  <h6 class="modal-title col-sm-10"><strong>{{"$registros->folio $registros->descripcion"}}</strong></h6>
                  <a class="btn waves-effect waves-light btn-outline-info col-sm-auto" href="{{route("Archivo",Crypt::encrypt($registros->folio))}}">
                    <i class="feather-sm" data-feather="download-cloud"></i>
                  </a>
                </div>
              @endif
            </div>
          </div>
        </div>
        <div class="card-footer">
          <div class="row">
            <div class="col-xl-2 col-md-6 col-lg-10 d-flex align-items-center border-bottom">
              <h4 class="card-title">
                <a class="text-dark">
                  <span class="lstick d-inline-block align-middle"></span>
                  <strong>{{ __('COMPLEMENTOS') }}</strong>
                </a>
              </h4>
            </div>
            @if(Auth::user()->usrdata->id_departamento != 35)
              <div class="col-xl-2 col-md-6 col-lg-2 d-flex align-items-center border-bottom">
                <button id="upload" type="button" class="btn waves-effect waves-light btn-outline-success">
                  <a data-bs-toggle="modal" data-bs-target="#Complementos">
                    <i class="feather-sm" data-feather="upload-cloud"></i>
                  </a>
                </button>
              </div>
            @endif
            <div class="col-md-12">
              @foreach($archivos as $archivo)
                @if (Str::contains($archivo->url, 'COMPLEMENTOS'))
                  <form id="{{$loop->iteration}}" method="POST" enctype="multipart/form-data" id="myAwesomeDropzone">
                    <div class="d-flex align-items-center">
                      <div class="icon"><i class="feather-sm" data-feather="file"></i></div>
                      <h6 class="modal-title col-sm-10">
                        <strong>{{pathinfo($archivo->url, PATHINFO_FILENAME)}}</strong>
                      </h6>
                      <a class="btn waves-effect waves-light btn-outline-info col-sm-auto" href="{{asset("$archivo->url")}}">
                        <i class="feather-sm" data-feather="download-cloud"></i>
                      </a>
                      @if(Auth::user()->usrdata->id_departamento != 35)
                        <a id="{{$archivo->id}}" class="btn waves-effect waves-light btn-outline-danger delete">
                          <i class="feather-sm" data-feather="trash-2"></i>
                        </a>
                      @endif
                    </div>
                  </form>
                @endif
              @endforeach
            </div>
            <div class="col-md-12">
              @foreach($mesas as $mesa)
                @if (Str::contains($mesa->evidencia, 'COMPLEMENTOS'))
                  <form id="{{$loop->iteration}}" method="POST" enctype="multipart/form-data" id="myAwesomeDropzone">
                    <div class="d-flex align-items-center">
                      <div class="icon"><i class="feather-sm" data-feather="file"></i></div>
                      <h6 class="modal-title col-sm-10">
                        <strong>{{pathinfo($mesa->evidencia, PATHINFO_FILENAME)}}</strong>
                      </h6>
                      <a class="btn waves-effect waves-light btn-outline-info col-sm-auto" href="{{asset("$mesa->evidencia")}}">
                        <i class="feather-sm" data-feather="download-cloud"></i>
                      </a>
                      @if(Auth::user()->usrdata->id_departamento != 35)
                        <a id="{{pathinfo($mesa->evidencia, PATHINFO_FILENAME)}}" class="btn waves-effect waves-light btn-outline-danger delete">
                          <i class="feather-sm" data-feather="trash-2"></i>
                        </a>
                      @endif
                    </div>
                  </form>
                @endif
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="col-xl-2 col-md-6 col-lg-12 d-flex align-items-center border-bottom">
            <h4 class="card-title">
              <a class="text-dark">
                <span class="lstick d-inline-block align-middle"></span>
                <strong>{{ __('COMENTARIOS') }}</strong>
              </a>
            </h4>
          </div>
          <form class="border-bottom" action="{{route('Comentar')}}" method="POST">
            {{ csrf_field() }}
            <div class=""width="500" height="10" style="margin-left:10;">
                <section class="u-align-left u-border-3 u-border-grey-75 u-clearfix u-white u-section-1" id="carousel_4c76">
                  <input type="text" class="d-none" name="folio" value="{{$registros->folio}}">
                  <input type="text" class="d-none" name="respuesta" value="No">
                  <div class="row">
                    <div class="p-1 col-1">
                      @if (Auth::user()->usrdata->avatar == NULL)
                        <img src="{{asset("assets/images/users/1.jpg")}}" alt="user" width="50" class="rounded-circle"/> 
                      @else
                        <img src="{{asset(Auth::user()->usrdata->avatar)}}" alt="user" width="50" class="rounded-circle"/>    
                      @endif
                    </div>
                    <div class="col-9">
                      <input name="contenido" placeholder="Escribe tu Comentario" class="form-control border-0 required form-control  @error ('contenido') is-invalid @enderror" style="resize: none">{{old('contenido')}}</textarea>
                      @error('contenido')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                    <div class="col-1 text-end">
                      <button type="submit" class="btn btn-lg">
                        <i class="fas fa-reply"></i>
                      </button>
                    </div>
                  </div>
                </section>
            </div>
          </form>
        </div>
        <div class="comment-widgets scrollable mb-2 common-widget">
          <!-- Comment Row -->
          @foreach ($comentarios as $comentario)
            @if($comentario->id_estatus == $registros->id_estatus)
              @if($comentario->id_estatus == 17)
                @include('layouts.comentario')
              @else
                @if($comentario->id_estatus == 10)
                  @include('layouts.comentario')
                @else
                  @if($comentario->id_estatus == 16)
                    @include('layouts.comentario')
                  @else
                    @if($comentario->id_estatus == 11)
                      @include('layouts.comentario')
                    @else
                      @if($comentario->id_estatus == 9)
                        @include('layouts.comentario')
                      @else
                        @if($comentario->id_estatus == 7)
                          @include('layouts.comentario')
                        @else
                          @if($comentario->id_estatus == 8)
                            @include('layouts.comentario')
                          @else
                            @if($comentario->id_estatus == 2)
                              @include('layouts.comentario')
                            @else
                              @if($comentario->id_estatus == 13)
                                @include('layouts.comentario')
                              @else
                                  @include('layouts.comentario')
                              @endif
                            @endif
                          @endif
                        @endif
                      @endif
                    @endif
                  @endif
                @endif
              @endif
            @else 
              @if($registros->id_estatus == 16 && $comentario->id_estatus == 10)
                @include('layouts.comentario')
              @else
                @if($registros->id_estatus == 9 || $registros->id_estatus == 7)
                  @if($comentario->id_estatus == 11 || $comentario->id_estatus == 9)
                    @include('layouts.comentario')
                  @endif
                @else
                  @if ($registros->id_estatus == 18)
                    @include('layouts.comentario')
                  @endif
                @endif
              @endif
            @endif  
          @endforeach
        </div>
      </div>
    </div>
  </div>
  <!-- BEGIN MODAL -->
  @include('formatos.requerimientos.desplegables.archivos')
  @include('formatos.requerimientos.desplegables.posponer')
  <!-- End Modal -->

  <style>
    .tooltip-inner {
        background-color: black;
        box-shadow: 0px 0px 4px black;
        color: #f4f6f9;
        max-width: 100%; 
        opacity: 1 !important;
        white-space: pre-line;
        word-wrap: break-word;
    }

    .tooltip.bs-tooltip-end .tooltip-arrow::before {
      border-right-color: black
    }
  </style>
  
  <script type="text/javascript">
    $(document).ready(function() {
      var folio = $('#folio').text().trim();
      $('.delete').on('click', function(e) {
        e.preventDefault();
        var parent = $(this).parent().parent().attr('id');
        var id = $(this).attr('id');
        var dataString = 'item='+id;        
        $.ajax({
          headers:{'X-CSRF-TOKEN' : "{{csrf_token()}}"},
          type: "DELETE",
          url: "file.borrar."+id,
          success: function(response) {
            $('#'+parent).hide("slow");
          }               
        });
      }); 
      $('.link').on('click', function(){
        var link = $('#evidencia').val().trim();
        $.ajax({
            headers: {'X-CSRF-TOKEN' : "{{csrf_token()}}"},
            type: 'POST',
            url: "formatos.link",
            data: { folio: folio, evidencia: link},
            success: function (response) {
              //window.location.href = "documentacion." + Crypt::encryptString(folio);
              location.reload(true);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
              //alert("Status: " + textStatus); alert("Error: " + errorThrown); 
              if (XMLHttpRequest.status === 422) {
                //alert('Not connect: Verify Network.');
                alert("Aun no capturas el Link");
              } 
            }
          });
      });
      $('[data-toggle="tooltip"]').tooltip({
          trigger: 'hover',
          delay: { "show": 500, "hide": 100 } // Agregar un retraso de 100 milisegundos al ocultar
      });
    }); 
  </script>
@endsection