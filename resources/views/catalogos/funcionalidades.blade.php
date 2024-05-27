
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