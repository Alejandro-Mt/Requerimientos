@extends('home')
@section('content')

<<<<<<< HEAD
    <div class="card">
        <div class="box bg-danger text-center">
        <!--<h5 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i></h5>-->
            <h3 class="text-white">LEVANTAMIENTO</h3>
        </div>
        <div class="card-body wizard-content">
            <!--<h4 class="card-title">Levantamiento</h4>-->
            <h6 class="card-subtitle"></h6>
            <form method="POST" action="{{route ('Actualizar')}}" class="mt-5">
                {{ csrf_field() }}
                <div>
                    <h3>Formato de Solicitud</h3>
                    <section>
                        <p>(*) Campos Obligatorios</p>
                        <div class="form-group row">
                            <label for="folio"
                                class="col-sm-2 text-end control-label col-form-label">Folio/ID</label>
                            <div class="col-md-3">
                                <input name="folio" type="text" class="required form-control  @error ('folio') is-invvalid @enderror" value={{$registros->folio}} readonly="readonly">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="id_solicitante"class="col-sm-2 text-end control-label col-form-label">Solicitante*</label>
                            <div class="col-md-8">
                                <select class="select2 form-control custom-select @error ('id_solicitante') is-invvalid @enderror" style="width: 100%; height:36px;" name="id_solicitante" required autofocus>
                                    @if($registros->solicitud)
                                        <option value={{$registros->solicitud->usuario->id}}>{{ $registros->solicitud->usuario->getFullnameAttribute() }}</option>
                                    @else
                                        <option value={{NULL}}>Selecciona</option>
                                    @endif
                                    @foreach ($responsables as $solicitante)
                                        <option value = {{ $solicitante->id }}>{{$solicitante->getFullnameAttribute()}}</option>;
                                    @endforeach
                                    @error('id_solicitante')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror                      
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <!-- departamento -->
                            <label for="departamento"
                                class="col-sm-2 text-end control-label col-form-label">Departamento</label>
                            <div class="col-md-8">
                                <select class="select2 form-control custom-select @error ('departamento') is-invvalid @enderror" 
                                    style="width: 100%; height:36px;" name="departamento" required autofocus>
                                <option value={{$levantamiento->departamento}}>
                                    @foreach ($departamentos as $departamento) 
                                        @if ($levantamiento->departamento == $departamento->id)
                                            {{$departamento->departamento}}
                                        @endif
                                    @endforeach
                                </option>                                        
                                @foreach ($departamentos as $departamento)
                                    <option value = {{ $departamento->id }}>{{$departamento->departamento}}</option>;
                                @endforeach  
                                    @error('departamento')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror                        
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <!-- ID Autoriza -->
                            <label for="autorizacion"
                                class="col-sm-2 text-end control-label col-form-label">Autorizó</label>
                            <div class="col-md-8">
                                <select class="select2 form-control custom-select @error ('autorizacion') is-invvalid @enderror" style="width: 100%; height:36px;" name="autorizacion" required autofocus>
                                    <option value={{$levantamiento->autorizacion}}>
                                        @foreach ($responsables as $previo) 
                                            @if ($levantamiento->autorizacion == $previo->id)
                                                {{$previo->getFullnameAttribute()}}
                                            @endif
                                        @endforeach
                                    </option>
                                @foreach ($responsables as $ejecutivo)
                                    @if ($ejecutivo->usrdata && $ejecutivo->usrdata->id_area == 6)
                                        <option value = {{ $ejecutivo->id }}>{{$ejecutivo->getFullnameAttribute()}}</option>;
                                    @endif
                                @endforeach  
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
                                    <input type="radio" value = 1 @if($levantamiento->previo == 1) checked @endif class="form-check-input" id="customControlValidation1" name="previo" required>
                                    <label class="form-check-label mb-0" for="customControlValidation1">Sí</label>
                                
                                    <input type="radio" value = 0 @if($levantamiento->previo == 0) checked @endif class="form-check-input" id="customControlValidation2" name="previo" required>
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
                                class="col-sm-2 text-end control-label col-form-label">Descripción del Problema*</label>
                            <div class="col-md-8">
                                    <input name="problema" type="text" class="required form-control @error ('problema') is-invvalid @enderror" 
                                value="{{$levantamiento->problema}}" placeholder="Se detallado" required autofocus>
                                @error('problema')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="prioridad"
                                class="col-sm-2 text-end control-label col-form-label">Impacto en la Operación*</label>
                            <div class="col-md-8">
                                <select name="prioridad" class="select2 form-control custom-select @error ('prioridad') is-invvalid @enderror" style="height: 36px;width: 100%;" required autofocus>
                                    <option value={{$levantamiento->prioridad}}>
                                        @if ($levantamiento->prioridad == 1)
                                            {{('Baja')}}
                                        @elseif ($levantamiento->prioridad ==2)
                                            {{('Media')}}
                                        @elseif ($levantamiento->prioridad ==3)
                                            {{('Alta')}}
                                        @elseif ($levantamiento->prioridad ==4)
                                            {{('Critica')}}
                                        @endif
                                    </option>
                                    <option value='1'>Baja</option>
                                    <option value='2'>Media</option>
                                    <option value='3'>Alta</option>
                                    <option value='4'>Critica</option>                         
                                </select>
                                @error('prioridad')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="general"
                                class="col-sm-2 text-end control-label col-form-label">Descripción General del Requerimiento*</label>
                            <div class="col-md-8">
                                <textarea name="general" type="text" class="required form-control  @error ('general') is-invvalid @enderror" 
                                    placeholder="Se breve" required autofocus>{{$levantamiento->general}}</textarea>
                                @error('general')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="detalle" class="col-sm-2 text-end control-label col-form-label">Descripción Específica del Requerimiento*</label>
                            <div class="col-md-8">
                                    <textarea name="detalle" type="text" class="required form-control @error ('detalle') is-invvalid @enderror" 
                                     placeholder="Se detallado" required autofocus>{{$levantamiento->detalle}}</textarea>
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
                                    <textarea name="esperado" aria-placeholder="Que es lo que se espera" required autofocus
                                        class="required form-control @error ('esperado') is-invvalid @enderror">{{$levantamiento->esperado}}
                                    </textarea>
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
                                <select name="involucrados[]" class="select2 form-control custom-select shadow-none mt-3 select2-hidden-accessible" multiple="" style="height: 36px;width: 100%;" required autofocus>
                                    @for ($i = 0; $i < count($involucrados); $i++)
                                        <option value={{$involucrados[$i]}} selected>
                                            @foreach ($responsables as $previo) 
                                                    @if ($involucrados[$i] == $previo->id)
                                                        {{$previo->getFullnameAttribute()}}
                                                    @endif 
                                            @endforeach
                                        </option>
                                    @endfor 
                                    @foreach ($responsables as $responsable)
                                        <option value="{{$responsable->id}}">{{$responsable->getFullnameAttribute()}}</option>
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
                                <select name="relaciones[]" class="select2 form-control custom-select shadow-none mt-3 select2-hidden-accessible" multiple="" style="height: 36px;width: 100%;" required autofocus>
                                    @for ($i = 0; $i < count($relaciones); $i++)
                                        <option value={{$relaciones[$i]}} selected>
                                            @foreach ($sistemas as $previo) 
                                                    @if ($relaciones[$i] == $previo->id_sistema)
                                                        {{$previo->nombre_s}}
                                                    @endif
                                            @endforeach
                                        </option> 
                                    @endfor
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
                                <select name="areas[]" class="select2 form-control custom-select shadow-none mt-3 select2-hidden-accessible" multiple="" style="height: 36px;width: 100%;" required autofocus>
                                    @for ($i = 0; $i < count($areasr); $i++)
                                        <option value={{$areasr[$i]}} selected>
                                            @foreach ($areas as $previo) 
                                                    @if ($areasr[$i] == $previo->id_area)
                                                        {{$previo->area}}
                                                    @endif
                                            @endforeach
                                        </option> 
                                    @endfor
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
                            <button type="reset" value="reset" class="btn btn-danger"><a href="{{route('Documentos',Crypt::encrypt($registros->folio))}}" style="color:white">Cancelar</a></button>
                        </div>
                    </section>
                </div>
            </form>
        </div>
    </div>
