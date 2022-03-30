@extends('home')
@section('content')

<link href="{{asset("assets/extra-libs/toastr/dist/build/toastr.min.css")}}" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <div class="card">
        <div class="box bg-cyan text-center">
        <!--<h5 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i></h5>-->
            <h3 class="text-white">CONSTRUCCIÓN</h3>
        </div>
        <div class="card-body wizard-content">
            <h3>Análisis de requerimientos</h3>
            <p>(*) Campos Obligatorios</p>
            <h6 class="card-subtitle"></h6>
            <form method="POST" action="{{route ('Propuesta')}}" class="mt-5">
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
                            <label for="fechaCompReqC"
                                class="col-sm-2 text-end control-label col-form-label">Fecha Compromiso para Entrega*</label>
                            <div class= 'col-md-8'>
                                <div class="input-group">
                                    <input name="fechaCompReqC" type="text" class="form-control mydatepicker required form-control @error('fechaCompReqC') is-invalid @enderror" placeholder="DD-MM-AAAA" data-date-format="dd-mm-yyyy"  required autofocus
                                        @if ($vacio == 0) value="{{ old('fechaCompReqC') }}" @endif 
                                        @foreach ($previo as $ant)
                                            @if ($ant->fechaCompReqC == NULL)
                                                value="{{ old('fechaCompReqC') }}"
                                            @else
                                                value="{{date('d-m-20y',strtotime($ant->fechaCompReqC))}}" 
                                            @endif 
                                        @endforeach >
                                    <div class="input-group-append">
                                        <span class="input-group-text h-100">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                    @error('fechaCompReqC')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="evidencia"
                                class="col-sm-2 text-end control-label col-form-label">Link de Evidencia*</label>
                            <div class="col-md-8">
                                <input type="text" class="required form-control @error('evidencia') is-invalid @enderror" 
                                    name="evidencia" @if ($vacio == 0) value="{{ old('evidencia') }}" @endif @foreach ($previo as $ant) @if($ant->evidencia == NULL) value="{{ old('evidencia') }}" @else value="{{$ant->evidencia}}" @endif @endforeach placeholder="evidencia" required autofocus>
                                @error('evidencia')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fechaCompReqR"
                                class="col-sm-2 text-end control-label col-form-label">Fecha Compromiso para Entrega Real*</label>
                            <div class= 'col-md-8'>
                                <div class="input-group">
                                    <input name = "fechaCompReqR"
                                        @if ($vacio == 0) value="{{ old('fechaCompReqR') }}" @endif 
                                        @foreach ($previo as $ant)
                                            @if ($ant->fechaCompReqR <> NULL)
                                                value="{{date('d-m-20y',strtotime($ant->fechaCompReqR))}}" 
                                            @else
                                                value="{{ old('fechaCompReqR') }}"
                                            @endif 
                                        @endforeach type="text" class="form-control mydatepicker required form-control @error('fechaCompReqR') is-invalid @enderror" id="datepicker-autoclose" placeholder="DD-MM-AAAA" data-date-format="dd-mm-yyyy">
                                    <div class="input-group-append">
                                        <span class="input-group-text h-100">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                    @error('fechaCompReqR')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 text-end form-check-label" for="desfase">Se Generó desfase</label>
                            <div class="col-md-8">
                                <input type="checkbox" class="form-check-input" id="desfase" name="desfase" {{ (! empty(old('desfase')) ? 'checked' : '') }} @foreach ($previo as $ant) @if ($ant->desfase==1) checked="true" @endif @endforeach onchange="javascript:showContent()">
                            </div>
                        </div>
                        <div id="content" @if($vacio <> 0) @foreach ($previo as $ant) @if ($ant->desfase == 1) style="display: block;" @else style="display: none;" @endif @endforeach @else style='display: none;' @endif>
                            <div class="form-group row">
                                <label for="motivodesfase"
                                    class="col-sm-2 text-end control-label col-form-label">Motivo de desfase*</label>
                                <div class="col-md-8">
                                    <select class="form-select @error ('motivodesfase') is-invalid @enderror" style="width: 100%; height:36px;"
                                        id="motivodesfase" name="motivodesfase" tabindex="-1" aria-hidden="true" autofocus onchange="javascript:showPause()">
                                        @foreach ($previo as $ant)    
                                            @if ($ant->motivodesfase <> null)
                                                <option value={{$ant->motivodesfase}}>
                                                    @foreach ($desfases as $desfase)
                                                        @if($desfase->id == $ant->motivodesfase)
                                                            {{$desfase->motivo}}
                                                        @endif
                                                    @endforeach
                                                </option>
                                            @endif
                                        @endforeach
                                        <option value={{null}}>Selección</option>
                                        @foreach ( $desfases as  $desfase)
                                            <option value={{ $desfase->id}}>{{ $desfase->motivo}}</option>
                                        @endforeach 
                                        <!--@error('motivodesfase')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror -->                         
                                    </select>
                                </div>
                            </div>
                            <div id="pause"  @if($vacio <> 0) @foreach ($previo as $ant) @if($ant->motivodesfase <> 6) style="display: none;" @endif @endforeach @else style='display: none;' @endif>
                                <div class="form-group row">
                                    <label for="motivopausa"
                                        class="col-sm-2 text-end control-label col-form-label">Motivo de Pausa</label>
                                    <div class="col-md-8">
                                        <input type="text" class="required form-control @error('motivopausa') is-invalid @enderror" 
                                            name="motivopausa" @foreach ($previo as $ant) value="{{$ant->motivopausa}}" @endforeach placeholder="Motivo" autofocus>
                                        <!--@error('motivopausa')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror-->
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="evpausa"
                                        class="col-sm-2 text-end control-label col-form-label">Evidencia de Pausa</label>
                                    <div class="col-md-8">
                                        <input type="text" class="required form-control @error('evpausa') is-invalid @enderror" 
                                            name="evpausa" @foreach ($previo as $ant) value="{{$ant->evPausa}}" @endforeach placeholder="Link de Evidencia" autofocus>
                                        <!--@error('evpausa')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror-->
                                    </div>
                                </div>
                            </div>
                            <div id="other" @if($vacio <> 0) @foreach ($previo as $ant) @if($ant->motivodesfase <> 7) style="display: none;" @endif @endforeach @else style='display: none;' @endif>
                                <div class="form-group row">
                                    <label for="otromotivo"
                                        class="col-sm-2 text-end control-label col-form-label">Motivo</label>
                                    <div class="col-md-8">
                                        <input type="text" class="required form-control @error('otromotivo') is-invalid @enderror" 
                                            name="motivopausa" @foreach ($previo as $ant) value="{{$ant->motivopausa}}" @endforeach placeholder="Otro Motivo" autofocus>
                                        <!--@error('otromotivo')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror-->
                                    </div>
                                </div>
                            </div>  
                            <div class="form-group row">
                                <label for="fechareact"
                                class="col-sm-2 text-end control-label col-form-label">Fecha de Reactivación</label>
                                <div class= 'col-md-8'>
                                    <div class="input-group">
                                        <input name="fechareact"  type="text" class="form-control mydatepicker required form-control @error('fechareact') is-invalid @enderror"placeholder="DD-MM-AAAA" data-date-format="dd-mm-yyyy"
                                            @foreach ($previo as $ant)
                                                @if ($ant->fechareact <> NULL)
                                                    value="{{date('d-m-20y',strtotime($ant->fechareact))}}" 
                                                @else
                                                    value="{{ old('fechareact') }}"
                                                @endif 
                                            @endforeach>
                                        <div class="input-group-append">
                                            <span class="input-group-text h-100">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </div>
                                        @error('fechareact')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <div class="card-body text-center">
                                <a class="fas fa-diagnoses fa-2x" style="text-align: center;color:rgb(44,52,91); display: inline-block; width: 100%;" href="{{route('Informacion',$registro->folio)}}"></a>
                                <a style='text-align: center'>Solicitar Información</a>
                            </div>
                            @if ($solinf == 0)
                                <button type="submit" name="id_estatus" value="7" class="btn btn-primary text-white">Guardar y Continuar</button>
                            @else
                                <button type="button" id="slide-toast" class="btn btn-primary text-white">Guardar y Continuar</button>
                            @endif
                            <button type="submit" name="id_estatus" value="9" class="btn btn-success text-white">Guardar</button>
                            <label> </label> 
                            <button type="reset" value="reset" class="btn btn-danger"><a href="{{('formatos.requerimientos.edit') }}" style="color:white">Cancelar</a></button>
                        </div>
                    </section>
                </div>
            </form>
        </div>
    </div>

    <form class="form-horizontal" action="" method="post">
    <h5>*Campos obligatorios</h5>
    
    <script src="{{asset("assets/extra-libs/toastr/dist/build/toastr.min.js")}}"></script>
    <script src="{{asset("assets/extra-libs/toastr/toastr-init.js")}}"></script>
    <script type="text/javascript">
        function showContent() {
            element = document.getElementById("content");
            check = document.getElementById("desfase");
            if (check.checked) {
                element.style.display='block';
                check.value= 1;
            }
            else {
                element.style.display='none';
                check.value= 0;
            }
        }
        function showPause() {
            element = document.getElementById("pause");
            otro = document.getElementById('other')
            elementodesfase = document.getElementById('motivodesfase');
            indiceSeleccionado = elementodesfase.value;
            if (indiceSeleccionado == 6) {
                element.style.display='block';
                otro.style.display='none';
            }else{
                if(indiceSeleccionado == 7) {
                    otro.style.display='block';
                    element.style.display='none';
                }else{
                    otro.style.display='none';
                    element.style.display='none';
                }
            }
        }
    </script>

@endsection 