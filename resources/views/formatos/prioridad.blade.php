@extends('home')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="border-bottom title-part-padding">
        <h4 class="card-title mb-0">Solicitudes</h4>
      </div>
      <div class="card-body">
        <div class="form-group mb-3">
          <button class="form-select" data-bs-toggle="dropdown" aria-expanded="false" id="dropdownMenuButton" type="button">
            Seleccionar
          </button>
          <div class="dropdown-menu w-75" aria-labelledby="dropdownMenuButton">
            @foreach ($solicitudes as $cliente)
              <li data-bs-toggle="collapse" data-bs-target="#{{str_replace(' ', '', $cliente->nombre_cl)}}" aria-expanded="false">
                <a>
                  {{$cliente->nombre_cl}}
                </a>
              </li>
            @endforeach
            </div>
        </div>
        @foreach ($solicitudes as $solicitud)
          <div class=" row collapse" id="{{str_replace(' ', '', $solicitud->nombre_cl)}}">
            <div class="card-body overflow-auto">
              <div class="card">
                <div class="card-header d-flex">
                  <h4 class="mb-0">{{$solicitud->nombre_cl}}</h4>
                </div>
                @for ($i = 0; $i < count(explode( ',', str_replace(' ', '', $solicitud->orden ))); $i++)
                  <div class="col-md-12 col-sm-12" id="{{$solicitud->folio}}" >
                    <!-- ---------------------start Special title treatment---------------- -->
                    <div class="card card-hover">
                      <div class="card-header">
                        <h5 class="mb-0 text-dark">{{explode( ',', str_replace(' ', '', $solicitud->orden ))[$i]}}</h5>
                      </div>
                      <div class="overflow-auto">
                        <div class="card-body">
                          @foreach ($pendientes as $pendiente)
                              @if ($pendiente->folio == explode( ',', str_replace(' ', '', $solicitud->orden ))[$i])
                                <h6 class="card-title">{{$pendiente->descripcion}}</h6>
                                <p class="card-text">
                                  {{$pendiente->nombre_s}}
                                </p>
                              @endif
                          @endforeach
                          <a href={{route('Avance',explode( ',', str_replace(' ', '', $solicitud->orden ))[$i])}} class="btn btn-light-primary text-primary">Documentacion</a>
                        </div>
                      </div>
                    </div>
                    <!-- ---------------------
                                      end Special title treatment
                                  ---------------- -->
                  </div>
                @endfor
              </div>
            </div>
            <a class="btn btn-success btn-sm ml-auto text-white" data-bs-toggle="modal" data-bs-target="#aut{{$solicitud->id}}">
              Autorizacion
            </a>
          </div>
          <!-- Modal -->
          <div class="modal fade" id="aut{{$solicitud->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header d-flex align-items-center">
                  <h4 class="modal-title" id="myLargeModalLabel">
                    Autorizar ajuste a prioridades
                  </h4>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <p>
                    Una vez autorizada la actualizacion si se de sea ajustar el orden se tendra que hacer una nueva solicitud y en caso de ser rechazado desaparecera de las solicitudes
                  </p>
                </div>
                <div class="modal-footer">
                  <form action="{{route ('AutR',$solicitud->id)}}">
                    {{ csrf_field() }}
                    <button name="estatus" value="rechazado" type="submit" class="btn btn-light-danger text-danger font-medium waves-effect text-start">
                      Rechazar
                    </button>
                    <button name="estatus" value="autorizado" id="solicitar" type="submit" class="btn btn-success">Autorizar</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
<style>
  .overflow-auto{
    overflow-y: auto;
    max-height: 500px;
  }
</style>
@endsection