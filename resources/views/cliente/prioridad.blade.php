@extends('home')
@section('content')

<!-- Incluir complemento -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="{{asset("assets/extra-libs/prism/prism.css")}}"/>
<link rel="stylesheet" type="text/css" href="{{asset("assets/libs/dragula/dist/dragula.min.css")}}"/>
  <!-- Start Row -->
  <!--<div class="tab-content">
    <div id="draggable-area" class="note-has-grid row">
      @foreach ($clientes as $cliente)
        <div class="col-md-2 single-note-item all-category">
          <a class="clientes" id="{{$cliente->id_cliente}}">
            <div class="card card-body">
              <span class="side-stick"></span>
              <h5 class="note-title text-truncate text-black w-75 mb-0">
                {{$cliente->nombre_cl}}
                <i class="point ri-checkbox-blank-circle-fill ms-1 fs-1"></i>
              </h5>
                <p class="note-date fs-2 text-muted">
                  <span>Solicitudes</span>
                  <span class="badge bg-light text-dark">*</span>
                </p>
            </div>
          </a>
        </div>
      @endforeach
      <div class="col-md-2 single-note-item all-category">
        <a id="reset">
          <div class="card card-body">
            <span class="side-stick"></span>
            <h5 class="note-title text-truncate w-75 mb-0">
              GENERAL
              <i class="point ri-checkbox-blank-circle-fill ms-1 fs-1"></i>
            </h5>
            
                <p class="note-date fs-2 text-muted">
                  <span>Solicitudes</span>
                  <span class="badge bg-light text-dark">*</span>
                </p>
          </div>
        </a>
      </div>
    </div>
  </div>-->
  <!-- End Row -->
<div class="row col-lg-12 col-md-12"> 
  <div class="col-md-12">
    <div class="row">
      <div class="card">
        <br>
        <select id="sistemas" class="select2 form-control custom-select" style="width: 100%; height: 36px">
          <option value="reset">Clientes</option>
          @foreach($clientes as $cliente)
            <option value="{{$cliente->id_cliente}}">{{$cliente->nombre_cl}}</option>
          @endforeach
        </select>
        <br>
        <div class="card-header d-flex bg-warning">
          <h4 class="mb-0 col-lg-9 text-white">Activos</h4>
          <button class="btn btn-sm ml-auto waves-effect waves-light btn-outline-dark" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            <a data-bs-toggle="tooltip" data-bs-placement="left" title="Recuerda seleccionar algún cliente un cliente">Solicitar Ajuste de prioridades</a>
          </button>
        </div>
        <div class="card-body">
          <div class="row draggable-cards" id="card-colors">
            @if ($validar == 0)
              @foreach($pendientes as $pendiente)
                <div class="col-md-4 col-sm-4 filter cliente-{{$pendiente->id_cliente}} sistema-{{$pendiente->id_sistema}}" id="{{$pendiente->folio}}" >
                  <div class="s d-none" id="{{$pendiente->id_sistema}}"></div>
                  <!-- ---------------------start Special title treatment---------------- -->
                  <div class="card card-hover ">
                    @if(($pendiente->posicion < 6) and ($pendiente->posicion != NULL))
                    <div class="card-header bg-danger">
                      <h5 class="mb-0 text-dark" data-bs-toggle="tooltip" data-bs-placement="right" title="LEVANTAMIENTO">
                        {{$pendiente->folio}}
                        @if($pendiente->es_emergente == 1)
                          <i class="point ri-checkbox-blank-circle-fill ms-1 fs-1 text-light-danger">Emergente</i>
                        @endif
                      </h5>
                    </div>
                    @elseif(($pendiente->posicion > 5) and ($pendiente->posicion < 9) and ($pendiente->posicion != NULL)) 
                    <div class="card-header bg-primary">
                      <h5 class="mb-0 text-dark" data-bs-toggle="tooltip" data-bs-placement="right" title="CONSTRUCCIÓN">
                        {{$pendiente->folio}}
                        @if($pendiente->es_emergente == 1)
                          <i class="point ri-checkbox-blank-circle-fill ms-1 fs-1 text-light-info">Emergente</i>
                        @endif
                      </h5>
                    </div>
                    @elseif(($pendiente->posicion == 9) and ($pendiente->posicion != NULL)) 
                    <div class="card-header bg-success" data-bs-toggle="tooltip" data-bs-placement="right" title="LIBERACIÓN">
                      <h5 class="mb-0 text-dark">
                        {{$pendiente->folio}}
                        @if($pendiente->es_emergente == 1)
                          <i class="point ri-checkbox-blank-circle-fill ms-1 fs-1 text-light-success">Emergente</i>
                        @endif
                      </h5>
                    </div>
                    @elseif(($pendiente->posicion == 10) and ($pendiente->posicion != NULL)) 
                    <div class="card-header bg-orange">
                      <h5 class="mb-0 text-dark" data-bs-toggle="tooltip" data-bs-placement="right" title="IMPLEMENTACIÓN">
                        {{$pendiente->folio}}
                        @if($pendiente->es_emergente == 1)
                          <i class="point ri-checkbox-blank-circle-fill ms-1 fs-1 text-light-warning">Emergente</i>
                        @endif
                      </h5>
                    </div>
                    @endif
                    <div @if($pendiente->posicion < 6) class="card-body sistemas bg-light-danger" @elseif(($pendiente->posicion > 5) and ($pendiente->posicion < 9) and ($pendiente->posicion != NULL)) class="card-body sistemas bg-light-primary" @elseif(($pendiente->posicion == 9) and ($pendiente->posicion != NULL)) class="card-body sistemas bg-light-success" @elseif(($pendiente->posicion == 10) and ($pendiente->posicion != NULL)) class="card-body sistemas bg-light-warning" @endif>
                      <h6 class="card-title text-truncate">{{$pendiente->descripcion}}</h6>
                      <p class="card-text filtro text-truncate">{{$pendiente->titulo}}</p>
                      <p class="card-text filtro">{{$pendiente->nombre_cl}}</p>
                      @if(($pendiente->posicion < 6) and ($pendiente->posicion != NULL))
                        <a href={{route('Documentos',Crypt::encrypt($pendiente->folio))}} class="btn btn-light-danger text-danger">Documentación</a>
                      @elseif(($pendiente->posicion > 5) and ($pendiente->posicion < 9) and ($pendiente->posicion != NULL))
                        <a href={{route('Documentos',Crypt::encrypt($pendiente->folio))}} class="btn btn-light-primary text-primary">Documentación</a>
                      @elseif(($pendiente->posicion == 9) and ($pendiente->posicion != NULL))
                        <a href={{route('Documentos',Crypt::encrypt($pendiente->folio))}} class="btn btn-light-success text-success">Documentación</a>
                      @elseif(($pendiente->posicion == 10) and ($pendiente->posicion != NULL))
                        <a href={{route('Documentos',Crypt::encrypt($pendiente->folio))}} class="btn btn-light-warning text-warning">Documentación</a>
                      @endif
                    </div>
                  </div>
                  <!-- --------------------- end Special title treatment ---------------- -->
                </div>
              @endforeach
            @else
                @for ($i = 0; $i < count(explode( ',', str_replace(' ', '', $orden->orden ))); $i++)
                  <div class="col-md-4 col-sm-4 filter cliente-{{$orden->id_cliente}} sistema-{{$orden->id_sistema}}" id="{{explode( ',', str_replace(' ', '', $orden->orden ))[$i]}}" >
                    <div class="s d-none" id="{{$orden->id_sistema}}"></div>
                    <!-- ---------------------start Special title treatment---------------- -->
                    <div class="card card-hover ">
                      <div class="card-header">
                        <h5 class="mb-0 text-dark">{{explode( ',', str_replace(' ', '', $orden->orden ))[$i]}}</h5>
                      </div>
                      <div class="card-body">
                        @foreach($pendientes as $pendiente)
                          @if (explode( ',', str_replace(' ', '', $orden->orden ))[$i] == $pendiente->folio)
                            <h6 class="card-title text-truncate">{{$pendiente->descripcion}}</h6>
                            <p class="card-text filtro text-truncate">
                              {{$pendiente->nombre_cl}}
                            </p>
                            <a href={{route('Documentos',Crypt::encrypt($pendiente->folio))}} class="btn btn-light-primary text-primary">Documentación</a>
                          @endif
                        @endforeach
                      </div>
                    </div>
                    <!-- ---------------------
                                      end Special title treatment
                                  ---------------- -->
                  </div>
                @endfor
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="card">
      <div class="card-header bg-danger">
        <h4 class="mb-0 text-white">Pospuestos</h4>
      </div>
      <div class="card-body">
        <div class="row draggable-cards" id="draggable-area">
          @foreach ($pospuestos as $pospuesto)
            <div class="col-md-4 col-sm-4 filter cliente-{{$pospuesto->id_cliente}}">
              <!-- ---------------------
                                start Special title treatment
                            ---------------- -->
              <div class="card card-hover ">
                <div class="card-header">
                  <h5 class="mb-0 text-dark">{{$pospuesto->folio}}</h5>
                </div>
                <div class="card-body">
                  <h6 class="card-title text-truncate">{{$pospuesto->descripcion}}</h6>
                  <p class="card-text filtro">
                    {{$pospuesto->nombre_cl}}
                  </p>
                  <a href={{route('Documentos',Crypt::encrypt($pospuesto->folio))}} class="btn btn-light-primary text-primary">Documentación</a>
                </div>
              </div>
              <!-- ---------------------
                                end Special title treatment
                            ---------------- -->
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="card">
      <div class="card-header bg-success">
        <h4 class="mb-0 text-white">Implementados</h4>
      </div>
      <div class="card-body">
        <div class="row draggable-cards" id="draggable-area">
          @foreach ($implementados as $implementado)
            <div class="col-md-4 col-sm-4 filter cliente-{{$implementado->id_cliente}}">
              <!-- ---------------------
                                start Special title treatment
                            ---------------- -->
              <div class="card card-hover ">
                <div class="card-header">
                  <h5 class="mb-0 text-dark">{{$implementado->folio}}</h5>
                </div>
                <div class="card-body">
                  <h6 class="card-title text-truncate">{{$implementado->descripcion}}</h6>
                  <p class="card-text filtro">
                    {{$implementado->nombre_cl}}
                  </p>
                  <a href={{route('Documentos',Crypt::encrypt($implementado->folio))}} class="btn btn-light-primary text-primary">Documentación</a>
                </div>
              </div>
              <!-- ---------------------
                                end Special title treatment
                            ---------------- -->
            </div>
          @endforeach
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
            Solicitar ajuste a prioridades
          </h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="icon text-sm-start">
          <i class="feather-sm h6" data-feather="info"></i>
          <small>El envio de la solicitud solo es posible si seleccionaste un cliente</small>
        </div>
        <div class="modal-body">
          <div class="fixed-top">...</div>
          <p>
            Si se autoriza enviar los datos, se debera esperar a que un coordinador autorice los ajustes
          </p>
          <div class="form-group row">
            <label for="solicitante" class="col-sm-12 control-label col-form-label">Quien solicita</label>
            <div class="col-md-12">
              <input id="solicitante" type="text" class="required form-control  @error ('solicitante') is-invvalid @enderror" placeholder="ej. Juan Pérez González">
              @error('solicitante')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light-danger text-danger font-medium waves-effect text-start" data-bs-dismiss="modal">
            Cancelar
          </button>
          <button id="solicitar" type="button" class="btn btn-success d-block block-modal">Enviar</button>
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
  /*$(document).ready(function(){
    $('#reset').click(function(){
        $('.filter').show();
    });
    $('.clientes').click(function(){
      var filtro = $(this).attr('id');
      $('.filter').hide();
      $('.cliente-' + filtro ).show();
    });
  });*/
  $(document).ready(function(){
   // $('.filter').hide();
    $('#sistemas').on('change', function(){
      var value = $(this).val();
      if(value == 'reset'){
        $('.filter').show();
      }else{
        $('.filter').hide();
      }
      $('.cliente-' + value ).show();
      $('#solicitar').on('click', function (){
        var cliente = value;
        var lista = document.getElementById('card-colors');
        var sistema = $('.s').attr('id');
        var solicitante = $('#solicitante').val();
        let orden = [];
        for(var i = 0; i<lista.children.length; i++){
          if(lista.children[i].classList[3] == 'cliente-' + cliente){
            //console.log()
            if (i < lista.children.length) {
              orden.push(lista.children[i].id);
            }
          }
        }
        if(orden.length > 1){
            //console.log($('.s'));
            //console.log(sistema);
          $.ajax({
            headers: {'X-CSRF-TOKEN' : "{{csrf_token()}}"},
            type: 'POST',
            url: "solicitud.prioridades",
            data: { id_cliente: cliente, orden: orden, id_sistema: sistema, solicitante: solicitante},
            success: function (response) {
              window.location.href = window.location.href;
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
              //alert("Status: " + textStatus); alert("Error: " + errorThrown); 
              if (XMLHttpRequest.status === 422) {
                //alert('Not connect: Verify Network.');
                alert("Se requiere el nombre del solicitante");
              } 
            }
          });
        }
      });
    });
  });
</script>

@endsection