@extends('home')
@section('content')
  <!--<ul class="nav nav-pills p-3 bg-white mb-3 align-items-center">
    <li class="nav-item">
      <a href="javascript:void(0)" class="nav-link rounded-pill note-link d-flex align-items-center justify-content-center active px-3 px-md-3 me-0 me-md-2" id="all-category">
        <i data-feather="list" class="feather-sm fill-white me-0 me-md-1"></i>
        <span class="d-none d-md-block font-weight-medium">All Notes</span>
      </a>
    </li>
    <li class="nav-item">
      <a href="javascript:void(0)" class="nav-link rounded-pill note-link d-flex align-items-center justify-content-center px-3 px-md-3 me-0 me-md-2" id="note-business">
        <i data-feather="briefcase" class="feather-sm fill-white me-0 me-md-1"></i>
        <span class="d-none d-md-block font-weight-medium">Business</span>
      </a>
    </li>
    <li class="nav-item">
      <a href="javascript:void(0)"
        class="nav-link rounded-pill note-link d-flex align-items-center justify-content-center px-3 px-md-3 me-0 me-md-2" id="note-social">
        <i data-feather="share-2" class="feather-sm fill-white me-0 me-md-1"></i>
        <span class="d-none d-md-block font-weight-medium">Social</span>
      </a>
    </li>
    <li class="nav-item">
      <a href="javascript:void(0)" class="nav-link rounded-pill note-link d-flex align-items-center justify-content-center px-3 px-md-3 me-0 me-md-2" id="note-important">
        <i data-feather="star" class="feather-sm fill-white me-0 me-md-1"></i>
        <span class="d-none d-md-block font-weight-medium">Important</span>
      </a>
    </li>
    <li class="nav-item ms-auto">
      <a href="javascript:void(0)" class="nav-link btn-primary rounded-pill d-flex align-items-center px-3" id="add-notes">
        <i data-feather="file" class="feather-sm fill-white me-0 me-md-1"></i>
        <span class="d-none d-md-block font-weight-medium fs-3">Add Notes</span>
      </a>
    </li>
  </ul>-->
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
                    <!--<img src="{{asset("$archivo->url")}}" alt="user" width="24" class="shadow col-sm-1"/> 
                    <h6 class="modal-title col-sm-9"><strong>{{pathinfo($archivo->url, PATHINFO_FILENAME)}}</strong></h6>
                    <button id="download" type="button" class="btn waves-effect waves-light btn-outline-info">
                      <a href="{{asset("$archivo->url")}}">
                        <i class="feather-sm"  href="{{asset("$archivo->url")}}" data-feather="download-cloud"></i>
                      </a>
                    </button>
                    <button id="{{pathinfo($archivo->url, PATHINFO_FILENAME)}}" type="button" class="btn waves-effect waves-light btn-outline-danger delete col-sm-1">
                      <i class="feather-sm" data-feather="trash-2"></i>
                    </button>-->
                  </div>
              @endswitch
            </p>
          </div>
          <!--<div class="d-flex align-items-center">
            <a href="javascript:void(0)" class="link me-1">
              <i class="ri-star-line fs-5 favourite-note"></i>
            </a>
            <a href="javascript:void(0)" class="link text-danger ms-2">
              <i class="ri-delete-bin-line fs-5 remove-note"></i>
            </a>
            <div class="ms-auto">
              <div class="category-selector btn-group">
                <a class="nav-link dropdown-toggle category-dropdown label-group p-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">
                  <div class="category">
                    <div class="category-business"></div>
                    <div class="category-social"></div>
                    <div class="category-important"></div>
                    <span class="more-options text-dark">
                      <i data-feather="more-vertical" class="feather-sm"></i>
                    </span>
                  </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right category-menu">
                  <a class="note-business badge-group-item badge-business dropdown-item position-relative category-business text-success d-flex align-items-center" href="javascript:void(0);">
                    <i class="ri-checkbox-blank-circle-line me-1"></i>
                    Business
                  </a>
                  <a class="note-social badge-group-item badge-social dropdown-item position-relative category-social text-info d-flex align-items-center" href="javascript:void(0);">
                    <i class="ri-checkbox-blank-circle-line me-1"></i>
                    Social
                  </a>
                  <a class="note-important badge-group-item badge-important dropdown-item position-relative category-important text-danger d-flex align-items-center" href="javascript:void(0);">
                    <i class="ri-checkbox-blank-circle-line me-1"></i>
                    Important
                  </a>
                </div>
              </div>
            </div>
          </div>-->
        </div>
      </div>
      @endforeach
    </div>
  </div>
@endsection