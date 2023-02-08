@extends('home')
@section('content')

<link href="{{asset("assets/extra-libs/toastr/dist/build/toastr.min.css")}}" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="card">
  <div class="box bg-success text-center">
    <!--<h5 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i></h5>-->
    <h3 class="text-white">RONDAS</h3>
  </div>
  <div class="card-body wizard-content">
    <!--<h3>Liberación</h3>-->
    <p>(*) Campos Obligatorios</p>
    <h6 class="card-subtitle"></h6>
    <form method="POST" action="{{route ('CRonda')}}" class="mt-5">
      {{ csrf_field() }}
      <div>
        <section>
          <div class="form-group row">
            <label for="Folio" class="col-sm-2 text-end control-label col-form-label">Folio</label>
            <div class="col-sm-3">
              @foreach ($registros as $registro)
                <input type="text" class="required form-control" name="folio" value="{{$registro->folio}}" readonly="readonly">
              @endforeach
            </div>
          </div>
          <div class="form-group row">
            <label for="Ronda" class="col-sm-2 text-end control-label col-form-label">Ronda</label>
            <div class="col-sm-1">
              <input type="text" class="required form-control" name="ronda" value="{{$ronda}}" readonly="readonly">
            </div>
          </div>
          <div class="form-group row">
            <label for="aprobadas" class="col-sm-2 text-end control-label col-form-label">Pruebas acreditadas*</label>
            <div class="col-md-8">
              <input type="number" name="aprobadas" class="required form-control
              @error('aprobadas') is-invalid @enderror"
              placeholder="Pruebas satisfactorias" required autofocus>
              @error('aprobadas')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div><div class="form-group row">
            <label for="rechazadas" class="col-sm-2 text-end control-label col-form-label">Pruebas declinadas*</label>
            <div class="col-md-8">
              <input type="number" name="rechazadas" class="required form-control
              @error('rechazadas') is-invalid @enderror"
              placeholder="Pruebas con errores" required autofocus>
              @error('rechazadas')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
          @if($ronda == '0')
            <div class="form-group row">
              <label for="evidencia" class="col-sm-2 text-end control-label col-form-label">Documentacion*</label>
              <div class="col-md-8">
                <input type="text" class="required form-control @error('evidencia') is-invalid @enderror" name="evidencia"  placeholder="evidencia" required autofocus>
                @error('evidencia')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
          @endif
          <div class="card-body text-center">
            @if ($solinf == 0)
              <button type="submit" class="btn btn-primary text-white">Guardar</button>
            @else
              <button type="button" class="btn btn-primary text-white" id="null-data-toast">Guardar</button>
            @endif
            <label> </label> 
            <button type="reset" value="reset" class="btn btn-danger"><a href="{{('formatos.requerimientos.edit') }}" style="color:white">Cancelar</a></button>
          </div>
        </section>
      </div>
    </form>
  </div>
</div>

<form class="form-horizontal" action="" method="post">
<h5>*Campos obligatorios</h5>

<script type="text/javascript">
    function showContent() {
        element = document.getElementById("content");
        check = document.getElementById("retraso");
        if (check.checked) {
            element.style.display='block';
        }
        else {
            element.style.display='none';
        }
    }
</script>
<script src="{{asset("assets/extra-libs/toastr/dist/build/toastr.min.js")}}"></script>
<script src="{{asset("assets/extra-libs/toastr/toastr-init.js")}}"></script>

@endsection 