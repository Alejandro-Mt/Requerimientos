@extends('home')
@section('content')
    <div class="container-fluid">
      <!-- Start Row -->
      <div class="row">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body little-profile text-center">
              @if(session('danger'))
                <div class="alert customize-alert alert-dismissible border-danger text-danger fade show" role="alert">
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  <div class="d-flex align-items-center font-medium">
                      <i data-feather="info" class="text-danger feather-sm me-2"></i>
                      <strong>{{session('danger') }}</strong>
                  </div>
                </div>
              @endif
              @if(session('success'))
                <div class="alert customize-alert alert-dismissible border-success text-success fade show" role="alert">
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  <div class="d-flex align-items-center font-medium">
                      <i data-feather="info" class="text-success feather-sm me-2"></i>
                      <strong>{{session('success') }}</strong>
                  </div>
                </div>
              @endif
              @error('password')
                <div class="alert customize-alert alert-dismissible border-warning text-warning fade show" role="alert">
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  <div class="d-flex align-items-center font-medium">
                      <i data-feather="info" class="text-warning feather-sm me-2"></i>
                      <strong>{{ $message }}</strong>
                  </div>
                </div>
              @enderror
                <div class="my-3">
                  @if (!$data->usrdata->avatar)
                    <img src="{{asset("assets/images/users/1.jpg")}}" alt="user" width="128" class="rounded-circle shadow"/>    
                  @else
                    <img src="{{asset($data->usrdata->avatar)}}" alt="user" width="128" class="rounded-circle shadow"/>   
                  @endif
                </div>
                <h3 class="mb-0">{{$data->getFullnameAttribute()}}</h3>
                <h6 class="text-muted">{{$data->usrdata->puesto->puesto}}</h6>
                <ul class="list-inline social-icons mt-4">
                  <li class="list-inline-item">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#add-new-event">
                      <i class="ri-edit-2-fill"></i>
                    </a>
                  </li>
                  @if($data->usrdata->id_puesto == 7)
                    <li class="list-inline-item">
                      <a href="{{route('Ajustes')}}">
                        <i class="ri-user-settings-line"></i>
                      </a>
                    </li>
                    <li class="list-inline-item">
                      <a href="{{route('Seguir')}}">
                        <i class="ri-settings-5-line"></i>
                      </a>
                    </li>
                  @endif
                  <!--<li class="list-inline-item">
                    <a href="javascript:void(0)">
                      <i class="ri-google-fill"></i>
                    </a>
                  </li>
                  <li class="list-inline-item">
                    <a href="javascript:void(0)">
                      <i class="ri-youtube-fill"></i>
                    </a>
                  </li>
                  <li class="list-inline-item">
                    <a href="javascript:void(0)">
                      <i class="ri-instagram-line"></i>
                    </a>
                  </li>-->
                </ul>
                <!-- BEGIN MODAL -->
                <div class="modal" id="add-new-event">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header d-flex align-items-center">
                            <h4 class="modal-title">
                              <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#img" role="tab" aria-controls="home5" aria-expanded="true">
                                        <span>Cambiar Imagen</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#pass" role="tab" aria-controls="profile">
                                        <span>Actualizar Contraseña</span>
                                    </a>
                                </li>
                              </ul>
                            </h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="tab-content tabcontent-border p-3" id="myTabContent">
                            <div role="tabpanel" class="tab-pane fade show active" id="img" aria-labelledby="home-tab">
                              <div class="modal-body">
                                <form class="dropzone" action="{{route('Actualiza')}}" method="post" enctype="multipart/form-data" id="myAwesomeDropzone">
                                  {{csrf_field()}}
                                  <div class="fallback">
                                    <input type="file" name="avatar" id="avatar" accept="image/*">
                                  </div>
                                </form>
                                <button type="submit" class="btn btn-success waves-effect waves-light text-white">
                                  <a href="{{route('profile',$data->id)}}" style="color:white"> Guardar</a>
                                </button>
                                <button type="button" class="btn waves-effect" data-bs-dismiss="modal"> Cancelar</button>
                              </div>
                            </div>
                              <div class="tab-pane fade" id="pass" role="tabpanel" aria-labelledby="profile-tab">
                                <form method="POST" action="{{ route('UsrPass') }}">
                                  @csrf
                                  <div class="form-group row">
                                      <label for="oldpass" class="col-md-5 col-form-label text-md-right">{{ __('Contraseña') }}</label>
                                      <div class="col-md-6">
                                          <input id="oldpass" type="password" class="form-control" name="oldpass" placeholder="Contraseña anterior" required autofocus>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <label for="password" class="col-md-5 col-form-label text-md-right">{{ __('Nueva contraseña') }}</label>
                                      <div class="col-md-6">
                                          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                          @error('password')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <label for="password-confirm" class="col-md-5 col-form-label text-md-right">{{ __('Confirmar contraseña') }}</label>
                                      <div class="col-md-6">
                                          <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                      </div>
                                  </div>
                                  <div class="form-group row mb-0">
                                      <div class="col-md-6 offset-md-4">
                                          <button type="submit" class="btn btn-success">
                                              {{ __('Aceptar') }}
                                          </button>
                                      </div>
                                  </div>
                                </form>
                              </div>
                          </div>
                      </div>
                  </div>
                </div>
                <!-- End Modal -->
            </div>
            <!--<div class="text-center bg-extra-light">
              <div class="row">
                <div class="col-6 p-3 border-right">
                  <h4 class="mb-0 font-weight-medium">1099</h4>
                  <small>Followers</small>
                </div>
                <div class="col-6 p-3">
                  <h4 class="mb-0 font-weight-medium">603</h4>
                  <small>Following</small>
                </div>
              </div>
            </div>
            <div class="card-body text-center">
              <a
                href="javascript:void(0)"
                class="
                  mt-2
                  mb-3
                  waves-effect waves-dark
                  btn btn-success btn-md btn-rounded
                "
                >Follow me</a
              >
            </div>-->
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <div class="d-md-flex">
                <div>
                  <h4 class="card-title">
                    <span class="lstick d-inline-block align-middle"></span>
                    Mis Requerimientos
                  </h4>
                </div>
                <!--<div class="ms-auto">
                  <select class="form-select">
                    <option selected="">Enero/Febrero</option>
                    <option value="1">Marzo/Abril</option>
                    <option value="2">Mayo/Junio</option>
                    <option value="3">Julio/Agosto</option>
                  </select>
                </div>-->
              </div>
              <div class="table-responsive mt-3">
                <table class="table v-middle no-wrap mb-0">
                  <thead>
                    <tr>
                      @if ($data->usrdata->id_area == 12)
                        <th class="border-0" colspan="2">Responsable</th>
                      @else
                        <th class="border-0" colspan="2">Arquitecto</th>
                      @endif
                      <th class="border-0">Titulo</th>
                      <th class="border-0">Estatus</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($folios as $registro)
                      <tr>
                        <td style="width: 50px">
                          @if ($data->usrdata->id_area == 12)
                            <span>
                              <img src="{{asset($registro->rpip->usrdata->avatar ?? 'assets/images/users/1.jpg')}}" alt="user" width="50" class="rounded-circle"/>
                            </span>
                          @else
                            <span>
                              <img src="{{asset($registro->rdes->usrdata->avatar ?? 'assets/images/users/1.jpg')}}" alt="user" width="50" class="rounded-circle"/>
                            </span>
                          @endif
                        </td>
                        <td>
                          @if (Auth::user()->id_area == 12)
                            <h6 class="mb-0 font-weight-medium">{{$registro->rpip->getFullnameAttribute()}}</h6>
                            <small class="text-muted">Responsable</small>
                          @else
                            <h6 class="mb-0 font-weight-medium">{{$registro->rdes->getFullnameAttribute()}}</h6>
                            <small class="text-muted">Arquitecto</small>
                          @endif
                        </td>
                        <td>{{$registro->folio. ' ' .$registro->descripcion}}</td>
                        <td>
                          @switch($registro->estatus->fase->nombre)
                              @case('LEVANTAMIENTO')
                                <span class="badge bg-info rounded-pill">{{$registro->estatus->fase->nombre}}</span>
                                @break
                              @case('CONSTRUCCIÓN')
                                <span class="badge bg-primary rounded-pill">{{$registro->estatus->fase->nombre}}</span>
                                @break
                              @case('LIBERACIÓN')
                                <span class="badge bg-secondary rounded-pill">{{$registro->estatus->fase->nombre}}</span>
                                @break
                              @case('IMPLEMENTACIÓN')
                                <span class="badge bg-success rounded-pill">{{$registro->estatus->fase->nombre}}</span>
                                @break
                              @case('IMPLEMENTADO')
                                <span class="badge bg-dark rounded-pill">{{$registro->estatus->fase->nombre}}</span>
                                @break
                              @default
                                <span class="badge bg-danger rounded-pill">{{$registro->estatus->titulo}}</span>
                          @endswitch
                        </td>
                      </tr>
                    @endforeach
                    
                  </tbody>
                </table>
              </div>
              {{ $folios->links() }}
            </div>
          </div>
        </div>
        <!-- -------------------------------------------------------------- -->
        <!-- Activity widget find scss into widget folder-->
        <!-- -------------------------------------------------------------- -->
      </div>
      <!-- End Row -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="border-bottom title-part-padding">
              <h4 class="card-title mb-0">Excel</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="fechas" class="table table-striped table-bordered display text-nowrap" style="width: 100%">
                  <thead>
                    <tr>
                      <th class="header">N°</th>
                      <th class="header">FOLIO</th>
                      <th class="header">REQUERIMIENTO</th>
                      <th class="header">LEVANTAMIENTO</th>
                      <th class="header">CONSTRUCCIÓN</th>
                      <th class="header">LIBERACIÓN</th>
                      <th class="header">IMPLEMENTACIÓN</th>
                      <th class="header">TOTAL</th>
                      <th class="header">SOLICITANTE</th>
                      <th class="header">CLIENTE</th>
                      <th class="header">SISTEMA</th>
                      <th class="header">ESTATUS</th>
                      <th class="header">RESPONSABLE</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($fechas as $fecha)
                      <tr>
                        <td>{{$fecha->id_registro}}</td>
                        <td>{{$fecha->folio}}</td>
                        <td>{{$fecha->solicitud ? $fecha->solicitud->created_at : $fecha->created_at}}</td>
                        <td>
                          {{$fecha->CalcDias(
                            ($fecha->solicitud ? $fecha->solicitud->created_at : $fecha->created_at),
                            ($fecha->plan ? ($fecha->plan->fechaCompReqR ?? now()) : now())
                          )}}
                        </td>
                        <td>
                          {{$fecha->CalcDias(
                            ($fecha->plan ? ($fecha->plan->fechaCompReqR ?? now()) : now()),
                            ($fecha->construccion ? ($fecha->construccion->fechaCompReqR ?? now()) : now())
                          )}}
                        </td>
                        <td>
                          {{$fecha->CalcDias(
                            ($fecha->construccion ? ($fecha->construccion->fechaCompReqR ?? now()) : now()),
                            ($fecha->liberacion ? $fecha->liberacion->inicio_lib : now())
                          )}}
                        </td>
                        <td>
                          {{$fecha->CalcDias(
                            ($fecha->liberacion ? $fecha->liberacion->inicio_lib : now()),
                            ($fecha->implementacion ? $fecha->implementacion->f_implementacion : now())
                          )}}
                        </td>
                        <td>
                          {{$fecha->CalcDias(
                            ($fecha->solicitud ? $fecha->solicitud->created_at : $fecha->created_at),
                            ($fecha->implementacion ? $fecha->implementacion->f_implementacion : now())
                          )}}
                        </td>
                        <td>{{$fecha->solicitud ? $fecha->solicitud->correo :''}}</td>
                        <td>{{$fecha->cliente->nombre_cl}}</td>
                        <td>{{$fecha->sistema->nombre_s}}</td>
                        <td>{{$fecha->estatus->titulo}}</td>
                        <td>{{$fecha->rpip->getFullnameAttribute()}}</td>
                      </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <th>N°</th>
                    <th>FOLIO</th>
                    <th>REQUERIMIENTO</th>
                    <th>LEVANTAMIENTO</th>
                    <th>CONSTRUCCIÓN</th>
                    <th>LIBERACIÓN</th>
                    <th>IMPLEMENTACIÓN</th>
                    <th>TOTAL</th>
                    <th>SOLICITANTE</th>
                    <th>CLIENTE</th>
                    <th>SISTEMA</th>
                    <th>ESTATUS</th>
                    <th>RESPONSABLE</th>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <link rel="stylesheet" type="text/css" href="../../assets/libs/dropzone/dist/min/dropzone.min.css"/>
    <script src="../../assets/libs/dropzone/dist/min/dropzone.min.js"></script>
    <!-- -------------------------------------------------------------- -->
    <!-- End Container fluid  -->
    <!-- -------------------------------------------------------------- -->
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
      Dropzone.options.myAwesomeDropzone = {
        paramName: "avatar", // Las imágenes se van a usar bajo este nombre de parámetro
        maxFilesize: 3 // Tamaño máximo en MB
      };
    </script>
    <script>
      $(document).ready(function () {
        $('#fechas').DataTable({
          dom: "Bfrtip",
          buttons: ["copy", "csv", "excel", "pdf", "print"],
            scrollY: 200,
            scrollX: true,
        });
      $(
        ".buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel"
      ).addClass("btn btn-primary mr-1");
      });
    </script>
@endsection
