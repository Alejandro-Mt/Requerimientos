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
                                <div class="col-md-4">
                                    <a class="btn me-2 mdi mdi-arrow-down-drop-circle" data-bs-toggle="collapse" href="#a" role="button" aria-expanded="false"></a> 
                                </div>
                                {{$registro->folio}}
                            </div>
                        </td>
                        <td class="">{{$registro->titulo}}</td>
                        @switch($registro->id_estatus)
                            @case(17)
                                <td><button type="submit" class="btn btn-warning text-white"><a href="{{route('Formato',$registro->id_registro)}}" style="color:white">Llenar Solicitud</a></button></td>
                                @break
                            @case(10)
                                <td><button type="submit" class="btn btn-warning text-white"><a href="{{route('Enviar',$registro->folio)}}" style="color:white">Enviar Reporte</a></button></td>
                                @break
                            @case(16)
                                <td>
                                    <button type="submit" class="btn btn-warning text-white"><a href="{{route('Levantamiento',$registro->id_registro)}}" style="color:white">Revision de Datos</a></button>
                                    <button type="submit" class="btn btn-warning text-white"><a href="{{route('Enviar',$registro->folio)}}" style="color:white">Confirmacion</a></button>
                                </td>
                                @break
                            @case(11)
                                <td>
                                    <button type="submit" class="btn btn-warning text-white"><a href="{{route('Planeacion',$registro->folio)}}" style="color:white">Planeacion</a></button>
                                </td>
                                @break
                            @case(9)
                                <td>
                                    <button type="submit" class="btn btn-warning text-white"><a href="{{route('Analisis',$registro->folio)}}" style="color:white">Analisis de Desarrollo</a></button>
                                </td>
                                @break
                            @case(7)
                                <td>
                                    <button type="submit" class="btn btn-warning text-white"><a href="{{route('Construccion',$registro->folio)}}" style="color:white">Construccion</a></button>
                                </td>
                                @break
                            @case(26)
                                <td>
                                    <button type="submit" class="btn btn-warning text-white"><a href="{{route('Planeacion',$registro->folio)}}" style="color:white">Planeacion</a></button>
                                </td>
                            @break
                            @case(9)
                            <td>
                                <button type="submit" class="btn btn-warning text-white"><a href="{{route('Analisis',$registro->folio)}}" style="color:white">Analisis</a></button>
                            </td>
                            @break
                            @default
                                
                        @endswitch
                        
                        <!--<button type="submit" class="btn btn-danger text-white">Continuar</button>-->
                        <td>
                            <button type="submit" class="btn btn-success text-white">
                                <a href="{{route('Levantamiento',$registro->id_registro)}}" style="color:white">Nuevo Subproceso</a>
                            </button>
                        </td>
                    </tr>
                    <tr><td></td>
                        <td id="content" class="">
                            <div id="a" class="form-group row collapse">
                                <label for="motivodesface"
                                    class="col-sm-6 text-end control-label col-form-label">Subproceso 1</label>
                                <div class="col-md-8">
                                    
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

@endsection

