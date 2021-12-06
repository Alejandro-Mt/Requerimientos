@extends('home')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <div class="card">
      @foreach ($registros as $avance)
        <div class="card-body wizard-content">
          <div class="form-group row">
            <div class="col-md-6">
              <input name="folio" type="text" class="required form-control  @error ('folio') is-invvalid @enderror" readonly="readonly" value="{{$avance->folio}}"> 
            </div>
            <div class="col-md-6">
              <input name="descripcion" type="text" class="required form-control" readonly="readonly" value="{{$avance->descripcion}}">  
            </div>
          </div>
          <div class="progress mt-3">
              <div class="progress-bar progress-bar-striped progress-bar-animated" 
                @switch($avance->id_estatus)
                    @case(17)
                      style="width:10%"
                      @break
                    @case(10)
                      style="width:20%"
                      @break
                    @case(16)
                      style="width:30%"
                      @break
                    @case(11)
                      style="width:40%"
                      @break
                    @case(9)
                      style="width:50%"
                      @break
                    @case(7)
                      style="width:60%"
                      @break
                    @case(8)
                      style="width:70%"
                      @break
                    @case(2)
                      style="width:80%"
                      @break
                    @case(18)
                      style="width:100%"
                      @break
                    @default
                @endswitch>
              </div>
          </div>
          <div class="d-flex no-block align-items-center">
            @switch($avance->id_estatus)
              @case(17)
                <span>10% Avance</span>
                @break
              @case(10)
                <span>20% Avance</span>
                @break
              @case(16)
                <span>30% Avance</span>
                @break
              @case(11)
                <span>40% Avance</span>
                @break
              @case(9)
                <span>50% Avance</span>
                @break
              @case(7)
                <span>60% Avance</span>
                @break
              @case(8)
                <span>70% Avance</span>
                @break
              @case(2)
                <span>80% Avance</span>
                @break
              @case(12)
                <span>90% Avance</span>
                @break
              @default
            @endswitch
            <div class="ms-auto">
              @foreach ($estatus as $e)
                @if ($e->id_estatus == $avance->id_estatus)
                  <span>{{$e->titulo}}</span>
                @endif
              @endforeach
            </div>
          </div>
          <!-- Visualizar el estatus en la seccion inf izq -->
        </div>  
      @endforeach
    </div>
    <div class="card">
      <!-- Card -->
      <!-- Start row -->
        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title border-bottom">
                  <span class="lstick d-inline-block align-middle"></span>Comentarios
                </h4>
                <form class="border-bottom" action="{{route('Comentar')}}" method="POST">
                  {{ csrf_field() }}
                  <div class=""width="500" height="10" style="margin-left:10;">
                      <section class="u-align-left u-border-3 u-border-grey-75 u-clearfix u-white u-section-1" id="carousel_4c76">
                        <input type="text" class="d-none" name="folio" value="{{$avance->folio}}">
                        <input type="text" class="d-none" name="respuesta" value="No">
                        <div class="row">
                          <div class="p-1 col-1">
                            @if (Auth::user()->avatar == NULL)
                              <img src="{{asset("assets/images/users/1.jpg")}}" alt="user" width="50" class="rounded-circle"/> 
                            @else
                              <img src="{{asset(Auth::user()->avatar)}}" alt="user" width="50" class="rounded-circle"/>    
                            @endif
                          </div>
                          <div class="col-9">
                            <textarea name="contenido" placeholder="Escribe tu Comentario" class="form-control border-0" style="resize: none"></textarea>
                          </div>
                          <div class="col-1 text-end">
                            <button type="submit" class="btn btn-lg">
                              <i class="fas fa-reply"></i>
                            </button>
                          </div>
                        </div>
                      </section>
                  </div>
                </form>
              </div>
              <div class="comment-widgets scrollable mb-2 common-widget" style="height: 450px">
                <!-- Comment Row -->
                @foreach ($comentarios as $comentario)
                  @if ($comentario->respuesta == 'No')
                    <div class="d-flex flex-row comment-row border-bottom p-3">
                      <div class="p-2">
                        @if (Auth::user()->avatar == NULL)
                          <img src="{{asset("assets/images/users/1.jpg")}}" alt="user" width="50" class="rounded-circle"/> 
                        @else
                          <img src="{{asset(Auth::user()->avatar)}}" alt="user" width="50" class="rounded-circle"/>    
                        @endif
                      </div>
                      <div class="comment-text w-100">
                        <h6 class="font-medium">{{"$comentario->nombre $comentario->apaterno"}}</h6>
                        <span class="mb-3 d-block">{{$comentario->contenido}}</span>
                        <div class="comment-footer d-md-flex align-items-center">
                          <span class="badge bg-light-danger text-danger rounded-pill font-weight-medium fs-1 py-1">{{$comentario->puesto}}</span>
                          <span class="action-icons">
                            <a data-bs-toggle="collapse" href="#r-{{$loop->iteration}}" role="button" aria-expanded="false" aria-controls="r-{{$loop->iteration}}" class="ps-3"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3 feather-sm"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg></a>
                          <!-- <a href="javascript:void(0)" class="ps-3"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle feather-sm"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg></a>
                            <a href="javascript:void(0)" class="ps-3"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart feather-sm"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg></a>-->
                          </span>
                          <div class="text-muted ms-auto mt-2 mt-md-0">{{/*date('d-m-20y',strtotime(*/$comentario->created_at->diffForHumans()}}</div>
                        </div>
                      </div>
                    </div>
                    <form id="r-{{$loop->iteration}}" class="collapse" action="{{route('Comentar')}}" method="POST">
                      {{ csrf_field() }}
                      <div class="" width="500" height="10" style="margin-left:100;">
                          <section class="u-align-left u-border-2 u-border-grey-7 u-clearfix u-white u-section-1" id="carousel_4c76">
                            <input type="text" class="d-none" name="folio" value="{{$avance->folio}}">
                            <input type="text" class="d-none" name="respuesta" value="SI">
                            <div class="row">
                              <div class="p-2 col-1">
                                @if (Auth::user()->avatar == NULL)
                                  <img src="{{asset("assets/images/users/1.jpg")}}" alt="user" width="40" class="rounded-circle"/> 
                                @else
                                  <img src="{{asset(Auth::user()->avatar)}}" alt="user" width="40" class="rounded-circle"/>    
                                @endif
                              </div>
                              <div class="col-6">
                                <textarea name="contenido" placeholder="Escribe tu Comentario" class="form-control border-0" style="resize: none"></textarea>
                              </div>
                              <div class="col-2 text-end">
                                <!--button type="button" class="btn btn-info btn-circle btn-lg"-->
                                <button type="submit" class="btn btn-lg">
                                  <i class="fas fa-reply"></i>
                                </button>
                              </div>
                            </div>
                              <!-- solo 5 comentarios para mostrar lo mas importante -->
                            
                          </section>
                      </div>
                    </form>
                  @else
                    <div class="d-flex flex-row comment-row border-bottom p-3" style="margin-left: 50">
                      <div class="p-2">
                        @if (Auth::user()->avatar == NULL)
                          <img src="{{asset("assets/images/users/1.jpg")}}" alt="user" width="40" class="rounded-circle"/> 
                        @else
                          <img src="{{asset(Auth::user()->avatar)}}" alt="user" width="40" class="rounded-circle"/>    
                        @endif
                      </div>
                      <div class="comment-text w-100">
                        <h6 class="font-medium">{{"$comentario->nombre $comentario->apaterno"}}</h6>
                        <span class="mb-3 d-block">{{$comentario->contenido}}</span>
                        <div class="comment-footer d-md-flex align-items-center">
                          <span class="badge bg-light-danger text-danger rounded-pill font-weight-medium fs-1 py-1">{{$comentario->puesto}}</span>
                          <span class="action-icons">
                          <!-- <a href="javascript:void(0)" class="ps-3"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle feather-sm"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg></a>
                            <a href="javascript:void(0)" class="ps-3"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart feather-sm"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg></a>-->
                          </span>
                          <div class="text-muted ms-auto mt-2 mt-md-0">{{/*date('d-m-20y',strtotime(*/$comentario->created_at->diffForHumans()}}</div>
                        </div>
                      </div>
                    </div>
                  @endif
                @endforeach
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="card">
              <div class="row">
                <div class="col-md-12">
                  <!-- ---------------------
                  start Drag & Drop Event
                  ---------------- -->
                    <div class="row">
                      <div class="col-lg-12">
                          <div class="card-body calender-sidebar">
                            <div id="calendar"></div>
                          </div>
                      </div>
                    </div>
                  <!-- ---------------------
                  end Drag & Drop Event
                  ---------------- -->
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- End row -->
    </div>    
@endsection