
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
              {{$registros->titulo}}
            @endif
          </button>
        @endif
        <div class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="btnGroupVerticalDrop1">
          @if ($pausa->pausa == 2)
            <a class="dropdown-item" href="{{route('Play',$registros->folio)}}">{{$registros->titulo}}</a>
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
<div id="confle" class="modal fade" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        @if($pausa->folio == $registros->folio)
          <div class="text-center mt-2 mb-4">
            <a href="index.html" class="text-danger">¿Estas seguro de cancelar este requerimiento?</a>
          </div>
        @endif
      </div>
      <div class="modal-footer">
        <a class="btn btn-invert" data-bs-dismiss="modal">Cancelar</a>
        <a type="submit" class="btn btn-success btn-ok" href="{{route('Cancelar',$registros->folio)}}">Confirmar</a>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
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
        <form  action={{route('Soporte',$registros->folio)}} method="post">
          {{ csrf_field() }}
          <div class="form-group row">
            <label for="tabla" class="col-sm-2 text-end control-label col-form-label">Tabla*</label>
            <div class="col-md-8">
              <input type="text" class="required form-control @error('tabla') is-invalid @enderror" name="tabla" placeholder="Tabla" required autofocus>
              @error('tabla')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
          <div class="form-group row">
            <label for="tabla" class="col-sm-2 text-end control-label col-form-label">Columna*</label>
            <div class="col-md-8">
              <input type="text" class="required form-control @error('columna') is-invalid @enderror" name="columna" placeholder="Columna" required autofocus>
              @error('columna')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
          <div class="form-group row">
            <label for="dato" class="col-sm-2 text-end control-label col-form-label">Dato*</label>
            <div class="col-md-8">
              <input type="text" class="required form-control @error('dato') is-invalid @enderror" name="dato" placeholder="Dato" required autofocus>
              @error('dato')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
          <!--<div class="form-group row">
            <label for="tabla" class="col-sm-2 text-end control-label col-form-label">Columna*</label>
            <div class="col-md-8">
              <input type="text" class="required form-control @error('columna') is-invalid @enderror" name="columna" placeholder="Columna" required autofocus>
              @error('columna')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>-->
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
          <form  class="dropzone" action="{{route('Adjuntos',$folio)}}" method="post" enctype="multipart/form-data" id="myAwesomeDropzone"></form> 
          <button type="submit" class="btn btn-success waves-effect waves-light text-white">
            <a href="{{route('Documentos',$folio)}}" style="color:white"> Actualizar</a>
          </button>
        </div>
      </div>
  </div>
</div>
<!-- End Modal -->