@extends('home')
@section('content')
    
<div class="card">
    <div class="card-body wizard-content-center">
        <div class="card-title mb-0">{{ __('Enviar Informe') }}</div>

        <form method="POST" action="{{ route('Enviado') }}">
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

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-success text-white">
                        {{ __('Enviar Correo de Informe') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection