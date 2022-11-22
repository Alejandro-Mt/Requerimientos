@extends('layouts.app')
@section('content')
  @foreach ($proyectos as $proyecto)
  <div class="col-lg-2 col-md-6">
    <div class="card">
      <div class="el-card-item pb-3">
        <div class="el-card-avatar mb-3 el-overlay-1 w-100 overflow-hidden position-relative text-center">
          <object data="{{asset("assets/images/users/$proyecto->nombre_s.png")}}" type="image/png"  width="130" height="130">
            <img src="{{asset("assets/images/new_logo_3ti.png")}}" alt="Sin imagen" class="d-block position-relative w-100" width="130" height="130">   
          </object> 
          <div class="el-overlay w-100 overflow-hidden">
            <ul class="list-style-none el-info text-white text-uppercase d-inline-block p-0">
              <li class="el-item d-inline-block my-0 mx-1">
                <div class="el-card-content text-center">
                  <button id="" type="button" class="btn waves-effect waves-light btn-outline-secondary">
                    <a href="{{route('Prioridad',$proyecto->id_sistema)}}">
                        <i class="me-2 mdi mdi-archive">
                          {{$proyecto->nombre_s}}
                        </i>
                    </a>
                  </button>
                </div>
                <!--<a class="btn default btn-outline el-link text-dark border-dark" href="{{route('Prioridad',$proyecto->id_sistema)}}">
                  <i class="fas fa-archive"></i>
                </a>-->
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endforeach
@endsection