@extends('home')
@section('content')

  <div class="card">
    <div class="box bg-success text-center">
    <!--<h5 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i></h5>-->
      <h3 class="text-white">Pruebas Testing</h3>
    </div>
    <div class="card-body wizard-content">
      <!--<h3>Liberación</h3>-->
      <p>(*) Campos Obligatorios</p>
      <h6 class="card-subtitle"></h6>
      <form method="POST" action="{{route ('GPT')}}" class="mt-5">
        {{ csrf_field() }}
        <div>
          <section>
            <div class="form-group row">
              <label for="Folio" class="col-sm-2 text-end control-label col-form-label">Folio</label>
              <div class="col-sm-3">
                <input type="text" class="required form-control" name="folio" value="{{$registros->folio}}" readonly="readonly">
              </div>
            </div>
            <div class="form-group row">
              <label for="fecha_lib_a" class="col-sm-2 text-end control-label col-form-label">Inicio de pruebas*</label>
              <div class= 'col-md-8'>
                <div class="input-group">
                  <input name="fecha_lib_a" type="text" class="form-control mydatepicker required form-control @error('fecha_lib_a') is-invalid @enderror" required autofocus autocomplete="off"
                    value="{{ $registros->liberacion ? ($registros->liberacion->fecha_lib_a ? date('d-m-20y',strtotime($registros->liberacion->fecha_lib_a)) : '') : old('fecha_lib_a') }}"
                    placeholder="DD/MM/AAAA" data-date-format="dd-mm-yyyy">
                  <div class="input-group-append">
                    <span class="input-group-text h-100">
                      <i class="fa fa-calendar"></i>
                    </span>
                  </div>
                  @error('fecha_lib_a')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label for="fecha_lib_r" class="col-sm-2 text-end control-label col-form-label">Fin de pruebas</label>
              <div class= 'col-md-8'>
                <div class="input-group">
                  <input id="finpruebas" name="fecha_lib_r" type="text" class="form-control mydatepicker required form-control @error('fecha_lib_r') is-invalid @enderror" autocomplete="off"
                    value="{{ $registros->liberacion ? ($registros->liberacion->fecha_lib_r ? date('d-m-20y',strtotime($registros->liberacion->fecha_lib_r)) : '') : old('fecha_lib_r') }}"
                    placeholder="DD/MM/AAAA" data-date-format="dd-mm-yyyy">
                  <div class="input-group-append">
                    <span class="input-group-text h-100">
                      <i class="fa fa-calendar"></i>
                    </span>
                  </div>
                  @error('fecha_lib_r')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 text-end form-check-label" for="complete">Completado</label>
              <div class="col-md-8">
                <input type="checkbox" class="form-check-input" id="id_estatus" name="id_estatus" value="7">
              </div>
            </div>
            <div class="card-body text-center">
              <button type="submit" name="id_estatus" value="8" class="btn btn-success text-white">Guardar</button>
              <label> </label> 
              <button type="reset" value="reset" class="btn btn-danger"><a href="{{route('Documentos',Crypt::encrypt($registros->folio))}}" style="color:white">Cancelar</a></button>
            </div>
          </section>
        </div>
      </form>
    </div>
  </div>
  <h5>*Campos obligatorios</h5>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#id_estatus').on('click', function () {
        if ($(this).is(':checked')) {
          $('#id_estatus').val('8');
          $('#finpruebas').attr('required', true);
        } else {
          $('#id_estatus').val('23');
          $('#finpruebas').removeAttr('required');
        }
      });
    });
  </script>

@endsection 