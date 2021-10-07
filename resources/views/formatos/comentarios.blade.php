@extends('home')
@section('content')
    <div class="card">
        <div class="card-body wizard-content">
            <div>
                <p class="u-align-left u-text u-text-2">
                    <input name="folio" type="text" class="required form-control  @error ('folio') is-invvalid @enderror" readonly="readonly" value="{{$folio}}">  
                </p>
            </div>
            <div class="progress mt-3">
                <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 10%"></div>
            </div>
            <!-- Visualizar el estatus en la seccion inf izq -->
            <div class="u-clearfix u-sheet u-sheet-1">
                <div class="u-border-1 u-border-black u-container-style u-group u-radius-50 u-shape-round u-group-1">
                    <div class="u-container-layout u-container-layout-1">
                        <p class="u-align-left u-text u-text-1">% Avance</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body wizard-content">
            <section class="u-align-left u-border-3 u-border-grey-75 u-clearfix u-white u-section-1" id="carousel_4c76">

                <div class="u-border-1 u-border-black u-container-style u-group u-radius-50 u-shape-round u-group-2">
                    <div class="u-container-layout u-valign-middle-md u-valign-middle-sm u-valign-middle-xs u-container-layout-2">
                    <p class="u-align-left u-text u-text-3">Usuario</p>
                    <p class="u-align-left u-text u-text-4">
                        <input type="text" class="required form-control @error('solicitante') is-invalid @enderror" 
                            name="solicitante" placeholder="Comentarios" required autofocus>
                        @error('solicitante')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </p>
                    </div>
                </div>
                <!-- solo 5 comentarios para mostrar lo mas importante -->
                <div class="u-border-1 u-border-black u-container-style u-group u-radius-50 u-shape-round u-group-7">
                    <div class="u-container-layout u-valign-middle-md u-valign-middle-sm u-valign-middle-xl u-valign-middle-xs u-container-layout-7">
                    <p class="u-align-right u-text u-text-13"></p>
                    <p class="u-align-left u-text u-text-14"></p>
                    </div>
                </div>
                </div>
            </section>
        </div>
    </div>
@endsection