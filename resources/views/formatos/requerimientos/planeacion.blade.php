@extends('home')
@section('content')

    <div class="card">
        <div class="card-body wizard-content">
            <div class="row mb-3">
                <div class="col-lg-10">
                  <h3 class="u-align-right u-text u-text-default u-title u-text-1">Planeacion</h3>
                </div>
            </div>
            <p class="u-align-left u-text u-text-2">(*) Campos Obligatorios</p>
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
                                    class="col-sm-2 text-end control-label col-form-label">Fecha Compromiso para Entrega*</label>
                                <div class= 'col-md-8'>
                                    <div class="input-group">
                                        <input name="fechaCompReqC" @foreach ($previo as $ant) value="{{date('d-m-20y',strtotime($ant->fechaCompReqC))}}" @endforeach type="text" class="form-control" id="datepicker-autoclose" placeholder="DD/MM/AAAA" data-date-format="dd-mm-yyyy">
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
                                    class="col-sm-2 text-end control-label col-form-label">Fecha Compromiso para Entrega Real*</label>
                                <div class= 'col-md-8'>
                                    <div class="input-group">
                                        <input name = "fechaCompReqR" @foreach ($previo as $ant) value="{{date('d-m-20y',strtotime($ant->fechaCompReqR))}}" @endforeach type="text" class="form-control mydatepicker" id="datepicker-autoclose" placeholder="DD/MM/AAAA" data-date-format="dd-mm-yyyy">
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
                                    class="col-sm-2 text-end control-label col-form-label">Fecha de Reactivacion</label>
                                    <div class= 'col-md-8'>
                                        <div class="input-group">
                                            <input name="fechareact" @foreach ($previo as $ant) value="{{date('d-m-20y',strtotime($ant->fechaReact))}}" @endforeach type="text" class="form-control mydatepicker"  placeholder="DD/MM/AAAA" data-date-format="dd-mm-yyyy">
                                            <div class="input-group-append">
                                                <span class="input-group-text h-100">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body text-center">
                                <a class="fas fa-diagnoses fa-2x" style="text-align: center;color:rgb(44,52,91); display: inline-block; width: 100%;" href="{{route('Informacion',$registro->folio)}}"></a><p>Solicitar Informacion</p>
                            </div>
                        <div class="card-body text-center">
                            <button type="submit" name="id_estatus" value="9" class="btn btn-primary text-white">Guardar y Continuar</button>
                            <button type="submit" name="id_estatus" value="11" class="btn btn-success text-white">Guardar</button>
                            <label> </label> 
                            <button type="reset" value="reset" class="btn btn-danger"><a href="{{('formatos.requerimientos.edit') }}" style="color:white">Cancelar</a></button>
                        </div>
                    </section>
                    <section>
                        <div class="container-fluid">
                            <!-- ============================================================== -->
                            <!-- Start Page Content -->
                            <!-- ============================================================== -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="">
                                            <div class="row">
                                                <div class="col-lg-3 border-right pe-0">
                                                    <div class="card-body border-bottom">
                                                        <h4 class="card-title mt-2">Drag & Drop Event</h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div id="calendar-events" class="">
                                                                    <div class="calendar-events mb-3" data-class="bg-info"><i
                                                                            class="fa fa-circle text-info me-2"></i>Evento Uno
                                                                    </div>
                                                                    <div class="calendar-events mb-3" data-class="bg-success"><i
                                                                            class="fa fa-circle text-success me-2"></i>Evento Dos
                                                                    </div>
                                                                    <div class="calendar-events mb-3" data-class="bg-danger"><i
                                                                            class="fa fa-circle text-danger me-2"></i>Evento Tres
                                                                    </div>
                                                                    <div class="calendar-events mb-3" data-class="bg-warning"><i
                                                                            class="fa fa-circle text-warning me-2"></i>Evento Cuatro
                                                                    </div>
                                                                </div>
                                                                <!-- checkbox -->
                                                                <div class="form-check">
                                                                    <input type="checkbox" class="form-check-input"
                                                                        id="drop-remove">
                                                                    <label class="cform-check-label" for="drop-remove">Remove
                                                                        after drop</label>
                                                                </div>
                                                                <a href="javascript:void(0)" data-toggle="modal"
                                                                    data-target="#add-new-event"
                                                                    class="btn mt-3 btn-info d-block waves-effect waves-light">
                                                                    <i class="ti-plus"></i> Nuevo Evento
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9">
                                                    <div class="card-body b-l calender-sidebar">
                                                        <div id="calendar"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- BEGIN MODAL -->
                            <div class="modal none-border" id="my-event">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title"><strong>Añadir Evento</strong></h4>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true">&times;</button>
                                        </div>
                                        <div class="modal-body"></div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary waves-effect"
                                                data-dismiss="modal">Cerrar</button>
                                            <button type="button" class="btn btn-success save-event waves-effect waves-light">Crear
                                                Evento</button>
                                            <button type="button" class="btn btn-danger delete-event waves-effect waves-light"
                                                data-dismiss="modal">Quitar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal Add Category -->
                            <div class="modal none-border" lang="es" id="add-new-event">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title"><strong></strong>Nueva categoria</h4>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="control-label">Nombre</label>
                                                        <input class="form-control form-white" placeholder="Ingresa Nombre" type="text"
                                                            name="category-name" />
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="control-label">Selecciona un color</label>
                                                        <select class="form-select shadow-none form-white" data-placeholder="Choose a color..."
                                                            name="category-color">
                                                            <option value="success">Verde</option>
                                                            <option value="danger">Amarillo</option>
                                                            <option value="info">Azul</option>
                                                            <option value="primary">Gris</option>
                                                            <option value="warning">Rojo</option>
                                                            <option value="inverse">Blanco</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger waves-effect waves-light save-category"
                                                data-dismiss="modal">Guardar</button>
                                            <button type="button" class="btn btn-inverse waves-effect"
                                                data-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END MODAL -->
                            <!-- ============================================================== -->
                            <!-- End PAge Content -->
                            <!-- ============================================================== -->
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
    
<script>
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        navLinks: true, // can click day/week names to navigate views
        selectable: true,
        selectMirror: true,
        select: function(arg) {
          var title = prompt('Titulo del Evento:');
          if (title) {
            calendar.addEvent({
              title: title,
              start: arg.start,
              end: arg.end,
              allDay: arg.allDay
            })
          }
          calendar.unselect()
        },
        eventClick: function(arg) {
          if (confirm('Seguro que quieres eliminar este evento?')) {
            arg.event.remove()
          }
        },
        editable: true,
        dayMaxEvents: true, // allow "more" link when too many events
        });
  
      calendar.render();
    });
</script>
@endsection 