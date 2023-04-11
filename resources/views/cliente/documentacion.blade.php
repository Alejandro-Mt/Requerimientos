@extends('home')
@section('content')
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        @foreach ($registros as $avance)
          <div class="card-body wizard-content">
            <div class="form-group row">
              <div class="col-md-6">
                <input name="folio" type="text" class="required form-control  @error ('folio') is-invvalid @enderror" readonly="readonly" value="{{$avance->folio}}"> 
              </div>
              <div class="col-md-6">
                <input name="descripcion" type="text" class="required form-control" readonly="readonly" value="{{$avance->descripcion}}">  
              </div>
            </div>
            <div class="progress mt-3">
                <div class="progress-bar progress-bar-striped progress-bar-animated" 
                  @switch($avance->id_estatus)
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
              @switch($avance->id_estatus)
                @case(17)
                  <span>10% Avance</span>
                  @break
                @case(10)
                  <span>20% Avance</span>
                  @break
                @case(16)
                  <span>30% Avance</span>
                  @break
                @case(11)
                  <span>40% Avance</span>
                  @break
                @case(9)
                  <span>50% Avance</span>
                  @break
                @case(7)
                  <span>60% Avance</span>
                  @break
                @case(8)
                  <span>70% Avance</span>
                  @break
                @case(2)
                  <span>80% Avance</span>
                  @break
                @case(12)
                  <span>90% Avance</span>
                  @break
                @default
              @endswitch
              <div class="ms-auto">
                @foreach ($estatus as $e)
                  @if ($e->id_estatus == $avance->id_estatus)
                    <span>{{$e->titulo}}</span>
                  @endif
                @endforeach
              </div>
            </div>
            <!-- Visualizar el estatus en la seccion inf izq -->
          </div>  
        @endforeach
      </div>
      <div class="card">
        <!-- Card -->
        <!-- Start row -->
          <div class="row">
            <div class="col-lg-6">
              <div class="d-flex align-items-stretch">
                <div class="card w-100">
                  <div class="card-body">
                    <h4 class="card-title">Avance</h4>
                    <h6 class="card-subtitle mb-0"></h6>
                  </div>
                  <div>
                    <ul class="feeds ps-0">
                      @foreach ($registros as $registro)
                        @if ($registro->posicion > 1)
                          <div class="feed-item mb-2 py-2 pe-3 ps-4">
                            <div class="border-start border-2 border-info d-md-flex">
                              <div class="d-flex align-items-start">
                                <a class="ms-3 btn btn-light-info text-info btn-circle fs-5 d-flex align-items-center justify-content-center flex-shrink-0">
                                  <i data-feather="bell" class="feather-sm"></i>
                                </a>
                                <div class="ms-3">
                                  <span class="text-dark font-weight-medium">LEVANTAMIENTO</span>
                                  @foreach ($estatus as $limite)
                                    @if(($limite->posicion < 6) and ($limite->posicion != NULL))
                                      <div class="justify-content ms-2 ps-4 ps-md-0 d-md-flex">
                                        <span class="fs-2 text-muted">{{$limite->titulo}}</span>
                                        <div class="justify-content-end ms-5 ms-md-auto ps-4 ps-md-0">
                                          <span class="fs-2 text-muted">
                                            @switch($limite->posicion)
                                              @case(1)
                                                {{date("d/M",strtotime($registro->solicitud))}}
                                                @break
                                              @case(2)
                                                {{date("d/M",strtotime($registro->autorizado))}}
                                                @break
                                              @case(3)
                                                {{date("d/M",strtotime($registro->planteamiento))}}
                                                @break
                                              @default   
                                                {{date("d/M",strtotime($registro->correo))}}
                                                @break  
                                            @endswitch
                                          </span>
                                        </div>
                                      </div>
                                    @endif
                                  @endforeach
                                </div>
                              </div>
                              <div class="justify-content-end ms-5 ms-md-auto ps-4 ps-md-0">
                                <span class="fs-2 text-muted">{{date("d/M",strtotime($registro->solicitud))}}</span>
                              </div>
                            </div>
                          </div>
                        @endif
                        @if ($registro->posicion > 6)
                          <div class="feed-item mb-2 py-2 pe-3 ps-4">
                            <div class="border-start border-2 border-warning d-md-flex">
                              <div class="d-flex align-items-start">
                                <a class="ms-3 btn btn-light-warning text-warning btn-circle fs-5 d-flex align-items-center justify-content-center flex-shrink-0">
                                  <i data-feather="shopping-cart" class="feather-sm"></i>
                                </a>
                                <div class="ms-3">
                                  <span class="text-dark font-weight-medium">CONSTRUCCIÓN</span>
                                  @foreach ($estatus as $limite)
                                    @if(($limite->posicion > 5) and ($limite->posicion < 9) and ($limite->posicion != NULL))
                                      <div class="justify-content ms-2 ps-4 ps-md-0 d-md-flex">
                                        <span class="fs-2 text-muted">{{$limite->titulo}}</span>
                                        <div class="justify-content-end ms-5 ms-md-auto ps-4 ps-md-0">
                                          <span class="fs-2 text-muted">
                                            @switch($limite->posicion)
                                              @case(6)
                                                {{date("d/M",strtotime($registro->planeacion))}}
                                                @break
                                              @case(7)
                                                {{date("d/M",strtotime($registro->analisis))}}
                                                @break
                                              @case(8)
                                                {{date("d/M",strtotime($registro->construccion))}}
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
                              <div class="justify-content-end ms-5 ms-md-auto ps-4 ps-md-0">
                                <span class="fs-2 text-muted">{{date("d/M",strtotime($registro->construccion))}}</span>
                              </div>
                            </div>
                          </div>
                        @endif
                        @if ($registro->posicion > 8)
                          <div class="feed-item mb-2 py-2 pe-3 ps-4">
                            <div class="border-start border-2 border-danger d-md-flex">
                              <div class="d-flex align-items-start">
                                <a class="ms-3 btn btn-light-danger text-danger btn-circle fs-5 d-flex align-items-center justify-content-center flex-shrink-0">
                                  <i data-feather="users" class="feather-sm"></i>
                                </a>
                                <div class="ms-3">
                                  <span class="text-dark font-weight-medium">LIBERACIÓN</span>
                                  @foreach ($estatus as $limite)
                                    @if(($limite->posicion == 9) and ($limite->posicion != NULL))
                                      <div class="justify-content ms-2 ps-4 ps-md-0 d-md-flex">
                                        <span class="fs-2 text-muted">{{$limite->titulo}}</span>
                                        <div class="justify-content-end ms-5 ms-md-auto ps-4 ps-md-0">
                                          <span class="fs-2 text-muted">
                                            {{date("d/M",strtotime($registro->liberacion))}}
                                          </span>
                                        </div>
                                      </div>
                                    @endif
                                  @endforeach
                                </div>
                              </div>
                              <div class="justify-content-end ms-5 ms-md-auto ps-4 ps-md-0">
                                <span class="fs-2 text-muted">{{date("d/M",strtotime($registro->liberacion))}}</span>
                              </div>
                            </div>
                          </div>
                        @endif
                        @if ($registro->posicion > 9)
                          <div class="feed-item mb-2 py-2 pe-3 ps-4">
                            <div class="border-start border-2 border-primary d-md-flex">
                              <div class="d-flex align-items-start">
                                <a class="ms-3 btn btn-light-primary text-primary btn-circle fs-5 d-flex align-items-center justify-content-center flex-shrink-0">
                                  <i data-feather="users" class="feather-sm"></i>
                                </a>
                                <div class="ms-3">
                                  <span class="text-dark font-weight-medium">
                                    EN IMPLEMENTACIÓN
                                  </span>
                                  @foreach ($estatus as $limite)
                                    @if(($limite->posicion == 10) and ($limite->posicion != NULL))
                                      <div class="justify-content ms-2 ps-4 ps-md-0 d-md-flex">
                                        <span class="fs-2 text-muted">{{$limite->titulo}}</span>
                                        <div class="justify-content-end ms-5 ms-md-auto ps-4 ps-md-0">
                                          <span class="fs-2 text-muted">
                                            {{date("d/M",strtotime($registro->implementacion))}}
                                          </span>
                                        </div>
                                      </div>
                                    @endif
                                  @endforeach
                                </div>
                              </div>
                              <div class="justify-content-end ms-5 ms-md-auto ps-4 ps-md-0">
                                <span class="fs-2 text-muted">{{date("d/M",strtotime($registro->implementacion))}}</span>
                              </div>
                            </div>
                          </div>
                        @endif
                      @endforeach
                  </div>
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
    <div class="card">
      <div class="card-body">  
        <div class="row">
          <div class="col-xl-2 col-md-12 col-lg-12 d-flex align-items-center border-bottom">
            <h4 id="upload" class="card-title">
              <span class="lstick d-inline-block align-middle"></span><strong>{{ __('DOCUMENTACIÓN') }}</strong>
            </h4>
          </div>
          <div class="col-md-12">
            @foreach($archivos as $archivo)
              <form id="{{$loop->iteration}}" action="{{route('dfile',pathinfo($archivo->url, PATHINFO_FILENAME))}}" method="POST" enctype="multipart/form-data" id="myAwesomeDropzone">
                    <div class="d-flex align-items-center">
                      <div class="icon"><i class="feather-sm" data-feather="file"></i></div>
                      <h6 class="modal-title col-sm-9"><strong>{{pathinfo($archivo->url, PATHINFO_FILENAME)}}</strong></h6>
                      <button id="download" type="button" class="btn waves-effect waves-light btn-outline-info">
                        <a href="{{asset("$archivo->url")}}"><i class="feather-sm" data-feather="download-cloud"></i></a>
                      </button>
                    </div>
              </form> 
            @endforeach
            @foreach($registros as $format)
              @if($formatos <> 0)
                <div class="d-flex align-items-center">
                  <div class="icon">
                    <i class="feather-sm" data-feather="file"></i>
                  </div> 
                  <h6 class="modal-title col-sm-9"><strong>{{"$format->folio $format->descripcion"}}</strong></h6>
                  <button id="download" type="button" class="btn waves-effect waves-light btn-outline-info">
                    <a href="{{route("Archivo",$format->folio)}}"><i class="feather-sm" data-feather="download-cloud"></i></a>
                  </button>
                </div>
              @endif
            @endforeach  
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection