@extends('home')
@section('content')
<div class="card">
  <div class="card-body">
    <!-- Row -->
    <div class="row">
      <!-- Contenido -->
      <div class="nav justify-content-center">
        <!-- Filtros -->
        <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" href="#Areas" role="tab" aria-selected="true">Áreas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-client-tab" data-bs-toggle="pill" href="#Clientes" role="tab" aria-selected="false">Clientes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-depto-tab" data-bs-toggle="pill" href="#Departamentos" role="tab" aria-selected="false">Departamentos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-depto-tab" data-bs-toggle="pill" href="#Estatus" role="tab" aria-selected="false">Estatus</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-func-tab" data-bs-toggle="pill" href="#Funcionalidad" role="tab" aria-selected="false">Funcionalidad</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-puesto-tab" data-bs-toggle="pill" href="#Puestos" role="tab" aria-selected="false">Puestos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-sistem-tab" data-bs-toggle="pill" href="#Sistemas" role="tab" aria-selected="false">Sistemas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-sol-tab" data-bs-toggle="pill" href="#Solicitantes" role="tab" aria-selected="false">Solicitantes</a>
          </li>
        </ul>
        <!-- Tablas -->
        <div class="nav tab-content mt-3" id="pills-tabContent">
          @include('catalogos.areas')
          @include('catalogos.clientes')
          @include('catalogos.departamentos')
          @include('catalogos.estatus')
          @include('catalogos.funcionalidades')
          @include('catalogos.puestos')
          @include('catalogos.sistemas')
          @include('catalogos.usuarios')
        </div>
      </div>
    </div>
    <!-- end row -->
  </div>
</div>
@endsection