@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{asset("vendor/bootstrap/css/bootstrap.min.css")}}">
    
    
<div class="row">
    <div class="col-lg-6">
        <div class="card-body little-profile text-center">
            <div class="my-3" data-tilt>
                <img src="images/img-01.png" alt="IMG">
            </div>
        </div>
    </div>
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body little-profile text-center">
            <div class="login100-form validate-form">
                <span class="login100-form-title">
                    {{ __('Iniciar Sesión') }}
                </span>

                <div class="wrap-input100 validate-input">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="wrap-input100 validate-input">
                            <input id="email" type="email" class="input100 @error('email') is-invalid @enderror" name="email" placeholder="Correo" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                            </span>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="wrap-input100 validate-input">
                            <input id="password" type="password" class="input100 @error('password') is-invalid @enderror" name="password" placeholder="Contraseña" required autocomplete="current-password">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                            </span>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Recordarme') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="container-login100-form-btn">
                            <div class="">
                                <button type="submit" class="login100-form-btn">
                                    {{ __('Iniciar Sesión') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Olvidé mi Contraseña') }}
                                    </a>
                                @endif
                            </div> 
                        </div>  
                    </form>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>
    <script src="{{asset("vendor/tilt/tilt.jquery.min.js")}}"></script>
    <script src="{{asset("vendor/bootstrap/js/bootstrap.min.js")}}"></script>
@endsection 