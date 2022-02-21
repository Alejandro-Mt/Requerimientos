@extends('home')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Incluir la hoja de estilo predeterminada -->
<link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/wenzhixin/multiple-select/e14b36de/multiple-select.css">
<!-- Incluir complemento -->
<script src="https://cdn.rawgit.com/wenzhixin/multiple-select/e14b36de/multiple-select.js"></script>
<body>
    <div class="row">
        <div class="card">
            <div class="btn-toolbar justify-content-between">
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
                                            <input id="estatus{{$loop->iteration}}" type="checkbox" class="form-check-input ches" value="{{$e->titulo}}">
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
                                            <input id="sistema{{$loop->iteration}}" type="checkbox" class="form-check-input chsi" value="{{$sistema->nombre_s}}">
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
                            <th scope="col">Folio</th>
                            <th scope="col">Estatus</th>
                            <th scope="col">Sistema</th>
                            <th scope="col">Acción</th>
                            <th scope="col"></th>
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
                                <td>
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
                                <td class="estatus">{{$registro->titulo}}</td>
                            <!-- Sistema -->
                                <td class="sistemas">
                                    @foreach ($sistemas as $sistema) 
                                        @if ($registro->id_sistema == $sistema->id_sistema)
                                           {{$sistema->nombre_s}}
                                        @endif
                                    @endforeach
                                </td>
                            <!-- Accion -->
                                @switch($registro->id_estatus)
                                    @case(17)
                                        <td><button id="btn{{$loop->iteration}}" type="submit" class="btn btn-warning text-white" ><a href="{{route('Formato',$registro->id_registro)}}" style="color:white">Llenar Solicitud</a></button></td>
                                        @break
                                    @case(10)
                                        <td><button id="btn{{$loop->iteration}}" type="submit" class="btn btn-warning text-white" ><a href="{{route('Enviar',$registro->folio)}}" style="color:white">Enviar Reporte</a></button></td>
                                        @break
                                    @case(16)
                                        <td>
                                            <button type="submit" class="btn btn-warning text-white" ><a href="{{route('Levantamiento',$registro->id_registro)}}" style="color:white">Revisión de Datos</a></button>
                                            @if($registro->fechaaut <> null)
                                                <button id="btn{{$loop->iteration}}" type="submit" class="btn btn-warning text-white" ><a href="{{route('Enviar',$registro->folio)}}" style="color:white">Confirmación</a></button>
                                            @endif
                                        </td>
                                        @break
                                    @case(11)
                                        <td> 
                                            <button id="btn{{$loop->iteration}}" type="submit" class="btn btn-warning text-white"><a href="{{route('Planeacion',$registro->folio)}}" style="color:white">Planeación</a></button>
                                        </td>
                                        @break
                                    @case(9)
                                        <td>
                                            <button id="btn{{$loop->iteration}}" type="submit" class="btn btn-warning text-white" ><a href="{{route('Analisis',$registro->folio)}}" style="color:white">Análisis de Desarrollo</a></button>
                                        </td>
                                        @break
                                    @case(7)
                                        <td>
                                            <button id="btn{{$loop->iteration}}" type="submit" class="btn btn-warning text-white" ><a href="{{route('Construccion',$registro->folio)}}" style="color:white">Construcción</a></button>
                                        </td>
                                        @break
                                    @case(8)
                                        <td>
                                            <button id="btn{{$loop->iteration}}" type="submit" class="btn btn-warning text-white" ><a href="{{route('Liberacion',$registro->folio)}}" style="color:white">Liberación</a></button>
                                        </td>
                                        @break
                                    @case(2)
                                        <td>
                                            <button id="btn{{$loop->iteration}}" type="submit" class="btn btn-warning text-white" ><a href="{{route('Implementacion',$registro->folio)}}" style="color:white">Implementación</a></button>
                                        </td>
                                        @break
                                    @case(18)
                                        <td>
                                            <button id="btn{{$loop->iteration}}" type="submit" class="btn btn-success text-white" ><a href="#" style="color:white">Implementado</a></button>
                                        </td>
                                        @break
                                    @default 
                                @endswitch
                            <!-- Menu -->
                                <td>
                                    @if ($registro->id_estatus <> 18)
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
                                                            <a class="btn btn-invert" data-bs-dismiss="modal">Cancelar</a>
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
        /*$("input:checkbox").on("change", function () {
        
            var a = $("input:checkbox:checked").map(function () {
                return $(this).val().replace(/\s+/g, '')
            })
            $("tbody tr").hide();
            var estatus = $(".estatus").filter(function () {
                var sestatus = $(this).text().replace(/\s+/g, ''),
                    index = $.inArray(sestatus, a);
                return index >= 0
            }).parent().show();
            var sistemas = $(".sistemas").filter(function () {
                var sistema = $(this).text().replace(/\s+/g, ''),
                    index = $.inArray(sistema, a);
                return index >= 0
            }).parent().show();
        }) */
        $(".ches,.chsi").on("change", function () {
        var ches = $(".ches:checked").map(function () {
            return $(this).val()
        }).get();
        var chsi = $(".chsi:checked").map(function () {
            return $(this).val().replace(/\s+/g, '')
        }).get();
        
        var all = $("tbody tr").hide();
        var sistemas = $(".sistemas").filter(function () {
            var sistema = $(this).text().replace(/\s+/g, ''),
            	index2 = $.inArray(sistema, chsi);
            	return index2 >=0
        }).parent()
        if (!sistemas.length) sistemas = all
        var estatus = $(".estatus").filter(function () {
            var sestatus = $(this).text(),
                index = $.inArray(sestatus, ches);
                
            return index >= 0
        }).parent()
        if (!estatus.length) estatus = all
        
        sistemas.filter(estatus).show()
        
        //console.log(sistemas,estatus)

    }).first().change()

    });
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
