@extends('home')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<body>
    <div class="row">
        <div class="card">
            <!--<div class="card-body">
                <div class="button-group">
                <button class="btn btn-light-primary text-primary px-4 rounded-pill font-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample1" aria-expanded="false" aria-controls="multiCollapseExample1">Requerimientos</button>
                <button class="btn btn-light-success text-success px-4 rounded-pill font-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2">Análisis</button>
                <button class="btn btn-light-info text-info px-4 rounded-pill font-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target=".multi-collapse" aria-expanded="false" aria-controls="multiCollapseExample1 multiCollapseExample2">
                    Requerimientos
                </button>
                </div>
                <div class="row">
                <div class="col">
                    <div class="multi-collapse collapse" id="multiCollapseExample1" style="">
                    <div class="card card-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry
                        richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes
                        anderson cred nesciunt sapiente ea proident.
                    </div>
                    </div>
                </div>
                <div class="col">
                    <div class="multi-collapse collapse" id="multiCollapseExample2" style="">
                    <div class="card card-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry
                        richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes
                        anderson cred nesciunt sapiente ea proident.
                    </div>
                    </div>
                </div>
                </div>
            </div>-->
            <div class="button-group">
                <button id="pestana1" type="button" class="btn btn-light-primary text-primary px-4 rounded-pill font-medium collapsed">Análisis</button>
                <button id="pestana2" type="button" class="btn btn-light-success text-success px-4 rounded-pill font-medium collapsed">Requerimientos</button>
            </div>
            <div class="btn-group mb-2">
                    <button type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-inbox feather-sm fill-white text-white"><polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline><path d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"></path></svg>
                    </button>
                    <ul class="dropdown-menu animated slideInUp">
                      <li><a class="dropdown-item" href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Acción</font></font></a></li>
                      <li>
                        <a class="dropdown-item" href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Otra acción</font></font></a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">algo mas aqui</font></font></a>
                      </li>
                      <li>
                        <hr class="dropdown-divider">
                      </li>
                      <li>
                        <a class="dropdown-item" href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Enlace separado</font></font></a>
                      </li>
                    </ul>
                  </div>
            <!--<div id='pestana' class="navbar navbar-expand-lg navbar-dark bg-success">
                <div id='lista' class="navbar-item">
                    <a id='pestana1' 
                        class="navbar-brand" 
                        href="javascript:cambiarPestanna('pestanas','pestana1')">Análisis
                    </a>
                </div>
                <div class="navbar-item" data-navbarbg="color: plum">
                    <a id='pestana2' 
                        class="navbar-brand" 
                        data-toggle="collapse"
                        data-target="#" 
                        href="javascript:cambiarPestanna('pestanas','pestana2')">Requerimiento
                    </a>
                </div>
            </div>-->
            <div class="card-body wizard-content">
                <h5 class="card-title mb-0">Seguimiento</h5>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Folio</th>
                            <th scope="col">Estatus</th>
                            <th scope="col">Acción</th>
                        </tr>
                    </thead>
                    <tbody id="contenidopestanas">
                        @foreach ($registros as $registro)
                            <tr id="{{$registro->folio}}"class="collapse show" onmousemove="lock('play{{$loop->iteration}}','btn{{$loop->iteration}}')">
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
                                <td class="">{{$registro->titulo}}</td>
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
                            <tr id="{{$registro->folio}}" class="collapse show"><td></td>
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

<script type="text/javascript">
    function lock(play,btn){
        button = document.getElementById(btn)
        estatus = document.getElementById(play)
        sub = document.getElementsByClassName('fa-plus')
        idSub = document.getElementsByClassName('fa-check')
        if(estatus.classList == "fas fa-play"){
            button.disabled = true;
            //sub.removeAttribute("href");
            //idSub.removeAttribute("href") 
        }
    }
</script>

