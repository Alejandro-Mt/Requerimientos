@extends('home')
@section('content')
<link href="{{asset("assets/extra-libs/toastr/dist/build/toastr.min.css")}}" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@if (session('alert'))
  <input class="d-none" id="folio" value={{ session('alert') }}>
  <script>
    $(document).ready(function(){
      toastr.success(
        "N° folio: " + $("#folio").val(),
        "¡Guardado!",                { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 2000 }
      );
    });
  </script>
@endif
<form method="POST" action="" class="mt-5">
  {{ csrf_field() }}
  <h3>Soportes</h3>
  <p>(*) Campos Obligatorios</p>
  <div class="card">
    <div class="card-body wizard-content">
      <h5 class="card-title">Nombre Completo*</h5>
      <p class="card-text">
        <input type="text" class="text-capitalize required form-control @error('descripcion') is-invalid @enderror" name="descripcion" placeholder="Nombre Apellidos" required autofocus>
        @error('descripcion')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
              </span>
        @enderror
      </p>
    </div>
  </div>
  <div class="card">
    <div class="card-body wizard-content">
      <h5 class="card-title">Proyecto*</h5>
      <p class="card-text">
        <select class="form-select @error ('id_cliente') is-invalid @enderror" style="width: 100%; height:36px;" name="id_cliente" tabindex="-1" aria-hidden="true" required autofocus>
          <option value={{null}}>Selección</option>
          @foreach ($cliente as $cliente)
            <option value={{$cliente->id_cliente}}>{{$cliente->nombre_cl}}</option>
          @endforeach 
          @error('id_cliente')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror                          
        </select>
      </p>
    </div>
  </div>
  <div class="card">
    <div class="card-body wizard-content">
      <h5 class="card-title">Localidad*</h5>
      <p class="card-text">
        <select class="form-select @error('id_responsable') is-invalid  @enderror" style="width: 100%; height:36px;" name="id_responsable" tabindex="-1" aria-hidden="true" required autofocus>
          <option value={{null}}>Selección</option>
          @foreach ($responsable as $ejecutivo):
            @if ($ejecutivo ->id_area == 2)
              <option value = {{ $ejecutivo->id_responsable }}>{{$ejecutivo->apellidos}} {{$ejecutivo->nombre_r}}</option>;
            @endif
          @endforeach                     
        </select>
        @error('id_responsable')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </p>
    </div>
  </div>
  <div class="card">
    <div class="card-body wizard-content">
      <h5 class="card-title">Sistema*</h5>
      <p class="card-text">
        <select class="form-select @error ('id_sistema') is-invvalid @enderror" style="width: 100%; height:36px;" name="id_sistema" tabindex="-1" aria-hidden="true" required autofocus>
          <option value={{null}}>Selección</option>
          @foreach ($sistema as $valores):
            <option value={{$valores->id_sistema}}>{{$valores->nombre_s}}</option>;
          @endforeach;  
          @error('id_sistema')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror                        
        </select>
      </p>
    </div>
  </div>
  <div class="card">
    <div class="card-body wizard-content">
      <h5 class="card-title">Sistema Operativo*</h5>
      <p class="card-text">
        <select class="form-select"   style="width: 100%; height:36px;" id="prioridad" tabindex="-1" aria-hidden="true">
          <option data-select2-id="0">Selección</option>
          <option value='1'>ANDROID</option>
          <option value='2'>IOS</option>
          <option value='3'>WINDOWS</option>
          <option value='4'>MAC</option> 
          <option value='5'>Otros:</option>                        
        </select>
        @error('id_responsable')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </p>
    </div>
  </div>
  <div class="card">
    <div class="card-body wizard-content">
      <h5 class="card-title">Usuario (el usuario dependerá del sistema del que reportan)*</h5>
      <p class="card-text">
        <input type="text" class="required form-control @error('descripcion') is-invalid @enderror" name="descripcion" placeholder="Example" required autofocus>
        @error('descripcion')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
              </span>
        @enderror
      </p>
    </div>
  </div>
  <div class="card">
    <div class="card-body wizard-content">
      <h5 class="card-title">LOG-IN / SAP / EMPLEADO</h5>
      <h6 class="card-subtitle mb-2 text-muted">Solo aplica para usuarios MARS</h6>
      <p class="card-text">
        <input type="text" class="required form-control @error('descripcion') is-invalid @enderror" name="descripcion" placeholder="Example" required autofocus>
        @error('descripcion')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
              </span>
        @enderror
      </p>
    </div>
  </div>
  <div class="card">
    <div class="card-body wizard-content">
      <h5 class="card-title">Teléfono de contacto*</h5>
      <div class="row media">
        <div class="col-md-6">
          <h6 class="card-subtitle mb-2 text-muted">A que numero se contactara para seguimiento de folio*</h6>
          <p class="card-text">
            <input type="text" class="required form-control @error('descripcion') is-invalid @enderror" name="descripcion" placeholder="(55)-5555-5555" required autofocus>
            @error('descripcion')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                  </span>
            @enderror
          </p>
        </div>
        <div class="col-md-6">
          <h6 class="card-subtitle mb-2 text-muted">En caso de contar con un número alternativo ingresalo aquí</h6>
          <div class="mb-3 text-center">
            <p class="card-text">
              <input type="text" class="required form-control @error('descripcion') is-invalid @enderror" name="descripcion" placeholder="(55)-5555-5555" required autofocus>
              @error('descripcion')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                    </span>
              @enderror
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-body wizard-content">
      <h5 class="card-title">Correo electrónico del usuario*</h5>
      <p class="card-text">
        <input type="text" class="required form-control @error('descripcion') is-invalid @enderror" name="descripcion" placeholder="nombre@example.mx" required autofocus>
        @error('descripcion')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </p>
    </div>
  </div>
</form>

<h5>*Campos obligatorios</h5>
<script src="{{asset("assets/extra-libs/toastr/dist/build/toastr.min.js")}}"></script>
<script src="{{asset("assets/extra-libs/toastr/toastr-init.js")}}"></script>


@endsection 