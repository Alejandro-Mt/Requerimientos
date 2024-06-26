
<!-- Accion Cancelar / Posponer -->
<div id="estle" class="modal fade" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        @if($pausa->folio == $registros->folio)
          <div class="text-center mt-2 mb-4">
            <a class="text-success">{{$registros->folio}}</a>
          </div>
          <button id="btnGroupVerticalDrop1" type="button" class="estatus justify-content-center w-100 btn btn-rounded d-flex text-dark align-items-center dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            @if($pausa->pausa == 2)
              <a class="text-danger">{{"POSPUESTO"}}</a>
            @else
              {{$registros->estatus->titulo}}
            @endif
          </button>
        @endif
        <div class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="btnGroupVerticalDrop1">
          @if ($pausa->pausa == 2)
            <a class="dropdown-item" href="{{route('Play',$registros->folio)}}">{{$registros->estatus->titulo}}</a>
            <a class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#confle">CANCELAR</a>
          @else
            <a class="dropdown-item texr-success" data-bs-toggle="modal" data-bs-target="#desfase">POSPONER</a>
            <a class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#confle">CANCELAR</a>
          @endif
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- Cancelar -->
<form method="post" action="{{ route('Cancelar', $registros->folio) }}">
  {{ csrf_field() }}
  <div id="confle" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <div class="text-center mt-2 mb-4">
            <a href="index.html" class="text-danger">¿Motivo de cancelación?</a>
          </div>
          <div class="form-group row">
            <label for="motivo" class="col-sm-2 text-end control-label col-form-label">Motivo de cancelación*</label>
            <div class="col-md-8">
              <select name="motivo" class="form-select @error ('motivo') is-invalid @enderror" style="height: 36px;width: 100%;" required autofocus>
                <option value={{null}}>Seleccion</option>
                @foreach($cancelar as $c)
                  <option value='{{$c->id_motivo}}'>{{$c->descripcion}}</option>
                @endforeach                   
              </select>
              @error('motivo')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-invert" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success btn-ok">Confirmar</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</form>
<!-- Impacto -->
<form method="post" action="{{ route('Clase', $registros->folio) }}">
  {{ csrf_field() }}
  <div id="impacto" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <div class="text-center mt-2 mb-4">
            <a class="text-danger">¿Tipo de desarrollo?</a>
          </div>
          <div class="form-group row">
            <label for="id_clase" class="col-sm-2 text-end control-label col-form-label">Clases*</label>
            <div class="col-md-9">
              <select class="form-select @error ('id_clase') is-invalid @enderror" name="id_clase" aria-hidden="true" required autofocus>
                <option value="">Selección</option>
                @foreach ($clases as $clase)
                  <option value = {{ $clase->id_clase }}>{{$clase->clase}}</option>
                @endforeach                     
              </select>
              @error('id_clase')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-invert" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success btn-ok">Confirmar</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</form>
<!-- Tester -->
<form method="post" action="{{ route('Tester', $registros->folio) }}">
  {{ csrf_field() }}
  <div id="Tester" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <div class="text-center mt-2 mb-4">
            <a class="text-white">Asignar Tester</a>
          </div>
          <div class="form-group row">
            <label for="id_tester" class="col-sm-2 text-end control-label col-form-label">Usuarios</label>
            <div class="col-md-9">
              <select class="form-select @error ('id_tester') is-invalid @enderror" name="id_tester" aria-hidden="true" required autofocus>
                <option value="">Selección</option>
                @foreach ($testers as $tester)
                  <option value = {{ $tester->id_user }}>{{$tester->user->getFullnameAttribute()}}</option>
                @endforeach                     
              </select>
              @error('id_tester')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-invert" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success btn-ok">Confirmar</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</form>
<!-- Posponer -->
<div id="desfase" class="modal fade" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="text-center mt-2 mb-4">
          <a class="text-orange">¿Motivo del desfase?</a>
        </div>
        <button id="btnGroupVerticalDrop2" type="button" class="estatus justify-content-center w-100 btn btn-rounded d-flex text-dark align-items-center dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <a class="text-danger">Seleccionar</a>
        </button>
        <div class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="btnGroupVerticalDrop2">
          @foreach($desfases as $desfase)
            <a class="dropdown-item texr-success" href={{route('Posponer',[$registros->folio,$desfase->id,$registros->id_estatus])}}>{{$desfase->motivo}}</a>
          @endforeach
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- Soporte -->

