
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
      removedfile: function (file) {
        // Verificar si el archivo tiene un ID asociado
        if (!file.id) {
          console.error("El archivo no tiene un ID asociado. No se puede eliminar.");
          return;
        }

        // Realizar la solicitud AJAX para eliminar el archivo
        $.ajax({
          headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
          type: 'DELETE',
          url: `file.borrar.${file.id}`, // Ajusta esta ruta si es necesario
          success: function (response) {
            console.log("Archivo eliminado correctamente:", response);
          },
          error: function (xhr, status, error) {
            console.error("Error al eliminar el archivo:", error);
          }
        });

        // Remover el elemento visualmente
        var _ref;
        return (_ref = file.previewElement) != null 
          ? _ref.parentNode.removeChild(file.previewElement) 
          : void 0;
      },
      init: function () {
        this.on("success", function (file, response) {
          // Asocia el ID del archivo devuelto por el backend
          if (response.id) {
            file.id = response.id;
          } else {
            console.error("No se recibió un ID para el archivo subido.");
          }
        });
      }
    };

    Dropzone.options.General = {
      headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
      paramName: "General", // Las imágenes se van a usar bajo este nombre de parámetro
      maxFilesize: 150, // Tamaño máximo en MB
      maxFiles: maxFiles,
      addRemoveLinks: true,
      dictRemoveFile: "Remover",
      removedfile: function (file) {
        // Verificar si el archivo tiene un ID asociado
        if (!file.id) {
          console.error("El archivo no tiene un ID asociado. No se puede eliminar.");
          return;
        }

        // Realizar la solicitud AJAX para eliminar el archivo
        $.ajax({
          headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
          type: 'DELETE',
          url: `file.borrar.${file.id}`, // Ajusta esta ruta si es necesario
          success: function (response) {
            console.log("Archivo eliminado correctamente:", response);
          },
          error: function (xhr, status, error) {
            console.error("Error al eliminar el archivo:", error);
          }
        });

        // Remover el elemento visualmente
        var _ref;
        return (_ref = file.previewElement) != null 
          ? _ref.parentNode.removeChild(file.previewElement) 
          : void 0;
      },
      init: function () {
        this.on("success", function (file, response) {
          // Asocia el ID del archivo devuelto por el backend
          if (response.id) {
            file.id = response.id;
          } else {
            console.error("No se recibió un ID para el archivo subido.");
          }
        });
      }
    };

    Dropzone.options.Complemento = {
      headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
      paramName: "Complemento", // Las imágenes se van a usar bajo este nombre de parámetro
      maxFilesize: 150, // Tamaño máximo en MB
      maxFiles: maxFiles,
      addRemoveLinks: true,
      dictRemoveFile: "Remover",
      removedfile: function (file) {
        // Verificar si el archivo tiene un ID asociado
        if (!file.id) {
          console.error("El archivo no tiene un ID asociado. No se puede eliminar.");
          return;
        }

        // Realizar la solicitud AJAX para eliminar el archivo
        $.ajax({
          headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
          type: 'DELETE',
          url: `file.borrar.${file.id}`, // Ajusta esta ruta si es necesario
          success: function (response) {
            console.log("Archivo eliminado correctamente:", response);
          },
          error: function (xhr, status, error) {
            console.error("Error al eliminar el archivo:", error);
          }
        });

        // Remover el elemento visualmente
        var _ref;
        return (_ref = file.previewElement) != null 
          ? _ref.parentNode.removeChild(file.previewElement) 
          : void 0;
      },
      init: function () {
        this.on("success", function (file, response) {
          // Asocia el ID del archivo devuelto por el backend
          if (response.id) {
            file.id = response.id;
          } else {
            console.error("No se recibió un ID para el archivo subido.");
          }
        });
      }
    };
    $(document).ready(function(){
      $("#reloadButton").click(function(){
        location.reload();
      });
    });
  </script>
  <!--<script>
    $(document).ready(function () {
      // Variables iniciales
      var estatus = {{ $registros->estatus->posicion }};
      var evidenciaVacia = {{ $registros->def ? 'false' : 'true' }};
      var aut_def = {{ $registros->fecha_def ? 'false' : 'true' }};
      var maxFiles = (estatus === 11 || estatus === 7) ? 2 : 1;
  
      // Función para inicializar Dropzone con configuraciones estándar
      function initializeDropzone(selector, paramName) {
        Dropzone.options[selector] = {
          headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
          paramName: paramName, // Parámetro personalizado
          maxFilesize: 150, // Tamaño máximo en MB
          maxFiles: maxFiles,
          addRemoveLinks: true,
          dictRemoveFile: "Remover",
          removedfile: function (file) {
            if (!file.id) {
              console.error("El archivo no tiene un ID asociado. No se puede eliminar.");
              return;
            }
  
            // Realizar la solicitud AJAX para eliminar el archivo
            $.ajax({
              headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
              type: 'DELETE',
              url: `file.borrar.${file.id}`, // Ajusta esta ruta si es necesario
              success: function (response) {
                console.log("Archivo eliminado correctamente:", response);
              },
              error: function (xhr, status, error) {
                console.error("Error al eliminar el archivo:", error);
              }
            });
  
            // Remover el elemento visualmente
            var _ref;
            return (_ref = file.previewElement) != null
              ? _ref.parentNode.removeChild(file.previewElement)
              : void 0;
          },
          init: function () {
            this.on("success", function (file, response) {
              // Asocia el ID del archivo devuelto por el backend
              if (response.id) {
                file.id = response.id;
              } else {
                console.error("No se recibió un ID para el archivo subido.");
              }
            });
          }
        };
      }
  
      // Inicializar Dropzone para los diferentes casos
      initializeDropzone('myAwesomeDropzone', 'adjunto');
      initializeDropzone('General', 'General');
      initializeDropzone('Complemento', 'Complemento');
  
      // Botón para recargar la página
      $("#reloadButton").click(function () {
        location.reload();
      });
    });
  </script>-->
  