=======
<div class="card">
  <div class="box bg-danger text-center">
    <!--<h5 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i></h5>-->
    <h3 class="text-white">LEVANTAMIENTO</h3>
  </div>
  <div class="card-body wizard-content">
    <!--<h4 class="card-title">Levantamiento</h4>-->
    <h6 class="card-subtitle"></h6>
    <form method="POST" action="{{route ('Actualizar')}}" class="mt-5">
      {{ csrf_field() }}
      <div>
        <h3>Formato de Solicitud</h3>
        <section>
          <p>(*) Campos Obligatorios</p>
          <div class="form-group row">
            <label for="folio" class="col-sm-2 text-end control-label col-form-label">Folio/ID</label>
            <div class="col-md-3">
              <input name="folio" type="text" class="required form-control  @error ('folio') is-invvalid @enderror" value={{$registros->folio}} readonly="readonly">
            </div>
          </div>
          <div class="form-group row">
            <label for="id_solicitante" class="col-sm-2 text-end control-label col-form-label">Solicitante*</label>
            <div class="col-md-8">
              <select class="select2 form-control custom-select @error ('id_solicitante') is-invvalid @enderror" style="width: 100%; height:36px;" name="id_solicitante" required autofocus>
                @if($registros->solicitud)
                  <option value={{$registros->solicitud->usuario->id}}>{{ $registros->solicitud->usuario->getFullnameAttribute() }}</option>
                @else
                  <option value={{NULL}}>Selecciona</option>
                @endif
                @foreach ($responsables as $solicitante)
                  <option value = {{ $solicitante->id }}>{{$solicitante->getFullnameAttribute()}}</option>;
                @endforeach
                @error('id_solicitante')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror                      
              </select>
            </div>
          </div>
          <div class="form-group row">
            <!-- departamento -->
            <label for="departamento" class="col-sm-2 text-end control-label col-form-label">Departamento</label>
            <div class="col-md-8">
              <select class="select2 form-control custom-select @error ('departamento') is-invvalid @enderror" style="width: 100%; height:36px;" name="departamento" required autofocus>
                <option value={{$levantamiento->departamento}}>
                  @foreach ($departamentos as $departamento) 
                    @if ($levantamiento->departamento == $departamento->id)
                      {{$departamento->departamento}}
                    @endif
                  @endforeach
                </option>                                        
                @foreach ($departamentos as $departamento)
                  <option value = {{ $departamento->id }}>{{$departamento->departamento}}</option>;
                @endforeach  
                @error('departamento')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror                        
              </select>
            </div>
          </div>
          <div class="form-group row">
            <!-- ID Autoriza -->
            <label for="autorizacion" class="col-sm-2 text-end control-label col-form-label">Autorizó</label>
            <div class="col-md-8">
              <select class="select2 form-control custom-select @error ('autorizacion') is-invvalid @enderror" style="width: 100%; height:36px;" name="autorizacion" required autofocus>
                <option value={{$levantamiento->autorizacion}}>
                  @foreach ($responsables as $previo) 
                    @if ($levantamiento->autorizacion == $previo->id)
                      {{$previo->getFullnameAttribute()}}
                    @endif
                  @endforeach
                </option>
                @foreach ($responsables as $ejecutivo)
                  @if ($ejecutivo->usrdata && $ejecutivo->usrdata->id_area == 6)
                    <option value = {{ $ejecutivo->id }}>{{$ejecutivo->getFullnameAttribute()}}</option>;
                  @endif
                @endforeach  
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
              <input type="radio" value = 1 @if($levantamiento->previo == 1) checked @endif class="form-check-input" id="customControlValidation1" name="previo" required>
              <label class="form-check-label mb-0" for="customControlValidation1">Sí</label>
              <input type="radio" value = 0 @if($levantamiento->previo == 0) checked @endif class="form-check-input" id="customControlValidation2" name="previo" required>
              <label class="form-check-label mb-0" for="customControlValidation1">No</label>
            </div>
            @error('previo')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
          <div class="form-group row">
            <label for="problema" class="col-sm-2 text-end control-label col-form-label">Descripción del Problema*</label>
            <div class="col-md-8">
              <input id="problema" name="problema" type="text" class="required form-control @error ('problema') is-invvalid @enderror" value="{{$levantamiento->problema}}" placeholder="Se detallado" required autofocus>
              <small class="text-muted" id="charCount">0/250 caracteres</small>
              @error('problema')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
          <div class="form-group row">
            <label for="prioridad" class="col-sm-2 text-end control-label col-form-label">Impacto en la Operación*</label>
            <div class="col-md-8">
              <select name="prioridad" class="select2 form-control custom-select @error ('prioridad') is-invvalid @enderror" style="height: 36px;width: 100%;" required autofocus>
                <option value={{$levantamiento->prioridad}}>
                  @if ($levantamiento->prioridad == 1)
                    {{('Baja')}}
                  @elseif ($levantamiento->prioridad ==2)
                    {{('Media')}}
                  @elseif ($levantamiento->prioridad ==3)
                    {{('Alta')}}
                  @elseif ($levantamiento->prioridad ==4)
                    {{('Critica')}}
                  @endif
                </option>
                <option value='1'>Baja</option>
                <option value='2'>Media</option>
                <option value='3'>Alta</option>
                <option value='4'>Critica</option>                         
              </select>
              @error('prioridad')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
          <div class="form-group row">
            <label for="general" class="col-sm-2 text-end control-label col-form-label">Descripción General del Requerimiento*</label>
            <div class="col-md-8">
              <textarea name="general" type="text" class="required form-control  @error ('general') is-invvalid @enderror" placeholder="Se breve" required autofocus>{{$levantamiento->general}}</textarea>
              @error('general')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
          <div class="form-group row">
            <label for="detalle" class="col-sm-2 text-end control-label col-form-label">Descripción Específica del Requerimiento*</label>
            <div class="col-md-8">
              <textarea name="detalle" type="text" class="required form-control @error ('detalle') is-invvalid @enderror" placeholder="Se detallado" required autofocus>{{$levantamiento->detalle}}</textarea>
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
              <textarea name="esperado" aria-placeholder="Que es lo que se espera" required autofocus class="required form-control @error ('esperado') is-invvalid @enderror">{{$levantamiento->esperado}}</textarea>
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
              <select name="involucrados[]" class="select2 form-control custom-select shadow-none mt-3 select2-hidden-accessible" multiple="" style="height: 36px;width: 100%;" required autofocus>
                @for ($i = 0; $i < count($involucrados); $i++)
                  <option value={{$involucrados[$i]}} selected>
                    @foreach ($responsables as $previo) 
                      @if ($involucrados[$i] == $previo->id)
                        {{$previo->getFullnameAttribute()}}
                      @endif 
                    @endforeach
                  </option>
                @endfor 
                @foreach ($responsables as $responsable)
                  <option value="{{$responsable->id}}">{{$responsable->getFullnameAttribute()}}</option>
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
            <label for="relaciones" class="col-sm-2 text-end control-label col-form-label">Relación con Otros Sistemas</label>
            <div class="col-md-8">
              <select name="relaciones[]" class="select2 form-control custom-select shadow-none mt-3 select2-hidden-accessible" multiple="" style="height: 36px;width: 100%;" required autofocus>
                @for ($i = 0; $i < count($relaciones); $i++)
                  <option value={{$relaciones[$i]}} selected>
                    @foreach ($sistemas as $previo) 
                      @if ($relaciones[$i] == $previo->id_sistema)
                        {{$previo->nombre_s}}
                      @endif
                    @endforeach
                  </option> 
                @endfor
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
            <label for="areas" class="col-sm-2 text-end control-label col-form-label">Relación con Otras Áreas</label>
            <div class="col-md-8">
              <select name="areas[]" class="select2 form-control custom-select shadow-none mt-3 select2-hidden-accessible" multiple="" style="height: 36px;width: 100%;" required autofocus>
                @for ($i = 0; $i < count($areasr); $i++)
                  <option value={{$areasr[$i]}} selected>
                    @foreach ($areas as $previo) 
                      @if ($areasr[$i] == $previo->id_area)
                        {{$previo->area}}
                      @endif
                    @endforeach
                  </option> 
                @endfor
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
            <button type="reset" value="reset" class="btn btn-danger"><a href="{{route('Documentos',Crypt::encrypt($registros->folio))}}" style="color:white">Cancelar</a></button>
          </div>
        </section>
      </div>
    </form>
  </div>
</div>
 
>>>>>>> versionprod
<h5>*Campos obligatorios</h5>
<!-- --------------------------------------------------------------- -->
<!-- This page JavaScript -->
<!-- --------------------------------------------------------------- -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- This Page CSS -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.css"/>
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.js"></script>
<script>
<<<<<<< HEAD
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
=======
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
@endsection
>>>>>>> versionprod
