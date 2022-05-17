@extends('home')
@section('content')
<link href="{{asset("assets/extra-libs/toastr/dist/build/toastr.min.css")}}" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@if (session('alert'))
    <input class="d-none" id="folio" value={{ session('alert') }}>
    <script>
        $(document).ready(function(){
            toastr.success(
                "N° folio: " + $("#folio").val(),
                "¡Guardado!",
                { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 2000 }
            );
        });
    </script>
@endif

    <div class="card">
        <div class="box bg-dark text-center">
        <!--<h5 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i></h5>-->
            <h3 class="text-white">REQUERIMIENTO</h3>
        </div>
        <div class="card-body wizard-content">
            <h3>Requerimiento</h3>
            <p>(*) Campos Obligatorios</p>
            <h6 class="card-subtitle"></h6>
            <form method="POST" action="{{route ('Nuevo')}}" class="mt-5">
                {{ csrf_field() }}
                <div>
                    <section>
                        <!--<div class="form-group row">
                            <label for="id_registro"
                                class="col-sm-2 text-end control-label col-form-label">{{__('ID')}}</label>
                            <div class="col-md-3">
                                @if ($vacio == 0)
                                    <input id="id_registro" type="text" class="required form-control" 
                                        placeholder="{{1}}" readonly="readonly"> 
                                @else
                                    <input id="id_registro" type="text" class="required form-control" 
                                        placeholder="{{$id->id_registro+1}}" readonly="readonly">
                                @endif
                            </div>
                        </div>--
                        <div class="form-group row">
                            <label for="folio"
                                    class="col-sm-2 text-end control-label col-form-label">Folio</label>-->
                            <div class="d-none col-sm-3">
                                    <input  type="text" class="required form-control" name="folio" value={{$registros+1}} readonly="readonly">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="descripcion"
                                class="col-sm-2 text-end control-label col-form-label">Descripción*</label>
                            <div class="col-md-8">
                                <input type="text" class="required form-control @error('descripcion') is-invalid @enderror" name="descripcion" placeholder="Descripción" required autofocus
                                    @if ($datos != NULL)
                                        @foreach ($datos as $dato)
                                            value="{{$dato->descripcion}}"
                                        @endforeach
                                    @endif
                                >
                                @error('descripcion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ejecutivo"
                                class="col-sm-2 text-end control-label col-form-label">Responsable</label>
                            <div class="col-md-8">  
                                <select class="form-select @error('id_responsable') is-invalid @enderror" 
                                    style="width: 100%; height:36px;" name="id_responsable" tabindex="-1" aria-hidden="true" required autofocus>
                                    <option value={{null}}>Selección</option>
                                    @foreach ($responsable as $ejecutivo):
                                        @if ($ejecutivo ->id_area == 2)
                                            <option value = {{ $ejecutivo->id_responsable }}>{{$ejecutivo->apellidos}} {{$ejecutivo->nombre_r}}</option>;
                                        @endif
                                    @endforeach                     
                                </select>
                                @error('id_responsable')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Sistema"
                                class="col-sm-2 text-end control-label col-form-label">Sistema*</label>
                            <div class="col-md-8">
                                <select class="form-select @error ('id_sistema') is-invvalid @enderror" 
                                    style="width: 100%; height:36px;" name="id_sistema" tabindex="-1" aria-hidden="true" required autofocus>
                                    @if ($datos != NULL)
                                        @foreach ($datos as $dato)
                                            @foreach ($sistema as $id)
                                                @if ($id->id_sistema == $dato->id_sistema)
                                                    <option value="{{$id->id_sistema}}">{{$id->nombre_s}}</option>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @else  <option value="{{NULL}}">Selección</option>
                                    @endif
                                    @foreach ($sistema as $valores):
                                        <option value={{$valores->id_sistema}}>{{$valores->nombre_s}}</option>;
                                    @endforeach;  
                                    @error('id_sistema')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror                        
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Cliente"
                                class="col-sm-2 text-end control-label col-form-label">Cliente*</label>
                            <div class="col-md-8">
                                <select class="form-select @error ('id_cliente') is-invalid @enderror" 
                                    style="width: 100%; height:36px;" name="id_cliente" tabindex="-1" aria-hidden="true" required autofocus>
                                    @if ($datos != NULL)
                                        @foreach ($datos as $dato)
                                            @foreach ($cliente as $id)
                                                @if ($id->id_cliente == $dato->id_cliente)
                                                    <option value="{{$id->id_cliente}}">{{$id->nombre_cl}}</option>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @else  <option value="{{NULL}}">Selección</option>
                                    @endif
                                    @foreach ($cliente as $cliente)
                                        <option value={{$cliente->id_cliente}}>{{$cliente->nombre_cl}}</option>
                                    @endforeach 
                                    @error('id_cliente')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror                          
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Arquitecto"
                                class="col-sm-2 text-end control-label col-form-label">Arquitecto*</label>
                            <div class="col-md-8">  
                                <select class="form-select @error('id_arquitecto') is-invalid @enderror" 
                                    style="width: 100%; height:36px;" name="id_arquitecto" tabindex="-1" aria-hidden="true" required autofocus>
                                    <option value={{null}}>Selección</option>
                                    @foreach ($responsable as $arquitecto):
                                        @if ($arquitecto ->id_area == 12)
                                            <option value = {{ $arquitecto->id_responsable }}>{{$arquitecto->apellidos}} {{$arquitecto->nombre_r}}</option>;
                                        @endif
                                    @endforeach                     
                                </select>
                                @error('id_arquitecto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Clase"
                                class="col-sm-2 text-end control-label col-form-label">Clase*</label>
                            <div class="col-md-8">  
                                <select class="form-select @error('id_clase') is-invalid @enderror" 
                                    style="width: 100%; height:36px;" name="id_clase" tabindex="-1" aria-hidden="true" required autofocus>
                                    <option value={{null}}>Selección</option>
                                    @foreach ($clases as $clase):
                                        <option value = {{ $clase->id_clase }}>{{$clase->clase}}</option>;
                                    @endforeach                     
                                </select>
                                @error('id_clase')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Prioridad"
                                class="col-sm-2 text-end control-label col-form-label">Impacto*</label>
                            <div class="col-md-8">
                                <select class="form-select"   style="width: 100%; height:36px;" id="prioridad" tabindex="-1" aria-hidden="true">
                                    <option data-select2-id="0">Selección</option>
                                    <option value='1'>Baja</option>
                                    <option value='2'>Media</option>
                                    <option value='3'>Alta</option>
                                    <option value='4'>Crítica</option> 
                                    <option value='5'>Nula</option>                        
                                </select>
                            </div>
                        </div>
                        <div class="d-none">
                            @foreach ($estatus as $estatus)
                                <input type="text" name="id_area" value="6" visible="false">
                            @endforeach 
                        </div>
                        <div class="d-none">
                            <input type="text" name="id_estatus" value="17" visible="false">
                            <input type="text" name="id_area" value="6" visible="false">
                        </div>
                        <div class="card-body text-center">
                            <button type="submit" name="preregistro" @if($datos != NULL) @foreach ($datos as $dato) value="{{$dato->folio}}" @endforeach @endif class="btn btn-success text-white">Guardar</button>
                            <label> </label> 
                            <button href="{{('home') }}" type="reset" value="reset" class="btn btn-danger"><a href="{{('home') }}" style="color:white">Cancelar</a></button>
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


@endsection 