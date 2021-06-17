@extends('home')
@section('content')
<body>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-0">Registro</h5>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Description</th>
                    <th scope="col">Estatus</th>
                    <th scope="col">Accion</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Registro 1</td>
                    <td class="text-success">Cerrado</td>
                    <td>
                        <button type="submit" class="btn btn-success text-white">Ver</button>
                    </td>
                </tr>
                <tr>
                    <td>Registro 2</td>
                    <td class="text-warning">En proceso</td>
                    <td>
                        <button type="submit" class="btn btn-warning text-white">Continuar</button>
                    </td>
                </tr>
                <tr>
                    <td>Registro 3 </td>
                    <td class="text-danger">Retrasado</td>
                    <td>
                        <button type="submit" class="btn btn-danger text-white">Continuar</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
@endsection