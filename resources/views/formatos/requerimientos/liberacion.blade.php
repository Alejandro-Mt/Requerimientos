@extends('home')
@section('content')

  <div class="card">
    <div class="box bg-success text-center">
    <!--<h5 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i></h5>-->
      <h3 class="text-white">LIBERACIÓN</h3>
    </div>
    <div class="card-body wizard-content">
      <!--<h3>Liberación</h3>-->
      <h6 class="card-subtitle"></h6>
      <form method="POST" action="{{route ('Liberar')}}" class="mt-5">
        {{ csrf_field() }}
        <div>
          <section>
            <div class="form-group row">
              <label for="Folio" class="col-sm-2 text-end control-label col-form-label">Folio</label>
              <div class="col-sm-3">
                <input type="text" class="required form-control" name="folio" value="{{$registros->folio}}" readonly="readonly">
              </div>
            </div>
            <!-- Agregar candado de fecha, evitar fechas menores al Fecha entrega real-->
            <div class="form-group row">
              <label for="inicio_p_r" class="col-sm-2 text-end control-label col-form-label">Fecha pase a produccion*</label>
              <div class= 'col-md-8'>
                <div class="input-group">
                  <input name="inicio_p_r" type="text" class="form-control mydatepicker required form-control @error('inicio_p_r') is-invalid @enderror" autocomplete="off"
                    value="{{ $registros->liberacion->inicio_p_r ? date('d-m-20y',strtotime($registros->liberacion->inicio_p_r)) : old('inicio_p_r') }}"  
                    placeholder="DD/MM/AAAA" data-date-format="dd-mm-yyyy">
                  <div class="input-group-append">
                    <span class="input-group-text h-100">
                      <i class="fa fa-calendar"></i>
                    </span>
                  </div>
                  @error('inicio_p_r')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label for="inicio_lib" class="col-sm-2 text-end control-label col-form-label">Fecha pase a produccion efectiva*</label>
              <div class= 'col-md-8'>
                <div class="input-group">
                  <input name="inicio_lib" type="text" class="form-control mydatepicker required form-control @error('inicio_lib') is-invalid @enderror" autocomplete="off"
                    value="{{ $registros->liberacion->inicio_lib ? date('d-m-20y',strtotime($registros->liberacion->inicio_lib)) : old('inicio_lib') }}" 
                    placeholder="DD/MM/AAAA" data-date-format="dd-mm-yyyy">
                  <div class="input-group-append">
                    <span class="input-group-text h-100">
                      <i class="fa fa-calendar"></i>
                    </span>
                  </div>
                  @error('inicio_lib')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
            </div>
            <div class="d-none"> 
              <input id="estatus" type="text" name="estatus" value="Información" visible="false">
            </div>
            <div class="card-body text-center">
              <button id="btnRonda" type="submit" class="btn btn-primary text-white">Ronda</button>
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
    $(document).ready(function() {
      $('#btnRonda').click(function() {
        $('#estatus').val('Ronda');
      });
    });
  </script>
  <script type="text/javascript">
    function showContent() {
      element = document.getElementById("content");
      check = document.getElementById("retraso");
      if (check.checked) {
        element.style.display='block';
      }
      else {
        element.style.display='none';
      }
    }
  </script>

@endsection 