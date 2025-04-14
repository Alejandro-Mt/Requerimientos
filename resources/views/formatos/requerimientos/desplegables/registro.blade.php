
<!-- /Add Company -->
<div id="registro-modal" class="modal fade" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-lg">
    <div class="modal-content">
      <div class="modal-body">
        <div class="card">
          <div class="box bg-dark text-center">
            <h3 class="text-white">REQUERIMIENTO</h3>
          </div>
          <div class="card-body wizard-content">
            <p>(*) Campos Obligatorios</p>
            <h6 class="card-subtitle"></h6>
            <form method="POST" action="{{ route('EditReq', ['folio' => $registros->folio]) }}" class="mt-5">
              {{ csrf_field() }}
              <div>
                <section>
                  <div class="form-group row">
                    <label class="col-sm-2 text-end form-check-label" for="proyecto">Es proyecto</label>
                    <div class="col-md-2">
                      <input type="checkbox" class="form-check-input" id="proyecto" name="es_pr" value="1" onchange="showContent()">
                    </div>
                    <label class="col-sm-2 text-end form-check-label" for="emergente">Emergente</label>
                    <div class="col-md-2">
                      <input type="checkbox" class="form-check-input" id="emergente" name="es_em" value="1">
                    </div>
                  </div><br>
                  <div class="form-group row">
                    <label for="descripcion" class="col-sm-2 text-end control-label col-form-label">Descripción*</label>
                    <div class="col-md-8">
                      <input maxlength="250" type="text" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" required autofocus value="{{$registros->descripcion}}">
                      @error('descripcion')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div><br>
                  <div class="form-group row">
                    <label for="ejecutivo" class="col-sm-2 text-end control-label col-form-label">Responsable</label>
                    <div class="col-md-8">
                      <select class="select2 form-control custom-select @error('id_responsable') is-invalid @enderror" style="width: 100%; height:36px;" name="id_responsable" required autofocus data-dropdown-parent="#registro-modal">
                        @foreach ($responsable as $ejecutivo)
                          @if ($ejecutivo->usrdata && $ejecutivo->usrdata->id_area == 2)
                            <option value="{{ $ejecutivo->id }}" 
                              {{ (old('id_responsable', $registros->id_responsable) == $ejecutivo->id) ? 'selected' : '' }}>
                              {{ $ejecutivo->getFullnameAttribute() }}
                            </option>
                          @endif
                        @endforeach                    
                      </select>
                      @error('id_responsable')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div><br>
                  <div class="form-group row">
                    <label for="Sistema" class="col-sm-2 text-end control-label col-form-label">Sistema*</label>
                    <div class="col-md-8">
                      <select class="select2 form-control custom-select @error ('id_sistema') is-invvalid @enderror" style="width: 100%; height:36px;" name="id_sistema" required autofocus data-dropdown-parent="#registro-modal">
                        @foreach ($sistema as $valores)
                          <option value="{{ $valores->id_sistema }}" 
                            {{ (old('id_sistema', $registros->id_sistema) == $valores->id_sistema) ? 'selected' : '' }}>
                            {{ $valores->nombre_s }}
                          </option>
                        @endforeach
                        @error('id_sistema')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror                        
                      </select>
                    </div>
                  </div><br>
                  <div class="form-group row">
                    <label for="Cliente" class="col-sm-2 text-end control-label col-form-label">Cliente*</label>
                    <div class="col-md-8">
                      <select class="select2 form-control custom-select @error ('id_cliente') is-invalid @enderror" style="width: 100%; height:36px;" name="id_cliente" required autofocus data-dropdown-parent="#registro-modal">
                        @foreach ($cliente as $cliente)
                          <option value="{{ $cliente->id_cliente }}" 
                            {{ (old('id_cliente', $registros->id_cliente) == $cliente->id_cliente) ? 'selected' : '' }}>
                            {{ $cliente->nombre_cl }}
                          </option>
                        @endforeach
                        @error('id_cliente')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror                          
                      </select>
                    </div>
                  </div><br>
                  <div class="form-group row">
                    <label for="Arquitecto" class="col-sm-2 text-end control-label col-form-label">Arquitecto*</label>
                    <div class="col-md-8">  
                      <select class="select2 form-control custom-select @error('id_arquitecto') is-invalid @enderror" style="width: 100%; height:36px;" name="id_arquitecto" required autofocus data-dropdown-parent="#registro-modal">
                        @foreach ($responsable as $arquitecto)
                          @if ($arquitecto->usrdata && $arquitecto->usrdata->id_area == 12)
                            <option value="{{ $arquitecto->id }}" 
                              {{ (old('id_arquitecto', $registros->id_arquitecto) == $arquitecto->id) ? 'selected' : '' }}>
                              {{ $arquitecto->getFullnameAttribute() }}
                            </option>
                          @endif
                        @endforeach                     
                      </select>
                      @error('id_arquitecto')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div><br>
                  <div id="content">
                    <div class="form-group row">
                      <label for="folio_pr" class="col-sm-2 text-end control-label col-form-label">Proyecto</label>
                      <div class="col-md-8">
                        <select class="select2 form-control custom-select @error('folio_pr') is-invalid @enderror" style="width: 100%; height:36px;" name="folio_pr" aria-hidden="true"  data-dropdown-parent="#registro-modal">
                          <option value={{null}}>Selección</option>
                          @foreach ($proyectos as $proyecto):
                            <option value = {{ $proyecto->folio }}>{{$proyecto->descripcion}}</option>;
                          @endforeach
                          @foreach ($proyectos as $proyecto)
                            <option value="{{ $proyecto->folio }}" 
                              {{ (old('id_cliente', $registros->folio_pr) == $proyecto->folio) ? 'selected' : '' }}>
                              {{ $proyecto->descripcion }}
                            </option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="card-body text-center">
                    <button type="submit" class="btn btn-success text-white">Actualizar</button>
                  </div>
                </section>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script>
  $(document).ready(function() {
    $('#registro-modal').on('shown.bs.modal', function (event) {
      $('.custom-select').select2({
        dropdownParent: $('#registro-modal .modal-body')
      });
    });
  });

  function showContent() {
    element = document.getElementById("content");
    check = document.getElementById("proyecto");
    if (check.checked) {
      element.style.display='none'
    }
    else {
      element.style.display='block'
    }
  }
</script>