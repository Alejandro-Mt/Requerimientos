@extends('layouts.app')
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
              <div class="card">
                <div class="card-body">  
                  <div class="row">
                    <div class="col-xl-2 col-md-6 col-lg-10 d-flex align-items-center border-bottom">
                      <h4 id="upload" class="card-title">
                        <span class="lstick d-inline-block align-middle"></span><strong>{{ __('DOCUMENTACIÓN') }}</strong>
                      </h4>
                    </div>
                    <div class="col-md-12">
                      @foreach($archivos as $archivo)
                        <form id="{{$loop->iteration}}" action="{{route('dfile',pathinfo($archivo->url, PATHINFO_FILENAME))}}" method="POST" enctype="multipart/form-data" id="myAwesomeDropzone"> 
                          @switch(pathinfo($archivo->url, PATHINFO_EXTENSION))
                            @case('xlsx')
                              <div class="d-flex align-items-center">
                                <img src="{{asset("assets/images/icons/xls.png")}}" alt="user" width="32" class="shadow col-sm-1"/>  
                                <h6 class="modal-title col-sm-9"><strong>{{pathinfo($archivo->url, PATHINFO_FILENAME)}}</strong></h6>
                                <button id="download" type="button" class="btn waves-effect waves-light btn-outline-info">
                                  <a href="{{asset("$archivo->url")}}"><i class="feather-sm" data-feather="download-cloud"></i></a>
                                </button>
                              </div>
                              @break
                            @case('docx')
                              <div class="d-flex align-items-center">
                                <img src="{{asset("assets/images/icons/doc.png")}}" alt="user" width="32" class="shadow col-sm-1"/> 
                                <h6 class="modal-title col-sm-9"><strong>{{pathinfo($archivo->url, PATHINFO_FILENAME)}}</strong></h6>
                                <button id="download" type="button" class="btn waves-effect waves-light btn-outline-info">
                                  <a href="{{asset("$archivo->url")}}"><i class="feather-sm" data-feather="download-cloud"></i></a>
                                </button>
                              </div>
                              @break
                            @case('txt')
                              <div class="d-flex align-items-center">
                                <img src="{{asset("assets/images/icons/txt.png")}}" alt="user" width="32" class="shadow col-sm-1"/> 
                                <h6 class="modal-title col-sm-9"><strong>{{pathinfo($archivo->url, PATHINFO_FILENAME)}}</strong></h6>
                                <button id="download" type="button" class="btn waves-effect waves-light btn-outline-info">
                                  <a href="{{asset("$archivo->url")}}"><i class="feather-sm" data-feather="download-cloud"></i></a>
                                </button>
                              </div>
                              @break
                            @case('pdf')
                              <div class="d-flex align-items-center">
                                <img src="{{asset("assets/images/icons/pdf.png")}}" alt="user" width="32" class="shadow col-sm-1"/> 
                                <h6 class="modal-title col-sm-9"><strong>{{pathinfo($archivo->url, PATHINFO_FILENAME)}}</strong></h6>
                                <button id="download" type="button" class="btn waves-effect waves-light btn-outline-info">
                                  <a href="{{asset("$archivo->url")}}">
                                    <i class="feather-sm"  href="{{asset("$archivo->url")}}" data-feather="download-cloud"></i>
                                  </a>
                                </button>
                              </div>
                              @break
                            @default
                              <div class="d-flex align-items-center">
                                <img src="{{asset("$archivo->url")}}" alt="user" width="24" class="shadow col-sm-1"/> 
                                <h6 class="modal-title col-sm-9"><strong>{{pathinfo($archivo->url, PATHINFO_FILENAME)}}</strong></h6>
                                <button id="download" type="button" class="btn waves-effect waves-light btn-outline-info">
                                  <a href="{{asset("$archivo->url")}}">
                                    <i class="feather-sm"  href="{{asset("$archivo->url")}}" data-feather="download-cloud"></i>
                                  </a>
                                </button>
                              </div>
                          @endswitch
                        </form> 
                      @endforeach
                      @foreach($registros as $format)
                        @if($formatos <> 0)
                          <div class="d-flex align-items-center">
                            <img src="{{asset("assets/images/icons/pdf.png")}}" alt="user" width="32" class="shadow col-sm-1"/>  
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
  </div>
@endsection