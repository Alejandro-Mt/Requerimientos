@extends('home')
@section('content')

<body>
    <div class="card">
        <div class="card-body wizard-content">
            <h4 class="card-title">Nuevo</h4>
            <h6 class="card-subtitle"></h6>
            <form id="example-form" action="#" class="mt-5">
                <div>
                    <h3>Requerimiento</h3>
                    <section>
                        <p>(*) Campos Obligatorios</p>
                        <div class="form-group row">
                            <label for="ID"
                                class="col-sm-2 text-end control-label col-form-label">ID</label>
                            <div class="col-md-3">
                                <input type="text" class="required form-control" id="ID" 
                                    placeholder="Default" readonly="readonly">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bitrix"
                                    class="col-sm-2 text-end control-label col-form-label">Bitrix</label>
                            <div class="col-sm-3">
                                <input type="text" class="required form-control" id="bitrix" 
                                    placeholder="Default" readonly="readonly">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="descripcion"
                                class="col-sm-2 text-end control-label col-form-label">Descripción*</label>
                            <div class="col-md-8">
                                <input type="text" class="required form-control" id="descripcion"
                                    placeholder="Descripcion">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ejecutivo"
                                class="col-sm-2 text-end control-label col-form-label">Ejecutivo de Cuenta*</label>
                            <div class="col-md-8">
                                <select class="form-select shadow-none select2-hidden-accessible"   style="width: 100%; height:36px;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                    <option value="0">Seleccion</option>
                                    @foreach ($responsable as $ejecutivo):
                                        @if ($ejecutivo ->id_area == 2)
                                            <option value = {{ $ejecutivo->id_responsable }}>{{$ejecutivo->nombre_r}}</option>;
                                        @endif
                                    @endforeach                     
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Sistema"
                                class="col-sm-2 text-end control-label col-form-label">Sistema*</label>
                            <div class="col-md-8">
                                <select class="form-select shadow-none select2-hidden-accessible"   style="width: 100%; height:36px;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                    <option data-select2-id="0">Seleccion</option>
                                    @foreach ($sistema as $valores):
                                        <option value={{$valores->id_sistema}}>{{$valores->nombre_s}}</option>;
                                    @endforeach;                          
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Cliente"
                                class="col-sm-2 text-end control-label col-form-label">Cliente*</label>
                            <div class="col-md-8">
                                <select class="form-select shadow-none select2-hidden-accessible" style="width: 100%; height:36px;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                    <option data-select2-id="0">Seleccion</option>
                                    @foreach ($cliente as $cliente)
                                        <option value={{$cliente->id_cliente}}>{{$cliente->nombre_cl}}</option>
                                    @endforeach                           
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Arquitecto"
                                class="col-sm-2 text-end control-label col-form-label">Arquitecto de Soluciones*</label>
                            <div class="col-md-8">
                                <select class="form-select shadow-none select2-hidden-accessible"   style="width: 100%; height:36px;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                    <option data-select2-id="0">Seleccion</option>
                                    @foreach ($responsable as $arqutecto)
                                        @if ($arqutecto ->id_area == 1)
                                            <option value = {{ $arqutecto->id_responsable }}>{{$arqutecto->nombre_r}}</option>;
                                        @endif    
                                    @endforeach                             
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Prioridad"
                                class="col-sm-2 text-end control-label col-form-label">Prioridad*</label>
                            <div class="col-md-8">
                                <select class="form-select shadow-none select2-hidden-accessible"   style="width: 100%; height:36px;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                    <option data-select2-id="0">Seleccion</option>
                                    <option value='1'>Baja</option>
                                    <option value='2'>Media</option>
                                    <option value='3'>Alta</option>
                                    <option value='4'>Critica</option>                         
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Fecha"
                            class="col-sm-2 text-end control-label col-form-label">Fecha*</label>
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
                        <div class="card-body text-center">
                            <button type="submit" class="btn btn-success text-white">Guardar</button>
                            <label> </label> 
                            <button type="submit" class="btn btn-danger text-white">Cancelar</button>
                        </div>
                    </section>
                </div>
            </form>
        </div>
    </div>

    <form class="form-horizontal" action="" method="post">
    <h5>*Campos obligatorios</h5>

</body>

@endsection 