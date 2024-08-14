
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
          <!--<a class="text-danger">Una vez autorizado no se podrán cargar nuevos archivos.</a><br>-->

          @if(($registros->estatus->posicion == 6) || ($registros->estatus->posicion == 8 && !$registros->levantamiento->fecha_def))
            <a>Para avanzar debes cargar: <strong>Definición de requerimiento</strong></a><!-- y Flujo de trabajo o Mockup-->
          @elseif($registros->estatus->posicion == 7)
            <a>Recuerda Que debes cargar: <strong>Flujo o Prototipo</strong></a>
          @elseif($registros->estatus->posicion == 8 && $registros->levantamiento->fecha_def)
            <a>Para avanzar debes cargar: <strong>Plan de trabajo</strong></a>
          @elseif($registros->estatus->posicion == 11) 
            <a>Recuerda Que debes cargar: <strong>Matriz de pruebas</strong> y <strong>Acta de validacion</strong></a>
          @elseif($registros->estatus->posicion == 12)
            <a>Recuerda Que debes cargar: <strong>Acta de cierre</strong></a>
          @endif
          <form  class="dropzone" action="{{route('Adjuntos',$registros->folio)}}" method="post" enctype="multipart/form-data" id="myAwesomeDropzone">
          </form> 
        </div>
        <div class="modal-footer">
          @if($registros->estatus->posicion == 12 || $registros->estatus->posicion == 8 || $registros->estatus->posicion == 6)
            <button type="button" class="btn btn-success waves-effect waves-light text-white" data-bs-dismiss="modal">Hecho</button>
          @else
            <a id="modal" type="button" class="btn btn-success waves-effect waves-light text-white" href="{{route('Aut',$registros->folio )}}">Autorizar</a>
            <button type="button" class="btn waves-effect" data-bs-dismiss="modal">Cancelar</button>
          @endif
        </div>
      </div>
    </div>
  </div>

<!-- Autorizacion Flujo -->
<div class="modal" id="Flujo" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header d-flex align-items-center">
        <h4 class="modal-title">
          <strong>Autorización de nuevo flujo</strong>
        </h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <a class="text-danger">Una vez autorizado no se podrán regresar el estatus.</a><br>
      </div>
      <div class="modal-footer">
        <a type="button" class="btn btn-success waves-effect waves-light" href="{{route('R_Flujo',[$registros->folio, 1] )}}">Autorizar</a>
        <a type="button" class="btn btn-danger waves-effect waves-light" href="{{route('R_Flujo',[$registros->folio, 0] )}}">Rechazar</a>
      </div>
    </div>
  </div>
</div>

    <!-- Incluir complemento -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{asset("assets/libs/dropzone/dist/min/dropzone.min.css")}}"/>
    <script src="{{asset("assets/libs/dropzone/dist/min/dropzone.min.js")}}"></script>
    <script>
      var estatus = {{ $registros->estatus->posicion }}; 
      var evidenciaVacia = {{ $registros->def ? 'false' : 'true' }};
      var aut_def = {{ $registros->fecha_def ? 'false' : 'true' }};
      var maxFiles = (estatus === 11  || estatus === 7) ? 2 : 1;
      Dropzone.options.myAwesomeDropzone = {
          headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
          paramName: "adjunto", // Las imágenes se van a usar bajo este nombre de parámetro
          maxFilesize: 150, // Tamaño máximo en MB
          maxFiles: maxFiles,
          addRemoveLinks: true,
          dictRemoveFile: "Remover",
          /*accept: function (file, done) {
            var validFileNames = [];
            var fileNameWithoutExtension = file.name.split('.')[0].toLowerCase(); // Convertir a minúsculas
            var folio = $('#folio').val().trim().toLowerCase(); // Convertir a minúsculas
            // Definir los nombres de archivos válidos según el valor de estatus
            if (estatus == 8) {
                validFileNames = ['matriz de pruebas', 'acta de validación'];
            } else if (estatus == 2) {
                validFileNames = ['acta de cierre'];
            } else if (estatus == 11) {
                validFileNames = ['definición de requerimiento'];//,'flujo de trabajo', 'mockup'];
            }else if (estatus == 9) {
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
          },*/
          removedfile: function (file) {
            var name = file.name;
            // Definir los nombres de archivos válidos según el valor de estatus
            if (estatus == 11) {
              name = ['matriz de pruebas', 'acta de validación'];
            } else if (estatus == 12) {
              name = 'acta de cierre';
            } else if (estatus == 6 || estatus == 7 && aut_def == 'false') {
              name = 'definición de requerimiento';
            }else if (estatus == 7 && aut_def) {
              name = 'plan de trabajo';
            }
            var folio = $('#folio').val();
            $.ajax({
                headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
                type: 'DELETE',
                url: "file.borrar." + name + "." + folio,
            });
            var _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
          },
          /*init: function () {
            this.on("addedfile", function (response) {
              if (estatus === 7 && evidenciaVacia) {
                // Si el estatus es 9 y la evidencia está vacía, habilita el botón "Autorizar"
                document.getElementById('btnAutorizar').removeAttribute('disabled');
              }
            });

            this.on("removedfile", function (file) {
              if (estatus === 7 && evidenciaVacia) {
                // Si el estatus es 9 y la evidencia está vacía, deshabilita el botón "Autorizar" al quitar el archivo
                document.getElementById('btnAutorizar').setAttribute('disabled', 'disabled');
              }
            });
          }*/
      };

      Dropzone.options.General = {
        headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
        paramName: "General", // Las imágenes se van a usar bajo este nombre de parámetro
        maxFilesize: 150, // Tamaño máximo en MB
        maxFiles: maxFiles,
        addRemoveLinks: true,
        dictRemoveFile: "Remover",
        removedfile: function (file) {
          var name = file.name.replace(/\.[^/.]+$/, "");
          var folio = $('#folio').val();
          $.ajax({
              headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
              type: 'DELETE',
              url: "file.borrar." + name + "." + folio,
          });
          var _ref;
          return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
        },
      };

      Dropzone.options.Complemento = {
        headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
        paramName: "Complemento", // Las imágenes se van a usar bajo este nombre de parámetro
        maxFilesize: 150, // Tamaño máximo en MB
        maxFiles: maxFiles,
        addRemoveLinks: true,
        dictRemoveFile: "Remover",
        removedfile: function (file) {
          var name = file.name.replace(/\.[^/.]+$/, "");
          var folio = $('#folio').val();
          $.ajax({
              headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
              type: 'DELETE',
              url: "file.borrar." + name + "." + folio,
          });
          var _ref;
          return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
        },
      };
      $(document).ready(function(){
        $("#reloadButton").click(function(){
          location.reload();
        });
      });
    </script>
  