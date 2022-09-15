@extends('home')
<link href="{{asset("assets/libs/magnific-popup/dist/magnific-popup.css")}}" rel="stylesheet"/>
@section('content')
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
                @if(Auth::user()->id_puesto >= 4)
                  <li class="el-item d-inline-block my-0 mx-1">
                    <a data-bs-toggle="modal" data-bs-target="#acceso-{{$loop->iteration}}" class="btn default btn-outline el-link text-white border-white" href="javascript:void(0);">
                      <i class="ri-links-line"></i>
                    </a>
                  </li>
                @endif
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
    @include('formatos.ajustes.infocolaborador')
    @include('formatos.ajustes.accesos')
  @endforeach
</div>
@endsection
<!-- scripts page -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
  function update(caja){
    //var name = $('#'+caja).attr('id'); //id de figura
    var create = document.getElementById(caja);
    var des = document.getElementById(caja).value;
    //console.log(create)
    //console.log(des)
    if (create.checked == true) {
      //insert
      $.ajax({
          headers:{'X-CSRF-TOKEN' : "{{csrf_token()}}"},
          type: "POST",
          url: "accesos."+caja
        });
      //console.log(1)
    }else{
      //destroy
      $.ajax({
          headers:{'X-CSRF-TOKEN' : "{{csrf_token()}}"},
          type: "GET",
          url: "accesos.update."+caja
        });
    };
  }
</script>