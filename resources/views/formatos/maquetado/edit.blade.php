@extends('home')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<body onload=cambiarPestanna(pestanas,pestana1)>
    <div class="contenedor">
        <div id="pestanas">
            <ul id=lista>
                <li id="pestana1"><a onclick="cambiarPestanna(pestanas,pestana1)" role="button">Analisis</a></li>
                <li id="pestana2"><a onclick="cambiarPestanna(pestanas,pestana2)" role="button">Requerimientos</a></li>
            </ul>
        </div>
        <div id="contenidopestanas">
            <div id="cpestana1">
                Primer Texto
            </div>
            <div id="cpestana2">
                Segundo Texto
            </div>
        </div>
    </div>
</body>


<!--<body onload="lock()">
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
                                <div class="col-md-13" >
                                    <i id="arrow" class="fas fa-arrow-circle-down" onclick="arrow()" data-bs-remove="fa-arrow-circle-down" data-bs-toggle="collapse" href="#a" role="button" aria-expanded="false"></i> 
                                    {{$registro->folio}}
                                </div>
                            </div>
                        </td>
                        <td class="">{{$registro->titulo}}</td>
                        @switch($registro->id_estatus)
                            @case(17)
                                <td><button type="submit" class="btn btn-warning text-white" ><a href="{{route('Formato',$registro->id_registro)}}" style="color:white">Llenar Solicitud</a></button></td>
                                @break
                            @case(10)
                                <td><button type="submit" class="btn btn-warning text-white" ><a href="{{route('Enviar',$registro->folio)}}" style="color:white">Enviar Reporte</a></button></td>
                                @break
                            @case(16)
                                <td>
                                    <button type="submit" class="btn btn-warning text-white" ><a href="{{route('Levantamiento',$registro->id_registro)}}" style="color:white">Revision de Datos</a></button>
                                    <button type="submit" class="btn btn-warning text-white" ><a href="{{route('Enviar',$registro->folio)}}" style="color:white">Confirmacion</a></button>
                                </td>
                                @break
                            @case(11)
                                <td> 
                                    <button type="submit" class="btn btn-warning text-white" onmouseover="lock()"><a href="{{route('Planeacion',$registro->folio)}}" style="color:white">Planeacion</a></button>
                                </td>
                                @break
                            @case(9)
                                <td>
                                    <button type="submit" class="btn btn-warning text-white" ><a href="{{route('Analisis',$registro->folio)}}" style="color:white">Analisis de Desarrollo</a></button>
                                </td>
                                @break
                            @case(7)
                                <td>
                                    <button type="submit" class="btn btn-warning text-white" ><a href="{{route('Construccion',$registro->folio)}}" style="color:white">Construccion</a></button>
                                </td>
                                @break
                            @case(12)
                                <td>
                                    <button type="submit" class="btn btn-warning text-white" ><a href="{{route('Planeacion',$registro->folio)}}" style="color:white">Solicitar informacion</a></button>
                                </td>
                            @break
                            @case(18)
                            <td>
                                <button type="submit" class="btn btn-warning text-white" ><a href="{{route('Analisis',$registro->folio)}}" style="color:white">Editar</a></button>
                                <button type="submit" class="btn btn-warning text-white" ><a href="{{route('Analisis',$registro->folio)}}" style="color:white">Guardar</a></button>
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
                                        <div class="col-md-2 col-lg-1 f-icon">
                                            <a class="fas fa-play" style="color:green" href="{{route('Play',$registro->folio)}}"></a>
                                        </div>
                                    @elseif ($p->pausa <> '1' and $p->folio==$registro->folio)
                                        <div class="col-md-2 col-lg-1 f-icon">
                                            <a class="fas fa-pause"  style="color:red" href="{{route('Pausa',$registro->folio)}}"></a>
                                        </div>
                                    @endif
                                @endforeach
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
                                                <a class="fas fa-check" style=color:green href="{{route('Concluir',$subproceso->subproceso)}}" aria-valuetext="pausado"></a>
                                            </div>
                                        @else
                                            <div class="col-md-3 col-lg-2 f-icon">
                                                <a class="fas fa-clock" style=color:red href="{{route('Concluir',$subproceso->subproceso)}}"></a>
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
</body>-->

@endsection

<style>
    .contenedor .titulo{
        font-size: 3.5ex;
        font-weight: bold;
        margin-left: 10px;
        margin-bottom: 10px;
    }

    #pestanas {
        float: top;
        font-size: 3ex;
        font-weight: bold;
    }

    #pestanas ul{
        margin-left: -40px;    
    }

    #pestanas li{
        list-style-type: none;
        float: left;
        text-align: center;
        margin: 0px 2px -2px -0px;
        background: white;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
        border: 2px solid lightslategray;
        border-bottom: dimgray;
        padding: 0px 20px 0px 20px;
    }

    #pestanas a:link{
        text-decoration: none;
        color: green;
    }

    #contenidopestanas{
        clear: both;  
        background: white;
        padding: 20px 0px 20px 20px;
        border-radius: 5px;
        border-top-left-radius: 0px;
        border: 2px solid lightslategray;
        width: 1025px;
    }
</style>

<script>            
    // Dadas la division que contiene todas las pestañas y la de la pestaña que se 
    // quiere mostrar, la funcion oculta todas las pestañas a excepcion de esa.
    function cambiarPestanna(pestannas,pestanna) {
        
        // Obtiene los elementos con los identificadores pasados.
        pestanna = document.getElementById(pestanna.id);
        listaPestannas = document.getElementById(pestannas.id);
        
        // Obtiene las divisiones que tienen el contenido de las pestañas.
        cpestanna = document.getElementById('c'+pestanna.id);
        listacPestannas = document.getElementById('contenido'+pestannas.id);
        
        i=0;
        // Recorre la lista ocultando todas las pestañas y restaurando el fondo 
        // y el padding de las pestañas.
        while (typeof listacPestannas.getElementsByTagName('div')[i] != 'undefined'){
            $(document).ready(function(){
                $(listacPestannas.getElementsByTagName('div')[i]).css('display','none');
                $(listaPestannas.getElementsByTagName('li')[i]).css('background','');
                $(listaPestannas.getElementsByTagName('li')[i]).css('padding-bottom','');
            });
            i += 1;
        }

        $(document).ready(function(){
            // Muestra el contenido de la pestaña pasada como parametro a la funcion,
            // cambia el color de la pestaña y aumenta el padding para que tape el  
            // borde superior del contenido que esta juesto debajo y se vea de este 
            // modo que esta seleccionada.
            $(cpestanna).css('display','');
            $(pestanna).css('background','lightblue');
            $(pestanna).css('padding-bottom','2px'); 
        });

    }
</script>

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
            //echo @json($registro->folio) == @json($subproceso->folio);
            //if(button[i].disabled <> true){
                button[i].disabled = true;
                sub[i].removeAttribute("href");
                idSub[i].removeAttribute("href")

            
        }
    }
</script>

