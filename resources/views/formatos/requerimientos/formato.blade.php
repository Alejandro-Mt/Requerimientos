@extends('home')
@section('content')

<div class="card">
    <div class="box bg-danger text-center">
    <!--<h5 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i></h5>-->
        <h3 class="text-white">LEVANTAMIENTO</h3>
    </div>
    <div class="card-body wizard-content">
        <!--<h4 class="card-title">Levantamiento</h4>-->
        <h6 class="card-subtitle"></h6>
        <form method="POST" action="{{route ('Guardar')}}" class="mt-5">
            {{ csrf_field() }}
            <div>
                <h3>Formato de Solicitud</h3>
                <section>
                    <p>(*) Campos Obligatorios</p>
                    <div class="form-group row">
                        <label for="folio"
                            class="col-sm-2 text-end control-label col-form-label">Folio/ID</label>
                        <div class="col-md-3">
                            @foreach ($registros as $registro)
                                <input name="folio" type="text" class="required form-control  @error ('folio') is-invvalid @enderror" 
                                    value={{$registro->folio}} readonly="readonly">                                  
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="solicitante"
                            class="col-sm-2 text-end control-label col-form-label">Solicitante*</label>
                        <div class="col-md-8">
                            <input type="text" class="required form-control @error('solicitante') is-invalid @enderror" 
                                name="solicitante" placeholder="Quien Solicita" required autofocus>
                            @error('solicitante')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="departamento"
                            class="col-sm-2 text-end control-label col-form-label">Departamento</label>
                        <div class="col-md-8">  
                            <select class="form-select @error('departamento') is-invalid @enderror" 
                                style="width: 100%; height:36px;" name="departamento" tabindex="-1" aria-hidden="true" required autofocus>
                                <option value={{null}}>Seleccion</option>
                                @foreach ($departamentos as $departamento):
                                    <option value = {{ $departamento->id }}>{{$departamento->departamento}}</option>;
                                @endforeach                     
                            </select>
                            @error('departamento')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!--<div class="form-group row">
                        <label for="jefe_departamento"
                            class="col-sm-2 text-end control-label col-form-label">Jefe de Departamento</label>
                        <div class="col-md-8">  
                            <select class="form-select @error('jefe_departamento') is-invalid @enderror" 
                                style="width: 100%; height:36px;" name="jefe_departamento" tabindex="-1" aria-hidden="true" required autofocus>
                                <option value={{null}}>Seleccion</option>
                                @foreach ($responsables as $ejecutivo):
                                    @if ($ejecutivo ->id_area == 2)
                                        <option value = {{ $ejecutivo->id_responsable }}>{{$ejecutivo->apellidos}} {{$ejecutivo->nombre_r}}</option>;
                                    @endif
                                @endforeach                     
                            </select>
                            @error('jefe_departamento')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>-->
                    <div class="form-group row">
                        <label for="autorizacion"
                            class="col-sm-2 text-end control-label col-form-label">Autorizo</label>
                        <div class="col-md-8">
                            <select class="form-select @error ('autorizacion') is-invvalid @enderror" 
                                style="width: 100%; height:36px;" name="autorizacion" tabindex="-1" aria-hidden="true" required autofocus>
                                <option value={{null}}>Seleccion</option>
                                @foreach ($responsables as $autoriza)
                                    @if ($autoriza->id_area == 6)
                                        <option value={{$autoriza->id_responsable}}>{{$autoriza->apellidos}} {{$autoriza->nombre_r}}</option>;
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
                        <label for="previo"
                            class="col-sm-2 text-end control-label col-form-label">¿Existe previo?</label>
                        <div class="col-md-8">
                        <!--<div class="form-check">-->
                            <input type="radio" value="1" class="form-check-input" id="customControlValidation1" name="previo" required>
                            <label class="form-check-label mb-0" for="customControlValidation1">Si</label>
                        
                            <input type="radio"  value="0" class="form-check-input" id="customControlValidation2" name="previo" required>
                            <label class="form-check-label mb-0" for="customControlValidation1">No</label>
                        </div>
                        @error('previo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="problema"
                            class="col-sm-2 text-end control-label col-form-label">Descripcion del Problema*</label>
                        <div class="col-md-8">
                            <input name="problema" type="text" class="required form-control @error ('problema') is-invvalid @enderror" 
                                placeholder="Se detallado" required autofocus>
                            @error('problema')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="impacto"
                            class="col-sm-2 text-end control-label col-form-label">Impacto en la Operacion*</label>
                        <div class="col-md-8">
                            <select name="impacto" class="form-select @error ('impacto') is-invvalid @enderror" style="height: 36px;width: 100%;" required autofocus>
                                <option value={{null}}>Seleccion</option>
                                <option value='1'>Baja</option>
                                <option value='2'>Media</option>
                                <option value='3'>Alta</option>
                                <option value='4'>Critica</option>                         
                            </select>
                            @error('impacto')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="general"
                            class="col-sm-2 text-end control-label col-form-label">Descripcion General del Requerimiento*</label>
                        <div class="col-md-8">
                            <input name="general" type="text" class="required form-control  @error ('general') is-invvalid @enderror" 
                                placeholder="Se breve" required autofocus>
                            @error('general')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="detalle"
                            class="col-sm-2 text-end control-label col-form-label">Descripcion Especifica del Requerimiento*</label>
                        <div class="col-md-8">
                            <input name="detalle" type="text" class="required form-control @error ('detalle') is-invvalid @enderror" 
                                placeholder="Se detallado" required autofocus>
                            @error('detalle')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="esperado"
                            class="col-sm-2 text-end control-label col-form-label">Resultado Esperado*</label>
                        <div class="col-md-8">
                            <textarea name="esperado" type="text" class="required form-control @error ('esperado') is-invvalid @enderror" 
                                placeholder="Que es lo que se espera" required autofocus></textarea>
                            @error('esperado')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="involucrados"
                            class="col-sm-2 text-end control-label col-form-label">Personas Involucradas</label>
                        <div class="col-md-8">
                            <select name="involucrados[]" class="select2 form-select mt-3 select2-hidden-accessible" multiple="multiple" style="height: 36px;width: 100%;" required autofocus>
                                @foreach ($responsables as $responsable)
                                    <option value="{{$responsable->id_responsable}}">{{$responsable->apellidos}} {{$responsable->nombre_r}}</option>
                                @endforeach
                                @error('involucrados')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="relaciones"
                            class="col-sm-2 text-end control-label col-form-label">Relación con Otros Sistemas</label>
                        <div class="col-md-8">
                            <select name="relaciones[]" class="select2 form-select shadow-none mt-3 select2-hidden-accessible" multiple="multiple" style="height: 36px;width: 100%;" required autofocus>
                                @foreach ($sistemas as $sistema)
                                    <option value="{{$sistema->id_sistema}}">{{$sistema->nombre_s}}</option>
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
                        <label for="areas"
                            class="col-sm-2 text-end control-label col-form-label">Relación con Otras Áreas</label>
                        <div class="col-md-8">
                            <select name="areas[]" class="select2 form-select shadow-none mt-3 select2-hidden-accessible" multiple="multiple" style="height: 36px;width: 100%;" required autofocus>
                                @foreach ($areas as $area)
                                    <option value="{{$area->id_area}}">{{$area->area}}</option>
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
                        <button type="reset" value="reset" class="btn btn-danger"><a href="{{route('Editar') }}" style="color:white">Cancelar</a></button>
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
    /************************************/
    //default editor
    /************************************/
    $('.summernote').summernote({
    height: 150, // set editor height
    //codemirror: { theme:'spacelab'}, // codemirror options
    //minHeight: null, // set minimum height of editor
    //maxHeight: null, // set maximum height of editor
    //focus: false, // set focus to editable area after initializing summernote
    });
</script>

@endsection 
