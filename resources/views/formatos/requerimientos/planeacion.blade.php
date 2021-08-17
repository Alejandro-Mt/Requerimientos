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
                                    <input name="fechaCompReqC" type="text" class="form-control" id="datepicker-autoclose" placeholder="MM/DD/AAAA">
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
                                    name="evidencia" placeholder="evidencia" required autofocus>
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
                                    <input name = "fechaCompReqR" type="text" class="form-control" id="datepicker-autoclose" placeholder="MM/DD/AAAA">
                                    <div class="input-group-append">
                                        <span class="input-group-text h-100">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="form-check-label" for="desface">Se Genero Desface</label>
                            <div class="col-md-6">
                                <input type="checkbox" class="form-check-input" id="desface" name="desface" value="1" onchange="javascript:showContent()">
                            </div>
                        </div>
                        <div id="content" style="display: none;">
                            <div class="form-group row">
                                <label for="motivodesface"
                                    class="col-sm-2 text-end control-label col-form-label">Motivo de Desface*</label>
                                <div class="col-md-8">
                                    <select class="form-select @error ('motivodesface') is-invalid @enderror" style="width: 100%; height:36px;"
                                        id="motivodesface" name="motivodesface" tabindex="-1" aria-hidden="true" autofocus onchange="javascript:showPause()">
                                        <option value={{null}}>Seleccion</option>
                                        @foreach ($desfaces as $desface)
                                            <option value={{$desface->id}}>{{$desface->motivo}}</option>
                                        @endforeach 
                                        <!--@error('motivodesface')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror -->                         
                                    </select>
                                </div>
                            </div>
                            <div id="pause" style="display: none;">
                                <div class="form-group row">
                                    <label for="motivopausa"
                                        class="col-sm-2 text-end control-label col-form-label">Motivo de Pausa</label>
                                    <div class="col-md-8">
                                        <input type="text" class="required form-control @error('motivopausa') is-invalid @enderror" 
                                            name="motivopausa" placeholder="Motivo" autofocus>
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
                                            name="evpausa" placeholder="Link de Evidencia" autofocus>
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
                                            <input name="fechareact" type="text" class="form-control" id="datepicker-autoclose" placeholder="MM/DD/AAAA">
                                            <div class="input-group-append">
                                                <span class="input-group-text h-100">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-none"> 
                                    <input type="text" name="id_estatus" value="9" visible="false">
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <button type="submit" class="btn btn-success text-white">Guardar</button>
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
            check = document.getElementById("desface");
            if (check.checked) {
                element.style.display='block';
                
            }
            else {
                element.style.display='none';
                <div class="d-none"> 
                    <input type="text" name="desface" value="0">
                </div>
            }
        }
    </script>
    <script type="text/javascript">
        function showPause() {
            element = document.getElementById("pause");
            elementoDesface = document.getElementById('motivodesface');
            indiceSeleccionado = elementoDesface.selectedIndex;
            if (indiceSeleccionado == 5) {
                element.style.display='block';
            }
            else {
                element.style.display='none';
            }
        }
    </script>

@endsection 