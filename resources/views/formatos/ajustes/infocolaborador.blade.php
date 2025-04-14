
<!-- Modal -->
<div class="modal fade" id="modal-{{$loop->iteration}}" tabindex="-1" aria-labelledby="scroll-long-inner-modal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <form action="{{route('AjUser')}}" method="post">
        {{ csrf_field() }}
        <div class="modal-header d-flex align-items-center">
          <h4 class="modal-title" id="myLargeModalLabel">{{$miembro->nombre}} {{$miembro->apaterno}}</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <div class="row border mt-3">
              <div class="col-md-6 ms-auto bg-light py-3">Puesto: </div>
              <div class="col-md-6 ms-auto bg-light py-3">
                <input class="d-none" name="id[]" value="{{$miembro->id}}" type="text">
                <select class="form-select @error('id_puesto') is-invalid @enderror" style="width: 100%; height:36px;" name="id_puesto[]" required autofocus>
                  <option value={{$miembro->usrdata->id_puesto}}>{{$miembro->usrdata->puesto->puesto}}</option> 
                  @foreach ($puestos as $puesto)
                    @if ($puesto->jerarquia < Auth::user()->usrdata->puesto->jerarquia && $puesto->id_puesto < Auth::user()->usrdata->id_puesto)
                      <option value = {{ $puesto->id_puesto }}>{{$puesto->puesto}}</option>;
                    @endif
                  @endforeach                     
                </select>
                @error('id_puesto')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <!--<div class="col-md-4 ms-auto bg-light py-3">.col-md-4 .ms-auto</div>-->
            </div>
            <div class="row border mt-3">
              <div class="col-md-6 ms-auto bg-light py-3">{{'Area'}}</div>
              <div class="col-md-6 ms-auto bg-light py-3">
                <select class="form-select @error('id_area') is-invalid @enderror" style="width: 100%; height:36px;" name="id_area[]" required autofocus>
                  <option value={{$miembro->usrdata->id_area}}>{{$miembro->usrdata->area->area}}</option> 
                  @foreach ($areas as $area)
                    @if (Auth::user()->usrdata->puesto->jerarquia > 3)
                      <option value = {{$area->id_area}}>{{$area->area}}</option>;
                    @endif
                  @endforeach                     
                </select>
                @error('id_area')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <div class="row border mt-3">
              <div class="col-md-6 ms-auto bg-light py-3">{{'Departamento'}}</div>
              <div class="col-md-6 ms-auto bg-light py-3">
                <select class="form-select @error('id_departamento') is-invalid @enderror" style="width: 100%; height:36px;" name="id_departamento[]" required autofocus>
                  <option value={{$miembro->usrdata->id_departamento}}>{{$miembro->usrdata->departamento->departamento}}</option> 
                  @foreach ($departamentos as $departamento)
                    @if (Auth::user()->usrdata->puesto->jerarquia > 3)
                      <option value = {{$departamento->id}}>{{$departamento->departamento}}</option>;
                    @endif
                  @endforeach                     
                </select>
                @error('id_departamento')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-light-success text-white font-medium waves-effect text-start">
            Guardar
          </button>
        </div>
      </form>
    </div>
  </div>
</div>