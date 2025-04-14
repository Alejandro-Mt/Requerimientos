<!-- Modal -->
<div class="modal fade" id="acceso-{{$loop->iteration}}" tabindex="-1" aria-labelledby="scroll-long-inner-modal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <form action="" method="post">
        <div class="modal-header d-flex align-items-center">
          <h4 class="modal-title" id="myLargeModalLabel">{{$miembro->nombre}} {{$miembro->apaterno}}</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <div class="row border mt-3">
              <div class="table-responsive">
                <li class="list-inline-item">
                  @foreach($sistemas as $sistema)
                    @if($miembro->id == Auth::user()->id)<div class="form-check mr-sm-2">
                      <input type="checkbox" class="form-check-input secondary check-outline outline-secondary" checked value={{$sistema->id_sistema}} disabled>
                      <label class="form-check-label" for="id_sistema">{{$sistema->nombre_s}}</label>
                    </div>
                    @else
                      <div class="form-check mr-sm-2" id="{{$miembro->id}}-{{$sistema->id_sistema}}">
                        <input name="id_sistema" type="checkbox" class="form-check-input secondary check-outline outline-secondary" 
                          @foreach ($accesos as $acs)
                              @if (($sistema->id_sistema == $acs->id_sistema) && ($miembro->id == $acs->id_user))
                                checked
                                value="{{$acs->id}}"
                              @endif
                          @endforeach
                          onchange='update("{{$miembro->id}}.{{$sistema->id_sistema}}")'
                          id = "{{$miembro->id}}.{{$sistema->id_sistema}}">
                        <label class="form-check-label" for="id_sistema">{{$sistema->nombre_s}}</label>
                      </div>
                    @endif
                  @endforeach
                </li>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button name="id" value={{$miembro->id}} type="button" class="btn btn-light-success text-white font-medium waves-effect text-start" data-bs-dismiss='modal'>
            Hecho
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<style>
  .modal-body {
  height: auto;
  max-height: 200px;
  overflow-x: hidden;
  }
</style>