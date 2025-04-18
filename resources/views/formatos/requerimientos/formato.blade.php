@extends('home')
@section('content')
<link href="{{asset("assets/extra-libs/toastr/dist/build/toastr.min.css")}}" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="card">
  <div class="box bg-danger text-center">
    <h3 class="text-white">LEVANTAMIENTO</h3>
  </div>
  <div class="card-body wizard-content">
    <form method="POST" action="{{route ('Guardar')}}" class="mt-5">
      {{ csrf_field() }}
      <div>
        <h3>Formato de Solicitud</h3>
        <section>
          <p>(*) Campos Obligatorios</p>
          <div class="form-group row">
            <label for="folio" class="col-sm-2 text-end control-label col-form-label">Folio/ID</label>
            <div class="col-md-3">
              <input name="folio" type="text" class="required form-control  @error ('folio') is-invalid @enderror" value={{$registros->folio}} readonly="readonly">
            </div>
          </div>
          <div class="form-group row">
            <label for="id_solicitante" class="col-sm-2 text-end control-label col-form-label">Solicitante*</label>
            <div class="col-md-8">
              <select class="select2 form-control custom-select @error('id_solicitante') is-invalid @enderror" style="width: 100%; height:36px;" name="id_solicitante" required autofocus>
                @if($registros->solicitud)
                  <option value={{$registros->solicitud->usuario->id}}>{{ $registros->solicitud->usuario->getFullnameAttribute() }}</option>
                @else
                  <option value={{NULL}}>Selección</option>
                @endif
                @foreach ($responsables as $solicitante):
                  <option value={{$solicitante->id}} {{old('id_solicitante')==$solicitante->id ? 'selected' : ''}}>{{ $solicitante->getFullnameAttribute() }}</option>
                @endforeach                     
              </select>
              @error('id_solicitante')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
          <div class="form-group row">
            <label for="departamento" class="col-sm-2 text-end control-label col-form-label">Departamento</label>
            <div class="col-md-8">  
              <select class="select2 form-control custom-select @error('departamento') is-invalid @enderror" style="width: 100%; height:36px;" name="departamento" tabindex="-1" aria-hidden="true" required autofocus>
                <option value={{null}}>Seleccion</option>
                @foreach ($departamentos as $departamento):
                  <option value="{{$departamento->id}}" {{old('departamento')==$departamento->id ? 'selected' : ''}}>{{$departamento->departamento}}</option>
                @endforeach                     
              </select>
              @error('departamento')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
          <div class="form-group row">
            <label for="autorizacion" class="col-sm-2 text-end control-label col-form-label">Autorizo</label>
            <div class="col-md-8">
              <select class="select2 form-control custom-select @error ('autorizacion') is-invalid @enderror"  style="width: 100%; height:36px;" name="autorizacion" required autofocus>
                <option value={{null}}>Seleccion</option>
                @foreach ($responsables as $autoriza)
                  @if ($autoriza->usrdata && $autoriza->usrdata->id_area == 6)
                    <option value="{{$autoriza->usrdata->id_user}}" {{old('autorizacion')==$autoriza->usrdata->id_user ? 'selected' : ''}}>{{$autoriza->getFullnameAttribute()}}</option>
                  @endif                            
                @endforeach; 
                @error('autorizacion')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror                        
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="previo" class="col-sm-2 text-end control-label col-form-label">¿Existe previo?</label>
            <div class="col-md-8">
              <input type="radio" value="1" {{old('previo')==1 ? 'checked' : ''}} class="form-check-input" id="customControlValidation1" name="previo" required>
              <label class="form-check-label mb-0" for="customControlValidation1">Si</label>
              <input type="radio"  value="0" {{old('previo')==0 ? 'checked' : ''}} class="form-check-input" id="customControlValidation2" name="previo" required>
              <label class="form-check-label mb-0" for="customControlValidation1">No</label>
            </div>
            @error('previo')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
          <div class="form-group row">
            <label for="problema" class="col-sm-2 text-end control-label col-form-label">Descripcion del Problema*</label>
            <div class="col-md-8">
              <div class="input-group">
                <input id="problema" name="problema" type="text" class="required form-control @error ('problema') is-invalid @enderror" value="{{old('problema')}}" placeholder="Se detallado" required autofocus>
                @error('problema')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <small class="text-muted" id="charCount">0/250 caracteres</small>
            </div>
          </div>
          <div class="form-group row">
            <label for="prioridad" class="col-sm-2 text-end control-label col-form-label">Impacto en la Operacion*</label>
            <div class="col-md-8">
              <select name="prioridad" class="select2 form-control custom-select @error ('prioridad') is-invalid @enderror" style="height: 36px;width: 100%;" required autofocus>
                <option value={{null}}>Seleccion</option>
                <option value='1' {{old('prioridad')==1 ? 'selected' : ''}}>Baja</option>
                <option value='2' {{old('prioridad')==2 ? 'selected' : ''}}>Media</option>
                <option value='3' {{old('prioridad')==3 ? 'selected' : ''}}>Alta</option>
                <option value='4' {{old('prioridad')==4 ? 'selected' : ''}}>Critica</option>                         
              </select>
              @error('prioridad')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
          <div class="form-group row">
            <label for="general" class="col-sm-2 text-end control-label col-form-label">Descripcion General del Requerimiento*</label>
            <div class="col-md-8">
              <textarea name="general" type="text" class="required form-control  @error ('general') is-invalid @enderror" value="" placeholder="Se breve" required autofocus>{{old('general')}}</textarea>
              @error('general')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
          <div class="form-group row">
            <label for="detalle" class="col-sm-2 text-end control-label col-form-label">Descripcion Especifica del Requerimiento*</label>
            <div class="col-md-8">
              <textarea name="detalle" type="text" class="required form-control @error ('detalle') is-invalid @enderror" value="" placeholder="Se detallado" required autofocus>{{old('detalle')}}</textarea>
              @error('detalle')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
          <div class="form-group row">
            <label for="esperado" class="col-sm-2 text-end control-label col-form-label">Resultado Esperado*</label>
            <div class="col-md-8">
              <textarea name="esperado" type="text" class="required form-control @error ('esperado') is-invalid @enderror" value="" placeholder="Que es lo que se espera" required autofocus>{{old('esperado')}}</textarea>
              @error('esperado')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
          <div class="form-group row">
            <label for="involucrados" class="col-sm-2 text-end control-label col-form-label">Personas Involucradas</label>
            <div class="col-md-8">
              <select name="involucrados[]" class="select2 form-control custom-select mt-3 select2-hidden-accessible" multiple="multiple" style="height: 36px;width: 100%;" required autofocus>
                @foreach ($responsables as $responsable)
                  <option value="{{$responsable->id}}" {{ (collect(old('involucrados'))->contains($responsable->id)) ? 'selected':'' }}>{{$responsable->getFullnameAttribute()}}</option>
                @endforeach
                @error('involucrados[]')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="relaciones" class="col-sm-2 text-end control-label col-form-label">Relación con Otros Sistemas</label>
            <div class="col-md-8">
              <select name="relaciones[]" class="select2 form-control custom-select shadow-none mt-3 select2-hidden-accessible" multiple="multiple" style="height: 36px;width: 100%;" required autofocus>
                @foreach ($sistemas as $sistema)
                  <option value="{{$sistema->id_sistema}}" {{ (collect(old('relaciones'))->contains($sistema->id_sistema)) ? 'selected':'' }}>{{$sistema->nombre_s}}</option>
                @endforeach
                @error('relaciones')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="areas" class="col-sm-2 text-end control-label col-form-label">Relación con Otras Áreas</label>
            <div class="col-md-8">
              <select name="areas[]" class="select2 form-control custom-select shadow-none mt-3 select2-hidden-accessible" multiple="multiple" style="height: 36px;width: 100%;" required autofocus>
                @foreach ($areas as $area)
                  <option value="{{$area->id_area}}" {{ (collect(old('areas'))->contains($area->id_area)) ? 'selected':'' }}>{{$area->area}}</option>
                @endforeach
                @error('areas')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </select>
            </div>
          </div>
          <div class="d-none"> 
            <input type="text" name="id_estatus" value="10" visible="false">
          </div>
          <div class="card-body text-center">
            <button type="submit" class="btn btn-success text-white">Guardar</button>
            <label> </label> 
            <button type="reset" value="reset" class="btn btn-danger"><a href="{{route('Documentos',Crypt::encrypt($registros->folio)) }}" style="color:white">Cancelar</a></button>
          </div>
        </section>
      </div>
    </form>
  </div>
</div>

<form class="form-horizontal" action="" method="post">
<h5>*Campos obligatorios</h5>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- This Page CSS -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.css"/>
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.js"></script>
<script>
  // Configuración para el contador de caracteres
  var maxLength = 250;
  $('#problema').keyup(function() {
    var length = $(this).val().length;
    var remainingChars = maxLength - length;
    $('#charCount').text(length + '/' + maxLength + ' caracteres');
    
    // Cambiar el color a rojo si se alcanza el límite
    if (length >= maxLength) {
      $('#charCount').removeClass('text-muted').addClass('text-danger');
      // Si deseas deshabilitar la entrada después de alcanzar el límite, puedes usar:
      $(this).attr('maxlength', length);
    } else {
      // Restaurar el color predeterminado si no se alcanza el límite
      $('#charCount').removeClass('text-danger').addClass('text-muted'); // Color predeterminado de texto
    }
  });
</script> 
<script src="{{asset("assets/extra-libs/toastr/dist/build/toastr.min.js")}}"></script>
<script src="{{asset("assets/extra-libs/toastr/toastr-init.js")}}"></script>
@endsection
