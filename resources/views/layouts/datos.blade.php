@extends('home')
@section('content')
  <div class="card">
    <div class="card-body">
      <!-- Row -->
      <div class="row">
        <!-- Titulo -->
        <!--<div class="d-md-flex align-items-center">
          <div>
            <h4 class="card-title">Place your Order</h4>
            <h5 class="card-subtitle">Buy and Sell Crypto as you Like</h5>
          </div>
          <div class="ms-auto d-flex align-items-center">
            <div class="dl">
              <select class="form-select">
                <option value="0" selected>Bitcoin</option>
                <option value="1">Ethereum</option>
                <option value="2">Ripple</option>
              </select>
            </div>
          </div>
        </div>-->
        <!-- Contenido -->
        <div class="nav justify-content-center">
          <!-- Filtros -->
          <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" href="#Areas" role="tab" aria-selected="true">Areas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" href="#Clientes" role="tab" aria-selected="false">Clientes</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-home-tab" data-bs-toggle="pill" href="#Departamentos" role="tab" aria-selected="false">Departamentos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-home-tab" data-bs-toggle="pill" href="#Funcionalidad" role="tab" aria-selected="false">Funcionalidad</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" href="#Puestos" role="tab" aria-selected="false">Puestos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-home-tab" data-bs-toggle="pill" href="#Responsables" role="tab" aria-selected="false">Responsables</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" href="#Sistemas" role="tab" aria-selected="false">Sistemas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" href="#Solicitantes" role="tab" aria-selected="false">Solicitantes</a>
            </li>
          </ul>
          <!-- tablas -->
          <div class="nav tab-content mt-3" id="pills-tabContent">
            <div class="tab-pane fade show active" id="Areas" role="tabpanel" aria-labelledby="pills-home-tab">
              <div class="mb-3">
                <div class="input-group input-group-lg">
                  <div class="card-body">
                    <div class="no-block align-items-center">
                      <div>
                        <!-- Titulos Area -->
                        <div class="row media">
                          <div class="col-md-3">
                            <div class="mb-3 text-center">ID</div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-3 text-center">Area</div>
                          </div>
                          <div class="col-md-3 action-btn">
                            <div class="mb-3 text-center">
                              <a class="edit">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add-a" class="btn-circle btn btn-outline-success">+</a>
                              </a>
                            </div>
                          </div>
                        </div>
                        <!-- Resultados  -->
                        @foreach ($areas as $area)
                          <div class="row media">
                            <div class="col-md-3">
                              <div class="mb-3">
                                <label type="text" class="form-control text-center">{{$area->id_area}}</label>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="mb-3">
                                <label type="text" class="form-control text-center">{{$area->area}}</label>
                              </div>
                            </div>
                            <div class="col-md-3 action-btn">
                              <div class="mb-3 text-center">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#edit-a{{$loop->iteration}}" class="text-dark edit">
                                  <i data-feather="eye" class="feather-sm fill-white"></i>
                                </a>
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#borrar-a{{$loop->iteration}}" class="text-danger delete ms-2">
                                  <i data-feather="trash-2" class="feather-sm fill-white"></i>
                                </a>
                              </div>
                            </div>
                          </div>
                          <form method="POST" action="{{route ('UArea')}}" class="mt-5">
                            @csrf
                            <!-- Modal Editar-->
                            <div class="modal" id="edit-a{{$loop->iteration}}">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-header d-flex align-items-center">
                                    <h5 class="modal-title">Area</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="add-contact-box">
                                      <div class="add-contact-content">
                                        <form id="addContactModalTitle">
                                          <div class="row">
                                            <div class="col-md-6">
                                              <div class="mb-3 contact-name">
                                                <input type="text" name="id_area" class="form-control d-none" value="{{$area->id_area}}"/>
                                                <span class="validation-text text-danger"></span>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="row">
                                            <div class="col-md-6">
                                              <div class="mb-3 contact-name">
                                                <label type="text" class="form-control">Titulo</label>
                                              </div>
                                            </div>
                                            <div class="col-md-6">
                                              <div class="mb-3 contact-name">
                                                <input type="text" name="area" class="form-control text-uppercase" value="{{$area->area}}"/>
                                                <span class="validation-text text-danger"></span>
                                              </div>
                                            </div>
                                          </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button id="btn-edit-1-{{$loop->iteration}}" class="btn btn-success rounded-pill px-4">Guardar</button>
                                    <button class="btn btn-danger rounded-pill px-4" data-bs-dismiss="modal">Cancelar</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- End Modal -->
                          </form>
                          <form method="POST" action="{{route ('DArea',$area->id_area)}}" class="mt-5">
                            @method('DELETE')
                            @csrf
                            <!-- Modal Borrar-->
                            <div class="modal" id="borrar-a{{$loop->iteration}}">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-header d-flex align-items-center">
                                    <h5 class="modal-title">Borrar area</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="add-contact-box">
                                      <div class="add-contact-content">
                                        <form id="addContactModalTitle">
                                          <div class="row">
                                            <div class="col-md-6">
                                              <div class="mb-3">
                                                <span class="validation-text text-danger">¿Esta seguro de eliminar el registro?</span>
                                              </div>
                                            </div>
                                          </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button id="btn-edit-2-{{$loop->iteration}}" class="btn btn-success rounded-pill px-4">SI</button>
                                    <button class="btn btn-danger rounded-pill px-4" data-bs-dismiss="modal">Cancelar</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- End Modal -->
                          </form>
                        @endforeach
                        <form method="POST" action="{{route('NArea')}}" class="mt-5">
                          @csrf
                          <!-- Modal Añadir-->
                          <div class="modal" id="add-a">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                <div class="modal-header d-flex align-items-center">
                                  <h5 class="modal-title">Nueva area</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <div class="add-contact-box">
                                    <div class="add-contact-content">
                                      <form id="addContactModalTitle">
                                        <div class="row">
                                          <div class="col-md-6">
                                            <div class="mb-3 contact-name">
                                              <label type="text" class="form-control">Titulo</label>
                                              <span class="validation-text text-danger"></span>
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="mb-3 contact-email">
                                              <input type="text" name="area" class="form-control text-uppercase" placeholder="Area"/>
                                              <span class="validation-text text-danger"></span>
                                            </div>
                                          </div>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button id="btn-add-a" class="btn btn-success rounded-pill px-4">Crear</button>
                                  <button class="btn btn-danger rounded-pill px-4" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- End -->
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="Clientes" role="tabpanel" aria-labelledby="pills-profile-tab">
              <div class="mb-3">
                <div class="input-group input-group-lg">
                  <div class="card-body">
                    <div class="no-block align-items-center">
                      <div>
                        <div class="row media">
                          <div class="col-md-2">
                            <div class="mb-3 text-center">ID</div>
                          </div>
                          <div class="col-md-5">
                            <div class="mb-3 text-center">Nombre</div>
                          </div>
                          <div class="col-md-3">
                            <div class="mb-3 text-center">Abreviación</div>
                          </div>
                          <div class="col-md-2 action-btn">
                            <div class="mb-3">
                                <a class="edit">
                                  <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add-c" class="btn-circle btn btn-outline-success">+</a>
                                </a>
                            </div>
                          </div>
                        </div>
                        @foreach ($clientes as $cliente)
                          <div class="row media">
                            <div class="col-md-2">
                              <div class="mb-3">
                                <label type="text" class="form-control text-center">{{$cliente->id_cliente}}</label>
                              </div>
                            </div>
                            <div class="col-md-5">
                              <div class="mb-3">
                                <label type="text" class="form-control text-center">{{$cliente->nombre_cl}}</label>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="mb-3">
                                <label type="text" class="form-control text-center">{{$cliente->abreviacion}}</label>
                              </div>
                            </div>
                            <div class="col-md-2 action-btn">
                              <div class="mb-3">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#edit-c{{$loop->iteration}}" class="text-dark edit">
                                  <i data-feather="eye" class="feather-sm fill-white"></i>
                                </a>
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#borrar-c{{$loop->iteration}}" class="text-danger delete ms-2">
                                  <i data-feather="trash-2" class="feather-sm fill-white"></i>
                                </a>
                              </div>
                            </div>
                          </div>
                          <form method="POST" action="{{route ('UCliente',$cliente->id_cliente)}}" class="mt-5" enctype="multipart/form-data">
                            @csrf
                            <!-- Modal Editar-->
                            <div class="modal" id="edit-c{{$loop->iteration}}">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-header d-flex align-items-center">
                                    <h5 class="modal-title">Cliente</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="add-contact-box">
                                      <div class="add-contact-content">
                                        <form id="addContactModalTitle">
                                          <div class="row">
                                            <div class="col-md-6">
                                              <div class="mb-3 contact-name">
                                                <label type="text" id="c-name" class="form-control">Cliente</label>
                                                <span class="validation-text text-danger"></span>
                                              </div>
                                            </div>
                                            <div class="col-md-6">
                                              <div class="mb-3 contact-name">
                                                <input type="text" name="nombre_cl" class="form-control text-uppercase" value="{{$cliente->nombre_cl}}"/>
                                                <span class="validation-text text-danger"></span>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="row">
                                            <div class="col-md-6">
                                              <div class="mb-3 contact-name">
                                                <label type="text" id="c-name" class="form-control">Abreviación</label>
                                                <span class="validation-text text-danger"></span>
                                              </div>
                                            </div>
                                            <div class="col-md-6">
                                              <div class="mb-3 contact-name">
                                                <input type="text" name="abreviacion" class="form-control text-uppercase" value="{{$cliente->abreviacion}}"/>
                                                <span class="validation-text text-danger"></span>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="row">
                                            <div class="input-group">
                                              <label type="text" class="form-control">Logo</label>
                                              <div class="custom-file">
                                                <input type="file" name="logo" class="form-control" accept="image/png, image/jpeg"/>
                                              </div>
                                            </div>
                                          </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button id="btn-edit-3-{{$loop->iteration}}" class="btn btn-success rounded-pill px-4">Guardar</button>
                                    <button class="btn btn-danger rounded-pill px-4" data-bs-dismiss="modal">Cancelar</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- End Modal -->
                          </form>
                          <form method="POST" action="{{route ('DCliente',$cliente->id_cliente)}}" class="mt-5">
                            @csrf
                            @method('delete')
                            <!-- Modal Borrar-->
                            <div class="modal" id="borrar-c{{$loop->iteration}}">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-header d-flex align-items-center">
                                    <h5 class="modal-title">Borrar cliente</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="add-contact-box">
                                      <div class="add-contact-content">
                                        <form id="addContactModalTitle">
                                          <div class="row">
                                            <div class="col-md-6">
                                              <div class="mb-3">
                                                <span class="validation-text text-danger">¿Esta seguro de eliminar el registro?</span>
                                              </div>
                                            </div>
                                          </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button id="btn-edit-4-{{$loop->iteration}}" class="btn btn-success rounded-pill px-4">SI</button>
                                    <button class="btn btn-danger rounded-pill px-4" data-bs-dismiss="modal">Cancelar</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- End Modal -->
                          </form>
                        @endforeach
                        <form method="POST" action="{{route ('NCliente')}}" class="mt-5" enctype="multipart/form-data">
                          @csrf
                          <!-- Modal Añadir-->
                          <div class="modal" id="add-c">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                <div class="modal-header d-flex align-items-center">
                                  <h5 class="modal-title">Nuevo cliente</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <div class="add-contact-box">
                                    <div class="add-contact-content">
                                      <form id="addContactModalTitle">
                                        <div class="row">
                                          <div class="col-md-6">
                                            <div class="mb-3 contact-name">
                                              <label type="text" id="c-name" class="form-control">Cliente</label>
                                              <span class="validation-text text-danger"></span>
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="mb-3 contact-email">
                                              <input type="text" name="nombre_cl" class="form-control text-uppercase" placeholder="Nombre"/>
                                              <span class="validation-text text-danger"></span>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-md-6">
                                            <div class="mb-3 contact-occupation">
                                              <label type="text" class="form-control">Abreviación</label>
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="mb-3 contact-phone">
                                              <input type="text" name="abreviacion" class="form-control text-uppercase" placeholder="AB"/>
                                              <span class="validation-text text-danger"></span>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="input-group">
                                            <label type="text" class="form-control">Logo</label>
                                            <div class="custom-file">
                                              <input type="file" name="logo" class="form-control" accept="image/png, image/jpeg"/>
                                            </div>
                                          </div>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button id="btn-add-c" class="btn btn-success rounded-pill px-4">Crear</button>
                                  <button class="btn btn-danger rounded-pill px-4" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- End -->
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="Departamentos" role="tabpanel" aria-labelledby="pills-profile-tab">
              <div class="mb-3">
                <div class="input-group input-group-lg">
                  <div class="card-body">
                    <div class="no-block align-items-center">
                      <div>
                        <div class="row media">
                          <div class="col-md-2">
                            <div class="mb-3 text-center">ID</div>
                          </div>
                          <div class="col-md-7">
                            <div class="mb-3 text-center">Departamentos</div>
                          </div>
                          <div class="col-md-2 action-btn">
                            <div class="mb-3 text-center">
                              <a class="edit">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add-d" class="btn-circle btn btn-outline-success">+</a>
                              </a>
                            </div>
                          </div>
                        </div>
                        @foreach ($departamentos as $departamento)
                          <div class="row media">
                            <div class="col-md-2">
                              <div class="mb-3">
                                <label type="text" class="form-control text-center">{{$departamento->id}}</label>
                              </div>
                            </div>
                            <div class="col-md-7">
                              <div class="mb-3">
                                <label type="text" class="form-control text-center">{{$departamento->departamento}}</label>
                              </div>
                            </div>
                            <div class="col-md-2 action-btn">
                              <div class="mb-3 text-center">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#edit-d{{$loop->iteration}}" class="text-dark edit">
                                  <i data-feather="eye" class="feather-sm fill-white"></i>
                                </a>
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#borrar-d{{$loop->iteration}}" class="text-danger delete ms-2">
                                  <i data-feather="trash-2" class="feather-sm fill-white"></i>
                                </a>
                              </div>
                            </div>
                          </div>
                          <form method="POST" action="{{route ('UDepto',$departamento->id)}}" class="mt-5">
                            @csrf
                            <!-- Modal Editar-->
                            <div class="modal" id="edit-d{{$loop->iteration}}">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-header d-flex align-items-center">
                                    <h5 class="modal-title">Departamento</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="add-contact-box">
                                      <div class="add-contact-content">
                                        <form id="addContactModalTitle">
                                          <div class="row">
                                            <div class="col-md-12">
                                              <div class="mb-3 contact-name">
                                                <input type="text" name="departamento" class="form-control text-uppercase" value="{{$departamento->departamento}}"/>
                                                <span class="validation-text text-danger"></span>
                                              </div>
                                            </div>
                                          </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button id="btn-edit-5-{{$loop->iteration}}" class="btn btn-success rounded-pill px-4">Guardar</button>
                                    <button class="btn btn-danger rounded-pill px-4" data-bs-dismiss="modal">Cancelar</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- End Modal -->
                          </form>
                          <form method="POST" action="{{route ('DDepto',$departamento->id)}}" class="mt-5">
                            @method('DELETE')
                            @csrf
                            <!-- Modal Borrar-->
                            <div class="modal" id="borrar-d{{$loop->iteration}}">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-header d-flex align-items-center">
                                    <h5 class="modal-title">Borrar departamento</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="add-contact-box">
                                      <div class="add-contact-content">
                                        <form id="addContactModalTitle">
                                          <div class="row">
                                            <div class="col-md-6">
                                              <div class="mb-3">
                                                <span class="validation-text text-danger">¿Esta seguro de eliminar el registro?</span>
                                              </div>
                                            </div>
                                          </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button id="btn-edit-6-{{$loop->iteration}}" class="btn btn-success rounded-pill px-4">SI</button>
                                    <button class="btn btn-danger rounded-pill px-4" data-bs-dismiss="modal">Cancelar</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- End Modal -->
                          </form>
                        @endforeach
                        <form method="POST" action="{{route ('NDepto')}}" class="mt-5">
                          @csrf
                          <!-- Modal Añadir-->
                          <div class="modal" id="add-d">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                <div class="modal-header d-flex align-items-center">
                                  <h5 class="modal-title">Nuevo departamento</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <div class="add-contact-box">
                                    <div class="add-contact-content">
                                      <form id="addContactModalTitle">
                                        <div class="row">
                                          <div class="col-md-6">
                                            <div class="mb-3 contact-name">
                                              <label type="text" class="form-control">Departamento</label>
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="mb-3 contact-email">
                                              <input type="text" name="departamento" class="form-control text-uppercase" placeholder="Nombre"/>
                                              <span class="validation-text text-danger"></span>
                                            </div>
                                          </div>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button id="btn-add-d" class="btn btn-success rounded-pill px-4">Crear</button>
                                  <button class="btn btn-danger rounded-pill px-4" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- End -->
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="Funcionalidad" role="tabpanel" aria-labelledby="pills-profile-tab">
              <div class="mb-3">
                <div class="input-group input-group-lg">
                  <div class="card-body">
                    <div class="no-block align-items-center">
                      <div>
                        <div class="row media">
                          <div class="col-md-2">
                            <div class="mb-3 text-center">ID</div>
                          </div>
                          <div class="col-md-7">
                            <div class="mb-3 text-center">Estatus Funcionalidad</div>
                          </div>
                          <div class="col-md-3 action-btn">
                            <div class="mb-3 text-center">
                              <a class="edit">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add-f" class="btn-circle btn btn-outline-success">+</a>
                              </a>
                            </div>
                          </div>
                        </div>
                        @foreach ($funcionalidad as $funcion)
                          <div class="row media">
                            <div class="col-md-2">
                              <div class="mb-3">
                                <label type="text" class="form-control text-center">{{$funcion->id_estatus}}</label>
                              </div>
                            </div>
                            <div class="col-md-7">
                              <div class="mb-3">
                                <label type="text" class="form-control text-center">{{$funcion->titulo}}</label>
                              </div>
                            </div>
                            <div class="col-md-3 action-btn">
                              <div class="mb-3 text-center">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#edit-f{{$loop->iteration}}" class="text-dark edit">
                                  <i data-feather="eye" class="feather-sm fill-white"></i>
                                </a>
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#borrar-f{{$loop->iteration}}" class="text-danger delete ms-2">
                                  <i data-feather="trash-2" class="feather-sm fill-white"></i>
                                </a>
                              </div>
                            </div>
                          </div>
                          <form method="POST" action="{{route ('UFuncion',$funcion->id_estatus)}}" class="mt-5">
                            @csrf
                            <!-- Modal Editar-->
                            <div class="modal" id="edit-f{{$loop->iteration}}">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-header d-flex align-items-center">
                                    <h5 class="modal-title">Estatus Funcionalidad</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="add-contact-box">
                                      <div class="add-contact-content">
                                        <form id="addContactModalTitle">
                                          <div class="row">
                                            <div class="col-md-12">
                                              <div class="mb-3 contact-name">
                                                <input type="text" name="titulo" class="form-control text-uppercase" value="{{$funcion->titulo}}"/>
                                                <span class="validation-text text-danger"></span>
                                              </div>
                                            </div>
                                          </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button id="btn-edit-7-{{$loop->iteration}}" class="btn btn-success rounded-pill px-4">Guardar</button>
                                    <button class="btn btn-danger rounded-pill px-4" data-bs-dismiss="modal">Cancelar</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- End Modal -->
                          </form>
                          <form method="POST" action="{{route ('DFuncion',$funcion->id_estatus)}}" class="mt-5">
                            @csrf
                            @method('DELETE')
                            <!-- Modal Borrar-->
                            <div class="modal" id="borrar-f{{$loop->iteration}}">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-header d-flex align-items-center">
                                    <h5 class="modal-title">Borrar estatus funcionalidad</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="add-contact-box">
                                      <div class="add-contact-content">
                                        <form id="addContactModalTitle">
                                          <div class="row">
                                            <div class="col-md-6">
                                              <div class="mb-3 contact-name">
                                                <span class="validation-text text-danger">¿Esta seguro de eliminar el registro?</span>
                                              </div>
                                            </div>
                                          </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button id="btn-edit-8-{{$loop->iteration}}" class="btn btn-success rounded-pill px-4">SI</button>
                                    <button class="btn btn-danger rounded-pill px-4" data-bs-dismiss="modal">Cancelar</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- End Modal -->
                          </form>
                        @endforeach
                        <form method="POST" action="{{route ('NFuncion')}}" class="mt-5">
                          @csrf
                          <!-- Modal Añadir-->
                          <div class="modal" id="add-f">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                <div class="modal-header d-flex align-items-center">
                                  <h5 class="modal-title">Nuevo estatus funcionalidad</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <div class="add-contact-box">
                                    <div class="add-contact-content">
                                      <form id="addContactModalTitle">
                                        <div class="row">
                                          <div class="col-md-6">
                                            <div class="mb-3 contact-name">
                                              <label type="text" class="form-control">Titulo</label>
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="mb-3 f-titulo">
                                              <input type="text" name="titulo" class="form-control text-uppercase" placeholder="Estatus Funcionalidad"/>
                                              <span class="validation-text text-danger"></span>
                                            </div>
                                          </div>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button id="btn-edit-9" class="btn btn-success rounded-pill px-4">Crear</button>
                                  <button class="btn btn-danger rounded-pill px-4" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- End -->
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="Puestos" role="tabpanel" aria-labelledby="pills-profile-tab">
              <div class="mb-3">
                <div class="input-group input-group-lg">
                  <div class="card-body">
                    <div class="no-block align-items-center">
                      <div>
                        <div class="row media">
                          <div class="col-md-2">
                            <div class="mb-3 text-center">ID</div>
                          </div>
                          <div class="col-md-4">
                            <div class="mb-3 text-center">Puesto</div>
                          </div>
                          <div class="col-md-3">
                            <div class="mb-3 text-center">Jerarquía</div>
                          </div>
                          <div class="col-md-3 action-btn">
                            <div class="mb-3">
                                <a class="edit">
                                  <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add-p" class="btn-circle btn btn-outline-success">+</a>
                                </a>
                            </div>
                          </div>
                        </div>
                        @foreach ($puestos as $puesto)
                          <div class="row media">
                            <div class="col-md-2">
                              <div class="mb-3">
                                <label type="text" class="form-control text-center">{{$puesto->id_puesto}}</label>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="mb-3">
                                <label type="text" class="form-control text-center">{{$puesto->puesto}}</label>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="mb-3">
                                <label type="text" class="form-control text-center">{{$puesto->jerarquia}}</label>
                              </div>
                            </div>
                            <div class="col-md-3 action-btn">
                              <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#edit-p{{$loop->iteration}}" class="text-dark edit">
                                <i data-feather="eye" class="feather-sm fill-white"></i>
                              </a>
                              <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#borrar-p{{$loop->iteration}}" class="text-danger delete ms-2">
                                <i data-feather="trash-2" class="feather-sm fill-white"></i>
                              </a>
                            </div>
                          </div>
                          <form method="POST" action="{{route ('UPuesto',$puesto->id_puesto)}}" class="mt-5">
                            @csrf
                            <!-- Modal Editar-->
                            <div class="modal" id="edit-p{{$loop->iteration}}">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-header d-flex align-items-center">
                                    <h5 class="modal-title">Puestos</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="add-contact-box">
                                      <div class="add-contact-content">
                                        <form id="addContactModalTitle">
                                          <div class="row">
                                            <div class="col-md-6">
                                              <div class="mb-3 contact-name">
                                                <label type="text" class="form-control">Puesto</label>
                                              </div>
                                            </div>
                                            <div class="col-md-6">
                                              <div class="mb-3 contact-name">
                                                <input type="text" name="puesto" class="form-control text-uppercase" value="{{$puesto->puesto}}"/>
                                                <span class="validation-text text-danger"></span>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="row">
                                            <div class="col-md-6">
                                              <div class="mb-3 contact-name">
                                                <label type="text" class="form-control">Jerarquia</label>
                                              </div>
                                            </div>
                                            <div class="col-md-6">
                                              <div class="mb-3 contact-name">
                                                <input type="text" name="jerarquia" class="form-control" value="{{$puesto->jerarquia}}"/>
                                                <span class="validation-text text-danger"></span>
                                              </div>
                                            </div>
                                          </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button id="btn-edit-10-{{$loop->iteration}}" class="btn btn-success rounded-pill px-4">Guardar</button>
                                    <button class="btn btn-danger rounded-pill px-4" data-bs-dismiss="modal">Cancelar</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- End Modal -->
                          </form>
                          <form method="POST" action="{{route ('DPuesto',$puesto->id_puesto)}}" class="mt-5">
                            @csrf
                            @method('DELETE')
                            <!-- Modal Borrar-->
                            <div class="modal" id="borrar-p{{$loop->iteration}}">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-header d-flex align-items-center">
                                    <h5 class="modal-title">Borrar cliente</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="add-contact-box">
                                      <div class="add-contact-content">
                                        <form id="addContactModalTitle">
                                          <div class="row">
                                            <div class="col-md-6">
                                              <div class="mb-3">
                                                <span class="validation-text text-danger">¿Esta seguro de eliminar el registro?</span>
                                              </div>
                                            </div>
                                          </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button id="btn-edit-11-{{$loop->iteration}}" class="btn btn-success rounded-pill px-4">SI</button>
                                    <button class="btn btn-danger rounded-pill px-4" data-bs-dismiss="modal">Cancelar</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </form>
                            <!-- End Modal -->
                        @endforeach
                        <form method="POST" action="{{route ('NPuesto')}}" class="mt-5">
                          @csrf
                          <!-- Modal Añadir-->
                          <div class="modal" id="add-p">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                <div class="modal-header d-flex align-items-center">
                                  <h5 class="modal-title">Nuevo puesto</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <div class="add-contact-box">
                                    <div class="add-contact-content">
                                      <form id="addContactModalTitle">
                                        <div class="row">
                                          <div class="col-md-6">
                                            <div class="mb-3 contact-name">
                                              <label type="text" class="form-control">Titulo</label>
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="mb-3 contact-email">
                                              <input type="text" name="titulo" class="form-control text-uppercase" placeholder="Puesto"/>
                                              <span class="validation-text text-danger"></span>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-md-6">
                                            <div class="mb-3 contact-occupation">
                                              <label type="text" class="form-control">Jerarquia</label>
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="mb-3 contact-phone">
                                              <input type="text" name="jerarquia" class="form-control" placeholder="Nivel"/>
                                              <span class="validation-text text-danger"></span>
                                            </div>
                                          </div>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button id="btn-edit-12" class="btn btn-success rounded-pill px-4">Crear</button>
                                  <button class="btn btn-danger rounded-pill px-4" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- End -->
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="Responsables" role="tabpanel" aria-labelledby="pills-profile-tab">
              <div class="mb-3">
                <div class="input-group input-group-lg">
                  <div class="card-body">
                    <div class="no-block align-items-center">
                      <div>
                        <div class="row media">
                          <div class="col-md-1">
                            <div class="mb-3 text-center">ID</div>
                          </div>
                          <div class="col-md-2">
                            <div class="mb-3 text-center">Nombre</div>
                          </div>
                          <div class="col-md-2">
                            <div class="mb-3 text-center">Apellidos</div>
                          </div>
                          <div class="col-md-3">
                            <div class="mb-3 text-center">Correo</div>
                          </div>
                          <div class="col-md-2">
                            <div class="mb-3 text-center">Area</div>
                          </div>
                          <div class="col-md-2 action-btn">
                            <div class="mb-3">
                                <a class="edit">
                                  <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add-r" class="btn-circle btn btn-outline-success">+</a>
                                </a>
                            </div>
                          </div>
                        </div>
                      @foreach ($responsables as $responsable)
                        <div class="row media">
                          <div class="col-md-1">
                            <div class="mb-3">
                              <label type="text" class="form-control text-center">{{$responsable->id_responsable}}</label>
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="mb-3">
                              <label type="text" class="form-control text-center">{{$responsable->nombre_r}}</label>
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="mb-3">
                              <label type="text" class="form-control text-center">{{$responsable->apellidos}}</label>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="mb-3">
                              <label type="text" class="form-control text-center">{{$responsable->email}}</label>
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="mb-3">
                              <label type="text" class="form-control text-center">{{$responsable->area}}</label>  
                            </div>
                          </div>
                          <div class="col-md-1 action-btn">
                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#edit-r{{$loop->iteration}}" class="text-dark edit">
                              <i data-feather="eye" class="feather-sm fill-white"></i>
                            </a>
                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#borrar-r{{$loop->iteration}}" class="text-danger delete ms-2">
                              <i data-feather="trash-2" class="feather-sm fill-white"></i>
                            </a>
                          </div>
                        </div>
                        <form method="POST" action="{{route ('UResponsable',$responsable->id_responsable)}}" class="mt-5">
                          @csrf
                          <!-- Modal Editar-->
                          <div class="modal" id="edit-r{{$loop->iteration}}">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                <div class="modal-header d-flex align-items-center">
                                  <h5 class="modal-title">Responsables</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <div class="add-contact-box">
                                    <div class="add-contact-content">
                                      <form id="addContactModalTitle">
                                        <div class="row">
                                          <div class="col-md-6">
                                            <div class="mb-3 contact-name">
                                              <label type="text" class="form-control">Nombre(s)</label>
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="mb-3 contact-email">
                                              <input type="text" name="nombre_r" class="form-control text-uppercase" value="{{$responsable->nombre_r}}"/>
                                              <span class="validation-text text-danger"></span>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-md-6">
                                            <div class="mb-3 contact-occupation">
                                              <label type="text" class="form-control">Apellidos</label>
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="mb-3 contact-phone">
                                              <input type="text" name="apellidos" class="form-control text-uppercase" value="{{$responsable->apellidos}}"/>
                                              <span class="validation-text text-danger"></span>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-md-6">
                                            <div class="mb-3 contact-location">
                                              <label type="text" class="form-control">Correo</label>
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="mb-3 contact-phone">
                                              <input type="text" name="email" class="form-control" value="{{$responsable->email}}"/>
                                              <span class="validation-text text-danger"></span>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-md-6">
                                            <div class="mb-3 contact-location">
                                              <label type="text" class="form-control">Area</label>
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="mb-3 contact-phone">
                                              <select class="form-select @error ('id_area') is-invvalid @enderror" 
                                                  style="width: 100%; height:36px;" name="id_area" tabindex="-1" aria-hidden="true" required autofocus>
                                                <option value={{$responsable->id_area}}>
                                                    {{$responsable->area}}
                                                </option> 
                                                @foreach ($areas as $area)
                                                  <option value="{{$area->id_area}}">{{$area->area}}</option>
                                                @endforeach
                                                @error('autorizacion')
                                                  <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                  </span>
                                                @enderror                        
                                              </select>
                                              <span class="validation-text text-danger"></span>
                                            </div>
                                          </div>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button id="btn-edit-13-{{$loop->iteration}}" class="btn btn-success rounded-pill px-4">Guardar</button>
                                  <button class="btn btn-danger rounded-pill px-4" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- End Modal -->
                        </form>
                        <form method="POST" action="{{route ('DResponsable',$responsable->id_responsable)}}" class="mt-5">
                          @csrf
                          @method('DELETE')
                          <!-- Modal Borrar-->
                          <div class="modal" id="borrar-r{{$loop->iteration}}">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                <div class="modal-header d-flex align-items-center">
                                  <h5 class="modal-title">Borrar responsable</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <div class="add-contact-box">
                                    <div class="add-contact-content">
                                      <form id="addContactModalTitle">
                                        <div class="row">
                                          <div class="col-md-6">
                                            <div class="mb-3">
                                              <span class="validation-text text-danger">¿Esta seguro de eliminar el registro?</span>
                                            </div>
                                          </div>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button id="btn-edit-14-{{$loop->iteration}}" class="btn btn-success rounded-pill px-4">SI</button>
                                  <button class="btn btn-danger rounded-pill px-4" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- End Modal -->
                        </form>
                      @endforeach
                      <form method="POST" action="{{route ('NResponsable')}}" class="mt-5">
                        @csrf
                        <!-- Modal Añadir-->
                        <div class="modal" id="add-r">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="modal-header d-flex align-items-center">
                                <h5 class="modal-title">Nuevo responsable</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <div class="add-contact-box">
                                  <div class="add-contact-content">
                                    <form id="addContactModalTitle">
                                      <div class="row">
                                        <div class="col-md-6">
                                          <div class="mb-3 contact-name">
                                            <label type="text" class="form-control">Nombre(s)</label>
                                          </div>
                                        </div>
                                        <div class="col-md-6">
                                          <div class="mb-3 contact-email">
                                            <input type="text" name="nombre_r" class="form-control text-uppercase" placeholder="Nombre responsable"/>
                                            <span class="validation-text text-danger"></span>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-md-6">
                                          <div class="mb-3 contact-occupation">
                                            <label type="text" class="form-control">Apellidos</label>
                                          </div>
                                        </div>
                                        <div class="col-md-6">
                                          <div class="mb-3 contact-phone">
                                            <input type="text" name="apellidos" class="form-control text-uppercase" placeholder="Apellidos"/>
                                            <span class="validation-text text-danger"></span>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-md-6">
                                          <div class="mb-3 contact-location">
                                            <label type="text" class="form-control">Correo</label>
                                          </div>
                                        </div>
                                        <div class="col-md-6">
                                          <div class="mb-3 contact-phone">
                                            <input type="text" name="email" class="form-control" placeholder="example@3ti.mx"/>
                                            <span class="validation-text text-danger"></span>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-md-6">
                                          <div class="mb-3 contact-location">
                                            <label type="text" class="form-control">Area</label>
                                          </div>
                                        </div>
                                        <div class="col-md-6">
                                          <div class="mb-3 contact-phone">
                                            <select class="form-select @error ('id_area') is-invvalid @enderror" 
                                                style="width: 100%; height:36px;" name="id_area" tabindex="-1" aria-hidden="true" required autofocus>
                                              <option value={{null}}>Seleccion</option>
                                                @foreach ($areas as $area)
                                                  <option value={{$area->id_area}}>{{$area->area}}</option>;
                                                @endforeach; 
                                              @error('autorizacion')
                                                <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                                </span>
                                              @enderror                        
                                            </select>
                                            <span class="validation-text text-danger"></span>
                                          </div>
                                        </div>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button id="btn-edit-15" class="btn btn-success rounded-pill px-4">Crear</button>
                                <button class="btn btn-danger rounded-pill px-4" data-bs-dismiss="modal">Cancelar</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- End -->
                      </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="Sistemas" role="tabpanel" aria-labelledby="pills-profile-tab">
              <div class="mb-3">
                <div class="input-group input-group-lg">
                  <div class="card-body">
                    <div class="no-block align-items-center">
                      <div>
                        <div class="row media">
                          <div class="col-md-2">
                            <div class="mb-3 text-center">ID</div>
                          </div>
                          <div class="col-md-5">
                            <div class="mb-3 text-center">Sistema</div>
                          </div>
                          <div class="col-md-3">
                            <div class="mb-3 text-center">Correo</div>
                          </div>
                          <div class="col-md-2 action-btn">
                            <div class="mb-3">
                                <a class="edit">
                                  <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add-s" class="btn-circle btn btn-outline-success">+</a>
                                </a>
                            </div>
                          </div>
                        </div>
                        @foreach ($sistemas as $sistema)
                          <div class="row media">
                            <div class="col-md-2">
                              <div class="mb-3">
                                <label type="text" class="form-control text-center">{{$sistema->id_sistema}}</label>
                              </div>
                            </div>
                            <div class="col-md-5">
                              <div class="mb-3">
                                <label type="text" class="form-control text-center">{{$sistema->nombre_s}}</label>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="mb-3">
                                <label type="text" class="form-control text-center">
                                  @if ($sistema->dispercion == NULL)
                                    Sin Correo  
                                  @else
                                    {{$sistema->dispercion}}
                                  @endif
                                </label>
                              </div>
                            </div>
                            <div class="col-md-2 action-btn">
                              <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#edit-s{{$loop->iteration}}" class="text-dark edit">
                                <i data-feather="eye" class="feather-sm fill-white"></i>
                              </a>
                              <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#borrar-s{{$loop->iteration}}" class="text-danger delete ms-2">
                                <i data-feather="trash-2" class="feather-sm fill-white"></i>
                              </a>
                            </div>
                          </div>
                          <form method="POST" action="{{route ('USistema',$sistema->id_sistema)}}" class="mt-5" enctype="multipart/form-data">
                            @csrf
                            <!-- Modal Editar-->
                            <div class="modal" id="edit-s{{$loop->iteration}}">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-header d-flex align-items-center">
                                    <h5 class="modal-title">Cliente</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="add-contact-box">
                                      <div class="add-contact-content">
                                        <form id="addContactModalTitle">
                                          <div class="row">
                                            <div class="col-md-6">
                                              <div class="mb-3 contact-name">
                                                <label type="text" id="c-name" class="form-control">Sistema</label>
                                                <span class="validation-text text-danger"></span>
                                              </div>
                                            </div>
                                            <div class="col-md-6">
                                              <div class="mb-3 contact-email">
                                                <input type="text" name="nombre_s" class="form-control text-uppercase" value="{{$sistema->nombre_s}}"/>
                                                <span class="validation-text text-danger"></span>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="row">
                                            <div class="col-md-6">
                                              <div class="mb-3 contact-occupation">
                                                <label type="text" class="form-control">Correo</label>
                                              </div>
                                            </div>
                                            <div class="col-md-6">
                                              <div class="mb-3 contact-phone">
                                                <input type="text" name="dispercion" class="form-control" value="{{$sistema->dispercion}}"/>
                                                <span class="validation-text text-danger"></span>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="row">
                                            <div class="input-group">
                                              <label type="text" class="form-control">Logo</label>
                                              <div class="custom-file">
                                                <input type="file" name="logo" class="form-control" accept="image/png, image/jpeg"/>
                                              </div>
                                            </div>
                                          </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button id="btn-edit-16-{{$loop->iteration}}" class="btn btn-success rounded-pill px-4">Guardar</button>
                                    <button class="btn btn-danger rounded-pill px-4" data-bs-dismiss="modal">Cancelar</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- End Modal -->
                          </form>
                          <form method="POST" action="{{route ('DSistema',$sistema->id_sistema)}}" class="mt-5">
                            @csrf
                            @method('DELETE')
                            <!-- Modal Borrar-->
                            <div class="modal" id="borrar-s{{$loop->iteration}}">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-header d-flex align-items-center">
                                    <h5 class="modal-title">Borrar sistema</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="add-contact-box">
                                      <div class="add-contact-content">
                                        <form id="addContactModalTitle">
                                          <div class="row">
                                            <div class="col-md-6">
                                              <div class="mb-3">
                                                <span class="validation-text text-danger">¿Esta seguro de eliminar el registro?</span>
                                              </div>
                                            </div>
                                          </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button id="btn-edit-17-{{$loop->iteration}}" class="btn btn-success rounded-pill px-4">SI</button>
                                    <button class="btn btn-danger rounded-pill px-4" data-bs-dismiss="modal">Cancelar</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- End Modal -->
                          </form>
                        @endforeach
                        <form method="POST" action="{{route ('NSistema')}}" class="mt-5" enctype="multipart/form-data">
                          @csrf
                          <!-- Modal Añadir-->
                          <div class="modal" id="add-s">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                <div class="modal-header d-flex align-items-center">
                                  <h5 class="modal-title">Nuevo sistema</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <div class="add-contact-box">
                                    <div class="add-contact-content">
                                      <form id="addContactModalTitle">
                                        <div class="row">
                                          <div class="col-md-6">
                                            <div class="mb-3 contact-name">
                                              <label type="text" id="c-name" class="form-control">Sistema</label>
                                              <span class="validation-text text-danger"></span>
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="mb-3 contact-email">
                                              <input type="text" name="nombre_s" class="form-control text-uppercase" placeholder="Nombre"/>
                                              <span class="validation-text text-danger"></span>
                                            </div>
                                          </div>
                                        </div>

                                        <div class="row">
                                          <div class="col-md-6">
                                            <div class="mb-3 contact-occupation">
                                              <label type="text" class="form-control">Correo</label>
                                            </div>
                                          </div>

                                          <div class="col-md-6">
                                            <div class="mb-3 contact-phone">
                                              <input type="text" name="dispercion" class="form-control" placeholder="example@3ti.mx"/>
                                              <span class="validation-text text-danger"></span>
                                            </div>
                                          </div>
                                        </div>

                                        <div class="row">
                                          <div class="input-group">
                                            <label type="text" class="form-control">Logo</label>
                                            <div class="custom-file">
                                              <input type="file" name="logo" class="form-control" accept="image/png, image/jpeg"/>
                                            </div>
                                          </div>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button id="btn-add-s" class="btn btn-success rounded-pill px-4">Crear</button>
                                  <button class="btn btn-danger rounded-pill px-4" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- End -->
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div> 
            <div class="tab-pane fade" id="Solicitantes" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="mb-3">
                  <div class="input-group input-group-lg">
                    <div class="card-body">
                      <div class="no-block align-items-center">
                        <div>
                          <div class="row media">
                            <div class="col-md-2">
                              <div class="mb-3 text-center">ID</div>
                            </div>
                            <div class="col-md-8">
                              <div class="mb-3 text-center">Solicitantes</div>
                            </div>
                            <div class="col-md-2 action-btn">
                              <div class="mb-3 text-center">
                                <a class="edit">
                                  <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add-sol" class="btn-circle btn btn-outline-success">+</a>
                                </a>
                              </div>
                            </div>
                          </div>
                          @foreach ($solicitantes as $solicitante)
                            <div class="row media">
                              <div class="col-md-2">
                                <div class="mb-3">
                                  <label type="text" class="form-control text-center">{{$solicitante->id_solicitante}}</label>
                                </div>
                              </div>
                              <div class="col-md-8">
                                <div class="mb-3">
                                  <label type="text" class="form-control text-center">{{"$solicitante->nombre $solicitante->a_pat $solicitante->a_mat"}}</label>
                                </div>
                              </div>
                              <div class="col-md-2 action-btn">
                                <div class="mb-3 text-center">
                                  <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#edit-sol{{$loop->iteration}}" class="text-dark edit">
                                    <i data-feather="eye" class="feather-sm fill-white"></i>
                                  </a>
                                  <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#borrar-sol{{$loop->iteration}}" class="text-danger delete ms-2">
                                    <i data-feather="trash-2" class="feather-sm fill-white"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                            <form method="POST" action="{{route ('USolicitante',$solicitante->id_solicitante)}}" class="mt-5">
                              @csrf
                              <!-- Modal Editar-->
                              <div class="modal" id="edit-sol{{$loop->iteration}}">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header d-flex align-items-center">
                                      <h5 class="modal-title">Solicitante</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                      <div class="add-contact-box">
                                        <div class="add-contact-content">
                                          <form id="addContactModalTitle">
                                            <div class="row">
                                              <div class="col-md-6">
                                                <div class="mb-3 contact-name">
                                                  <label type="text" class="form-control">Nombre(s)</label>
                                                </div>
                                              </div>
                                              <div class="col-md-6">
                                                <div class="mb-3 contact-email">
                                                  <input type="text" name="nombre" class="form-control text-uppercase" value="{{$solicitante->nombre}}"/>
                                                  <span class="validation-text text-danger"></span>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="row">
                                              <div class="col-md-6">
                                                <div class="mb-3 contact-occupation">
                                                  <label type="text" class="form-control">Apellido paterno</label>
                                                </div>
                                              </div>
                                              <div class="col-md-6">
                                                <div class="mb-3 contact-phone">
                                                  <input type="text" name="a_pat" class="form-control text-uppercase" value="{{$solicitante->a_pat}}"/>
                                                  <span class="validation-text text-danger"></span>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="row">
                                              <div class="col-md-6">
                                                <div class="mb-3 contact-occupation">
                                                  <label type="text" class="form-control">Apellido materno</label>
                                                </div>
                                              </div>
                                              <div class="col-md-6">
                                                <div class="mb-3 contact-phone">
                                                  <input type="text" name="a_mat" class="form-control text-uppercase" value="{{$solicitante->a_mat}}"/>
                                                  <span class="validation-text text-danger"></span>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="row">
                                              <div class="col-md-6">
                                                <div class="mb-3 contact-location">
                                                  <label type="text" class="form-control">Correo</label>
                                                </div>
                                              </div>
                                              <div class="col-md-6">
                                                <div class="mb-3 contact-phone">
                                                  <input type="text" name="email" class="form-control" value="{{$solicitante->email}}"/>
                                                  <span class="validation-text text-danger"></span>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="row">
                                              <div class="col-md-6">
                                                <div class="mb-3 contact-location">
                                                  <label type="text" class="form-control">Division</label>
                                                </div>
                                              </div>
                                              <div class="col-md-6">
                                                <div class="mb-3 contact-phone">
                                                  <select class="form-select @error ('id_division') is-invvalid @enderror" 
                                                      style="width: 100%; height:36px;" name="id_division" tabindex="-1" aria-hidden="true" required autofocus>
                                                    <option value={{$solicitante->id_division}}>
                                                        {{$solicitante->division}}
                                                    </option> 
                                                    @foreach ($divisiones as $div)
                                                      <option value="{{$div->id_division}}">{{$div->division}}</option>
                                                    @endforeach
                                                    @error('id_division')
                                                      <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                      </span>
                                                    @enderror                        
                                                  </select>
                                                  <span class="validation-text text-danger"></span>
                                                </div>
                                              </div>
                                            </div>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button id="btn-edit-18-{{$loop->iteration}}" class="btn btn-success rounded-pill px-4">Guardar</button>
                                      <button class="btn btn-danger rounded-pill px-4" data-bs-dismiss="modal">Cancelar</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <!-- End Modal -->
                            </form>
                            <form method="POST" action="{{route ('DSolicitante',$solicitante->id_solicitante)}}" class="mt-5">
                              @csrf
                              @method('DELETE')
                              <!-- Modal Borrar-->
                              <div class="modal" id="borrar-sol{{$loop->iteration}}">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header d-flex align-items-center">
                                      <h5 class="modal-title">Borrar estatus</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                      <div class="add-contact-box">
                                        <div class="add-contact-content">
                                          <form id="addContactModalTitle">
                                            <div class="row">
                                              <div class="col-md-6">
                                                <div class="mb-3 contact-name">
                                                  <span class="validation-text text-danger">¿Esta seguro de eliminar el registro?</span>
                                                </div>
                                              </div>
                                            </div>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button id="btn-edit-19-{{$loop->iteration}}" class="btn btn-success rounded-pill px-4">SI</button>
                                      <button class="btn btn-danger rounded-pill px-4" data-bs-dismiss="modal">Cancelar</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <!-- End Modal -->
                            </form>
                          @endforeach
                          <!--<form method="POST" action="{{ route('register') }}">-->
                          <form method="POST" action="{{route ('NSolicitante')}}" class="mt-5">
                            @csrf
                            <!-- Modal Añadir-->
                            <div class="modal" id="add-sol">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-header d-flex align-items-center">
                                    <h5 class="modal-title">Nuevo responsable</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="add-contact-box">
                                      <div class="add-contact-content">
                                        <form id="addContactModalTitle">
                                          <div class="row">
                                            <div class="col-md-6">
                                              <div class="mb-3 contact-name">
                                                <label type="text" class="form-control">Nombre(s)</label>
                                              </div>
                                            </div>
                                            <div class="col-md-6">
                                              <div class="mb-3 contact-email">
                                                <input type="text" name="nombre" class="form-control text-uppercase" placeholder="Nombre solicitante"/>
                                                <span class="validation-text text-danger"></span>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="row">
                                            <div class="col-md-6">
                                              <div class="mb-3 contact-occupation">
                                                <label type="text" class="form-control">Apellido paterno</label>
                                              </div>
                                            </div>
                                            <div class="col-md-6">
                                              <div class="mb-3 contact-phone">
                                                <input type="text" name="apaterno" class="form-control text-uppercase" placeholder="Apellido paterno"/>
                                                <span class="validation-text text-danger"></span>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="row">
                                            <div class="col-md-6">
                                              <div class="mb-3 contact-occupation">
                                                <label type="text" class="form-control">Apellido materno</label>
                                              </div>
                                            </div>
                                            <div class="col-md-6">
                                              <div class="mb-3 contact-phone">
                                                <input type="text" name="amaterno" class="form-control text-uppercase" placeholder="Apellido materno"/>
                                                <span class="validation-text text-danger"></span>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="row">
                                            <div class="col-md-6">
                                              <div class="mb-3 contact-location">
                                                <label type="text" class="form-control">Correo</label>
                                              </div>
                                            </div>
                                            <div class="col-md-6">
                                              <div class="mb-3 contact-phone">
                                                <input type="email" name="email" class="form-control" placeholder="example@it-strategy.mx"/>
                                                <span class="validation-text text-danger"></span>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="row">
                                            <div class="col-md-6">
                                              <div class="mb-3 contact-occupation">
                                                <label type="text" class="form-control">Contraseña</label>
                                              </div>
                                            </div>
                                            <div class="col-md-6">
                                              <div class="mb-3 contact-phone">
                                                <input type="password" name="password" class="form-control" placeholder=""/>
                                                <span class="validation-text text-danger"></span>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="row">
                                            <div class="col-md-6">
                                              <div class="mb-3 contact-location">
                                                <label for="password-confirm" type="text" class="form-control" data-toggle="tooltip" data-toggle-placement="top" title="Default tooltip">Confirmacion de contraseña</label>
                                              </div>
                                            </div>
                                            <div class="col-md-6">
                                              <div class="mb-3 contact-phone">
                                                <input id="password-confirm" type="password" name="password_confirmation" class="form-control" required autocomplete="new-password"/>
                                                <span class="validation-text text-danger"></span>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="row">
                                            <div class="col-md-6">
                                              <div class="mb-3 contact-location">
                                                <label for="area" type="text" class="form-control" data-toggle="tooltip" data-toggle-placement="top" title="Default tooltip">Area</label>
                                              </div>
                                            </div>
                                            <div class="col-md-6">
                                              <div class="mb-3 contact-phone">
                                                <select class="form-select @error ('id_area') is-invvalid @enderror" 
                                                    style="width: 100%; height:36px;" name="id_area" tabindex="-1" aria-hidden="true" required autofocus>
                                                  <option value={{null}}>Seleccion</option>
                                                    @foreach ($areas as $area)
                                                      <option value={{$area->id_area}}>{{$area->area}}</option>;
                                                    @endforeach; 
                                                  @error('autorizacion')
                                                    <span class="invalid-feedback" role="alert">
                                                      <strong>{{ $message }}</strong>
                                                    </span>
                                                  @enderror                        
                                                </select>
                                                <span class="validation-text text-danger"></span>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="row">
                                            <div class="col-md-6">
                                              <div class="mb-3 contact-location">
                                                <label for="division" type="text" class="form-control" data-toggle="tooltip" data-toggle-placement="top" title="Default tooltip">Division</label>
                                              </div>
                                            </div>
                                            <div class="col-md-6">
                                              <div class="mb-3 contact-phone">
                                                <select class="form-select @error ('id_division') is-invvalid @enderror" 
                                                    style="width: 100%; height:36px;" name="id_division" tabindex="-1" aria-hidden="true" required autofocus>
                                                  <option value={{null}}>Seleccion</option>
                                                    @foreach ($divisiones as $division)
                                                      <option value={{$division->id_division}}>{{$division->division}}</option>;
                                                    @endforeach; 
                                                  @error('id_division')
                                                    <span class="invalid-feedback" role="alert">
                                                      <strong>{{ $message }}</strong>
                                                    </span>
                                                  @enderror                        
                                                </select>
                                                <span class="validation-text text-danger"></span>
                                              </div>
                                            </div>
                                          </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button id="btn-edit-20" class="btn btn-success rounded-pill px-4">Crear</button>
                                    <button class="btn btn-danger rounded-pill px-4" data-bs-dismiss="modal">Cancelar</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- End -->
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
        </div>
      </div>
      <!-- end row -->
    </div>
  </div>
@endsection