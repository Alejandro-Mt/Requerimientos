@extends('home')
@section('content')
<!-- Incluir complemento -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="card">

@if(session('error'))
  <div class="toast show mb-2 text-white bg-light-danger border-0 remove-close-icon " role="alert" aria-live="polite" aria-atomic="true" style="position: absolute; top: 0; right: 50;">
    <div class="d-flex align-items-center">
      <div class="toast-body">
        <div class="d-flex align-items-center text-danger font-weight-medium">
          <i data-feather="info" class="fill-white feather-sm me-2"></i>
          {{ session('error') }}
        </div>
      </div>
      <button type="button" class="btn-close ms-auto me-2 d-flex align-items-center" data-bs-dismiss="toast" aria-label="Close">
        <i data-feather="x" class="feather-sm fill-white text-danger"></i>
      </button>
    </div>
  </div>
@endif
    <div class="card-body wizard-content-center">
        <div class="card-title mb-0">{{ __('Enviar Informe') }}</div>
        <form method="POST" action="{{route('Enviado')}}" enctype="multipart/form-data">
            <div class="form-group row">
                <label for="email" class="col-sm-2 text-end control-label col-form-label">{{ __('Dirección de Correo') }}</label>
                <div class="col-md-6">
                       <!-- <i class="fa fa-envelope"></i>-->
                    <input id="email" type="text" class="required form-control @error('email') is-invalid @enderror" name="email[]" value="{{ old('email') }}" required autocomplete="email" autofocus>                    
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="d-none">
                <input id="folio" type="text" name="folio" value={{$registro->folio}} visible="false">
            </div>
            <div class="d-none">
                @if ($registro->id_estatus == "10" || $registro->id_estatus == "11")
                    <input type="text" name="id_estatus" value="16" visible="false">
                @else
                    <input type="text" name="id_estatus" value="11" visible="false">
                @endif                
            </div>
            <!-- Modal de Confirmacion -->
            <div class="modal" id="confirm" aria-hidden="true">
                {{csrf_field()}}
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"></h4>
                        </div>
                        <div class="modal-body">
                            <label>¿Enviar Correo?</label>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-invert" data-bs-dismiss="modal">Cancelar</a>
                            <button type="submit" class="btn btn-success btn-ok">Confirmar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="row">
            <label for="doc" class="col-sm-2 text-end control-label col-form-label">{{ __('Documentos precargados') }}</label>
            <div class="col-md-6">
                @foreach($archivos as $archivo)
                    <form id="{{$loop->iteration}}" action="{{route('dfile',pathinfo($archivo->url, PATHINFO_FILENAME))}}" method="POST" enctype="multipart/form-data" id="myAwesomeDropzone"> 
                        {{csrf_field()}}
                        @method('DELETE')
                        @switch(pathinfo($archivo->url, PATHINFO_EXTENSION))
                            @case('xlsx')
                                <div class="d-flex align-items-center">
                                    <img src="{{asset("assets/images/icons/xls.png")}}" alt="user" width="24" class="shadow col-sm-1"/>  
                                    <h6 class="modal-title col-sm-9"><strong>{{pathinfo($archivo->url, PATHINFO_FILENAME)}}</strong></h6>
                                    <button id="{{pathinfo($archivo->url, PATHINFO_FILENAME)}}" type="button" class="btn waves-effect waves-light btn-outline-danger delete col-sm-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 feather-sm fill-white"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                    </button>
                                </div>
                                @break
                            @case('docx')
                                <div class="d-flex align-items-center">
                                    <img src="{{asset("assets/images/icons/doc.png")}}" alt="user" width="32" class="shadow col-sm-1"/> 
                                    <h6 class="modal-title col-sm-9"><strong>{{pathinfo($archivo->url, PATHINFO_FILENAME)}}</strong></h6>
                                    <button id="{{pathinfo($archivo->url, PATHINFO_FILENAME)}}" type="button" class="btn waves-effect waves-light btn-outline-danger delete col-sm-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 feather-sm fill-white"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                    </button>
                                </div>
                                @break
                            @case('txt')
                                <div class="d-flex align-items-center">
                                    <img src="{{asset("assets/images/icons/txt.png")}}" alt="user" width="32" class="shadow col-sm-1"/> 
                                    <h6 class="modal-title col-sm-9"><strong>{{pathinfo($archivo->url, PATHINFO_FILENAME)}}</strong></h6>
                                    <button id="{{pathinfo($archivo->url, PATHINFO_FILENAME)}}" type="button" class="btn waves-effect waves-light btn-outline-danger delete col-sm-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 feather-sm fill-white"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                    </button>
                                </div>
                                @break
                            @case('pdf')
                                <div class="d-flex align-items-center">
                                    <img src="{{asset("assets/images/icons/pdf.png")}}" alt="user" width="32" class="shadow col-sm-1"/> 
                                    <h6 class="modal-title col-sm-9"><strong>{{pathinfo($archivo->url, PATHINFO_FILENAME)}}</strong></h6>
                                    <button id="{{pathinfo($archivo->url, PATHINFO_FILENAME)}}" type="button" class="btn waves-effect waves-light btn-outline-danger delete col-sm-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 feather-sm fill-white"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                    </button>
                                </div>
                                @break
                            @default
                                <div class="d-flex align-items-center">
                                    <img src="{{asset("$archivo->url")}}" alt="user" width="24" class="shadow col-sm-1"/> 
                                    <h6 class="modal-title col-sm-9"><strong>{{pathinfo($archivo->url, PATHINFO_FILENAME)}}</strong></h6>
                                    <button id="{{pathinfo($archivo->url, PATHINFO_FILENAME)}}" type="button" class="btn waves-effect waves-light btn-outline-danger delete col-sm-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 feather-sm fill-white"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                    </button>
                                </div>
                        @endswitch
                    </form>   
                @endforeach
            </div>
        </div>
        <div class="row">
            <label for="doc" class="col-sm-2 text-end control-label col-form-label">{{ __('Documentos adjuntos') }}</label>
            <div class="col-md-6">
                    <form  class="dropzone" action="{{route('Adjuntos',Crypt::decrypt($folio))}}" method="post" enctype="multipart/form-data" id="myAwesomeDropzone">
                    </form>   
            </div>
        </div>
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button class="btn-success text-white" id="alerta" data-bs-toggle="modal" data-bs-target="#confirm">
                    {{ __('Enviar Correo de Informe') }}
                </button>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" type="text/css" href="{{asset("assets/libs/dropzone/dist/min/dropzone.min.css")}}"/>
