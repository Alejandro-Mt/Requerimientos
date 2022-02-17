@extends('home')
<link href="{{asset("assets/libs/magnific-popup/dist/magnific-popup.css")}}" rel="stylesheet"/>
@section('content')
<form action="{{route('AUser')}}" method="post">
  {{ csrf_field() }}
<div class="row el-element-overlay">
  @foreach ($equipo as $miembro)
    <div class="col-lg-3 col-md-6">
      <div class="card">
        <div class="el-card-item pb-3">
          <div class="el-card-avatar mb-3 el-overlay-1 w-100 overflow-hidden position-relative text-center">
              @if ($miembro->avatar == NULL)
                  <img src="{{asset("assets/images/users/1.jpg")}}" alt="user" class="d-block position-relative w-100"/> 
              @else
                  <img src="{{$miembro->avatar}}" alt="user" class="d-block position-relative w-100"/>    
              @endif
            <div class="el-overlay w-100 overflow-hidden">
              <ul class="list-style-none el-info text-white text-uppercase d-inline-block p-0">
                <li class="el-item d-inline-block my-0 mx-1">
                  <a data-bs-toggle="modal" data-bs-target="#modal-{{$loop->iteration}}" class="btn default btn-outline image-popup-vertical-fit el-link text-white border-white" href={{$miembro->avatar}}>
                    <i class="ri-search-line"></i>
                  </a>
                </li>
                <li class="el-item d-inline-block my-0 mx-1">
                  <a class="btn default btn-outline el-link text-white border-white" href="javascript:void(0);">
                    <i class="ri-links-line"></i>
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <div class="el-card-content text-center">
            <h4 class="mb-0">{{$miembro->nombre}} {{$miembro->apaterno}}</h4>
            <span class="text-muted">{{$miembro->email}}</span>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modal-{{$loop->iteration}}" tabindex="-1" aria-labelledby="scroll-long-inner-modal" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
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
                  <select class="form-select @error('id_puesto') is-invalid @enderror" 
                          style="width: 100%; height:36px;" 
                          name="id_puesto[]" 
                          tabindex="-1" 
                          aria-hidden="true" 
                          required 
                          autofocus>
                    <option value={{$miembro->id_puesto}}>
                      @foreach ($puestos as $puesto) 
                        @if ($puesto->id_puesto == $miembro->id_puesto) 
                            {{$puesto->puesto}}
                        @endif  
                      @endforeach
                    </option> 
                    @foreach ($puestos as $puesto)
                      @if ($puesto->jerarquia < $usuario->jerarquia && $puesto->id_puesto < $usuario->id_puesto)
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
                  <select class="form-select @error('id_area') is-invalid @enderror" 
                          style="width: 100%; height:36px;" 
                          name="id_area[]" 
                          tabindex="-1" 
                          aria-hidden="true" 
                          required 
                          autofocus>
                    <option value={{$miembro->id_area}}>
                      @foreach ($areas as $area) 
                        @if ($area->id_area == $miembro->id_area)
                            {{$area->area}}
                        @endif  
                      @endforeach
                    </option> 
                    @foreach ($areas as $area)
                      @if ($usuario->jerarquia > 3)
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
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-light-success text-white font-medium waves-effect text-start">
              Guardar
            </button>
          </div>
        </div>
      </div>
    </div>
  @endforeach
</div>  
</form>
@endsection
<script src="{{asset("assets/libs/magnific-popup/dist/jquery.magnific-popup.min.js")}}"></script>
<script src="{{asset("assets/libs/magnific-popup/meg.init.js")}}"></script>