<div class="modal" id="Soporte">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header d-flex align-items-center">
        <h4 class="modal-title">
          <strong>Ajustar datos</strong>
        </h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action={{route('ReDef',$registros->folio)}} method="post">
          {{ csrf_field() }}
          <div class="form-group row">
            <label for="motivo" class="col-sm-4 text-end control-label col-form-label">Motivo de Reajuste*</label>
            <div class="col-md-8">
              <input type="text" class="required form-control @error('motivo') is-invalid @enderror" name="motivo" placeholder="Cual es el alcance" required autofocus>
              @error('motivo')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
          <div @if($registros->posicion > 5) class="form-group row" @else class="form-group row d-none" @endif>
            <label for="definision" class="col-sm-4 text-end control-label col-form-label">Definision*</label>
            <div class="col-md-8">
              <input type="text" class="required form-control mydatepicker @error('definision') is-invalid @enderror" name="definision" placeholder="Nueva fecha de entrega" required autofocus>
              @error('definision')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
          <div @if($registros->posicion > 6) class="form-group row" @else class="form-group row d-none" @endif>
            <label for="analisis" class="col-sm-4 text-end control-label col-form-label">Planeacion*</label>
            <div class="col-md-8">
              <input type="text" class="required form-control mydatepicker @error('analisis') is-invalid @enderror" name="analisis" placeholder="Nueva fecha de entrega" required autofocus>
              @error('analisis')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
          @if($registros->posicion > 7)
            <div class="form-group row">
              <label for="construccion" class="col-sm-4 text-end control-label col-form-label">Construcción*</label>
              <div class="col-md-8">
                <input type="text" class="required form-control mydatepicker @error('construccion') is-invalid @enderror" name="construccion" placeholder="Nueva fecha de entrega" required autofocus>
                @error('construccion')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
          @endif
          <!--@if($registros->posicion > 7)
            <div class="form-group row">
              <label for="construccion" class="col-sm-4 text-end control-label col-form-label">Pre-producción*</label>
              <div class="col-md-8">
                <input type="text" class="required form-control mydatepicker @error('construccion') is-invalid @enderror" name="construccion" placeholder="Nueva fecha de entrega" required autofocus>
                @error('construccion')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
          @endif
          @if($registros->posicion > 7)
            <div class="form-group row">
              <label for="construccion" class="col-sm-4 text-end control-label col-form-label">Inicio pruebas PIP*</label>
              <div class="col-md-8">
                <input type="text" class="required form-control mydatepicker @error('construccion') is-invalid @enderror" name="construccion" placeholder="Nueva fecha de entrega" required autofocus>
                @error('construccion')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
          @endif
          @if($registros->posicion > 7)
            <div class="form-group row">
              <label for="construccion" class="col-sm-4 text-end control-label col-form-label">Fin pruebas PIP*</label>
              <div class="col-md-8">
                <input type="text" class="required form-control mydatepicker @error('construccion') is-invalid @enderror" name="construccion" placeholder="Nueva fecha de entrega" required autofocus>
                @error('construccion')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
          @endif-->
          <button type="submit" class="btn btn-success waves-effect waves-light text-white">
            <a style="color:white"> Autorizar</a>
          </button>
          <button type="button" class="btn waves-effect" data-bs-dismiss="modal"> Cancelar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- BEGIN MODAL LINK -->
<div class="modal" id="link">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header d-flex align-items-center">
        <h4 class="modal-title"><strong>Adjuntar Link</strong></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group row">
          <label for="evidencia" class="col-sm-2 text-end control-label col-form-label">Link</label>
            <div class="col-md-8">
              <input id="evidencia" type="text" class="required form-control @error('evidencia') is-invalid @enderror" 
                    name="evidencia" placeholder="evidencia" required autofocus>
                @error('evidencia')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
            </div>
        </div>
        <button type="button" class="btn btn-success waves-effect waves-light text-white link">
          <i style="color:white"> Actualizar</i>
        </button>
      </div>
    </div>
  </div>
</div>
<!-- End Modal -->
<!-- BEGIN MODAL -->
<div class="modal" id="Adjuntos">
  <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header d-flex align-items-center">
          <h4 class="modal-title"><strong>Cargar documentos</strong></h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form  class="dropzone" action="{{route('Adjuntos',Crypt::decrypt($folio))}}" method="post" enctype="multipart/form-data" id="General"></form> 
          <button type="submit" class="btn btn-success waves-effect waves-light text-white">
            <a href="{{route('Documentos',$folio)}}" style="color:white"> Actualizar</a>
          </button>
        </div>
      </div>
  </div>
</div>
<!-- End Modal -->
<!-- BEGIN MODAL -->
<div class="modal" id="Complementos">
  <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header d-flex align-items-center">
          <h4 class="modal-title"><strong>Cargar Complementos</strong></h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form  class="dropzone" action="{{route('Adjuntos',Crypt::decrypt($folio))}}" method="post" enctype="multipart/form-data" id="Complemento"></form> 
          <button type="submit" class="btn btn-success waves-effect waves-light text-white">
            <a href="{{route('Documentos',$folio)}}" style="color:white"> Actualizar</a>
          </button>
        </div>
      </div>
  </div>
</div>
<!-- End Modal -->