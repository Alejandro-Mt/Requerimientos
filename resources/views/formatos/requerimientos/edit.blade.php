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
                        <td>{{$registro->bitrix}}</td>
                        
                            @if ($registro->estatus == 'Abierto')
                            <td class="text-warning">{{$registro->estatus}}</td>
                            <td><button type="submit" class="btn btn-warning text-white"><a href="{{route('Levantamiento',$registro->id_registro)}}" style="color:white">Continuar</a></button></td>
                            @else
                                @if ($registro->estatus == 'En Construccion')
                                <td class="text-warning">{{$registro->estatus}}</td>
                                <td><button type="submit" class="btn btn-warning text-white"><a href="{{route('Enviar')}}" style="color:white">Enviar a Cliente</a></button></td>
                                @else
                                    @if ($registro->estatus == 'Cerrado')
                                    <td class="text-success">{{$registro->estatus}}</td>
                                    <td><button type="submit" class="btn btn-success text-white">Ver</button></td>
                                    @endif
                                @endif
                            @endif
                            <!--<button type="submit" class="btn btn-danger text-white">Continuar</button>-->
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
@endsection