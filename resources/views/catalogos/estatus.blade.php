<div class="tab-pane fade" id="Estatus" role="tabpanel" aria-labelledby="pills-profile-tab">
    <div class="mb-3">
      <div class="input-group input-group-lg">
        <div class="card-body">
          <div class="no-block align-items-center">
            <div class="row media">
              <div class="col-md-1">
                <div class="mb-1 text-center">ID</div>
              </div>
              <div class="col-md-4">
                <div class="mb-3 text-center">Nombre</div>
              </div>
              <div class="col-md-1">
                <div class="mb-3 text-center">Posición</div>
              </div>
              <div class="col-md-3">
                <div class="mb-3 text-center">Fase</div>
              </div>
              <div class="col-md-1">
                <div class="mb-3 text-center">Activo</div>
              </div>
              <div class="col-md-2 action-btn">
                <div class="mb-3 text-center">
                  <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add-e" class="btn-circle btn btn-outline-success">+</a>
                </div>
              </div>
            </div>
            @foreach ($estatus as $est)
              <div class="row media">
                <div class="col-md-1">
                  <div class="mb-3">
                    <label class="form-control text-center">{{$est->id_estatus}}</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="mb-3">
                    <label class="form-control text-center">{{$est->titulo}}</label>
                  </div>
                </div>
                <div class="col-md-1">
                  <div class="mb-3">
                    <label class="form-control text-center">{{$est->posicion}}</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="mb-3">
                    <label class="form-control text-center">{{$est->fase->nombre ?? ''}}</label>
                  </div>
                </div>
                <div class="col-md-1">
                  <div class="mb-3 text-center">
                    <input type="checkbox" class="form-check-input" disabled {{ $est->activo ? 'checked' : '' }}>
                  </div>
                </div>
                <div class="col-md-2 action-btn">
                  <div class="mb-3 text-center">
                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#edit-e{{$loop->iteration}}" class="text-dark edit">
                      <i data-feather="eye" class="feather-sm"></i>
                    </a>
                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#borrar-e{{$loop->iteration}}" class="text-danger delete ms-2">
                      <i data-feather="trash-2" class="feather-sm"></i>
                    </a>
                  </div>
                </div>
              </div>
              <form method="POST" action="{{route ('UEstatus',$est->id_estatus)}}" class="mt-5" enctype="multipart/form-data">
                @csrf
                <div class="modal fade" id="edit-e{{$loop->iteration}}" tabindex="-1" aria-labelledby="edit-Label{{$loop->iteration}}" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="edit-Label{{$loop->iteration}}">Editar Estatus</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-control">Nombre</label>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-3">
                              <input type="text" name="titulo" class="form-control text-uppercase" value="{{$est->titulo}}" required>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-control">Posición</label>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-3">
                              <input type="text" name="posicion" class="form-control text-uppercase" value="{{$est->posicion}}" required>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-control">Fase</label>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-3">
                              <select class="form-select" style="width: 100%; height:36px;" name="id_fase" required autofocus>
                                <option value={{$est->id_fase ?? ''}}>{{$est->fase->nombre ?? ''}}</option> 
                                @foreach ($fases as $fase)
                                  <option value="{{$fase->id_fase}}">{{$fase->nombre}}</option>
                                @endforeach                      
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-control">Activo</label>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-3">
                              <input type="checkbox" name="activo" class="form-check-input" value="1" {{$est->activo ? 'checked' : ''}}>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Guardar</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
              <form method="POST" action="{{route ('DEstatus',$est->id_estatus)}}" class="mt-5">
                @csrf
                @method('delete')
                <div class="modal fade" id="borrar-e{{$loop->iteration}}" tabindex="-1" aria-labelledby="borrar-Label{{$loop->iteration}}" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="borrar-Label{{$loop->iteration}}">Borrar Cliente</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <p class="text-danger">¿Está seguro de eliminar el registro?</p>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Sí</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            @endforeach
            <form method="POST" action="{{route ('NEstatus')}}" class="mt-5" enctype="multipart/form-data">
              @csrf
              <div class="modal fade" id="add-e" tabindex="-1" aria-labelledby="add-Label" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="add-Label">Nuevo Estatus</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-control">Estatus</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <input type="text" name="titulo" class="form-control text-uppercase" placeholder="Nombre" required>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-control">Posición</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <input type="text" name="posicion" class="form-control text-uppercase" placeholder="#" required>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-control">Fase</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <select class="form-select" style="width: 100%; height:36px;" name="id_fase" required autofocus>
                              <option value=''>Seleccionar</option> 
                              @foreach ($fases as $fase)
                                <option value="{{$fase->id_fase}}">{{$fase->nombre}}</option>
                              @endforeach                      
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-control">Activo</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <input type="checkbox" name="activo" class="form-check-input" value="1" {{$est->activo ? 'checked' : ''}}>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-success">Crear</button>
                      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>