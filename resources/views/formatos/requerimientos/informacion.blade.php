@extends('home')
@section('content')

    <div class="card">
        <div class="card-body wizard-content">
            <h3>Solicitar Información</h3>
            <p>(*) Campos Obligatorios</p>
            <h6 class="card-subtitle"></h6>
            <form method="POST" action="{{route ('Solicitud')}}" class="mt-5">
                {{ csrf_field() }}
                <div>
                    <section>
                        <div class="form-group row">
                            <label for="Folio"
                                    class="col-sm-2 text-end control-label col-form-label">Folio</label>
                            <div class="col-sm-3">
                            @foreach ($registros as $registro)
                                <input type="text" class="required form-control" name="folio" value="{{$registro->folio}}" readonly="readonly">                        
                            @endforeach
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="solInfopip"
                            class="col-sm-2 text-end control-label col-form-label">Solicitar informacion a PIP*</label>
                            <div class= 'col-md-8'>
                                <div class="input-group">
                                    <input name="solInfopip" type="text" class="form-control mydatepicker" placeholder="DD-MM-AAAA" data-date-format="dd-mm-yyyy"
                                        @foreach ($previo as $ant) 
                                            @if ($ant->solInfopip <> NULL)
                                                value="{{date('d-m-20y',strtotime($ant->solInfopip))}}"
                                            @else
                                                value="{{null}}"
                                            @endif 
                                        @endforeach >
                                    <div class="input-group-append">
                                        <span class="input-group-text h-100">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="detalle"
                                class="col-sm-2 text-end control-label col-form-label">Informacion Solicitada*</label>
                            <div class="col-md-8">
                                <input type="text" class="required form-control @error('detalle') is-invalid @enderror" 
                                    name="detalle" @foreach ($previo as $ant) value="{{$ant->detalle}}" @endforeach placeholder="detalle" required autofocus>
                                @error('detalle')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="solInfoC" class="col-sm-2 text-end control-label col-form-label">Fecha de Solicitud a Cliente*</label>
                            <div class= 'col-md-8'>
                                <div class="input-group">
                                    <input name="solInfoC" 
                                        @foreach ($previo as $ant)
                                            @if ($ant->solInfoC <> NULL)
                                                value="{{date('d-m-20y',strtotime($ant->solInfoC))}}" 
                                            @else
                                                value="{{null}}"
                                            @endif 
                                        @endforeach type="text" class="form-control mydatepicker" placeholder="DD-MM-AAAA" data-date-format="dd-mm-yyyy">
                                    <div class="input-group-append">
                                        <span class="input-group-text h-100">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--<div class="form-group row">
                            <label for="evidencia"
                                class="col-sm-2 text-end control-label col-form-label">Link de Evidencia*</label>
                            <div class="col-md-8">
                                <input type="text" class="required form-control @error('evidencia') is-invalid @enderror" 
                                    name="evidencia" placeholder="evidencia" required autofocus>
                                @error('evidencia')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>-->
                        <div class="form-group row">
                            <label class="col-sm-2 text-end form-check-label" for="retraso">Retaraso en Informacion</label>
                            <div class="col-md-6">
                                <input type="checkbox" class="form-check-input" id="retraso" name="retraso" value="1" @foreach ($previo as $ant) @if ($ant->retraso==1) checked=true @endif @endforeach onchange="javascript:showContent()">
                            </div>
                        </div>
                        <div id="content" @if($vacio <> 0) @foreach ($previo as $ant) @if ($ant->retraso == 1) style="display: block;" @else style="display: none;" @endif @endforeach @else style='display: none;' @endif>
                            <div class="form-group row">
                                <label for="motivoRetrasoInfo"
                                    class="col-sm-2 text-end control-label col-form-label">Motivo de Retraso*</label>
                                <div class="col-md-8">
                                    <select class="form-select @error ('motivoRetrasoInfo') is-invalid @enderror" style="width: 100%; height:36px;"
                                        id="motivoRetrasoInfo" name="motivoRetrasoInfo" aria-hidden="true" autofocus>
                                        @foreach ($previo as $ant)    
                                            @if ($ant->motivoRetrasoInfo <> null)
                                                <option value={{$ant->motivoRetrasoInfo}}>
                                                    @foreach ($desfases as $desfase)
                                                        @if($desfase->id == $ant->motivoRetrasoInfo)
                                                            {{$desfase->motivo}}
                                                        @endif
                                                    @endforeach
                                                </option>
                                            @endif
                                        @endforeach
                                        <option value={{null}}>Seleccion</option>
                                        @foreach ( $desfases as  $desfase)
                                            <option value={{ $desfase->id}}>{{ $desfase->motivo}}</option>
                                        @endforeach 
                                        <!--@error('motivoRetrasoInfo')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror -->                         
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="respuesta" class="col-sm-2 text-end control-label col-form-label">Fecha de Entrega de informacion*</label>
                            <!--agregar campo para visualizar que informacion adicional de 254 caracteres se require
                                Script para poder agregar archivo o imagen-->
                            <div class= 'col-md-8'>
                                <div class="input-group">
                                    <input name="respuesta"
                                        @foreach ($previo as $ant) 
                                            @if ($ant->respuesta <> null)
                                                value="{{date('d-m-20y',strtotime($ant->respuesta))}}" 
                                            @else
                                                value="{{null}}"
                                            @endif
                                            
                                        @endforeach type="text" class="form-control mydatepicker" placeholder="DD-MM-AAAA" data-date-format="dd-mm-yyyy">
                                    <div class="input-group-append">
                                        <span class="input-group-text h-100">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <button type="submit" name="id_estatus" value="" class="btn btn-primary text-white">Guardar Y Continuar</button>
                            <button type="submit" class="btn btn-success text-white">Guardar</button>
                            <label> </label> 
                            <button type="reset" value="reset" class="btn btn-danger"><a href="{{route('Planeacion',$registro->folio)}}" style="color:white">Cancelar</a></button>
                        </div>
                    </section>
                </div>
            </form>
        </div>
    </div>

    <form class="form-horizontal" action="" method="post">
    <h5>*Campos obligatorios</h5>

    <script type="text/javascript">
        function showContent() {
            element = document.getElementById("content");
            check = document.getElementById("retraso");
            if (check.checked) {
                element.style.display='block';
                check.value="1";
            }
            else {
                element.style.display='none';
                check.value="0";
            }
        }
    </script>

@endsection 