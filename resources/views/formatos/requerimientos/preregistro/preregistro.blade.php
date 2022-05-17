@extends('layouts.app')
@section('content')
<!-- Incluir complemento -->
<link href="{{asset("assets/extra-libs/toastr/dist/build/toastr.min.css")}}" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="{{asset("vendor/bootstrap/css/bootstrap.min.css")}}">    
  <!-- -------------------------------------------------------------- -->
  <!-- Container fluid  -->
  <!-- -------------------------------------------------------------- -->
  <div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-4">
            <div class="card-body little-profile text-center">
                <div class="my-3" data-tilt>
                    <img src="images/img-01.png" alt="IMG">
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body wizard-content">
                <div class="box text-center">
                <!--<h5 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i></h5>-->
                    <h3 class="text-dark">SOLICITAR REQUERIMIENTO</h3>
                </div>
                    <form method="POST" action="{{route ('ClienteSol')}}" class="mt-5">
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
                                            class="col-sm-4 text-end control-label col-form-label">Folio</label>
                                    <div class="col-sm-8">
                                        <input id="folio" type="text" class="required form-control" name="folio" value="" readonly="readonly">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="solicitante"
                                        class="col-sm-4 text-end control-label col-form-label">Solicitante*</label>
                                    <div class="col-md-8">
                                        <input type="text" class="required form-control @error('solicitante') is-invalid @enderror" 
                                            name="solicitante" placeholder="Nombre completo" required autofocus>
                                        @error('solicitante')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="correo"
                                        class="col-sm-4 text-end control-label col-form-label">Correo*</label>
                                    <div class="col-md-8">
                                        <input type="text" class="required form-control @error('correo') is-invalid @enderror" 
                                            name="correo" placeholder="user@example.com" required autofocus>
                                        @error('correo')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Cliente"
                                        class="col-sm-4 text-end control-label col-form-label">Cliente*</label>
                                    <div class="col-md-8">
                                        <select id="id_cliente" class="form-select @error ('id_cliente') is-invalid @enderror" 
                                            style="width: 100%; height:36px;" name="id_cliente" tabindex="-1" aria-hidden="true" required autofocus>
                                            <option value={{null}}>Selección</option>
                                            @foreach ($cliente as $cliente)
                                                <option id={{$cliente->abreviacion}} value={{$cliente->id_cliente}}>{{$cliente->nombre_cl}}</option>
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
                                    <label for="Sistema"
                                        class="col-sm-4 text-end control-label col-form-label">Sistema*</label>
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
                                    <label for="descripcion"
                                        class="col-sm-4 text-end control-label col-form-label">Descripción*</label>
                                    <div class="col-md-8">
                                        <input type="text" class="required form-control @error('descripcion') is-invalid @enderror" 
                                            name="descripcion" placeholder="maximo 250 caracteres" required autofocus>
                                        @error('descripcion')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <p>(*) Campos Obligatorios</p>
                                <div class="card-body text-center">
                                    <button class="btn btn-success" type="button" data-toggle="modal" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                    Guardar
                                    </button>
                                    <label> </label> 
                                    <button href="{{ url('/') }}" type="reset" value="reset" class="btn btn-danger"><a href="{{url('/') }}" style="color:white">Cancelar</a></button>
                                </div>
                            </section>
                        </div>
                        <!-- BEGIN MODAL -->
                        <div class="modal" id="collapseExample">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header d-flex align-items-center">
                                        <h4 class="modal-title"><strong>Documentos adjuntos</strong></h4>
                                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <a href="index.html" class="">Desea agregar archivos como referencia a este reporte</a>
                                    </div>
                                    <div class="modal-feed text-center">
                                        <button type="submit" name='adjunto' value="true" class="btn btn-success waves-effect waves-light text-white">
                                            <a style="color:white"> Si</a>
                                        </button>
                                        <button type="submit" name='adjunto' value="false" class="btn btn-danger waves-effect waves-light text-white">
                                            <a  style="color:white"> No</a>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal -->
                    </form>
                </div>
            </div>
        </div>
    </div>
  </div>
    <script src="{{asset("vendor/tilt/tilt.jquery.min.js")}}"></script>
    <script src="{{asset("vendor/bootstrap/js/bootstrap.min.js")}}"></script>
    <script src="{{asset("assets/extra-libs/toastr/dist/build/toastr.min.js")}}"></script>
    <script src="{{asset("assets/extra-libs/toastr/toastr-init.js")}}"></script>
    <script>
        //cliente = document.getElementById('id_cliente');
        let $select = $('#id_cliente');
        $select.on('change', () => {
            let selecteds = [];

            // Buscamos los option seleccionados
            $select.children(':selected').each((idx, el) => {
                // Obtenemos los atributos que necesitamos
                selecteds.value = el.id
                now = new Date();
                registro = document.getElementById('id_registro');
                folio = document.getElementById('folio');
                if(now.getDate()<10){
                    if(now.getMonth()<10){
                        folio.value = `PR-${selecteds.value}-0${now.getDate()}0${now.getMonth()+1}${now.getFullYear().toString().slice(-2)}`; 
                    }
                    else{
                        folio.value = `PR-${selecteds.value}-0${now.getDate()}${now.getMonth()+1}${now.getFullYear().toString().slice(-2)}`; 
                    }
                }
                else{
                    if(now.getMonth()<10){
                    folio.value = `PR-${selecteds.value}-${now.getDate()}0${now.getMonth()+1}${now.getFullYear().toString().slice(-2)}`; 
                    }
                    else{
                    folio.value = `PR-${selecteds.value}-${now.getDate()}${now.getMonth()+1}${now.getFullYear().toString().slice(-2)}`; 
                    }
                }
                ruta = 'http://localhost:8000/preregistro.archivos.'+folio.value;
                //route('previsto',folio.value)
                //console.log(ruta)
                $("#myAwesomeDropzone").attr("action",ruta);
            });
            
            //console.log(selecteds.value);
        });
    </script>
@endsection 