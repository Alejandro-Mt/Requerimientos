@extends('home')
@section('content')

    <div class="card">
        @if(session('error'))
            <div class="toast show mb-2 text-white bg-light-danger border-0 remove-close-icon " role="alert" aria-live="polite" aria-atomic="true" style="position: absolute; top: 0; right: 50;">
                <div class="d-flex align-items-center">
                <div class="toast-body">
                    <div class="d-flex align-items-center text-danger font-weight-medium">
                    <i data-feather="info" class="fill-white feather-sm me-2"></i>
                    {{ session('error') }}
                    </div>
                </div>
                <button type="button" class="btn-close ms-auto me-2 d-flex align-items-center" data-bs-dismiss="toast" aria-label="Close">
                    <i data-feather="x" class="feather-sm fill-white text-danger"></i>
                </button>
                </div>
            </div>
        @endif
        <div class="box bg-warning text-center">
        <!--<h5 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i></h5>-->
            <h3 class="text-white">IMPLEMENTACIÓN</h3>
        </div>
        <div class="card-body wizard-content">
        <!--<h3>Implementación</h3>-->
            <p>(*) Campos Obligatorios</p>
            <h6 class="card-subtitle"></h6>
            <form method="POST" action="{{route ('Implementar')}}" class="mt-5">
                {{ csrf_field() }}
                <div>
                    <section>
                        <div class="form-group row">
                            <label for="Folio"
                                    class="col-sm-2 text-end control-label col-form-label">Folio</label>
                            <div class="col-sm-3">
                                <input id="folio" type="text" class="required form-control" name="folio" value="{{$registros->folio}}" readonly="readonly">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 text-end form-check-label" for="cronograma">Cronograma</label>
                            <div class="col-md-6">
                                <input type="checkbox" class="form-check-input" id="cronograma" name="cronograma" value="1" @foreach ($previo as $ant) @if ($ant->cronograma==1) checked=true @endif @endforeach onchange="showContent()">
                            </div>
                        <div id="content" @if($vacio <> 0) @foreach ($previo as $ant) @if ($ant->cronograma == 1) style="display: block;" @else style="display: none;" @endif @endforeach @else style='display: none;' @endif>
                            <div class="form-group row">
                                <label for="link_c"
                                    class="col-sm-2 text-end control-label col-form-label">Evidencia*</label>
                                <div class="col-md-8">
                                    <input type="text" class="required form-control @error('link_c') is-invalid @enderror" 
                                        name="link_c" placeholder="Link De Cronograma" @foreach ($previo as $ant) value="{{$ant->link_c}}" @endforeach>
                                    <!--@error('link_c')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror-->
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="f_implementacion"
                                class="col-sm-2 text-end control-label col-form-label">Fecha de Implementación*</label>
                            <div class= 'col-md-8'>
                                <div class="input-group">
                                    <input name="f_implementacion" type="text" class="form-control mydatepicker required form-control @error('f_implementacion') is-invalid @enderror"
                                    @if ($vacio == 0) value="{{ old('f_implementacion') }}" @endif 
                                    @foreach ($previo as $ant) 
                                        @if($ant->f_implementacion == null) value="{{ old('f_implementacion') }}"
                                            @else value="{{date('d-m-20y',strtotime($ant->f_implementacion))}}"
                                        @endif
                                    @endforeach placeholder="DD/MM/AAAA" data-date-format="dd-mm-yyyy">
                                    <div class="input-group-append">
                                        <span class="input-group-text h-100">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                    @error('f_implementacion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="estatus_f"
                                class="col-sm-2 text-end control-label col-form-label">Estatus de Funcionalidad*</label>
                            <div class="col-md-8">
                                <select class="form-select @error ('estatus_f') is-invalid @enderror" style="width: 100%; height:36px;"
                                    id="estatus_f" name="estatus_f" aria-hidden="true" autofocus>
                                    @foreach ($previo as $ant)    
                                        @if ($ant->estatus_f <> null)
                                            <option value={{$ant->estatus_f}}>
                                                @foreach ($desfases as $desfase)
                                                    @if($desfase->id_estatus == $ant->estatus_f)
                                                        {{$desfase->titulo}}
                                                    @endif
                                                @endforeach
                                            </option>
                                        @endif
                                    @endforeach
                                    
                                    <option value={{null}}>Selección</option>
                                    @foreach ( $desfases as  $desfase)
                                        <option value={{ $desfase->id_estatus}}>{{ $desfase->titulo}}</option>
                                    @endforeach 
                                    <!--@error('motivodesfase')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror -->                         
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="seguimiento"
                                class="col-sm-2 text-end control-label col-form-label">Seguimiento</label>
                            <div class="col-md-8">
                                <input type="text" class="required form-control" 
                                    name="seguimiento" placeholder="Presenta Fallas?">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="comentarios"
                                class="col-sm-2 text-end control-label col-form-label">Comentarios</label>
                            <div class="col-md-8">
                                <input type="text" class="required form-control" 
                                    name="comentarios" placeholder="Hasta 250 caracteres">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 text-end form-check-label" for="complete">Completado</label>
                            <div class="col-md-8">
                                <input type="checkbox" class="form-check-input" id="id_estatus" name="id_estatus" value="18" data-bs-toggle="modal" data-bs-target="#Auto2">
                            </div>
                              
                        </div>
                        <div class="card-body text-center">
                            <button type="submit" name="id_estatus" value="2" class="btn btn-success text-white">Guardar</button>
                            <label> </label> 
                            <button type="reset" value="reset" class="btn btn-danger"><a href="{{route('Documentos',Crypt::encrypt($registros->folio))}}" style="color:white">Cancelar</a></button>
                        </div>
                    </section>
                </div>
            </form>
        </div>
    </div>
    @include('formatos.requerimientos.desplegables.archivos')
    <form class="form-horizontal" action="" method="post">
    <h5>*Campos obligatorios</h5>

<script type="text/javascript">
    function showContent() {
        element = document.getElementById("content");
        check = document.getElementById("cronograma");
        if (check.checked) {
            element.style.display='block'
        }
        else {
            element.style.display='none'
        }
    }
</script>

@endsection 
