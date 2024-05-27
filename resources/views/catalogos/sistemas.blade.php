
<div class="tab-pane fade" id="Sistemas" role="tabpanel" aria-labelledby="pills-profile-tab">
  <div class="mb-3">
    <div class="input-group input-group-lg">
      <div class="card-body">
        <div class="no-block align-items-center">
          <div>
            <!-- Titulos Sistemas -->
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