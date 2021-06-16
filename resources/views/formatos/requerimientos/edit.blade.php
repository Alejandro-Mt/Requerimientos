@extends('home')
@section('content')
<body>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-0">Tasks</h5>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Description</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Making The New Suit</td>
                    <td class="text-success">Progress</td>
                    <td>
                        <a href="#" data-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Update">
                            <i class="mdi mdi-check"></i>
                        </a>
                        <a href="#" data-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Delete">
                            <i class="mdi mdi-close"></i>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>Luanch My New Site</td>
                    <td class="text-warning">Pending</td>
                    <td>
                        <a href="#" data-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Update">
                            <i class="mdi mdi-check"></i>
                        </a>
                        <a href="#" data-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Delete">
                            <i class="mdi mdi-close"></i>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>Maruti Excellant Theme</td>
                    <td class="text-danger">Cancled</td>
                    <td>
                        <a href="#" data-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Update">
                            <i class="mdi mdi-check"></i>
                        </a>
                        <a href="#" data-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Delete">
                            <i class="mdi mdi-close"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
@endsection