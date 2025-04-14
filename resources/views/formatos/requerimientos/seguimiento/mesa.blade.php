@extends('home')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <div class="card">
    <div class="box bg-dark text-center">
      <h5 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i></h5>
      <h3 class="text-white">Reunión de Planificación de Proyecto</h3>
    </div>
    <div class="card-body wizard-content">
      <p>(*) Campos Obligatorios</p>
      <h6 class="card-subtitle"></h6>
      <form method="POST" action="{{route ('NMesa',Crypt::encrypt($data->folio))}}" class="mt-5" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div>
          <section>
            @if ($data->id_estatus == 17)
              <div class="d-none col-sm-3">
                <input type="checkbox" class="required form-control" id="es_alcance" name="es_alcance" value='1' readonly="readonly" checked>
              </div>
            @endif
            <!--<div class="form-group row">
              <label class="col-sm-2 text-end form-check-label" for="es_alcance">Es Alcance</label>
              <div class="col-md-2">
                <input type="checkbox" class="form-check-input" id="es_alcance" name="es_alcance" value='1'>
              </div>
              <label class="col-sm-2 text-end form-check-label" for="emergente">Emergente</label>
              <div class="col-md-2">
                <input type="checkbox" class="form-check-input" id="emergente" name="es_em" value="1">
              </div>
            </div><br>-->
            
            <div class="form-group row">
              <label for="fecha_mesa"class="col-sm-2 text-end control-label col-form-label">Fecha de reunion*</label>
              <div class="col-md-3">
                <input type="datetime-local" class="required form-control @error('fecha_mesa') is-invalid @enderror" name="fecha_mesa" required autofocus>
                @error('fecha_mesa')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div><br>

            <div class="form-group row">
              <label for="objetivo"class="col-sm-2 text-end control-label col-form-label">Objetivo*</label>
              <div class="col-md-8">
                <input type="text" class="required form-control @error('objetivo') is-invalid @enderror" name="objetivo" required autofocus>
                @error('objetivo')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div><br>
            
            <div class="form-group row">
              <label for="minuta"class="col-sm-2 text-end control-label col-form-label">Evidencia</label>
              <div class="col-md-8">
                <input type="file" class="required form-control @error('minuta') is-invalid @enderror" name="minuta" required autofocus>
                @error('minuta')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div><br>
            
            <div class="form-group row">
              <label for="participantes" class="col-sm-2 text-end control-label col-form-label">Participantes</label>
              <div class="col-md-8">
                <select name="participantes[]" class="select2 form-control custom-select form-select shadow-none mt-3" style="width: 100%;" multiple required autofocus>
                  @foreach ($responsables as $responsable)
                    <option value="{{$responsable->id}}">{{$responsable->getFullnameAttribute()}}</option>
                  @endforeach
                </select>
                @error('participantes')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <div class="card-body text-center">
              <button type="submit" class="btn btn-success text-white">Guardar</button>
              <label> </label> 
              <a href="{{route('Documentos',Crypt::encrypt($data->folio))}}" class="btn btn-danger">Cancelar</a>
            </div>
          </section>
        </div>
      </form>
    </div>
  </div>

  <h5>*Campos obligatorios</h5>
  
  <!--style>
    /* mostrar el calendario al hacer click */
    input[type="datetime-local"]::-webkit-calendar-picker-indicator {
        display: initial;
        background: transparent;
        bottom: 0;
        color: transparent;
        cursor: pointer;
        height: auto;
        left: 0;
        position: absolute;
        right: 0;
        top: 0;
        width: auto;
    }
  </style>-->
  <style>
    .select2{
      height: auto;
      overflow-y: auto;
    }
  </style>
  <script>
    // Asegurarse de que el DOM esté cargado antes de ejecutar el código JavaScript
    $(document).ready(function() {
      // Seleccionar el campo de entrada datetime-local
      var datetimeInput = $('input[type="datetime-local"]');
      // Agregar un controlador de eventos para el evento focus
      datetimeInput.focus(function() {
        // Simular un clic en el campo de entrada para abrir el selector
        console.log('El campo datetime-local ha recibido el foco.');
      });
    });
  </script>

@endsection 