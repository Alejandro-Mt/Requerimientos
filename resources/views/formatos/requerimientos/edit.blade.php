@extends('home')
@section('content')
<body>
    <div class="card">
        <div class="card-body wizard-content">
            <h5 class="card-title mb-0">Registro</h5>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Folio</th>
                    <th scope="col">Estatus</th>
                    <th scope="col">Accion</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($registros as $registro)
                    <tr>
                        <td>
                            <div class="form-group row">
                                <div class="col-md-4" >
                                    <i id="arrow" class="fas fa-arrow-circle-down" onclick="arrow()" data-bs-remove="fa-arrow-circle-down" data-bs-toggle="collapse" href="#a" role="button" aria-expanded="false"></i> 
                                </div>
                                {{$registro->folio}}
                            </div>
                        </td>
                        <td class="">{{$registro->titulo}}</td>
                        @switch($registro->id_estatus)
                            @case(17)
                                <td><button type="submit" class="btn btn-warning text-white" onmouseover=lock()><a href="{{route('Formato',$registro->id_registro)}}" style="color:white">Llenar Solicitud</a></button></td>
                                @break
                            @case(10)
                                <td><button type="submit" class="btn btn-warning text-white" onmouseover=lock()><a href="{{route('Enviar',$registro->folio)}}" style="color:white">Enviar Reporte</a></button></td>
                                @break
                            @case(16)
                                <td>
                                    <button type="submit" class="btn btn-warning text-white" onmouseover=lock()><a href="{{route('Levantamiento',$registro->id_registro)}}" style="color:white">Revision de Datos</a></button>
                                    <button type="submit" class="btn btn-warning text-white" onmouseover=lock()><a href="{{route('Enviar',$registro->folio)}}" style="color:white">Confirmacion</a></button>
                                </td>
                                @break
                            @case(11)
                                <td> 
                                    <button type="submit" class="btn btn-warning text-white" onmouseover="read()"><a href="{{route('Planeacion',$registro->folio)}}" style="color:white">Planeacion</a></button>
                                </td>
                                @break
                            @case(9)
                                <td>
                                    <button type="submit" class="btn btn-warning text-white" onmouseover=lock()><a href="{{route('Analisis',$registro->folio)}}" style="color:white">Analisis de Desarrollo</a></button>
                                </td>
                                @break
                            @case(7)
                                <td>
                                    <button type="submit" class="btn btn-warning text-white" onmouseover=lock()><a href="{{route('Construccion',$registro->folio)}}" style="color:white">Construccion</a></button>
                                </td>
                                @break
                            @case(12)
                                <td>
                                    <button type="submit" class="btn btn-warning text-white" onmouseover=lock()><a href="{{route('Planeacion',$registro->folio)}}" style="color:white">Solicitar informacion</a></button>
                                </td>
                            @break
                            @case(18)
                            <td>
                                <button type="submit" class="btn btn-warning text-white" onmouseover=lock()><a href="{{route('Analisis',$registro->folio)}}" style="color:white">Editar</a></button>
                                <button type="submit" class="btn btn-warning text-white" onmouseover=lock()><a href="{{route('Analisis',$registro->folio)}}" style="color:white">Guardar</a></button>
                            </td>
                            @break
                            @default
                                
                        @endswitch
                        
                        <!--<button type="submit" class="btn btn-danger text-white">Continuar</button>-->
                        <td>
                            <div class="form-group row">
                                <div class="col-md-2 col-lg-1 f-icon">
                                    <a class="fas fa-plus" href="{{route('Subproceso',$registro->folio)}}" role="button" style="color:#3e5569"></a> 
                                </div>
                                @foreach ($pausa as $p)
                                    @if ($p->pausa == '1' and $p->folio==$registro->folio)
                                        <div class="col-md-2 col-lg-1 f-icon">
                                            <a class="fas fa-play" style="color:green" href="{{route('Play',$registro->folio)}}"></a>
                                        </div>
                                    @elseif ($p->pausa <> '1' and $p->folio==$registro->folio)
                                        <div class="col-md-2 col-lg-1 f-icon">
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
                    <tr><td></td>
                        <td id="content" class="">
                            @foreach ($subprocesos as $subproceso)
                              @if ($subproceso->folio == $registro->folio && $subproceso->estatus == 'pendiente')
                                <div id="a" class="form-group row collapse">
                                    <label for="motivodesface"
                                        class="col-sm-6 control-label col-form-label">{{$subproceso->subproceso}}</label>
                                        @if ($subproceso->previsto >= now())
                                            <div class="col-md-2 col-lg-1 f-icon">
                                                <a class="fas fa-check" style=color:green href="{{route('Concluir',$subproceso->subproceso)}}"></a>
                                            </div>
                                        @else
                                            <div class="col-md-2 col-lg-1 f-icon">
                                                <a class="fas fa-check" style=color:red href="{{route('Concluir',$subproceso->subproceso)}}"></a>
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
</body>

@endsection

<script type="text/javascript">
    function arrow(){
        //icon = document.getElementById('arrow');
        icon = document.getElementsByClassName('fas')
        for(i=0; i<icon.length; i++){
            if(icon[i].classList == "fas fa-arrow-circle-down"){
                icon[i].classList.remove("fa-arrow-circle-down");
                icon[i].classList.toggle("fa-arrow-circle-up");
            }
            else{
                icon[i].classList.toggle("fa-arrow-circle-down");
                icon[i].classList.remove("fa-arrow-circle-up");
            }
        }
    }
</script>

<script type="text/javascript">
    function lock(){
        button = document.getElementsByClassName('btn')
        estatus = document.getElementsByClassName("fa-play")
        sub = document.getElementsByClassName('fa-plus')
        idSub = document.getElementsByClassName('fa-check')
        for(i=0; i<estatus.length; i++){
            if (subproceso->folio == registro->folio){
            //if(button[i].disabled <> true){
                button[i].disabled = true;
            }
        }
    }
</script>

