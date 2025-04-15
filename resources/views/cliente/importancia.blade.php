@extends('home')
@section('content')

<!-- Incluir complemento -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="{{asset("assets/extra-libs/prism/prism.css")}}"/>
<link rel="stylesheet" type="text/css" href="{{asset("assets/libs/dragula/dist/dragula.min.css")}}"/>
<div class="row col-lg-12 col-md-12"> 
  {{ method_field('POST') }}
  <div class="col-md-12">
    <div class="row">
      <div class="card">
<select id="sistemas" class="select2 form-control custom-select" style="width: 100%; height: 36px">
  <option>Cliente</option>
  @foreach($proyectos as $s)
    <option value="{{$s->id_sistema}}">{{$s->nombre_s}}</option>
  @endforeach
</select>
        <div class="card-header d-flex bg-warning">
          <h4 class="mb-0 text-white">Clientes</h4>
          <!--<a class="btn btn-success btn-sm ml-auto text-white" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Solicitar Ajuste de prioridades
          </a>-->
          <button class="btn btn-sm ml-auto waves-effect waves-light btn-outline-dark" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Ajustar posiciones
          </button>
        </div>
        <div class="card-body">
          <div class="row draggable-cards" id="card-colors">
              @foreach($listado as $lista)
                @foreach ($proyectos as $p)
                  @if($lista->id_sistema == $p->id_sistema)
                  <div class="col-md-3 col-sm-12 filter sistema-{{$lista->id_sistema}}" id="{{$lista->id_cliente}}">
                    <!-- ---------------------start Special title treatment---------------- -->
                    <div class="card card-hover">
                      <div class="card-header">
                        <h5 class="mb-0 text-dark">{{$lista->nombre_cl}}</h5>
                      </div>
                      <div class="card-body sistemas">
                        <div class="el-card-item pb-3">
                          <div class="el-card-avatar mb-3 el-overlay-1 w-100 overflow-hidden position-relative text-center">
                            <object data="{{asset("assets/images/users/$lista->nombre_cl.png")}}" type="image/png"  width="130" height="130">
                              <img src="{{asset("assets/images/new_logo_3ti.png")}}" alt="Sin imagen" class="d-block position-relative w-100" width="130" height="130">   
                            </object> 
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- --------------------- end Special title treatment ---------------- -->
                  </div>

                  @endif
                @endforeach
               
              @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header d-flex align-items-center">
          <h4 class="modal-title" id="myLargeModalLabel">
            Autorizar
          </h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>
            ¿Estas seguro de aceptar la actualizacion?
          </p>
          <!--<div class="form-group row">
            <label for="solicitante" class="col-sm-12 text-end control-label col-form-label">Quien solicita</label>
            <div class="col-md-12">
              <input id="solicitante" type="text" class="required form-control  @error ('solicitante') is-invvalid @enderror" placeholder="ej. Juan Pérez González">
              @error('solicitante')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>-->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light-danger text-danger font-medium waves-effect text-start" data-bs-dismiss="modal">
            Cancelar
          </button>
          <button id="solicitar" type="button" class="btn btn-success d-block block-modal">Aceptar</button>
        </div>
      </div>
    </div>
  </div>
</div>
<style>
  .card-body,.overflow-auto{
    overflow-y: auto;
    max-height: 500px;
  }
</style>
<script src='https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.3/dragula.min.js'></script>
<script>
  $(document).ready(function () {
    dragula([document.getElementById('draggable-area')]),
      dragula([document.getElementById('card-colors')],
        {
          copy: false,
          copySortSource: true,
        },
      )
        .on('drag', function (e) {
          e.className = e.className.replace('card-moved', '');
        })
        .on('drop', function (e) {
          e.className += ' card-moved';         
        })
        .on('over', function (e, t) {
          t.className += ' card-over';
        })
        .on('out', function (e, t) {
          t.className = t.className.replace('card-over', '');
        }),
      dragula([document.getElementById('copy-left'), document.getElementById('copy-right')], {
        copy: !0,
      }),
      dragula(
        [document.getElementById('left-handles'), document.getElementById('right-handles')],
        {
          moves: function (e, t, n) {
            return n.classList.contains('handle');
            //console.log(n.classList.contains('titleArea'));
          },
        },
      ),
      dragula(
        [
          document.getElementById('left-titleHandles'),
          document.getElementById('right-titleHandles'),
        ],
        {
          moves: function (e, t, n) {
            return n.classList.contains('titleArea');
          },
        },
      );
  });
</script>
<script>
  $(document).ready(function () {
    $('#solicitar').on('click', function (){
      var sistema = $('#sistemas').val();
      var lista = document.getElementById('card-colors');
      var solicitante = $('#solicitante').val();
      let orden = [];
      for(var i = 0; i<lista.children.length; i++){
        if(lista.children[i].classList[3] == 'sistema-' + sistema){
          console.log()
          if (i < lista.children.length) {
            orden.push(lista.children[i].id);
          }
        }
      }
      console.log(orden, sistema)
      if(orden.length > 1){
        $.ajax({
          headers: {'X-CSRF-TOKEN' : "{{csrf_token()}}"},
          type: 'POST',
          url: "clientes.prioridades",
          data: { orden: orden, id_sistema: sistema},
          success: function (response) {
            window.location.href = "clientes";
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) { 
            //alert("Status: " + textStatus); alert("Error: " + errorThrown); 
            if (XMLHttpRequest.status === 422) {
              //alert('Not connect: Verify Network.');
              alert("Se requiere el nombre del solicitante");
            } else{alert(XMLHttpRequest.status)}
          }
        });
      }else{alert("Tines que seleccionar un sistema con mas de un cliente")}
    }) 

  })
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('.filter').hide();
    $('#sistemas').on('change', function(){
      var value = $(this).val();
      $('.filter').hide();
      $('.sistema-' + value ).show();
      
    });
  });
  </script>
@endsection