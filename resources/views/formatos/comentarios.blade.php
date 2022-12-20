@extends('home')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <div class="card">
      @foreach ($registros as $avance)
        <div class="card-body wizard-content">
          <div class="form-group row">
            <div class="col-md-6">
              <input id="folio" name="folio" type="text" class="required form-control  @error ('folio') is-invvalid @enderror" readonly="readonly" value="{{$avance->folio}}"> 
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
                    <h4 class="card-title">
                      @if ($link != NULL)
                        <a href="{{$link->evidencia}}" class="text-dark">
                          <span class="lstick d-inline-block align-middle"></span>
                          <strong>{{ __('DOCUMENTACIÓN') }}</strong>
                        </a>
                      @else
                        @foreach ($registros as $registro)
                          <a data-bs-toggle="modal" data-bs-target="#link" class="text-dark">
                            <span class="lstick d-inline-block align-middle"></span>
                            <strong>{{ __('DOCUMENTACIÓN') }}</strong>
                          </a>
                        @endforeach
                      @endif
                    </h4>
                  </div>
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
                  </div><!-- BEGIN MODAL LINK -->
                  <div class="modal" id="link">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header d-flex align-items-center">
                          <h4 class="modal-title"><strong>Adjuntar Link</strong></h4>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <div class="form-group row">
                            <label for="evidencia" class="col-sm-2 text-end control-label col-form-label">Link</label>
                              <div class="col-md-8">
                                <input id="evidencia" type="text" class="required form-control @error('evidencia') is-invalid @enderror" 
                                      name="evidencia" placeholder="evidencia" required autofocus>
                                  @error('evidencia')
                                    <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                  @enderror
                              </div>
                          </div>
                          <button type="button" class="btn btn-success waves-effect waves-light text-white link">
                            <i style="color:white"> Actualizar</i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- End Modal -->
                  <!-- BEGIN MODAL -->
                  <div class="modal" id="Adjuntos">
                    <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header d-flex align-items-center">
                            <h4 class="modal-title"><strong>Cargar documentos</strong></h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <form  class="dropzone" action="{{route('Adjuntos',$folio)}}" method="post" enctype="multipart/form-data" id="myAwesomeDropzone"></form> 
                            <button type="submit" class="btn btn-success waves-effect waves-light text-white">
                              <a href="{{route('Avance',$folio)}}" style="color:white"> Actualizar</a>
                            </button>
                          </div>
                        </div>
                    </div>
                  </div>
                  <!-- End Modal -->
                  <div class="col-md-12">
                    @foreach($archivos as $archivo)
                      <form id="{{$loop->iteration}}" action="{{route('dfile',pathinfo($archivo->url, PATHINFO_FILENAME))}}" method="POST" enctype="multipart/form-data" id="myAwesomeDropzone"> 
                        {{csrf_field()}}
                        @method('DELETE')
                        @switch(pathinfo($archivo->url, PATHINFO_EXTENSION))
                          @case('xlsx')
                            <div class="d-flex align-items-center">
                              <img src="{{asset("assets/images/icons/xls.png")}}" alt="user" width="32" class="shadow col-sm-1"/>  
                              <h6 class="modal-title col-sm-9"><strong>{{pathinfo($archivo->url, PATHINFO_FILENAME)}}</strong></h6>
                              <button id="download" type="button" class="btn waves-effect waves-light btn-outline-info">
                                <a href="{{asset("$archivo->url")}}"><i class="feather-sm" data-feather="download-cloud"></i></a>
                              </button>
                              <button id="{{pathinfo($archivo->url, PATHINFO_FILENAME)}}" type="button" class="btn waves-effect waves-light btn-outline-danger delete">
                                <i class="feather-sm" data-feather="trash-2"></i>
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
                              <button id="{{pathinfo($archivo->url, PATHINFO_FILENAME)}}" type="button" class="btn waves-effect waves-light btn-outline-danger delete col-sm-1">
                                <i class="feather-sm" data-feather="trash-2"></i>
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
                              <button id="{{pathinfo($archivo->url, PATHINFO_FILENAME)}}" type="button" class="btn waves-effect waves-light btn-outline-danger delete col-sm-1">
                                <i class="feather-sm" data-feather="trash-2"></i>
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
                              <button id="{{pathinfo($archivo->url, PATHINFO_FILENAME)}}" type="button" class="btn waves-effect waves-light btn-outline-danger delete col-sm-1">
                                <i class="feather-sm" data-feather="trash-2"></i>
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
                              <button id="{{pathinfo($archivo->url, PATHINFO_FILENAME)}}" type="button" class="btn waves-effect waves-light btn-outline-danger delete col-sm-1">
                                <i class="feather-sm" data-feather="trash-2"></i>
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
                <h4 class="card-title border-bottom">
                  <span class="lstick d-inline-block align-middle"></span>Comentarios
                </h4>
                <form class="border-bottom" action="{{route('Comentar')}}" method="POST">
                  {{ csrf_field() }}
                  <div class=""width="500" height="10" style="margin-left:10;">
                      <section class="u-align-left u-border-3 u-border-grey-75 u-clearfix u-white u-section-1" id="carousel_4c76">
                        <input type="text" class="d-none" name="folio" value="{{$avance->folio}}">
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
                            <textarea name="contenido" placeholder="Escribe tu Comentario" class="form-control border-0 required form-control  @error ('contenido') is-invalid @enderror" style="resize: none">{{old('contenido')}}</textarea>
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
              <div class="comment-widgets scrollable mb-2 common-widget" style="height: 450px">
                <!-- Comment Row -->
                @foreach ($comentarios as $comentario)
                  @if($comentario->id_estatus == $avance->id_estatus)
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
                    @if($avance->id_estatus == 16 && $comentario->id_estatus == 10)
                      @include('layouts.comentario')
                    @else
                      @if($avance->id_estatus == 9 || $avance->id_estatus == 7)
                        @if($comentario->id_estatus == 11 || $comentario->id_estatus == 9)
                          @include('layouts.comentario')
                        @endif
                      @else
                        @if ($avance->id_estatus == 18)
                          @include('layouts.comentario')
                        @endif
                      @endif
                    @endif
                  @endif  
                @endforeach
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
            window.location.href = "formatos.comentarios." + folio;
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