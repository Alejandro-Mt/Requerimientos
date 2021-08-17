<html lang="es">
<link rel="stylesheet" href="{{asset("assets/css/nicepage.css")}}" media="screen">
<link rel="stylesheet" href="{{asset("assets/css/Formato.css")}}" media="screen">
<link rel="icon" type="image/png" sizes="16x16" href="{{asset("assets/images/tripleilogo1.png")}}">
    <script class="u-script" type="text/javascript" src="{{asset("assets/js/jquery.js")}}" defer=""></script>
    <script class="u-script" type="text/javascript" src="{{asset("assets/js/nicepage.js")}}" defer=""></script>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Confirmacion de Seguimiento</title>
</head>
<body>
    @extends('home')
@section('content')
<div class="card">
    <div class="card-body wizard-content">
        <form method="GET" action="#" class="mt-5">
            <div>
                <header class="u-clearfix u-header u-header" id="sec-3a12">
                  <div class="u-clearfix u-sheet u-sheet-1">
                    <a href="#" class="u-image u-logo u-image-1" data-image-width="350" data-image-height="144">
                      <img src="{{asset("assets/images/tripleilogo.png")}}" class="u-logo-image u-logo-image-1">
                    </a>
                    <h1 class="u-align-center u-text u-text-default u-title u-text-1">Solicitud de Requerimientos</h1>
                    <p class="u-align-left u-text u-text-2">Fecha de Solicitud:</p>
                    <div class="u-align-right u-border-1 u-border-grey-dark-1 u-line u-line-horizontal u-line-1"></div>
                  </div>
                </header>
                <section class="u-align-left u-border-3 u-border-grey-75 u-clearfix u-white u-section-1" id="carousel_4c76">
                  <div class="u-clearfix u-sheet u-sheet-1">
                    <div class="u-border-1 u-border-black u-container-style u-group u-radius-50 u-shape-round u-group-1">
                      <div class="u-container-layout u-container-layout-1">
                        <p class="u-align-left u-text u-text-1">Area:</p>
                        <p class="u-align-left u-text u-text-2">
                            @foreach ($registros as $registro)
                                <input name="folio" type="text" class="required form-control  @error ('folio') is-invvalid @enderror" 
                                    value={{$registro->folio}} readonly="readonly">                                  
                            @endforeach
                        </p>
                      </div>
                    </div>
                    <div class="u-border-1 u-border-black u-container-style u-group u-radius-50 u-shape-round u-group-2">
                      <div class="u-container-layout u-valign-middle-md u-valign-middle-sm u-valign-middle-xs u-container-layout-2">
                        <p class="u-align-left u-text u-text-3">Nombre de Solicitante:</p>
                        <p class="u-align-left u-text u-text-4">
                            @foreach ($levantamientos as $valor)
                                <input type="text" class="required form-control @error('solicitante') is-invalid @enderror" 
                                name="solicitante" placeholder="Quien Solicita" required autofocus value={{$valor->solicitante}}>
                            @endforeach
                            @error('solicitante')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </p>
                      </div>
                    </div>
                    <div class="u-border-1 u-border-black u-container-style u-group u-radius-50 u-shape-round u-group-3">
                      <div class="u-container-layout u-valign-middle-md u-valign-middle-sm u-valign-middle-xs u-container-layout-3">
                        <p class="u-align-left u-text u-text-5">Quien Autoriza:</p>
                        <p class="u-align-left u-text u-text-6">
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
                                @foreach ($responsables as $autoriza):
                                    <option value={{$autoriza->id_responsable}}>{{$autoriza->nombre_r}}</option>;
                                @endforeach;  
                                @error('autorizacion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror                        
                            </select>
                        </p>
                      </div>
                    </div>
                    <div class="u-border-1 u-border-black u-container-style u-group u-radius-50 u-shape-round u-group-4">
                      <div class="u-container-layout u-container-layout-4">
                        <p class="u-align-left u-text u-text-7">Departamento:</p>
                        <p class="u-align-left u-text u-text-8">Requerimiento</p>
                      </div>
                    </div>
                    <div class="u-border-1 u-border-black u-container-style u-group u-radius-50 u-shape-round u-group-5">
                      <div class="u-container-layout u-valign-middle u-container-layout-5">
                        <p class="u-align-left u-text u-text-9">Jefe Departamental:</p>
                        <p class="u-align-left u-text u-text-10">
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
                        </p>
                      </div>
                    </div>
                    <div class="u-border-1 u-border-black u-container-style u-group u-radius-50 u-shape-round u-group-6">
                      <div class="u-container-layout u-container-layout-6">
                        <p class="u-align-left u-text u-text-default u-text-11">Sistema / Aplicacion:</p>
                        <p class="u-align-left u-text u-text-12">Requerimiento</p>
                      </div>
                    </div>
                    <div class="u-border-1 u-border-black u-container-style u-group u-radius-50 u-shape-round u-group-7">
                      <div class="u-container-layout u-valign-middle-md u-valign-middle-sm u-valign-middle-xl u-valign-middle-xs u-container-layout-7">
                        <p class="u-align-left u-text u-text-13">Cliente</p>
                        <p class="u-align-left u-text u-text-14">Requerimiento</p>
                      </div>
                    </div>
                  </div>
                </section>
                <section class="u-clearfix u-section-2" id="sec-1559">
                  <div class="u-clearfix u-sheet u-sheet-1">
                    <div class="u-border-2 u-border-grey-75 u-container-style u-grey-25 u-group u-group-1">
                      <div class="u-container-layout u-valign-middle u-container-layout-1">
                        <p class="u-text u-text-default u-text-1">¿Existe desarrollo Previo?</p>
                      </div>
                    </div>
                    <p class="u-align-left u-text u-text-4">
                        @foreach ($levantamientos as $valor)
                            <input type="radio" value = 1 @if($valor->previo == 1) checked @endif class="form-check-input" id="customControlValidation1" name="previo" required>
                            <label class="form-check-label mb-0" for="customControlValidation1">Si</label>
                    </p>
                    <p class="u-align-left u-text u-text-5">  
                            <input type="radio" value = 0 @if($valor->previo == 0) checked @endif class="form-check-input" id="customControlValidation2" name="previo" required>
                            <label class="form-check-label mb-0" for="customControlValidation2">No</label>
                        
                        @endforeach
                    </p>
                    <div class="u-align-left u-border-2 u-border-grey-75 u-container-style u-grey-25 u-group u-group-2">
                      <div class="u-container-layout u-valign-middle u-container-layout-2">
                        <p class="u-text u-text-6">Descripcion del Problema:</p>
                      </div>
                    </div>
                    <div class="u-border-2 u-border-grey-75 u-container-style u-grey-25 u-group u-group-3">
                      <div class="u-container-layout u-valign-middle u-container-layout-3">
                        <p class="u-text u-text-default u-text-7">Impacto En la Operacion</p>
                      </div>
                    </div>
                    <!--<h5 class="u-align-left u-text u-text-8">☑&nbsp;&nbsp;</h5>
                    <h5 class="u-align-left u-text u-text-9">☑&nbsp;&nbsp;</h5>
                    <p class="u-align-left u-text u-text-10">Alta</p>
                    <p class="u-align-left u-text u-text-11">Media</p>
                    <h5 class="u-align-left u-text u-text-12">☑&nbsp;&nbsp;</h5>
                    <p class="u-align-left u-text u-text-13">Baja</p>-->
                    <div class="u-border-1 u-border-black u-container-style u-expanded-width u-group u-palette-2-light-3 u-radius-50 u-shape-round u-group-4">
                      <div class="u-container-layout u-container-layout-4">
                        <p class="u-text u-text-14">
                            @foreach ($levantamientos as $valor)
                                <input name="problema" type="text" class="u-border-0 u-border-black u-container-style u-expanded-width u-group u-palette-2-light-3 u-radius-50 u-shape-round required form-control @error ('problema') is-invvalid @enderror" 
                               value="{{$valor->problema}}" placeholder="Se detallado" required autofocus>
                            @endforeach
                            @error('problema')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </p>
                      </div>
                    </div>
                    <!--<h5 class="u-align-left u-text u-text-15">☑&nbsp;&nbsp;</h5>
                    <h5 class="u-align-left u-text u-text-16">☑&nbsp;&nbsp;</h5>
                    <p class="u-align-left u-text u-text-17">Alta</p>
                    <p class="u-align-left u-text u-text-18">Media</p>
                    <h5 class="u-align-left u-text u-text-19">☑&nbsp;&nbsp;</h5>
                    <p class="u-align-left u-text u-text-20">Baja</p>-->
                    <div class="u-align-left u-border-2 u-border-grey-75 u-container-style u-grey-25 u-group u-group-2">
                        <div class="u-container-layout u-valign-middle u-container-layout-2">
                          <p class="u-text u-text-6">Descripcion del Requerimiento:</p>
                        </div>
                      </div>
                    <div class="u-border-2 u-border-grey-75 u-container-style u-grey-25 u-group u-group-6">
                      <div class="u-container-layout u-container-layout-6">
                        <p class="u-text u-text-default u-text-22">Prioridad</p>
                      </div>
                    </div>
                    <!--<h5 class="u-align-left u-text u-text-8">☑&nbsp;&nbsp;</h5>
                    <h5 class="u-align-left u-text u-text-9">☑&nbsp;&nbsp;</h5>
                    <p class="u-align-left u-text u-text-10">Alta</p>
                    <p class="u-align-left u-text u-text-11">Media</p>
                    <h5 class="u-align-left u-text u-text-12">☑&nbsp;&nbsp;</h5>
                    <p class="u-align-left u-text u-text-13">Baja</p>-->
                    <div class="u-border-1 u-border-black u-container-style u-expanded-width u-group u-palette-2-light-3 u-radius-50 u-shape-round u-group-7">
                      <div class="u-container-layout u-container-layout-7">
                        <p class="u-text u-text-23">
                            @foreach ($levantamientos as $valor)
                             <input name="general" type="text" class="u-border-0 u-border-black u-container-style u-expanded-width u-group u-palette-2-light-3 u-radius-50 u-shape-round required form-control  @error ('general') is-invvalid @enderror" 
                                value="{{$valor->general}}" placeholder="Se breve" required autofocus>
                            @endforeach
                            @error('general')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </p>
                      </div>
                    </div>
                    <div class="u-align-left u-border-2 u-border-grey-75 u-container-style u-grey-25 u-group u-group-8">
                      <div class="u-container-layout u-container-layout-8">
                        <p class="u-text u-text-default u-text-24">Descripcion Especifica del Requerimiento</p>
                      </div>
                    </div>
                    <div class="u-border-1 u-border-black u-container-style u-expanded-width u-group u-palette-2-light-3 u-radius-50 u-shape-round u-group-9">
                      <div class="u-container-layout u-container-layout-9">
                        <p class="u-text u-text-25">
                            @foreach ($levantamientos as $valor)
                                <input name="detalle" type="text" class="u-border-0 u-border-black u-container-style u-expanded-width u-group u-palette-2-light-3 u-radius-50 u-shape-round required form-control  @error ('general') is-invvalid @enderror" 
                                value="{{$valor->detalle}}" placeholder="Se detallado" required autofocus>
                            @endforeach
                            @error('detalle')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </p>
                      </div>
                    </div>
                    <div class="u-align-left u-border-2 u-border-grey-75 u-container-style u-grey-25 u-group u-group-10">
                      <div class="u-container-layout u-container-layout-10">
                        <p class="u-text u-text-default u-text-26">Resultado Esperado</p>
                      </div>
                    </div>
                    <div class="u-border-1 u-border-black u-container-style u-expanded-width u-group u-palette-2-light-3 u-radius-50 u-shape-round u-group-11">
                      <div class="u-container-layout u-valign-middle u-container-layout-11">
                        <p class="u-text u-text-27">
                            @foreach ($levantamientos as $valor)
                                <input name="esperado" type="text" class="u-border-0 u-border-black u-container-style u-expanded-width u-group u-palette-2-light-3 u-radius-50 u-shape-round required form-control  @error ('general') is-invvalid @enderror"
                                value={{$valor->esperado}} placeholder="Que es lo que se espera" required autofocus>
                            @endforeach
                            @error('esperado')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </p>
                      </div>
                    </div>
                    <div class="u-align-left u-border-2 u-border-grey-75 u-container-style u-grey-25 u-group u-group-12">
                      <div class="u-container-layout u-valign-middle u-container-layout-12">
                        <p class="u-text u-text-default u-text-28">Areas o Sistemas Relacionados</p>
                      </div>
                    </div>
                    <div class="u-border-1 u-border-black u-container-style u-expanded-width u-group u-palette-2-light-3 u-radius-50 u-shape-round u-group-13">
                      <div class="u-container-layout u-container-layout-13">
                        <p class="u-text u-text-29">
                            <select name="relaciones" class="select2 u-border-0 u-border-black u-container-style u-expanded-width u-group u-palette-2-light-3 u-radius-50 u-shape-round form-select shadow-none mt-3 select2-hidden-accessible" multiple="" style="height: 36px;width: 100%;" required autofocus>
                                @foreach ($levantamientos as $valor)
                                    <option value={{$valor->relaciones}} selected>
                                        @foreach ($sistemas as $previo) 
                                            @if ($valor->relaciones == $previo->id_sistema)
                                                {{$previo->nombre_s}}
                                            @endif
                                        @endforeach</option>                                        
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
                        </p>
                      </div>
                    </div>
                    <div class="u-border-2 u-border-grey-75 u-container-style u-grey-25 u-group u-group-14">
                      <div class="u-container-layout u-valign-middle u-container-layout-14">
                        <p class="u-text u-text-default u-text-30">Responsables del Proceso Actual y Usuario Funcional:</p>
                      </div>
                    </div>
                    <div class="u-border-1 u-border-black u-container-style u-expanded-width u-group u-palette-2-light-3 u-radius-50 u-shape-round u-group-15">
                      <div class="u-container-layout u-container-layout-15">
                        <p class="u-text u-text-31">
                            <select name="involucrados" class="select2 u-border-0 u-border-black u-container-style u-expanded-width u-group u-palette-2-light-3 u-radius-50 u-shape-round form-select shadow-none mt-3 select2-hidden-accessible" multiple="" style="height: 36px;width: 100%;" required autofocus>
                                @foreach ($levantamientos as $valor)
                                    <option value={{$valor->involucrados}} selected>
                                        @foreach ($responsables as $previo) 
                                            @if ($valor->involucrados == $previo->id_responsable)
                                                {{$previo->nombre_r}}
                                            @endif
                                        @endforeach</option>                                        
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
                            @error('jefe_departamento')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </p>
                      </div>
                    </div>
                  </div>
                </section>
                <section class="u-align-left u-border-2 u-border-grey-75 u-clearfix u-white u-section-3" id="carousel_34a0">
                  <div class="u-clearfix u-sheet u-sheet-1">
                    <p class="u-align-left u-text u-text-1">Espacio Exclusivo Para Desarrollo</p>
                    <div class="u-border-2 u-border-grey-75 u-container-style u-grey-25 u-group u-group-1">
                      <div class="u-container-layout u-valign-middle u-container-layout-1">
                        <p class="u-align-left u-text u-text-2">Observaciones:</p>
                      </div>
                    </div>
                    <div class="u-border-2 u-border-grey-75 u-container-style u-grey-25 u-group u-group-2">
                      <div class="u-container-layout u-valign-middle u-container-layout-2">
                        <p class="u-align-right u-text u-text-3">Impacto en Desarrollos:</p>
                      </div>
                    </div>
                    <!--<h5 class="u-align-left u-text u-text-4">☑&nbsp;&nbsp;</h5>
                    <h5 class="u-align-left u-text u-text-5">☑&nbsp;&nbsp;</h5>
                    <p class="u-align-left u-text u-text-6">Alta</p>
                    <p class="u-align-left u-text u-text-7">Media</p>
                    <h5 class="u-align-left u-text u-text-8">☑&nbsp;&nbsp;</h5>
                    <p class="u-align-left u-text u-text-9">Baja</p>-->
                    <div class="u-border-1 u-border-black u-container-style u-expanded-width u-group u-palette-2-light-3 u-radius-50 u-shape-round u-group-3">
                      <div class="u-container-layout u-container-layout-3">
                        <p class="u-text u-text-10">Blanco</p>
                      </div>
                    </div>
                    <div class="u-border-2 u-border-grey-75 u-container-style u-grey-25 u-group u-group-4">
                      <div class="u-container-layout u-container-layout-4">
                        <p class="u-text u-text-default u-text-11">Prioridad</p>
                      </div>
                    </div>
                    <!--<h5 class="u-align-left u-text u-text-12">☑&nbsp;&nbsp;</h5>
                    <h5 class="u-align-left u-text u-text-13">☑&nbsp;&nbsp;</h5>
                    <p class="u-align-left u-text u-text-14">Alta</p>
                    <p class="u-align-left u-text u-text-15">Media</p>
                    <h5 class="u-align-left u-text u-text-16">☑&nbsp;&nbsp;</h5>
                    <p class="u-align-left u-text u-text-17">Baja</p>-->
                    <div class="u-border-1 u-border-black u-container-style u-group u-radius-50 u-shape-round u-group-5">
                      <div class="u-container-layout u-valign-middle-md u-valign-middle-sm u-valign-middle-xs u-container-layout-5">
                        <p class="u-align-left u-text u-text-18">Quien Autoriza:</p>
                        <div class="u-border-1 u-border-grey-dark-1 u-line u-line-horizontal u-line-1"></div>
                      </div>
                    </div>
                  </div>
                </section>
                <section class="u-border-5 u-border-grey-75 u-clearfix u-section-4" id="sec-2ab0">
                  <div class="u-clearfix u-sheet u-sheet-1">
                    <div class="u-container-style u-group u-shape-rectangle u-group-1">
                      <div class="u-container-layout u-valign-middle-md u-valign-middle-sm u-valign-middle-xs u-container-layout-1">
                        <div class="u-border-1 u-border-grey-dark-1 u-line u-line-horizontal u-line-1"></div>
                        <p class="u-align-center u-text u-text-1">Nombre y Firma de quien Autoriza</p>
                      </div>
                    </div>
                    <div class="u-align-center u-container-style u-group u-shape-rectangle u-group-2">
                      <div class="u-container-layout u-valign-middle u-container-layout-2">
                        <div class="u-border-1 u-border-grey-dark-1 u-line u-line-horizontal u-line-2"></div>
                        <p class="u-text u-text-2">Fecha de Recepcion por IT</p>
                      </div>
                    </div>
                    <div class="u-align-center u-container-style u-group u-shape-rectangle u-group-3">
                      <div class="u-container-layout u-valign-middle u-container-layout-3">
                        <p class="u-align-center u-text u-text-3">Vo. Bo. IT</p>
                        <div class="u-border-1 u-border-grey-dark-1 u-line u-line-horizontal u-line-3"></div>
                      </div>
                    </div>
                  </div>
                </section>
            </div>
        </form>
    </div>
</div>

@endsection 
</body>
</html>