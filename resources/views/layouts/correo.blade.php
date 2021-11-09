@extends('home')
@section('content')
    
<div class="card">
    <div class="card-body wizard-content-center">
        <div class="card-title mb-0">{{ __('Enviar Informe') }}</div>

        <form method="POST" action="{{route('Enviado')}}">
            @csrf

            <div class="form-group row">
                <label for="email" class="col-sm-2 text-end control-label col-form-label">{{ __('Dereccion de Correo') }}</label>

                <div class="col-md-6">
                       <!-- <i class="fa fa-envelope"></i>-->
                    <input id="email" type="email" class="required form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="d-none">
                @foreach ($registros as $registro)
                <input type="text" name="folio" value={{$registro->folio}} visible="false">                                  
                @endforeach
            </div> 
            
            <div class="d-none">
                @if ($registro->id_estatus == "10" || $registro->id_estatus == "11")
                <input type="text" name="id_estatus" value="16" visible="false">
                @else
                    <input type="text" name="id_estatus" value="11" visible="false">
                @endif                
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button class="btn-success text-white" id="alerta" data-toggle="modal" data-target="#confirm">
                        {{ __('Enviar Correo de Informe') }}
                    </button>
                </div>
            </div>
            <!-- Modal de Confirmacion -->
            <div class="modal" id="confirm" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"></h4>
                        </div>
                        <div class="modal-body">
                            <label>¿Enviar Correo?</label>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-invert" data-dismiss="modal">Cancelar</a>
                            <button type="submit" class="btn btn-success btn-ok">Confirmar</a></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection