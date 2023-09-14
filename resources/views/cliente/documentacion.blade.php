@extends('home')
@section('content')
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body wizard-content">
          <div class="form-group row">
            <div class="col-md-6">
              <input id="folio" name="folio" type="text" class="required form-control  @error ('folio') is-invvalid @enderror" readonly="readonly" value="{{$registros->folio}}"> 
            </div>
            <div class="col-md-6">
              <input name="descripcion" type="text" class="required form-control" readonly="readonly" value="{{$registros->descripcion}}">
            </div>
          </div>
          <div class="progress mt-3">
              <div 
                @if($pausa->pausa == 2) 
                  class="progress-bar progress-bar-striped progress-bar-animated bg-danger" 
                @else 
                  class="progress-bar progress-bar-striped progress-bar-animated bg-cyan" 
                @endif
                @switch($registros->id_estatus)
                    @case(17)
                      style="width:10%"
                      @break
                    @case(10)
                      style="width:20%"
                      @break
                    @case(16)
                      style="width:30%"
                      @break
                    @case(11)
                      style="width:40%"
                      @break
                    @case(9)
                      style="width:50%"
                      @break
                    @case(7)
                      style="width:60%"
                      @break
                    @case(8)
                      style="width:70%"
                      @break
                    @case(2)
                      style="width:80%"
                      @break
                    @case(18)
                      style="width:100%"
                      @break
                    @default
                @endswitch>
              </div>
          </div>
          <div class="d-flex no-block align-items-center">
            <span @if($pausa->pausa == 2) class="text-danger" @endif>
              @switch($registros->id_estatus)
                @case(17)
                  10% 
                  @break
                @case(10)
                  20% 
                  @break
                @case(16)
                  30% 
                  @break
                @case(11)
                  40% 
                  @break
                @case(9)
                  50% 
                  @break
                @case(7)
                  60% 
                  @break
                @case(8)
                  70% 
                  @break
                @case(2)
                  80% 
                  @break
                @case(12)
                  90% 
                  @break
                @default
              @endswitch
              @if($pausa->pausa == 2)Motivo: {{$pausa->motivo}} @else Avance @endif
            </span>

            <div class="ms-auto">
              <strong>Días activo: </strong>{{$registros->activo}}
            </div>

            <div class="ms-auto">
              @foreach ($estatus as $e)
                @if ($e->id_estatus == $registros->id_estatus)
                  @if($pausa->pausa == 2)
                    <span class="text-danger">POSPUESTO</span>
                  @else
                    <span>{{$e->titulo}}</span>
                  @endif
                @endif
              @endforeach
            </div>
          </div>
          <!-- Visualizar el estatus en la seccion inf izq -->
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
                          @switch($registros->posicion)
                            @case(6)
                              @if($registros->fechades == NULL)
                                DESARROLLO
                              @elseif($registros->impacto == 3)
                                DESARROLLO
                              @elseif($registros->impacto == 2)
                              DESARROLLO/PIP
                              @elseif($registros->impacto == 1)
                              PIP
                              @endif
                              @break
                            @case(7)
                              DESARROLLO
                              @break
                            @case(8)
                              DESARROLLO
                              @break
                            @default
                              PIP
                              @break  
                          @endswitch
                        </strong>
                      </a>
                      <a href={{route('Prioridad',Crypt::encrypt($registros->id_sistema))}} class="ms-auto">
                        <i class="" data-feather="corner-down-left"></i>
                      </a>
                    </div>
                    </div>
                    <div >
                      <ul class="feeds ps-0">
                        @if ($registros->posicion > 1)
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
                                        <span class="fs-2 text-muted">{{$limite->titulo}}</span>
                                        <div class="position-absolute end-0">
                                          <span class="fs-2 text-muted">
                                            @switch($limite->posicion)
                                              @case(1)
                                                @if($registros->solicitud <> NULL)
                                                  {{date("d/M/y",strtotime($registros->solicitud))}}
                                                @endif
                                                @break
                                              @case(2)
                                                @if($registros->autorizado <> NULL)
                                                  {{date("d/M/y",strtotime($registros->autorizado))}}
                                                @endif
                                                @break
                                              @case(3)
                                                @if($registros->planteamiento <> NULL)
                                                  {{date("d/M/y",strtotime($registros->planteamiento))}}
                                                @endif
                                                @break
                                              @case(4)
                                                @if($registros->fechaaut <> NULL)
                                                  {{date("d/M/y",strtotime($registros->fechaaut))}}
                                                @endif
                                                @break
                                              @case(5)
                                                @if($registros->fechades <> NULL)
                                                  {{date("d/M/y",strtotime($registros->fechades))}}
                                                @endif
                                                @break
                                              @default   
                                                {{date("d/M/y",strtotime($registros->correo))}}
                                                @break  
                                            @endswitch
                                          </span>
                                        </div>
                                      </div>
                                    @endif
                                  @endforeach
                                </div>
                              </div>
                              <div class="position-absolute start-50">
                                <a class="text-danger">
                                  <strong>{{$registros->lev}} Días</strong> / 
                                  @if($registros->posicion == 1) 1
                                  @elseif($registros->posicion == 2) 2
                                  @elseif($registros->posicion == 3) 3
                                  @elseif($registros->posicion == 4) 4
                                  @elseif($registros->posicion > 4) 5
                                  @endif de 5
                                </a>
                              </div>
                              <div class="position-absolute end-0">
                                @if($registros->posicion > 5)
                                  <span class="fs-2 text-muted">{{date("d/M/y",strtotime($registros->solicitud))}}</span>
                                @endif
                              </div>
                            </div>
                          </div>
                        @endif
                        @if ($registros->posicion > 6)
                          <div class="feed-item mb-2 py-2 pe-3 ps-4">
                            <div class="border-start border-2 border-info d-md-flex">
                              <div class="d-flex align-items-start">
                                <a class="ms-3 btn btn-light-info text-info btn-circle fs-5 d-flex align-items-center justify-content-center flex-shrink-0">
                                  <i data-feather="settings" class="feather-sm"></i>
                                </a>
                                <div class="ms-3">
                                  <span class="text-dark font-weight-medium">CONSTRUCCIÓN</span>
                                  @foreach ($estatus as $limite)
                                    @if(($limite->posicion > 5) and ($limite->posicion < 9) and ($limite->posicion != NULL))
                                      <div class="justify-content ms-2 ps-4 ps-md-0 d-md-flex">
                                        <span class="fs-2 text-muted">{{$limite->titulo}}</span>
                                        <div class="position-absolute end-0">
                                          <span class="fs-2 text-muted">
                                            @switch($limite->posicion)
                                              @case(6)
                                                @if($registros->planeacion <> NULL)
                                                  {{date("d/M/y",strtotime($registros->planeacion))}}
                                                @endif
                                                @break
                                              @case(7)
                                                @if($registros->analisis <> NULL)
                                                  {{date("d/M/y",strtotime($registros->analisis))}}
                                                @endif
                                                @break
                                              @case(8)
                                                @if($registros->construccion <> NULL)
                                                  {{date("d/M/y",strtotime($registros->construccion))}}
                                                @endif
                                                @break
                                              @default 
                                            @endswitch
                                          </span>
                                        </div>
                                      </div>
                                    @endif
                                  @endforeach
                                </div>
                              </div>
                              <div class="position-absolute start-50">
                                <a class="text-info">
                                  <strong>{{$registros->cons}} Días</strong> / 
                                  @if ($registros->posicion == 6) 1 
                                  @elseif($registros->posicion == 7) 2
                                  @elseif($registros->posicion > 7) 3
                                  @endif de 3
                                </a>
                              </div>
                              <div class="position-absolute end-0">
                                @if($registros->posicion > 7)
                                <span class="fs-2 text-muted">{{date("d/M/y",strtotime($registros->construccion))}}</span>
                                @endif
                              </div>
                            </div>
                          </div>
                        @endif
                        @if ($registros->posicion > 8)
                          <div class="feed-item mb-2 py-2 pe-3 ps-4">
                            <div class="border-start border-2 border-success d-md-flex">
                              <div class="d-flex align-items-start">
                                <a class="ms-3 btn btn-light-success text-success btn-circle fs-5 d-flex align-items-center justify-content-center flex-shrink-0">
                                  <i data-feather="check-circle" class="feather-sm"></i>
                                </a>
                                <div class="ms-3">
                                  <span class="text-dark font-weight-medium">LIBERACIÓN</span>
                                  @foreach ($estatus as $limite)
                                    @if(($limite->posicion == 9) and ($limite->posicion != NULL))
                                      <div class="justify-content ms-2 ps-4 ps-md-0 d-md-flex">
                                        <span class="fs-2 text-muted">{{$limite->titulo}}</span>
                                        <div class="position-absolute end-0">
                                          <span class="fs-2 text-muted">
                                            @if($registros->liberacion <> NULL)
                                              {{date("d/M/y",strtotime($registros->liberacion))}}
                                            @endif
                                          </span>
                                        </div>
                                      </div>
                                    @endif
                                  @endforeach
                                </div>
                              </div>
                              <div class="position-absolute start-50">
                                <a class="text-success"><strong>{{$registros->lib}} Días</strong> / @if ($registros->posicion > 9) 1 @else {{$registros->posicion - 9}} @endif de 1</a>
                              </div>
                              <div class="position-absolute end-0">
                                @if($registros->posicion > 9)
                                <span class="fs-2 text-muted">{{date("d/M/y",strtotime($registros->liberacion))}}</span>
                                @endif
                              </div>
                            </div>
                          </div>
                        @endif
                        @if ($registros->posicion > 9)
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
                                    @if(($limite->posicion == 10) and ($limite->posicion != NULL))
                                      <div class="justify-content ms-2 ps-4 ps-md-0 d-md-flex">
                                        <span class="fs-2 text-muted">{{$limite->titulo}}</span>
                                        <div class="position-absolute end-0">
                                          <span class="fs-2 text-muted">
                                            @if($registros->implementacion <> NULL)
                                              {{date("d/M/y",strtotime($registros->implementacion))}}
                                            @endif
                                          </span>
                                        </div>
                                      </div>
                                    @endif
                                  @endforeach
                                </div>
                              </div>
                              <div class="position-absolute start-50">
                                <a class="text-orange"><strong>{{$registros->imp}} Días</strong> / @if ($registros->posicion > 10) 1 @else {{$registros->posicion - 10}} @endif de 1</a>
                              </div>
                              <div class="position-absolute end-0">
                                @if($registros->posicion > 10)
                                <span class="fs-2 text-muted">{{date("d/M/y",strtotime($registros->implementacion))}}</span>
                                @endif
                              </div>
                            </div>
                          </div>
                        @endif
                      </ul>
                    </div>
                    @if(Auth::user()->id_area <> 3)
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
                          @if((Auth::user()->id_puesto == 7 || Auth::user()->id_area == 12) && ($registros->posicion == 7 || $registros->posicion == 8))
                            <a class="justify-content-center btn btn-rounded btn-light-info text-info align-items-center" data-bs-toggle="modal" data-bs-target="#Soporte">
                              <i class="feather-sm" data-feather="edit"></i>
                            </a>
                          @endif  
                        @endif
                      </div>
                      <div class="position-absolute end-0">
                        @if($pausa->pausa == 0) 
                          @switch($registros->id_estatus)
                            @case(17)
                              @if(Auth::user()->id_area == '6' || Auth::user()->id_puesto == '7')
                                <a href="{{route('Formato',Crypt::encrypt($registros->id_registro))}}" id="btn" type="button" class="btn btn-outline-purple">Llenar Solicitud</a>
                              @endif
                            @break
                            @case(10)
                              @if(Auth::user()->id_area == '6' || Auth::user()->id_puesto == '7')
                                <a href="{{route('Enviar',Crypt::encrypt($registros->folio))}}" id="btn" type="button" class="btn btn-outline-purple">Enviar Reporte</a>
                              @endif
                            @break
                            @case(16)
                              @if(Auth::user()->id_area == '6' || Auth::user()->id_puesto == '7')
                                <a href="{{route('Levantamiento',Crypt::encrypt($registros->id_registro))}}" type="button" class="btn btn-outline-cyan">Revisión de Datos</a>
                                @if($registros->fechaaut <> null)
                                  <a href="{{route('Enviar',Crypt::encrypt($registros->folio))}}" id="btn" type="button" class="btn btn-outline-purple">Confirmación</a>
                                @endif
                              @endif
                            @break
                            @case(11)
                              @if($registros->impacto == 1)
                                @if(Auth::user()->id_area == '6' || Auth::user()->id_puesto == '7')
                                  <a href="{{route('Planeacion',Crypt::encrypt($registros->folio))}}" id="btn" type="button" class="btn btn-outline-purple">Planeación</a>
                                @endif
                              @elseif($registros->impacto == 3)
                                @if(Auth::user()->id_area == '12' || Auth::user()->id_puesto == '7')
                                  <a href="{{route('Planeacion',Crypt::encrypt($registros->folio))}}" id="btn" type="button" class="btn btn-outline-purple">Planeación</a>
                                @endif
                              @elseif($registros->impacto == 2)
                                <a href="{{route('Planeacion',Crypt::encrypt($registros->folio))}}" id="btn" type="button" class="btn btn-outline-purple">Planeación</a>
                              @elseif($registros->fechades == NULL)
                                @if(Auth::user()->id_area == '12' || Auth::user()->id_puesto == '7')
                                  <span class="text-dark font-weight-medium">IMPACTO: </span>
                                  <a href={{route('DPrioridad',[$registros->folio,'1'])}} id="btn" type="button" class="btn btn-outline-purple">BAJO</a>
                                  <a href={{route('DPrioridad',[$registros->folio,'2'])}} id="btn" type="button" class="btn btn-outline-purple">MEDIO</a>
                                  <a href={{route('DPrioridad',[$registros->folio,'3'])}} id="btn" type="button" class="btn btn-outline-purple">ALTO</a>
                                @endif
                              @endif
                            @break
                            @case(9)
                              @if(Auth::user()->id_area == '12' || Auth::user()->id_puesto == '7')
                                <a href="{{route('Analisis',Crypt::encrypt($registros->folio))}}" id="btn" type="button" class="btn btn-outline-purple">Plan de trabajo</a>
                              @endif
                            @break
                            @case(7)
                              @if ($registros->fechades == null)
                                <button id="btn" type="button" class="btn btn-outline-purple" data-bs-toggle="modal" data-bs-target="#Auto2">Cargar autorización</button> 
                              @elseif(Auth::user()->id_area == '12' || Auth::user()->id_puesto == '7')
                                <a href="{{route('Construccion',Crypt::encrypt($registros->folio))}}" id="" type="button" class="btn btn-outline-purple">Construcción</a>
                              @endif
                            @break
                            @case(8)
                              @if(Auth::user()->id_area == '6' || Auth::user()->id_puesto == '7')
                                <a href="{{route('Liberacion',Crypt::encrypt($registros->folio))}}" id="btn" type="button" class="btn btn-outline-purple">Liberación</a>
                              @endif
                            @break
                            @case(2)
                              @if(Auth::user()->id_area == '6' || Auth::user()->id_puesto == '7')
                                @if ($registros->evidencia <> 1)
                                  <button id="btn" type="button" class="btn btn-outline-purple" data-bs-toggle="modal" data-bs-target="#Auto2">Cargar autorización</button> 
                                @else
                                  <a href="{{route('Implementacion',Crypt::encrypt($registros->folio))}}" id="btn" type="button" class="btn btn-outline-purple">Implementación</a>
                                @endif
                              @endif
                            @break
                            @case(18)
                          @endswitch
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
                @if ($link != NULL)
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
            @if(Auth::user()->id_area <> 3)
              <div class="col-xl-2 col-md-6 col-lg-2 d-flex align-items-center border-bottom">
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
                <form id="{{$loop->iteration}}" action="{{route('dfile',pathinfo($archivo->url, PATHINFO_FILENAME))}}" method="POST" enctype="multipart/form-data" id="myAwesomeDropzone">
                  <div class="d-flex align-items-center">
                    <div class="icon"><i class="feather-sm" data-feather="file"></i></div>
                    <h6 class="modal-title col-sm-10">
                      <strong>{{pathinfo($archivo->url, PATHINFO_FILENAME)}}</strong>
                    </h6>
                    <a class="btn waves-effect waves-light btn-outline-info col-sm-auto" href="{{asset("$archivo->url")}}">
                      <i class="feather-sm" data-feather="download-cloud"></i>
                    </a>
                    @if(Auth::user()->id_area <> 3)
                      <a id="{{pathinfo($archivo->url, PATHINFO_FILENAME)}}" class="btn waves-effect waves-light btn-outline-danger delete">
                        <i class="feather-sm" data-feather="trash-2"></i>
                      </a>
                    @endif
                  </div>
                </form> 
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
                      @if (Auth::user()->avatar == NULL)
                        <img src="{{asset("assets/images/users/1.jpg")}}" alt="user" width="50" class="rounded-circle"/> 
                      @else
                        <img src="{{asset(Auth::user()->avatar)}}" alt="user" width="50" class="rounded-circle"/>    
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

  <!-- Incluir complemento -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="{{asset("assets/libs/dropzone/dist/min/dropzone.min.css")}}"/>
  <script src="{{asset("assets/libs/dropzone/dist/min/dropzone.min.js")}}"></script>
  <script>
    Dropzone.options.myAwesomeDropzone = {
      headers:{'X-CSRF-TOKEN' : "{{csrf_token()}}"},
      paramName: "adjunto", // Las imágenes se van a usar bajo este nombre de parámetro
      //uploadMultiple: true,
      maxFilesize: 150, // Tamaño máximo en MB
      addRemoveLinks: true,
      dictRemoveFile: "Remover",
      removedfile: function(file) {
        var name = file.name;        
        $.ajax({
          headers: {'X-CSRF-TOKEN' : "{{csrf_token()}}"},
          type: 'DELETE',
          url: "file.borrar." + name,
        });
        var _ref;
        return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
      }
    };
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('.delete').on('click', function(e) {
        e.preventDefault();
        var parent = $(this).parent().parent().attr('id');
        var name = $(this).attr('id');
        var dataString = 'item='+name;
        $.ajax({
          headers:{'X-CSRF-TOKEN' : "{{csrf_token()}}"},
          type: "DELETE",
          url: "file.borrar."+name, 
          success: function(response) {
            $('#'+parent).hide("slow");
          }               
        });
      }); 
      $('.link').on('click', function(){
        var link = $('#evidencia').val();
        var folio = $('#folio').val();
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
    }); 
  </script>
@endsection