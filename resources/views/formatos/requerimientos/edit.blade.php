@extends('home')
@section('content')
<!-- Incluir la hoja de estilo predeterminada -->
<link href="{{asset("assets/extra-libs/toastr/dist/build/toastr.min.css")}}" rel="stylesheet" />
<!-- Incluir complemento -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<body>
    @if (session('alert'))
        <input class="d-none" id="message" value="{{ session('alert') }}">
        <script>
            $(document).ready(function(){
                message = $("#message").val();
                sended = 'El Correo ha sido enviado ';
                if(message == sended){
                    toastr.success(
                        message,
                        "¡Enviado!",
                        { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 2000 }
                    );
                }else{
                    toastr.error(
                        message,
                        "¡Error!",
                        { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 2000 }
                    );
                }
            });
        </script>
    @endif
    <div class="row">
        <div class="card">
            <div class="button-group col-md-6 col-lg-4 d-flex align-items-stretch">
                @if (Auth::user()->id_puesto > 5)
                    <button id="pestana1" type="button" class="btn btn-light-primary text-primary px-4 rounded-pill font-medium collapsed">Análisis</button>
                    <button id="pestana2" type="button" class="btn btn-light-success text-success px-4 rounded-pill font-medium collapsed">Requerimientos</button>
                @else
                    @if (Auth::user()->id_area == 11)
                        <button id="pestana1" type="button" class="btn btn-light-primary text-primary px-4 rounded-pill font-medium collapsed">Análisis</button>
                    @else  
                        <button id="pestana2" type="button" class="btn btn-light-success text-success px-4 rounded-pill font-medium collapsed">Requerimientos</button>
                    @endif
                @endif
                <div class="mt-2 mt-md-0">
                    <button type="button" class="btn waves-effect waves-light btn-sm btn-outline-dark dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-filter feather-sm"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon></svg>
                    </button>
                </div>
            </div>
            <div class="btn-toolbar justify-content-between">
                <div class="collapse" id="collapseExample">
                    <div class="button-group">
                        <div class="btn-group mb-2" data-mdb-perfect-scrollbar="true" data-mdb-suppress-scroll-x="true">
                            <button type="button" class="btn text-gray dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Estatus
                            </button>
                            <ul class="dropdown-menu scrollable-menu">
                                @foreach ($estatus as $e)
                                <div class="table-responsive">
                                    <li class="list-inline-item">
                                        <a class="dropdown-item" href="#"> 
                                            <div class="form-check mr-sm-2">
                                            <input id="estatus{{$loop->iteration}}" type="checkbox" class="form-check-input secondary check-outline outline-secondary ches" value="{{$e->titulo}}">
                                            <label id="les{{$loop->iteration}}" class="form-check-label" for="estatus">{{$e->titulo}}</label>
                                            </div>
                                        </a>
                                    </li>
                                </div>
                                @endforeach
                            </ul>
                        </div>
                        <div class="btn-group mb-2">
                            <button type="button" class="btn text-gray dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Sistema
                            </button>
                            <ul class="dropdown-menu scrollable-menu">
                                @foreach ($sistemas as $sistema)
                                <div class="table-responsive">
                                    <li class="list-inline-item">
                                        <a class="dropdown-item" href="#"> 
                                            <div class="form-check">
                                            <input id="sistema{{$loop->iteration}}" type="checkbox" class="form-check-input secondary check-outline outline-secondary chsi" value="{{$sistema->nombre_s}}">
                                            <label id="lsi{{$loop->iteration}}" class="form-check-label" for="invalidcheck3">{{$sistema->nombre_s}}</label>
                                            </div>
                                        </a>
                                    </li>
                                </div>
                                @endforeach
                            </ul>
                        </div>
                        <button id="reset" class="btn waves-effect waves-light btn-rounded btn-outline-danger">Quitar filtros</button>
                    </div>
                </div>
            </div>
            <div class="card-body wizard-content">
                <h5 class="card-title mb-0">Seguimiento</h5>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">Folio</th>
                            <th class="text-center">Estatus</th>
                            <th class="text-center">Sistema</th>
                            <th class="text-center">Acción</th>
                            <th class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody id="searchable">
                        @foreach ($registros as $registro)
                            <tr id="{{$registro->folio}}"
                                @if (Auth::user()->id_puesto < 6)
                                    @if (Auth::user()->id_area == 11)
                                        @if ($registro->folio[0] == 'A')
                                            class="collapse show"
                                        @else
                                            class="collapse"
                                        @endif
                                    @else
                                        @if ($registro->folio[0] == 'P')
                                            class="collapse show"
                                        @else
                                            class="collapse"
                                        @endif
                                    @endif 
                                @else
                                    class="collapse show" 
                                @endif
                            onmousemove="lock('play{{$loop->iteration}}','btn{{$loop->iteration}}')">
                            <!-- Folio -->
                                <td class="col-md-2 text-center">
                                    <div class="form-group row">
                                        <div class="col-md-13" >
                                            <i id="{{$loop->iteration}}" 
                                                class="fas fa-arrow-circle-down" 
                                                onclick="arrow({{$loop->iteration}})" 
                                                data-bs-remove="fa-arrow-circle-down" 
                                                data-bs-toggle="collapse" 
                                                data-bs-target="#collapseOne_{{$loop->iteration}}" 
                                                href="#collapseOne_{{$loop->iteration}}">
                                            </i> 
                                            <a href="{{route('Avance',$registro->folio)}}" style="color:rgb(85, 85, 85)">{{$registro->folio}}</a>
                                        </div>
                                    </div>
                                </td>
                            <!-- Titulo -->
                                <td class="estatus col-md-3 text-center">
                                    @if ($registro->id_estatus==18 || $registro->id_estatus==14)
                                        <button type="button" class="w-100 btn btn-rounded text-dark">
                                            {{$registro->titulo}}
                                        </button>
                                    @else
                                        @foreach ($pausa as $pospuesto)
                                            @if ($registro->folio == $pospuesto->folio)
                                                @if ($pospuesto->pausa == 2)
                                                    <button type="button" class="w-100 btn btn-rounded text-dark" data-bs-toggle="modal" data-bs-target="#est{{$loop->iteration}}">
                                                        <a class="text-danger">{{"POSPUESTO"}}</a>
                                                    </button>
                                                @else     
                                                    <!-- Full width modal -->
                                                    <button type="button" class="w-100 btn btn-rounded text-dark" data-bs-toggle="modal" data-bs-target="#est{{$loop->iteration}}">
                                                        <!--<i data-feather="log-in" class="fill-white m-auto feather-sm text-center d-block text-center"></i>-->
                                                        {{$registro->titulo}}
                                                    </button>
                                                @endif
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                                <div id="est{{$loop->iteration}}" class="modal fade" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                @foreach($pausa as $p)
                                                    @if($p->folio == $registro->folio)
                                                        <div class="text-center mt-2 mb-4">
                                                            <a href="index.html" class="text-success">{{$registro->folio}}</a>
                                                        </div>
                                                        <button id="btnGroupVerticalDrop1" type="button" class="estatus justify-content-center w-100 btn btn-rounded d-flex text-dark align-items-center dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            @if($p->pausa == 2)
                                                                <a class="text-danger">{{"POSPUESTO"}}</a>
                                                            @else
                                                                {{$registro->titulo}}
                                                            @endif
                                                        </button>
                                                    @endif
                                                    <div class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="btnGroupVerticalDrop1">
                                                        @if ($p->pausa == 2 && $p->folio == $registro->folio)
                                                            <a class="dropdown-item" href="{{route('Play',$registro->folio)}}">{{$registro->titulo}}</a>
                                                            <a class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#conf{{$loop->iteration}}">CANCELAR</a>
                                                        @else
                                                            <a class="dropdown-item" href="{{route('Posponer',$registro->folio)}}">POSPONER</a>
                                                            <a class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#conf{{$loop->iteration}}">CANCELAR</a>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <div id="conf{{$loop->iteration}}" class="modal fade" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                @foreach($pausa as $p)
                                                    @if($p->folio == $registro->folio)
                                                        <div class="text-center mt-2 mb-4">
                                                            <a href="index.html" class="text-danger">¿Estas seguro de cancelar este requerimiento?</a>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div class="modal-footer">
                                                <a class="btn btn-invert" data-bs-dismiss="modal">Cancelar</a>
                                                <a type="submit" class="btn btn-success btn-ok" href="{{route('Cancelar',$registro->folio)}}">Confirmar</a>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->
                            <!-- Sistema -->
                                <td class="sistemas col-md-3 text-center">
                                    @foreach ($sistemas as $sistema) 
                                        @if ($registro->id_sistema == $sistema->id_sistema)
                                           {{$sistema->nombre_s}}
                                        @endif
                                    @endforeach
                                </td>
                            <!-- Accion -->
                                <td class="col-md-2">
                                    @switch($registro->id_estatus)
                                        @case(17)
                                            <button id="btn{{$loop->iteration}}" type="submit" class="btn btn-warning text-white w-100" ><a href="{{route('Formato',$registro->id_registro)}}" style="color:white">Llenar Solicitud</a></button>
                                            @break
                                        @case(10)
                                            <button id="btn{{$loop->iteration}}" type="submit" class="btn btn-warning text-white w-100" ><a href="{{route('Enviar',$registro->folio)}}" style="color:white">Enviar Reporte</a></button>
                                            @break
                                        @case(16)
                                                <button type="submit" class="btn btn-warning text-white w-100" ><a href="{{route('Levantamiento',$registro->id_registro)}}" style="color:white">Revisión de Datos</a></button>
                                                @if($registro->fechaaut <> null)
                                                    <button id="btn{{$loop->iteration}}" type="submit" class="btn btn-warning text-white w-100" ><a href="{{route('Enviar',$registro->folio)}}" style="color:white">Confirmación</a></button>
                                                @endif
                                            @break
                                        @case(11)
                                            @if ($registro->fechades == null)
                                                <button id="btn{{$loop->iteration}}" type="submit" class="btn btn-warning text-white w-100"><a data-bs-toggle="modal" data-bs-target="#Adjuntos{{$loop->iteration}}" style="color:white">Cargar autorización</a></button> 
                                                <!-- BEGIN MODAL -->
                                                <div class="modal" id="Adjuntos{{$loop->iteration}}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header d-flex align-items-center">
                                                                <h4 class="modal-title"><strong>Documentos adjuntos</strong></h4>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <a href="index.html" class="text-danger">Una vez autorizado no se podrán cargar nuevos archivos</a>
                                                                <form  class="dropzone" action="{{route('Adjuntos',$registro->folio)}}" method="post" enctype="multipart/form-data" id="myAwesomeDropzone">
                                                                </form> 
                                                            <button type="submit" class="btn btn-success waves-effect waves-light text-white">
                                                                <a href="{{route('Aut',$registro->folio)}}" style="color:white"> Autorizar</a>
                                                            </button>
                                                            <button type="button" class="btn waves-effect" data-bs-dismiss="modal"> Cancelar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                 <!-- End Modal -->
                                            @else
                                                <button id="btn{{$loop->iteration}}" type="submit" class="btn btn-warning text-white w-100"><a href="{{route('Planeacion',$registro->folio)}}" style="color:white">Planeación</a></button>
                                            @endif
                                            @break
                                        @case(9)
                                                <button id="btn{{$loop->iteration}}" type="submit" class="btn btn-warning text-white w-100" ><a href="{{route('Analisis',$registro->folio)}}" style="color:white">Análisis de Desarrollo</a></button>
                                            @break
                                        @case(7)
                                                <button id="btn{{$loop->iteration}}" type="submit" class="btn btn-warning text-white w-100" ><a href="{{route('Construccion',$registro->folio)}}" style="color:white">Construcción</a></button>
                                            @break
                                        @case(8)
                                                <button id="btn{{$loop->iteration}}" type="submit" class="btn btn-warning text-white w-100" ><a href="{{route('Liberacion',$registro->folio)}}" style="color:white">Liberación</a></button>
                                            @break
                                        @case(2)
                                                <button id="btn{{$loop->iteration}}" type="submit" class="btn btn-warning text-white w-100" ><a href="{{route('Implementacion',$registro->folio)}}" style="color:white">Implementación</a></button>
                                            @break
                                        @case(18)
                                                <button id="btn{{$loop->iteration}}" type="submit" class="btn btn-success text-white w-100" ><a href="#" style="color:white">Implementado</a></button>
                                            @break
                                        @default 
                                                <button id="btn{{$loop->iteration}}" type="submit" class="btn btn-danger text-white w-100" ><a href="#" style="color:white">Cancelado</a></button>
                                    @endswitch
                                </td>
                            <!-- Menu -->
                                <td class="col-md-2 align-items-center">
                                    @if ($registro->id_estatus <> 18)
                                      @if ($registro->id_estatus <> 14)
                                        <div class="form-group row">
                                            <div class="col-md-2 col-lg-1 f-icon">
                                                <a class="fas fa-plus" href="{{route('Subproceso',$registro->folio)}}" role="button" style="color:#3e5569"></a> 
                                            </div>
                                            @foreach ($pausa as $p)
                                                @if ($p->pausa == '1' and $p->folio==$registro->folio)
                                                    <div class="col-md-2 col-lg-2 f-icon">
                                                        <a id="play{{$loop->iteration}}" class="fas fa-play" style="color:green" href="{{route('Play',$registro->folio)}}"></a>
                                                    </div>
                                                @elseif ($p->pausa <> '1' and $p->folio==$registro->folio)
                                                    <div class="col-md-2 col-lg-2 f-icon">
                                                        <a id="play{{$loop->iteration}}"class="fas fa-pause"  style="color:red" href="{{route('Pausa',$registro->folio)}}"></a>
                                                    </div>
                                                @endif
                                            @endforeach
                                            <!--<button type="submit" class="btn btn-success text-white">
                                                <a href="{{route('Subproceso',$registro->folio)}}" style="color:white">Nuevo Subproceso</a>
                                            </button>-->
                                        </div>
                                      @endif
                                    @endif
                                </td>
                            </tr>
                            <tr id="{{$registro->folio}}" 
                                @if (Auth::user()->id_puesto < 6)
                                    @if (Auth::user()->id_area == 11)
                                        @if ($registro->folio[0] == 'A')
                                            class="collapse show"
                                        @else
                                            class="collapse"
                                        @endif
                                    @else
                                        @if ($registro->folio[0] == 'P')
                                            class="collapse show"
                                        @else
                                            class="collapse"
                                        @endif
                                    @endif 
                                @else
                                    class="collapse show" 
                                @endif>
                                <td></td>
                                <td id="collapseOne_{{$loop->iteration}}" class="panel-collapse collapse">
                                    @foreach ($subprocesos as $subproceso)
                                        @if ($subproceso->folio == $registro->folio && $subproceso->estatus == 'pendiente')
                                            <div class="form-group row">
                                                <label for="motivodesface" class="col-sm-7 control-label col-form-label">{{$subproceso->subproceso}}</label>
                                                    @if ($subproceso->previsto >= now())
                                                        <div class="col-md-2 col-lg-2 f-icon">
                                                            <a class="fas fa-check" style=color:green data-bs-toggle="modal" data-bs-target="#confirm-{{$subproceso->id}}" aria-valuetext="pausado"></a>
                                                        </div>
                                                    @else
                                                        <div class="col-md-2 col-lg-2 f-icon">
                                                            <a class="fas fa-clock" style=color:red data-bs-toggle="modal" data-bs-target="#confirm-{{$subproceso->id}}" ><!--p class="fas fa-clock"></p--></a>
                                                        </div>
                                                    @endif
                                            </div>
                                            <!-- Modal de Confirmación -->
                                            <div class="modal" id="confirm-{{$subproceso->id}}" dismis aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header d-flex align-items-center">
                                                            <h4 class="modal-title">Concluir Subporceso</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <label>Una vez Concluido el Subproceso este desaparecera</label>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a class="btn btn-invert" data-bs-dismiss="modal" href="">Cancelar</a>
                                                            <button type="submit" class="btn btn-success btn-ok"><a href="{{route('Concluir',$subproceso->subproceso)}}" style="color:white">Confirmar</a></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function(){
        $("#pestana1").click(function(){
            $('[id^="AA"]').collapse('show')
            $('[id^="PIP"]').collapse('hide')
        });
        $("#pestana2").click(function(){
            $('[id^="AA"]').collapse('hide')
            $('[id^="PIP"]').collapse('show')
        });
    });
