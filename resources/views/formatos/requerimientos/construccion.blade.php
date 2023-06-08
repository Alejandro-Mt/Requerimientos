@extends('home')
@section('content')

<link href="{{asset("assets/extra-libs/toastr/dist/build/toastr.min.css")}}" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <div class="card">
        <div class="box bg-cyan text-center">
            <!--<h5 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i></h5>-->
            <h3 class="text-white">CONSTRUCCIÓN</h3>
        </div>
        <section>
            <div class="row">
                <div class="col-md-12">
                    <!-- ---------------------
                        start Drag & Drop Event
                            ---------------- -->
                    <div class="row">
                        <div class="col-lg-3 border-right pe-0">
                            <div class="card-body border-bottom">
                                <h4 class="card-title mt-2">Arrastra & Borra Eventos</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="calendar-events" class="">
                                            <div class="calendar-events mb-3 d-flex align-items-center" data-class="bg-danger"><i
                                                    class="fa fa-circle text-danger me-2"></i>Construcción
                                            </div>
                                            <div class="calendar-events mb-3 d-flex align-items-center" data-class="bg-warning"><i
                                                    class="fa fa-circle text-warning me-2"></i>Liberación
                                            </div>
                                        </div>
                                        <!-- checkbox -->
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input"
                                                id="drop-remove">
                                            <label class="form-check-label" for="drop-remove">Uso Único</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="card-body calender-sidebar">
                                <div id="calendar"></div>
                            </div>
                        </div>
                    </div>
                    <!-- ---------------------
                        end Drag & Drop Event
                            ---------------- -->
                </div>
            </div>
            <!-- BEGIN MODAL -->
            <div class="modal" id="my-event">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header d-flex align-items-center">
                        <h4 class="modal-title"><strong> Editar Evento</strong></h4>
                        <button type="button" class="btn-close close-dialog" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body"></div>
                        <div class="modal-footer">
                        <button type="button" class="btn close-dialog waves-effect" data-bs-dismiss="modal" aria-label="Close"> Cerrar</button>
                        <button type="button" class="btn btn-success save-event waves-effect waves-light" style="color: white"> Crear Evento</button>
                        <button type="button" class="btn btn-danger delete-event waves-effect waves-light" style="color: white" data-bs-dismiss="modal"> Borrar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-backdrop bckdrop hide"></div>
            <!-- Modal Agregar Categoria -->
            <div class="modal" id="add-new-event">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header d-flex align-items-center">
                        <h4 class="modal-title"><strong>Añadir Evento</strong></h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <form>
                            <div class="row">
                            <div class="col-md-6">
                                <label class="control-label">Titulo</label>
                                <input class="form-control form-white" placeholder="Ingresa Titulo" type="text" name="category-name"
                                />
                            </div>
                            <div class="col-md-6">
                                <label class="control-label">Selecciona Color</label>
                                <select class="form-select form-white" name="category-color">
                                <option selected value="{{NULL}}">Seleccione</option>
                                <option value="success">Verde</option>
                                <option value="danger">Rojo</option>
                                <option value="info">Azul</option>
                                <option value="primary">Cian</option>
                                <option value="warning">Amarillo</option>
                                <option value="inverse">Gris</option>
                                </select>
                            </div>
                            </div>
                        </form>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn waves-effect" data-bs-dismiss="modal"> Cerrar</button>
                        <button type="button" class="btn btn-success waves-effect waves-light save-category" style="color: white" data-bs-dismiss="modal"> Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MODAL -->
        </section>
        <div class="card-body wizard-content">
            <h3>Desarrollo</h3>
            <p>(*) Campos Obligatorios</p>
            <h6 class="card-subtitle"></h6>
            <form method="POST" action="{{route ('Construir')}}" class="mt-5">
                {{ csrf_field() }}
                <div>
                    <section>
                        <div class="form-group row">
                            <label for="Folio"
                                    class="col-sm-2 text-end control-label col-form-label">Folio</label>
                            <div class="col-sm-3">
                                    <input type="text" class="required form-control" name="folio" value="{{$registros->folio}}" readonly="readonly">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fechaCompReqC"
                                class="col-sm-2 text-end control-label col-form-label">Fecha Compromiso para Entrega*</label>
                            <div class= 'col-md-8'>
                                <div class="input-group">
                                    <input name="fechaInConP" type="text" class="form-control mydatepicker required form-control @error('fechaInConP') is-invalid @enderror" placeholder="DD-MM-AAAA" data-date-format="dd-mm-yyyy"  required autofocus
                                        @if ($vacio == 0) value="{{ old('fechaInConP') }}" @endif 
                                        @foreach ($previo as $ant)
                                            @if ($ant->fechaCompReqC == NULL)
                                                value="{{ old('fechaInConP') }}"
                                            @else
                                                value="{{date('d-m-20y',strtotime($ant->fechaCompReqC))}}" 
                                            @endif 
                                        @endforeach >
                                    <div class="input-group-append">
                                        <span class="input-group-text h-100">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                    @error('fechaInConP')
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
                                    <input name = "fechaInConR"
                                        @if ($vacio == 0) value="{{ old('fechaInConR') }}" @endif 
                                        @foreach ($previo as $ant)
                                            @if ($ant->fechaCompReqR <> NULL)
                                                value="{{date('d-m-20y',strtotime($ant->fechaCompReqR))}}" 
                                            @else
                                                value="{{ old('fechaInConR') }}"
                                            @endif 
                                        @endforeach type="text" class="form-control mydatepicker required form-control @error('fechaInConR') is-invalid @enderror" id="datepicker-autoclose" placeholder="DD-MM-AAAA" data-date-format="dd-mm-yyyy">
                                    <div class="input-group-append">
                                        <span class="input-group-text h-100">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                    @error('fechaInConR')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 text-end form-check-label" for="complete">Completado</label>
                            <div class="col-md-8">
                                <input type="checkbox" class="form-check-input" id="id_estatus" name="id_estatus" value="7">
                            </div>
                        </div>
                        <input class="d-none" name="FechaLibP" value="{{null}}" type="text" class="form-control" data-date-format="dd-mm-yyyy">
                        <input class="d-none" name="FechaLibR" value="{{null}}" type="text" class="form-control" data-date-format="dd-mm-yyyy"> 
                        <input class="d-none" name="FechaImpP" value="{{null}}" type="text" class="form-control" data-date-format="dd-mm-yyyy">
                            <div class="card-body text-center">
                                <a class="fas fa-diagnoses fa-2x" style="text-align: center;color:rgb(44,52,91); display: inline-block; width: 100%;" href="{{route('Informacion',Crypt::encrypt($registros->folio))}}"></a>
                                <a style='text-align: center'>Solicitar Información</a>
                            </div>
                            <div class="card-body text-center">
                                @if ($solinf == 0)
                                    <button id="next" type="submit" value="8" class="btn btn-primary text-white" disabled>Guardar y Continuar</button>
                                @else
                                    <button type="button" id="slide-toast" class="btn btn-primary text-white">Guardar y Continuar</button>
                                @endif
                                <button type="submit" value="7" class="btn btn-success text-white">Guardar</button>
                                <label> </label> 
                                <button type="reset" value="reset" class="btn btn-danger"><a href="{{route('Documentos',Crypt::encrypt($registros->folio))}}" style="color:white">Cancelar</a></button>
                            </div>
                    </section>
                </div>
            </form>
        </div>
    </div>
    
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
                check.value = 0;
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
        $(document).ready(function () {
            $('#id_estatus').on('click', function () {
                if ($(this).is(':checked')) {
                console.log($(this));
                    $('#next').removeAttr('disabled');
                    $('#id_estatus').val('8');
                } else {
                console.log($(this));
                    $('#next').prop('disabled',true);
                    $('#id_estatus').val('7');
                }
            });
        });
    </script>

@endsection 