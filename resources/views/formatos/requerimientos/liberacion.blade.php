@extends('home')
@section('content')
<link href="{{asset("assets/extra-libs/toastr/dist/build/toastr.min.css")}}" rel="stylesheet" />
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
          <div class="form-group row">
            <label class="col-sm-2 text-end form-check-label" for="complete">Completado</label>
            <div class="col-md-8">
              <input type="checkbox" class="form-check-input" id="id_estatus" name="id_estatus" value="2" data-bs-toggle="modal" data-bs-target="#Auto2">
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
@include('formatos.requerimientos.desplegables.archivos')
@endsection 