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
    <h3 class="text-white">RONDAS</h3>
  </div>
  <div class="card-body wizard-content">
    <!--<h3>Liberación</h3>-->
    <p>(*) Campos Obligatorios</p>
    <h6 class="card-subtitle"></h6>
    <form id="round" method="POST" action="{{route ('CRonda')}}" class="mt-5">
      {{ csrf_field() }}
      <div>
        <section>
          <div class="form-group row">
            <label for="Folio" class="col-sm-2 text-end control-label col-form-label">Folio</label>
            <div class="col-sm-3">
              <input id="folio" type="text" class="required form-control" name="folio" value="{{$registros->folio}}" readonly="readonly">
            </div>
          </div>
          <div class="form-group row">
            <label for="Ronda" class="col-sm-2 text-end control-label col-form-label">Ronda</label>
            <div class="col-sm-1">
              <input type="text" class="required form-control" name="ronda" value="{{$ronda}}" readonly="readonly">
            </div>
          </div>
          <div class="form-group row">
            <label for="aprobadas" class="col-sm-2 text-end control-label col-form-label">Pruebas acreditadas*</label>
            <div class="col-md-8">
              <input type="number" name="aprobadas" class="required form-control
              @error('aprobadas') is-invalid @enderror"
              placeholder="Pruebas satisfactorias" required autofocus>
              @error('aprobadas')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div><div class="form-group row">
            <label for="rechazadas" class="col-sm-2 text-end control-label col-form-label">Pruebas declinadas*</label>
            <div class="col-md-8">
              <input  id="falla" type="number" name="rechazadas" class="required form-control
              @error('rechazadas') is-invalid @enderror"
              placeholder="Pruebas con errores" required autofocus>
              @error('rechazadas')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
          <div class="card-body text-center">
            @if ($solinf == 0)
              <button type="button" class="btn btn-primary text-white" id="null-data-toast">Guardar</button>
            @else
              <button id="btn" type="button" class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#Auto2">Guardar</button>
            @endif
            <label> </label> 
              <a class="btn btn-danger" href="{{route('Documentos',Crypt::encrypt($registros->folio)) }}">Cancelar</a>
          </div>
        </section>
      </div>
    </form>
  </div>
</div>

<!-- BEGIN MODAL -->
@include('formatos.requerimientos.desplegables.archivos')
<script>
  var miBoton = document.getElementById('btn');
  var input = document.getElementById('falla');
  miBoton.addEventListener('click', function() {
    if (input.value != '0') {
        miBoton.setAttribute('type', 'submit');
        miBoton.removeAttribute('data-bs-toggle');
        miBoton.removeAttribute('data-bs-target');
    }
    if(input.value == '0'){
      //var enlace = document.querySelector('a');
      var enlace = document.getElementById('modal');
      enlace.removeAttribute('href');
      enlace.setAttribute('data-bs-dismiss','modal');
      enlace.addEventListener('click', function() {
        miBoton.removeAttribute('data-bs-toggle');
        miBoton.removeAttribute('data-bs-target');
        miBoton.setAttribute('type', 'submit');
      }); // Hacer algo con el enlace que cumple la condición
    }
  });
</script>
<script src="{{asset("assets/extra-libs/toastr/dist/build/toastr.min.js")}}"></script>
<script src="{{asset("assets/extra-libs/toastr/toastr-init.js")}}"></script>

@endsection 