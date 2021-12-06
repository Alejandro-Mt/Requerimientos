@extends('home')
@section('content')
<link href="{{asset("assets/extra-libs/toastr/dist/build/toastr.min.css")}}" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    @if (session('alert'))
        <input class="d-none" id="folioM" value={{ session('alert') }}>
        <script>
            $(document).ready(function(){
                toastr.success(
                    "N° folio: " + $("#folioM").val(),
                    "¡Guardado!",
                    { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 2000 }
                );
            });
        </script>
    @endif

    <div class="card">
        <div class="card-body wizard-content">
            <h3>Indicador</h3>
            <p>(*) Campos Obligatorios</p>
            <h6 class="card-subtitle"></h6>
            <form method="POST" action="{{route ('NRegistro')}}" class="mt-5">
                {{ csrf_field() }}
                <div>
                    <section>
                        <div class="d-none">
                            <div class="col-md-3">
                                <input id="id_registro" type="text" class="required form-control" 
                                    placeholder="{{$registros+1}}" readonly="readonly"> 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="folio"
                                    class="col-sm-2 text-end control-label col-form-label">Folio</label>
                            <div class="col-sm-3">
                                <input id="folio" type="text" class="required form-control" name="folio" value="" readonly="readonly">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="descripcion"
                                class="col-sm-2 text-end control-label col-form-label">Descripción*</label>
                            <div class="col-md-8">
                                <input type="text" class="required form-control @error('descripcion') is-invalid @enderror" 
                                    name="descripcion" placeholder="Descripción" required autofocus>
                                @error('descripcion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ejecutivo"
                                class="col-sm-2 text-end control-label col-form-label">Analista</label>
                            <div class="col-md-8">  
                                <select class="form-select @error('id_responsable') is-invalid @enderror" 
                                    style="width: 100%; height:36px;" name="id_responsable" tabindex="-1" aria-hidden="true" required autofocus>
                                    <option value={{null}}>Selección</option>
                                    @foreach ($responsable as $ejecutivo):
                                        @if ($ejecutivo ->id_area == 11)
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
                                    <option value={{null}}>Selección</option>
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
                                <select id="id_cliente" class="form-select @error ('id_cliente') is-invalid @enderror"
                                    style="width: 100%; height:36px;" name="id_cliente" tabindex="-1" aria-hidden="true" required autofocus>
                                    <option value={{null}}>Selección</option>
                                    @foreach ($clientes as $cliente)
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
                        <!--<div class="form-group row">
                            <label for="Arquitecto"
                                class="col-sm-2 text-end control-label col-form-label">personal solicitante*</label>
                            <div class="col-md-8">
                                <select class="form-select shadow-none select2-hidden-accessible"   style="width: 100%; height:36px;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                    <option data-select2-id="0">Selección</option>
                                    @foreach ($responsable as $arqutecto)
                                        @if ($arqutecto ->id_area == 1)
                                            <option value = {{ $arqutecto->id_responsable }}>{{$arqutecto->nombre_r}}</option>;
                                        @endif    
                                    @endforeach                             
                                </select>
                            </div>
                        </div>-->
                        <div class="form-group row">
                            <label for="Prioridad"
                                class="col-sm-2 text-end control-label col-form-label">Prioridad*</label>
                            <div class="col-md-8">
                                <select class="form-select"   style="width: 100%; height:36px;" id="prioridad" tabindex="-1" aria-hidden="true">
                                    <option data-select2-id="0">Selección</option>
                                    <option value='1'> Muy Baja</option>
                                    <option value='2'>Baja</option>
                                    <option value='3'>Media</option>
                                    <option value='4'>Alta</option>
                                    <option value='5'>Muy Alta</option>
                                    <option value='6'>Crítica</option> 
                                    <option value='7'>Nula</option>                        
                                </select>
                            </div>
                        </div>
                        <!--<div class="form-group row">
                            <label for="Fecha"
                            class="col-sm-2 text-end control-label col-form-label">Fecha*</label>
                            <div class= 'col-md-8'>
                                <div class="input-group">
                                    <input type="text" class="form-control mydatepicker" placeholder="MM/DD/AAAA">
                                    <div class="input-group-append">
                                        <span class="input-group-text h-100">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>-->
                        <div class="d-none">
                                <input type="text" name="id_estatus" value="{{17}}" visible="false">
                                <input type="text" name="id_area" value="11" visible="false">
                        </div>
                        <div class="card-body text-center">
                            <button type="submit" class="btn btn-success text-white">Guardar</button>
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

<script>
    cliente = document.getElementById('id_cliente');
    cliente.addEventListener('change', (event) => {
      now = new Date();
      registro= document.getElementById('id_registro');
      folio = document.getElementById('folio');
      if(now.getDate()<10){
        if(now.getMonth()<10){
          folio.value = `AA-${event.target.value}-0${now.getDate()}0${now.getMonth()+1}${now.getFullYear().toString().slice(-2)}`; 
        }
        else{
	      folio.value = `AA-${event.target.value}-0${now.getDate()}${now.getMonth()+1}${now.getFullYear().toString().slice(-2)}`; 
        }
	  }
	  else{
	    if(now.getMonth()<10){
		  folio.value = `AA-${event.target.value}-${now.getDate()}0${now.getMonth()+1}${now.getFullYear().toString().slice(-2)}`; 
	    }
  	    else{
		  folio.value = `AA-${event.target.value}-${now.getDate()}${now.getMonth()+1}${now.getFullYear().toString().slice(-2)}`; 
	    }
      }
    });
      </script>

@endsection 

