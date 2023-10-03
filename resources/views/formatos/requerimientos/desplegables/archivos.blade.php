
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
          <a class="text-danger">Una vez autorizado no se podrán cargar nuevos archivos.</a><br> 
          @if($registros->id_estatus == 8)
          <a>Recuerda Que debes cargar: <strong>Matriz de pruebas</strong> y <strong>Acta de validacion</strong></a>
          @elseif($registros->id_estatus == 2)
          <a>Recuerda Que debes cargar: <strong>Acta de cierre</strong></a>
          @elseif($registros->id_estatus == 11)
          <a>Para avanzar debes cargar: <strong>Definición de requerimiento</strong></a><!-- y Flujo de trabajo o Mockup-->
          @elseif($registros->id_estatus == 9)
          <a>Para avanzar debes cargar: <strong>Plan de trabajo</strong></a>
          @endif
          <form  class="dropzone" action="{{route('Adjuntos',$registros->folio)}}" method="post" enctype="multipart/form-data" id="myAwesomeDropzone">
          </form> 
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success waves-effect waves-light text-white">
                <a @if($registros->id_estatus == 2 || $registros->id_estatus == 9 || $registros->id_estatus == 11) data-bs-dismiss="modal" @else href="{{route('Aut',$registros->folio)}}" @endif style="color:white"> Autorizar</a>
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
      var id_estatus = {{ $registros->id_estatus }};
      var maxFiles = (id_estatus === 2  || id_estatus === 9) ? 1 : 2;
      Dropzone.options.myAwesomeDropzone = {
          headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
          paramName: "adjunto", // Las imágenes se van a usar bajo este nombre de parámetro
          maxFilesize: 150, // Tamaño máximo en MB
          maxFiles: maxFiles,
          addRemoveLinks: true,
          dictRemoveFile: "Remover",
          accept: function (file, done) {
            var validFileNames = [];
            var fileNameWithoutExtension = file.name.split('.')[0].toLowerCase(); // Convertir a minúsculas
            var folio = $('#folio').val().trim().toLowerCase(); // Convertir a minúsculas
            // Definir los nombres de archivos válidos según el valor de id_estatus
            if (id_estatus == 8) {
                validFileNames = ['matriz de pruebas', 'acta de validación'];
            } else if (id_estatus == 2) {
                validFileNames = ['acta de cierre'];
            } else if (id_estatus == 11) {
                validFileNames = ['definición de requerimiento'];//,'flujo de trabajo', 'mockup'];
            }else if (id_estatus == 9) {
                validFileNames = ['plan de trabajo'];
            }

            // Comprobamos si el nombre del archivo contiene el folio
            if (fileNameWithoutExtension.includes(folio)) {
                // Comprobamos si el nombre del archivo también contiene uno de los nombres válidos (en minúsculas)
                if (validFileNames.some(name => fileNameWithoutExtension.includes(name.toLowerCase()))) {
                    done();
                } else {
                    done("El nombre del archivo debe contener uno de los siguientes: '" + validFileNames.join("', '") + "'");
                }
            } else {
                done("El nombre del archivo debe contener el folio '" + folio + "'");
            }
          },
          removedfile: function (file) {
              var name = file.name;
              $.ajax({
                  headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
                  type: 'DELETE',
                  url: "file.borrar." + name,
              });
              var _ref;
              return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
          }
      };
  </script>
  