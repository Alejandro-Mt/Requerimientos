<div class="tab-pane fade" id="Clientes" role="tabpanel" aria-labelledby="pills-profile-tab">
  <div class="mb-3">
    <div class="input-group input-group-lg">
      <div class="card-body">
        <div class="no-block align-items-center">
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
              <div class="mb-3 text-center">
                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add-c" class="btn-circle btn btn-outline-success">+</a>
              </div>
            </div>
          </div>
          @foreach ($clientes as $cliente)
            <div class="row media">
              <div class="col-md-2">
                <div class="mb-3">
                  <label class="form-control text-center">{{$cliente->id_cliente}}</label>
                </div>
              </div>
              <div class="col-md-5">
                <div class="mb-3">
                  <label class="form-control text-center">{{$cliente->nombre_cl}}</label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="mb-3">
                  <label class="form-control text-center">{{$cliente->abreviacion}}</label>
                </div>
              </div>
              <div class="col-md-2 action-btn">
                <div class="mb-3 text-center">
                  <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#edit-c{{$loop->iteration}}" class="text-dark edit">
                    <i data-feather="eye" class="feather-sm"></i>
                  </a>
                  <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#borrar-c{{$loop->iteration}}" class="text-danger delete ms-2">
                    <i data-feather="trash-2" class="feather-sm"></i>
                  </a>
                </div>
              </div>
            </div>
            <form method="POST" action="{{route ('UCliente',$cliente->id_cliente)}}" class="mt-5" enctype="multipart/form-data">
              @csrf
              <div class="modal fade" id="edit-c{{$loop->iteration}}" tabindex="-1" aria-labelledby="edit-cLabel{{$loop->iteration}}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="edit-cLabel{{$loop->iteration}}">Editar Cliente</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="mb-3">
                        <label class="form-label">Cliente</label>
                        <input type="text" name="nombre_cl" class="form-control text-uppercase" value="{{$cliente->nombre_cl}}" required>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Abreviación</label>
                        <input type="text" name="abreviacion" class="form-control text-uppercase" value="{{$cliente->abreviacion}}" required>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Logo</label>
                        <input type="file" name="logo" class="form-control" accept="image/png, image/jpeg">
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
            <form method="POST" action="{{route ('DCliente',$cliente->id_cliente)}}" class="mt-5">
              @csrf
              @method('delete')
              <div class="modal fade" id="borrar-c{{$loop->iteration}}" tabindex="-1" aria-labelledby="borrar-cLabel{{$loop->iteration}}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="borrar-cLabel{{$loop->iteration}}">Borrar Cliente</h5>
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
          <form method="POST" action="{{route ('NCliente')}}" class="mt-5" enctype="multipart/form-data">
            @csrf
            <div class="modal fade" id="add-c" tabindex="-1" aria-labelledby="add-cLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="add-cLabel">Nuevo Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="mb-3">
                      <label class="form-label">Cliente</label>
                      <input type="text" name="nombre_cl" class="form-control text-uppercase" placeholder="Nombre" required>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Abreviación</label>
                      <input type="text" name="abreviacion" class="form-control text-uppercase" placeholder="AB" required>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Logo</label>
                      <input type="file" name="logo" class="form-control" accept="image/png, image/jpeg" required>
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