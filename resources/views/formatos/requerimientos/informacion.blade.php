@extends('home')
@section('content')

    <div class="card">
        <div class="card-body wizard-content">
            <h3>Indicador</h3>
            <p>(*) Campos Obligatorios</p>
            <h6 class="card-subtitle"></h6>
            <form method="POST" action="{{route ('Nuevo')}}" class="mt-5">
                {{ csrf_field() }}
                <div>
                    <section>
                       <!-- <div class="form-group row">
                            <label for="Folio"
                                    class="col-sm-2 text-end control-label col-form-label">Folio</label>
                            <div class="col-sm-3">
                                <input type="text" class="required form-control" name="folio" value="PIP-{{$id->id_registro+1}}" readonly="readonly">
                            </div>
                        </div>-->
                        <div class="form-group row">
                            <label for="fechaCompReqC"
                            class="col-sm-2 text-end control-label col-form-label">Solicitar informacion a PIP*</label>
                            <div class= 'col-md-8'>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="datepicker-autoclose" placeholder="MM/DD/AAAA">
                                    <div class="input-group-append">
                                        <span class="input-group-text h-100">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fechaCompReqC"
                            class="col-sm-2 text-end control-label col-form-label">Solicitar informacion a PIP*</label>
                            <div class= 'col-md-8'>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="datepicker-autoclose" placeholder="MM/DD/AAAA">
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
                            <label for="fechaCompReqR"
                            class="col-sm-2 text-end control-label col-form-label">Solicitud a Cliente*</label>
                            <div class= 'col-md-8'>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="datepicker-autoclose" placeholder="MM/DD/AAAA">
                                    <div class="input-group-append">
                                        <span class="input-group-text h-100">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="form-check-label" for="retraso">Retaraso en Informacion</label>
                            <div class="col-md-6">
                                <input type="checkbox" class="form-check-input" id="retraso" name="retraso" value="1" onchange="javascript:showContent()">
                            </div>
                        </div>
                        <div id="content" style="display: none;">
                            <div class="form-group row">
                                <label for="motivoretraso"
                                    class="col-sm-2 text-end control-label col-form-label">Motivo de Desface*</label>
                                <div class="col-md-8">
                                    <select class="form-select @error ('motivoretraso') is-invalid @enderror" 
                                        style="width: 100%; height:36px;" name="motivodesface" tabindex="-1" aria-hidden="true" required autofocus>
                                        <option value={{null}}>Seleccion</option>
                                        @foreach ($cliente as $cliente)
                                            <option value={{$cliente->id_cliente}}>{{$cliente->nombre_cl}}</option>
                                        @endforeach 
                                        @error('motivoretraso')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror                          
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="d-none"> 
                                <input type="text" name="estatus" value="Informacion" visible="false">
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
            check = document.getElementById("retraso");
            if (check.checked) {
                element.style.display='block';
            }
            else {
                element.style.display='none';
            }
        }
    </script>

@endsection 