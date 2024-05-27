
<div class="tab-pane fade show active" id="Areas" role="tabpanel" aria-labelledby="pills-home-tab">
  <div class="mb-3">
    <div class="input-group input-group-lg">
      <div class="card-body">
        <div class="no-block align-items-center">
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