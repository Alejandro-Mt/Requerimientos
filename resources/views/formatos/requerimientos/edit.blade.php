@extends('home')
@section('content')
<!-- Incluir la hoja de estilo predeterminada -->
<link href="{{asset("assets/extra-libs/toastr/dist/build/toastr.min.css")}}" rel="stylesheet" />
<!-- Incluir complemento -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<body>
    @if (session('alert'))
        <input class="d-none" id="message" value="{{ session('alert') }}">
        <script>
            $(document).ready(function(){
                message = $("#message").val();
                sended = 'El Correo ha sido enviado ';
                if(message == sended){
                    toastr.success(
                        message,
                        "¡Enviado!",
                        { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 2000 }
                    );
                }else{
                    toastr.error(
                        message,
                        "¡Error!",
                        { showMethod: "slideDown", hideMethod: "slideUp", timeOut: 2000 }
                    );
                }
            });
        </script>
    @endif
    <div class="row">
        <div class="card">
            <div class="button-group col-md-6 col-lg-4 d-flex align-items-stretch">
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
                        <!--<div class="btn-group mb-2" data-mdb-perfect-scrollbar="true" data-mdb-suppress-scroll-x="true">
                            <button type="button" class="btn text-gray dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Estatus
                            </button>
                            <ul class="dropdown-menu scrollable-menu">
                                _@foreach ($estatus as $e)
                                <div class="table-responsive">
                                    <li class="list-inline-item">
                                        <a class="dropdown-item" href="#"> 
                                            <div class="form-check mr-sm-2">
                                            <input id="estatus{$loop->iteration}}" type="checkbox" class="form-check-input secondary check-outline outline-secondary ches" value="{$e->titulo}}">
                                            <label id="les{$loop->iteration}}" class="form-check-label" for="estatus">{$e->titulo}}</label>
                                            </div>
                                        </a>
                                    </li>
                                </div>
                                _@endforeach
                            </ul>
                        </div>-->
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
                                            <input id="sistema{{$loop->iteration}}" type="checkbox" class="form-check-input secondary check-outline outline-secondary chsi" value="{{$sistema->nombre_s}}">
                                            <label id="lsi{{$loop->iteration}}" class="form-check-label" for="invalidcheck3">{{$sistema->nombre_s}}</label>
                                            </div>
                                        </a>
                                    </li>
                                </div>
                                @endforeach
                            </ul>
                        </div>
                        <div class="btn-group mb-2" data-mdb-perfect-scrollbar="true" data-mdb-suppress-scroll-x="true">
                            <button type="button" class="btn text-gray dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Cliente
                            </button>
                            <ul class="dropdown-menu scrollable-menu">
                                @foreach ($cliente as $c)
                                <div class="table-responsive">
                                    <li class="list-inline-item">
                                        <a class="dropdown-item" href="#"> 
                                            <div class="form-check mr-sm-2">
                                            <input id="cliente{{$loop->iteration}}" type="checkbox" class="form-check-input secondary check-outline outline-secondary chcl" value="{{$c->nombre_cl}}">
                                            <label id="lcl{{$loop->iteration}}" class="form-check-label" for="clientes">{{$c->nombre_cl}}</label>
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
            <!-- Fases de requerimiento -->
            <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                <li class="nav-item">
                <a class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" href="#Requerimiento" role="tab" aria-selected="true">Requerimiento</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" href="#Levantamiento" role="tab" aria-selected="false">Levantamiento</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" id="pills-home-tab" data-bs-toggle="pill" href="#Construccion" role="tab" aria-selected="false">Construcción</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" href="#Liberacion" role="tab" aria-selected="false">Liberación</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" id="pills-home-tab" data-bs-toggle="pill" href="#Implementacion" role="tab" aria-selected="false">Implementación</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" id="pills-home-tab" data-bs-toggle="pill" href="#Cancelado" role="tab" aria-selected="false">Cancelado</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" href="#Implementado" role="tab" aria-selected="false">Implementado</a>
                </li>
            </ul>
            <div class="nav tab-content mt-3" id="pills-tabContent">
                <div class="tab-pane fade show active" id="Requerimiento" role="tabpanel" aria-labelledby="pills-home-tab">
                    @include('formatos.requerimientos.seguimiento.requerimiento')
                </div>
                <div class="tab-pane fade" id="Levantamiento" role="tabpanel" aria-labelledby="pills-home-tab">
                    @include('formatos.requerimientos.seguimiento.levantamiento')
                </div>
                <div class="tab-pane fade" id="Construccion" role="tabpanel" aria-labelledby="pills-home-tab">
                    @include('formatos.requerimientos.seguimiento.construccion')
                </div>
                <div class="tab-pane fade" id="Liberacion" role="tabpanel" aria-labelledby="pills-home-tab">
                    @include('formatos.requerimientos.seguimiento.liberacion')
                </div>
                <div class="tab-pane fade" id="Implementacion" role="tabpanel" aria-labelledby="pills-home-tab">
                    @include('formatos.requerimientos.seguimiento.implementacion')
                </div>
                <div class="tab-pane fade" id="Cancelado" role="tabpanel" aria-labelledby="pills-home-tab">
                    @include('formatos.requerimientos.seguimiento.cancelado')
                </div>
                <div class="tab-pane fade" id="Implementado" role="tabpanel" aria-labelledby="pills-home-tab">
                    @include('formatos.requerimientos.seguimiento.implementado')
                </div>
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
        $(".chcl,.chsi").on("change", function () {
            var chcl = $(".chcl:checked").map(function () {
                return $(this).val().replace(/\s+/g, '')
            }).get();
            var chsi = $(".chsi:checked").map(function () {
                return $(this).val().replace(/\s+/g, '')
            }).get();
            
            var all = $("tbody tr").hide();
            var sistemas = $(".sistemas").filter(function () {
                var sistema = $(this).text().replace(/\s+/g, ''),
                    index2 = $.inArray(sistema, chsi);
                    //console.log(sistemas);
                    return index2 >=0
            }).parent()
            if (!sistemas.length) sistemas = all
            var clientes = $(".clientes").filter(function () {
                var cliente = $(this).text().replace(/\s+/g, ''),
                    index = $.inArray(cliente, chcl);
                    //console.log(sestatus);
                return index >= 0
            }).parent()
            if (!clientes.length) clientes = all
            sistemas.filter(clientes).show()
            console.log(clientes)
        }).first().change()
    });
</script>
<script src="{{asset("assets/extra-libs/toastr/dist/build/toastr.min.js")}}"></script>
<script src="{{asset("assets/extra-libs/toastr/toastr-init.js")}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset("assets/libs/dropzone/dist/min/dropzone.min.css")}}"/>
<script src="{{asset("assets/libs/dropzone/dist/min/dropzone.min.js")}}"></script>
<!-- -------------------------------------------------------------- -->
<!-- End Container fluid  -->
<!-- -------------------------------------------------------------- -->

<script>
    Dropzone.options.myAwesomeDropzone = {
        headers:{'X-CSRF-TOKEN' : "{{csrf_token()}}"},
        paramName: "adjunto", // Las imágenes se van a usar bajo este nombre de parámetro
        //uploadMultiple: true,
        maxFilesize: 150, // Tamaño máximo en MB
        addRemoveLinks: true,
        dictRemoveFile: "Remover",
        removedfile: function(file) {
            var name = file.name;        
            $.ajax({
                headers: {'X-CSRF-TOKEN' : "{{csrf_token()}}"},
                type: 'DELETE',
                url: "file.borrar." + name,
            });
            var _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
        }
    };
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

