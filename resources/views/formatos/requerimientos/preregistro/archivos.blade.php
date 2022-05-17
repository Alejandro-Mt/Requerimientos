@extends('home')
@section('content')
  <div class="tab-content">
    <div id="note-full-container" class="note-has-grid row">
      @foreach ($archivos as $archivo)
      <div class="col-md-4 single-note-item all-category">
        <div class="card card-body">
          <span class="side-stick"></span>
          <h5 class="note-title text-truncate w-75 mb-0">
            {{pathinfo($archivo->url, PATHINFO_FILENAME)}}
            <i class="point ri-checkbox-blank-circle-fill ms-1 fs-1"></i>
          </h5>
          <p class="note-date fs-2 text-muted">{{$archivo->folio}}</p>
          <div class="note-content">
            <p class="note-inner-content text-muted" >
              @switch(pathinfo($archivo->url, PATHINFO_EXTENSION))
                @case('xlsx')
                  <div class="d-flex align-items-center">
                    <a href="{{asset("$archivo->url")}}" class="mx-auto">
                      <img src="{{asset("assets/images/icons/xls.png")}}" alt="Archivo" width="125" class="mx-auto"/>
                    </a>
                    <!--<button id="download" type="button" class="btn waves-effect waves-light btn-outline-info">
                      
                    </button>
                    <button id="{{pathinfo($archivo->url, PATHINFO_FILENAME)}}" type="button" class="btn waves-effect waves-light btn-outline-danger delete">
                      <i class="feather-sm" data-feather="trash-2"></i>
                    </button>-->
                  </div>
                  @break
                @case('docx')
                  <div class="d-flex align-items-center">
                    <a href="{{asset("$archivo->url")}}" class="mx-auto">
                      <img src="{{asset("assets/images/icons/doc.png")}}" alt="Archivo" width="125" class="mx-auto"/>
                    </a>
                  </div>
                  @break
                @case('txt')
                  <div class="d-flex align-items-center">
                    <a href="{{asset("$archivo->url")}}" class="mx-auto">
                      <img src="{{asset("assets/images/icons/txt.png")}}" alt="Archivo" width="125" class="mx-auto"/>
                    </a>
                  </div>
                  @break
                @case('pdf')
                  <div class="d-flex align-items-center">
                    <a href="{{asset("$archivo->url")}}" class="mx-auto">
                      <img src="{{asset("assets/images/icons/pdf.png")}}" alt="Archivo" width="125" class="mx-auto"/>
                    </a>
                  </div>
                  @break
                @default
                  <div class="d-flex align-items-center">
                    <a href="{{asset("$archivo->url")}}" class="mx-auto">
                      <img src="{{asset("$archivo->url")}}" alt="Archivo" width="125" class="mx-auto"/>
                    </a>
                  </div>
              @endswitch
            </p>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
@endsection