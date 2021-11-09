@extends('home')
@section('content')

<div class="card">
    <div class="card-body wizard-content">
        <h4 class="card-title">Levantamiento</h4>
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
                            @foreach ($levantamientos as $valor)
                                <input type="text" class="required form-control @error('solicitante') is-invalid @enderror" 
                                name="solicitante" placeholder="Quien Solicita" required autofocus value={{$valor->solicitante}}>
                            @endforeach
                            @error('solicitante')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jefe_departamento"
                            class="col-sm-2 text-end control-label col-form-label">Jefe de Departamento</label>
                        <div class="col-md-8">  
                            <select class="form-select @error('jefe_departamento') is-invalid @enderror" 
                                style="width: 100%; height:36px;" name="jefe_departamento" tabindex="-1" aria-hidden="true" required autofocus>
                                @foreach ($levantamientos as $valor)
                                    <option value={{$valor->jefe_departamento}}>
                                        @foreach ($responsables as $previo) 
                                            @if ($valor->jefe_departamento == $previo->id_responsable)
                                                {{$previo->nombre_r}}
                                            @endif
                                        @endforeach</option>                                        
                                @endforeach
                                @foreach ($responsables as $ejecutivo):
                                    @if ($ejecutivo ->id_area == 2)
                                        <option value = {{ $ejecutivo->id_responsable }}>{{$ejecutivo->nombre_r}}</option>;
                                    @endif
                                @endforeach                     
                            </select>
                            @error('jefe_departamento')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <!-- ID Autoriza -->
                        <label for="autorizacion"
                            class="col-sm-2 text-end control-label col-form-label">Autorizo</label>
                        <div class="col-md-8">
                            <select class="form-select @error ('autorizacion') is-invvalid @enderror" 
                                style="width: 100%; height:36px;" name="autorizacion" tabindex="-1" aria-hidden="true" required autofocus>
                                @foreach ($levantamientos as $valor)
                                <option value={{$valor->autorizacion}}>
                                    @foreach ($responsables as $previo) 
                                        @if ($valor->autorizacion == $previo->id_responsable)
                                            {{$previo->nombre_r}}
                                        @endif
                                    @endforeach</option>                                        
                            @endforeach
                            @foreach ($responsables as $ejecutivo):
                                @if ($ejecutivo->id_area == 6)
                                    <option value = {{ $ejecutivo->id_responsable }}>{{$ejecutivo->nombre_r}}</option>;
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
                            @foreach ($levantamientos as $valor)
                                <input type="radio" value = 1 @if($valor->previo == 1) checked @endif class="form-check-input" id="customControlValidation1" name="previo" required>
                                <label class="form-check-label mb-0" for="customControlValidation1">Si</label>
                            
                                <input type="radio" value = 0 @if($valor->previo == 0) checked @endif class="form-check-input" id="customControlValidation2" name="previo" required>
                                <label class="form-check-label mb-0" for="customControlValidation1">No</label>
                           
                            @endforeach
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
                            @foreach ($levantamientos as $valor)
                                <input name="problema" type="text" class="required form-control @error ('problema') is-invvalid @enderror" 
                               value="{{$valor->problema}}" placeholder="Se detallado" required autofocus>
                            @endforeach
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
                                @foreach ($levantamientos as $valor)
                                    <option value={{$valor->impacto}}>
                                            @if ($valor->impacto == 1)
                                                {{('Baja')}}
                                            @else
                                                @if ($valor->impacto ==2)
                                                {{('Media')}}
                                                @else
                                                    @if ($valor->impacto ==3)
                                                        {{('Alta')}}
                                                    @else
                                                        @if ($valor->impacto ==4)
                                                            {{('Critica')}}
                                                        @endif
                                                    @endif
                                                @endif
                                            @endif</option>                                        
                                @endforeach
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
                            @foreach ($levantamientos as $valor)
                             <input name="general" type="text" class="required form-control  @error ('general') is-invvalid @enderror" 
                                value="{{$valor->general}}" placeholder="Se breve" required autofocus>
                            @endforeach
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
                            @foreach ($levantamientos as $valor)
                                <input name="detalle" type="text" class="required form-control @error ('detalle') is-invvalid @enderror" 
                                value="{{$valor->detalle}}" placeholder="Se detallado" required autofocus>
                            @endforeach
                            @error('detalle')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="esperado"
                            class="col-sm-2 text-end control-label col-form-label">resultado Esperado*</label>
                        <div class="col-md-8">
                            @foreach ($levantamientos as $valor)
                                <input name="esperado" type="text" class="required form-control @error ('esperado') is-invvalid @enderror" 
                                    value={{$valor->esperado}} placeholder="Que es lo que se espera" required autofocus>
                            @endforeach
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
                            <select name="involucrados[]" class="select2 form-select shadow-none mt-3 select2-hidden-accessible" multiple="" style="height: 36px;width: 100%;" required autofocus>
                                @foreach ($levantamientos as $valor)
                                    @for ($i = 0; $i < count($involucrados); $i++)
                                        <option value={{$involucrados[$i]}} selected>
                                            @foreach ($responsables as $previo) 
                                                    @if ($involucrados[$i] == $previo->id_responsable)
                                                        {{$previo->nombre_r}}
                                                    @endif 
                                            @endforeach
                                        </option>
                                    @endfor                                        
                                @endforeach
                                @foreach ($responsables as $responsable)
                                    <option value="{{$responsable->id_responsable}}">{{$responsable->nombre_r}}</option>
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
                            class="col-sm-2 text-end control-label col-form-label">Relacion con Otras Areas o Sistemas</label>
                        <div class="col-md-8">
                            <select name="relaciones[]" class="select2 form-select shadow-none mt-3 select2-hidden-accessible" multiple="" style="height: 36px;width: 100%;" required autofocus>
                                @foreach ($levantamientos as $valor)
                                    @for ($i = 0; $i < count($relaciones); $i++)
                                        <option value={{$relaciones[$i]}} selected>
                                            @foreach ($sistemas as $previo) 
                                                    @if ($relaciones[$i] == $previo->id_sistema)
                                                        {{$previo->nombre_s}}
                                                    @endif
                                            @endforeach
                                        </option> 
                                    @endfor                                       
                                @endforeach
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

@endsection 