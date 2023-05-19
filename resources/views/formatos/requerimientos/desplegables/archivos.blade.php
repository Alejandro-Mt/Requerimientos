
<!-- Autorizacion 2 -->
<div class="modal" id="Auto2" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header d-flex align-items-center">
          <h4 class="modal-title">
            <strong>Documentos adjuntos</strong>
          </h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <a class="text-danger">Una vez autorizado no se podrán cargar nuevos archivos</a>
          <form  class="dropzone" action="{{route('Adjuntos',$registros->folio)}}" method="post" enctype="multipart/form-data" id="myAwesomeDropzone">
          </form> 
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success waves-effect waves-light text-white">
                <a @if($registros->id_estatus == 2) data-bs-dismiss="modal" @else href="{{route('Aut',$registros->folio)}}" @endif style="color:white"> Autorizar</a>
            </button>
            <button type="button" class="btn waves-effect" data-bs-dismiss="modal"> Cancelar</button>
        </div>
      </div>
    </div>
  </div>

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