<script src="{{asset("assets/libs/dropzone/dist/min/dropzone.min.js")}}"></script>
<script>
    Dropzone.options.myAwesomeDropzone = {
        headers:{'X-CSRF-TOKEN' : "{{csrf_token()}}"},
        paramName: "adjunto", // Las imágenes se van a usar bajo este nombre de parámetro
        //uploadMultiple: true,
        maxFilesize: 150, // Tamaño máximo en MB
        maxFiles: 1,
        addRemoveLinks: true,
        dictRemoveFile: "Remover",
        accept: function(file, done) {
            var id_estatus = {{ $registro->id_estatus }};
            var validFileNames = ['gantt'];
            var fileNameWithoutExtension = file.name.split('.')[0].toLowerCase();
            var folio = $('#folio').val().trim().toLowerCase();
            if (id_estatus === 10) {
                if (fileNameWithoutExtension.includes(folio)) {
                    // Comprobamos si el nombre del archivo también contiene uno de los nombres válidos
                    if (validFileNames.some(name => fileNameWithoutExtension.includes(name))) {
                        done();
                    } else {
                        done("El nombre del archivo debe contener: '" + validFileNames.join("', '") + "'");
                    }
                } else {
                    done("El nombre del archivo debe contener el folio '" + folio + "'");
                }
            }else{ done();}
        },
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
    });    
</script>

@endsection

