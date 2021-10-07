@extends('home')
@section('content')
<body>
    <div class="container">
        <button id="pestana1" type="button" class="btn btn-primary">Analisis</button>
        <button id="pestana2" type="button" class="btn btn-info">Requerimientos</button>
    
        <div class="card">
            <!--<div id='pestana' class="navbar navbar-expand-lg navbar-dark bg-success">
                <div id='lista' class="navbar-item">
                    <a id='pestana1' 
                        class="navbar-brand" 
                        href="javascript:cambiarPestanna('pestanas','pestana1')">Analisis
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
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Folio</th>
                        <th scope="col">Estatus</th>
                        <th scope="col">Accion</th>
                    </tr>
                </thead>
                <tbody id="contenidopestanas">
                    @foreach ($registros as $registro)
                        <tr id="{{$registro->folio}}" class="collapse" onmousemove="lock('play{{$loop->iteration}}','btn{{$loop->iteration}}')">
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
                                        <button type="submit" class="btn btn-warning text-white" ><a href="{{route('Levantamiento',$registro->id_registro)}}" style="color:white">Revision de Datos</a></button>
                                        <button id="btn{{$loop->iteration}}" type="submit" class="btn btn-warning text-white" ><a href="{{route('Enviar',$registro->folio)}}" style="color:white">Confirmacion</a></button>
                                    </td>
                                    @break
                                @case(11)
                                    <td> 
                                        <button id="btn{{$loop->iteration}}" type="submit" class="btn btn-warning text-white"><a href="{{route('Planeacion',$registro->folio)}}" style="color:white">Planeacion</a></button>
                                    </td>
                                    @break
                                @case(9)
                                    <td>
                                        <button id="btn{{$loop->iteration}}" type="submit" class="btn btn-warning text-white" ><a href="{{route('Analisis',$registro->folio)}}" style="color:white">Analisis de Desarrollo</a></button>
                                    </td>
                                    @break
                                @case(7)
                                    <td>
                                        <button id="btn{{$loop->iteration}}" type="submit" class="btn btn-warning text-white" ><a href="{{route('Construccion',$registro->folio)}}" style="color:white">Construccion</a></button>
                                    </td>
                                    @break
                                @case(8)
                                    <td>
                                        <button id="btn{{$loop->iteration}}" type="submit" class="btn btn-warning text-white" ><a href="{{route('Liberacion',$registro->folio)}}" style="color:white">Liberacion</a></button>
                                    </td>
                                @break
                                @case(2)
                                    <td>
                                        <button id="btn{{$loop->iteration}}" type="submit" class="btn btn-warning text-white" ><a href="{{route('Implementacion',$registro->folio)}}" style="color:white">Implementacion</a></button>
                                    </td>
                                @break
                                @case(12)
                                    <td>
                                        <button id="btn{{$loop->iteration}}" type="submit" class="btn btn-success text-white" ><a href="{{route('Implementacion',$registro->folio)}}" style="color:white">Implementado</a></button>
                                    </td>
                                @break
                                @default
                                    
                            @endswitch
                            <td>
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
                                                <a class="fas fa-pause"  style="color:red" href="{{route('Pausa',$registro->folio)}}"></a>
                                            </div>
                                        @endif
                                    @endforeach
                                    <!--<button type="submit" class="btn btn-success text-white">
                                        <a href="{{route('Subproceso',$registro->folio)}}" style="color:white">Nuevo Subproceso</a>
                                    </button>-->
                                </div>
                            </td>
                        </tr>
                        <tr id="{{$registro->folio}}" class="collapse"><td></td>
                            <td id="collapseOne_{{$loop->iteration}}" class="panel-collapse collapse">
                                @foreach ($subprocesos as $subproceso)
                                @if ($subproceso->folio == $registro->folio && $subproceso->estatus == 'pendiente')
                                    <div class="form-group row">
                                        <label for="motivodesface"
                                            class="col-sm-6 control-label col-form-label">{{$subproceso->subproceso}}</label>
                                            @if ($subproceso->previsto >= now())
                                                <div class="col-md-2 col-lg-1 f-icon">
                                                    <a id class="fas fa-check" style=color:green href="{{route('Concluir',$subproceso->subproceso)}}" aria-valuetext="pausado"></a>
                                                </div>
                                            @else
                                                <div class="col-md-5 col-lg-4 f-icon">
                                                    <a class="fas fa-clock" style=color:red href="{{route('Concluir',$subproceso->subproceso)}}"><!--p class="fas fa-clock"></p--></a>
                                                </div>
                                            @endif
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
        //for(i=0; i<estatus.length; i++){
            if(estatus.classList == "fas fa-play"){
                button.disabled = true;
                //sub.removeAttribute("href");
                //idSub.removeAttribute("href") 
        }
    }
</script>


