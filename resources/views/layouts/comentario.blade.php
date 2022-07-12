
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