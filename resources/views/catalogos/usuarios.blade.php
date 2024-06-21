
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
                  <div class="mb-3 text-center">Usuarios</div>
                </div>
                <div class="col-md-2 action-btn">
                  <div class="mb-3 text-center">
                    <a class="edit">
                      <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add-sol" class="btn-circle btn btn-outline-success">+</a>
                    </a>
                  </div>
                </div>
              </div>
              @foreach ($users as $user)
                <div class="row media">
                  <div class="col-md-2">
                    <div class="mb-3">
                      <label type="text" class="form-control text-center">{{$user->id}}</label>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="mb-3">
                      <label type="text" class="form-control text-center">{{$user->getFullnameAttribute()}}</label>
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
                <form method="POST" action="{{route ('USolicitante',$user->id)}}" class="mt-5">
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
                                      <input type="text" name="nombre" class="form-control text-uppercase" value="{{$user->nombre}}"/>
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
                                      <input type="text" name="a_pat" class="form-control text-uppercase" value="{{$user->apaterno}}"/>
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
                                      <input type="text" name="a_mat" class="form-control text-uppercase" value="{{$user->amaterno}}"/>
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
                                      <input type="text" name="email" class="form-control" value="{{$user->email}}"/>
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
                                      <select class="form-select @error ('id_area') is-invvalid @enderror" style="width: 100%; height:36px;" name="id_area"user required autofocus>
                                        <option value={{$user->usrdata->id_area}}>
                                            {{$user->usrdata->area ? $user->usrdata->area->area : ''}}
                                        </option> 
                                        @foreach ($areas as $area)
                                          <option value="{{$area->id_area}}">{{$area->area}}</option>
                                        @endforeach
                                        @error('id_area')
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
                                      <label type="text" class="form-control">Departamento</label>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="mb-3 contact-phone">
                                      <select class="form-select @error ('id_departamento') is-invvalid @enderror" style="width: 100%; height:36px;" name="id_departamento" user required autofocus>
                                        <option value={{$user->usrdata->id_departamento}}>
                                            {{$user->usrdata->departamento ? $user->usrdata->departamento->departamento : ''}}
                                        </option> 
                                        @foreach ($departamentos as $departamento)
                                          <option value="{{$departamento->id}}">{{$departamento->departamento}}</option>
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
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="mb-3 contact-location">
                                      <label type="text" class="form-control">Division</label>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="mb-3 contact-phone">
                                      <select class="form-select @error ('id_division') is-invvalid @enderror" style="width: 100%; height:36px;" name="id_division" user required autofocus>
                                        <option value={{$user->usrdata->id_division}}>
                                            {{$user->usrdata->division ? $user->usrdata->division->division : ''}}
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
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="mb-3 contact-location">
                                      <label type="text" class="form-control">Puesto</label>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="mb-3 contact-phone">
                                      <select class="form-select @error ('id_puesto') is-invvalid @enderror" style="width: 100%; height:36px;" name="id_puesto" user required autofocus>
                                        <option value={{$user->usrdata->id_puesto}}>
                                            {{$user->usrdata->puesto ? $user->usrdata->puesto->puesto : ''}}
                                        </option> 
                                        @foreach ($puestos as $puesto)
                                          <option value="{{$puesto->id_puesto}}">{{$puesto->puesto}}</option>
                                        @endforeach
                                        @error('id_puesto')
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
                <form method="POST" action="{{route ('DSolicitante',$user->id)}}" class="mt-5">
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
                        <h5 class="modal-title">Nuevo usuario</h5>
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
                                    <input type="text" name="nombre" class="form-control text-uppercase" placeholder="Nombre usuario"/>
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
                                    <select class="form-select @error ('id_area') is-invvalid @enderror" style="width: 100%; height:36px;" name="id_area" user required autofocus>
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
                                    <label for="departamento" type="text" class="form-control" data-toggle="tooltip" data-toggle-placement="top" title="Default tooltip">Departamento</label>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="mb-3 contact-phone">
                                    <select class="form-select @error ('id_departamento') is-invvalid @enderror" style="width: 100%; height:36px;" name="id_departamento" required autofocus>
                                      <option value={{null}}>Seleccion</option>
                                        @foreach ($departamentos as $departamento)
                                          <option value={{$departamento->id}}>{{$departamento->departamento}}</option>;
                                        @endforeach; 
                                      @error('id_departamento')
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
                                        style="width: 100%; height:36px;" name="id_division" user required autofocus>
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
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="mb-3 contact-location">
                                    <label for="puesto" type="text" class="form-control" data-toggle="tooltip" data-toggle-placement="top" title="Selecciona">Puesto</label>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="mb-3 contact-phone">
                                    <select class="form-select @error ('id_puesto') is-invvalid @enderror" style="width: 100%; height:36px;" name="id_puesto" required autofocus>
                                      <option value={{null}}>Seleccion</option>
                                        @foreach ($puestos as $puesto)
                                          <option value={{$puesto->id_puesto}}>{{$puesto->puesto}}</option>;
                                        @endforeach; 
                                      @error('id_puesto')
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