@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center wrap-login100">
        <div class="justify-content-center">
            <div class="login100-form-title">{{ __('Confirmar Contraseña') }}</div>

            <div class="wrap-input100 validate-input text-md-center">
                {{ __('Confirme su contraseña antes de continuar.') }}

                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="password" class="col-md-3 col-form-label text-md-center"></label>

                        <div class="col-md-8">
                            <input id="password" type="password" placeholder="Contraseña" class="input100 form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                            </span>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-8 offset-md-3">
                            <button type="submit" class="login100-form-btn">
                                {{ __('Confirmar') }}
                            </button>

                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Olvide mi Contraseña') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