</script>
<script>
    $(document).ready(function () {
        $("#reset").click(function(){
            $("tbody tr").show();
            $( "input:checkbox:checked" ).prop( "checked", false );
        });
        $(".ches,.chsi").on("change", function () {
        var ches = $(".ches:checked").map(function () {
            return $(this).val().replace(/\s+/g, '')
        }).get();
        var chsi = $(".chsi:checked").map(function () {
            return $(this).val().replace(/\s+/g, '')
        }).get();
        
        var all = $("tbody tr").hide();
        var sistemas = $(".sistemas").filter(function () {
            var sistema = $(this).text().replace(/\s+/g, ''),
            	index2 = $.inArray(sistema, chsi);
                console.log(sistemas);
            	return index2 >=0
        }).parent()
        if (!sistemas.length) sistemas = all
        var estatus = $(".estatus").filter(function () {
            var sestatus = $(this).first().text().replace(/\s+/g, ''),
                index = $.inArray(sestatus, ches);
                console.log(sestatus);
            return index >= 0
        }).parent()
        if (!estatus.length) estatus = all
        
        sistemas.filter(estatus).show()
        
        //console.log(sistemas,estatus)

    }).first().change()

    });
</script>
<script src="{{asset("assets/extra-libs/toastr/dist/build/toastr.min.js")}}"></script>
<script src="{{asset("assets/extra-libs/toastr/toastr-init.js")}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset("assets/libs/dropzone/dist/min/dropzone.min.css")}}"/>
<script src="{{asset("assets/libs/dropzone/dist/min/dropzone.min.js")}}"></script>
<!-- -------------------------------------------------------------- -->
<!-- End Container fluid  -->
<!-- -------------------------------------------------------------- -->

<script>
    Dropzone.options.myAwesomeDropzone = {
        headers:{'X-CSRF-TOKEN' : "{{csrf_token()}}"},
        paramName: "adjunto", // Las imágenes se van a usar bajo este nombre de parámetro
        //uploadMultiple: true,
        maxFilesize: 150, // Tamaño máximo en MB
        addRemoveLinks: true,
        dictRemoveFile: "Remover",
        removedfile: function(file) {
            var name = file.name;        
            $.ajax({
                headers: {'X-CSRF-TOKEN' : "{{csrf_token()}}"},
                type: 'DELETE',
                url: "file.borrar." + name,
            });
            var _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
        }
    };
</script>
@endsection

<script type="text/javascript">
    function arrow(id){
        icon = document.getElementById(id);
        //icon = document.getElementsByClassName('fas')
        //for(i=0; i<icon.length; i++){
            if(icon.classList == "fas fa-arrow-circle-down"){
                icon.classList.remove("fa-arrow-circle-down");
                icon.classList.toggle("fa-arrow-circle-up");
            }
            else{
                icon.classList.toggle("fa-arrow-circle-down");
                icon.classList.remove("fa-arrow-circle-up");
            }
        //}
    }
</script>
<style>
    .scrollable-menu {
    height: auto;
    max-height: 200px;
    overflow-x: hidden;
    }
</style>

<script type="text/javascript">
    function lock(play,btn){
        button = document.getElementById(btn)
        estatus = document.getElementById(play)
        sub = document.getElementsByClassName('fa-plus')
        idSub = document.getElementsByClassName('fa-check')
        console.log(estatus.classList);
        if(estatus.classList == "fas fa-play"){
            button.disabled = true;
            //sub.removeAttribute("href");
            //idSub.removeAttribute("href") 
        }
    }
</script>

