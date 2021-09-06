@extends('home')
@section('content')

    <div class="card">
        <div class="card-body wizard-content">
            <h3>Planeacion</h3>
            <p>(*) Campos Obligatorios</p>
            <h6 class="card-subtitle"></h6>
            <form method="POST" action="{{route ('Plan')}}" class="mt-5">
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
                                    class="col-sm-2 text-end control-label col-form-label">Fecha Compromiso para Entrega de Requerimientos*</label>
                                <div class= 'col-md-8'>
                                    <div class="input-group">
                                        <input name="fechaCompReqC" @foreach ($previo as $ant) value="{{$ant->fechaCompReqC}}" @endforeach type="text" class="form-control" id="datepicker-autoclose" placeholder="DD/MM/AAAA" data-date-format="yyyy-mm-dd">
                                        <div class="input-group-append">
                                            <span class="input-group-text h-100">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="evidencia"
                                    class="col-sm-2 text-end control-label col-form-label">Link de Evidencia*</label>
                                <div class="col-md-8">
                                    <input type="text" class="required form-control @error('evidencia') is-invalid @enderror" 
                                        name="evidencia" @foreach ($previo as $ant) value="{{$ant->evidencia}}" @endforeach placeholder="evidencia" required autofocus>
                                    @error('evidencia')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fechaCompReqR"
                                    class="col-sm-2 text-end control-label col-form-label">Fecha Compromiso para Entrega de Requerimientos Real*</label>
                                <div class= 'col-md-8'>
                                    <div class="input-group">
                                        <input name = "fechaCompReqR" @foreach ($previo as $ant) value="{{$ant->fechaCompReqR}}" @endforeach type="text" class="form-control mydatepicker" id="datepicker-autoclose" placeholder="DD/MM/AAAA" data-date-format="yyyy-mm-dd">
                                        <!--<input type="text" class="form-control mydatepicker" placeholder="dd/mm/yyyy">-->
                                        <div class="input-group-append">
                                            <span class="input-group-text h-100">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                    <label class="col-sm-2 text-end form-check-label" for="desfase">Se Genero desfase</label>
                                <div class="col-md-8">
                                    <input type="checkbox" class="form-check-input" id="desfase" name="desfase" value="1" @foreach ($previo as $ant) @if ($ant->desfase==1) checked=true @endif @endforeach onchange="javascript:showContent()">
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
                                            
                                            <option value={{null}}>Seleccion</option>
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
                                                name="motivopausa" @foreach ($previo as $ant) value={{$ant->motivopausa}} @endforeach placeholder="Motivo" autofocus>
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
                                    <div class="form-group row">
                                        <label for="fechareact"
                                        class="col-sm-2 text-end control-label col-form-label">Fecha de Reactivacion</label>
                                        <div class= 'col-md-8'>
                                            <div class="input-group">
                                                <input name="fechareact" @foreach ($previo as $ant) value="{{$ant->fechaReact}}" @endforeach type="text" class="form-control mydatepicker"  placeholder="DD/MM/AAAA" data-date-format="yyyy-mm-dd">
                                                <div class="input-group-append">
                                                    <span class="input-group-text h-100">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                </div>
                                            </div>
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
                            </div>
                        <div class="card-body text-center">
                            <button type="submit" name="id_estatus" value="9" class="btn btn-primary text-white">Guardar y Continuar</button>
                            <button type="submit" name="id_estatus" value="11" class="btn btn-success text-white">Guardar</button>
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

    <script type="text/javascript">
        function showContent() {
            element = document.getElementById("content");
            check = document.getElementById("desfase");
            if (check.checked) {
                element.style.display='block'
            }
            else {
                element.style.display='none'
            }
        }
    </script>
    <script type="text/javascript">
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