
<div class="modal fade" id="report-reg"  tabindex="-1" aria-labelledby="report-regLabel">
  <div class="modal-dialog">
    <div class="modal-content">
        <form id="Rprt" action="{{ route('ReqReport') }}" method="POST">
          @csrf
        <div class="modal-header d-flex align-items-center">
          <h4 class="modal-title"><strong>Cargar documentos</strong></h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Responsable -->
          <div class="form-group row">
            <label for="ejecutivo" class="col-sm-3 control-label col-form-label">Responsable</label>
            <div class="col-md-8">
              <select class="select2 form-control custom-select"  name="id_responsable[]" data-dropdown-parent="#report-reg" multiple="multiple">
                @foreach ($UsPIP as $ejecutivo)
                  <option value="{{ $ejecutivo->id }}">
                    {{ $ejecutivo->getFullnameAttribute() }}
                  </option>
                @endforeach                    
              </select>
            </div>
          </div><br>

          <!-- Cliente -->
          <div class="form-group row">
            <label for="Cliente" class="col-sm-3 control-label col-form-label">Cliente</label>
            <div class="col-md-8">
              <select class="select2 form-control custom-select"  name="id_cliente[]" data-dropdown-parent="#report-reg" multiple="multiple">
                @foreach ($cl as $cliente)
                  <option value="{{ $cliente->id_cliente }}">
                    {{ $cliente->nombre_cl }}
                  </option>
                @endforeach                        
              </select>
            </div>
          </div><br>

          <!-- Sistema -->
          <div class="form-group row">
            <label for="Sistema" class="col-sm-3 control-label col-form-label">Sistema</label>
            <div class="col-md-8">
              <select class="select2 form-control custom-select"  name="id_sistema[]" data-dropdown-parent="#report-reg" multiple="multiple">
                @foreach ($s as $valores)
                  <option value="{{ $valores->id_sistema }}">
                    {{ $valores->nombre_s }}
                  </option>
                @endforeach                       
              </select>
            </div>
          </div><br>
          
          <!-- Estado -->
          <div class="form-group row">
            <label for="Estado" class="col-sm-3 control-label col-form-label">Estado</label>
            <div class="col-md-8">
              <select class="select2 form-control custom-select"  name="estado[]" data-dropdown-parent="#report-reg" multiple="multiple">
                <!--<option value="1">Activo</option>
                <option value="2">Pausado</option>
                <option value="3">Implementado</option>
                <option value="4">Cancelado</option>       -->
                @foreach ($status as $est)
                  <option value="{{ $est->id_estatus }}">{{ $est->titulo }}</option>
                @endforeach       
              </select>
            </div>
          </div><br>

          <div class="form-group row">
            <label for="FechaInicio" class="col-sm-3 control-label col-form-label">Fecha Inicio</label>
            <div class="col-md-8">
              <input type="date" class="form-control" name="fecha_inicio" data-dropdown-parent="#report-reg">
            </div>
          </div><br>
          
          <div class="form-group row">
            <label for="FechaFin" class="col-sm-3 control-label col-form-label">Fecha Fin</label>
            <div class="col-md-8">
              <input type="date" class="form-control" name="fecha_fin" data-dropdown-parent="#report-reg">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="button-group">
            <a id="env" class="btn waves-effect waves-light btn-light-success text-success">Aceptar</a>
            <a type="button" class="btn waves-effect waves-light btn-light-danger text-danger" data-bs-dismiss="modal">Cancelar</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<style>
  .custom-select-container {
  min-height: 60px;  /* Altura mínima */
  transition: min-height 0.3s ease;
}
.select2-selection.select2-selection--multiple {
    height: auto !important; /* Asegura que la altura se ajuste al contenido */
    min-height: 38px; /* Puedes ajustar este valor según tus necesidades */
    padding: 6px; /* Ajusta el espaciado interno si es necesario */
}
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    $('#report-reg').on('shown.bs.modal', function (event) {
      $('.custom-select').select2({
        dropdownParent: $('#report-reg .modal-body'),
        closeOnSelect: false,
        placeholder: "Selecciona"
      });

      $('.custom-select').on('select2:select select2:unselect', function (e) {
        var select = $(this);
        var selectedCount = select.select2('data').length;  // Contar cuántos elementos están seleccionados
        var container = select.closest('.form-group.row');

        // Ajustar el contenedor según el número de elementos seleccionados
        if (selectedCount > 0) {
          container.addClass('custom-select-container');
        } else {
          container.removeClass('custom-select-container');
        }
      });

      $('#env').on('click', function (e) {
        $('#report-reg').modal('hide');
        $('#Rprt').submit();  
      });

    });
  });
</script>