@extends('layouts.app')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset("vendor/bootstrap/css/bootstrap.min.css")}}">
    
    
  <!-- -------------------------------------------------------------- -->
  <!-- Container fluid  -->
  <!-- -------------------------------------------------------------- -->
  <div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <div class="card-body little-profile text-center">
                <div class="my-3" data-tilt>
                    <img src="images/img-01.png" alt="IMG">
                </div>
            </div>
        </div>
        <div class="col-lg-4">
          <div class="card">
            <div class="border-bottom title-part-padding">
              <h4 class="card-title mb-0">{{$folio}}</h4>
            </div>
            <div class="card-body">
              <h6 class="card-subtitle mb-3">Cargar archivos</h6>
              <form  class="dropzone" action="{{route('Previsto',$folio)}}" method="post" enctype="multipart/form-data" id="myAwesomeDropzone">
                {{ csrf_field() }}
              </form>
              <button type="button" class="login100-form-btn">
                <a href="{{url('/') }}" style="color:white"> Finalizar</a>
              </button>
            </div>
          </div>
        </div>
    </div>
  </div>
  <script src="{{asset("vendor/tilt/tilt.jquery.min.js")}}"></script>
  <script src="{{asset("vendor/bootstrap/js/bootstrap.min.js")}}"></script>

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
      dictDefaultMessage: "Archivos de muestra",
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
@endsection