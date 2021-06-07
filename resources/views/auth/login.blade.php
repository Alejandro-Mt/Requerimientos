@extends('layouts.app')

<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<link rel="stylesheet" type="text/css" href="{{asset("vendor/bootstrap/css/bootstrap.min.css")}}">
<link rel="stylesheet" type="text/css" href="{{asset("fonts/font-awesome-4.7.0/css/font-awesome.min.css")}}">
<link rel="stylesheet" type="text/css" href="{{asset("vendor/animate/animate.css")}}">
<link rel="stylesheet" type="text/css" href="{{asset("vendor/css-hamburgers/hamburgers.min.css")}}">
<link rel="stylesheet" type="text/css" href="{{asset("vendor/select2/select2.min.css")}}">
<link rel="stylesheet" type="text/css" href="{{asset("css/util.css")}}">
<link rel="stylesheet" type="text/css" href="{{asset("css/main.css")}}">

@section('content')

<div class="container-right">
    <div class="wrap-login100">   
        <div class="row justify-content-left">
            <div class="login100-pic js-tilt" data-tilt>
                <img src="images/img-01.png" alt="IMG">
            </div>
            <div class="login100-form validate-form">
                <span class="login100-form-title">
                    {{ __('Iniciar Secion') }}</span>

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
                                    {{ __('Iniciar Secion') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Olvide mi Contraseña') }}
                                    </a>
                                @endif
                            </div>   
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset("vendor/jquery/jquery-3.2.1.min.js")}}"></script>
<script src="{{asset("vendor/bootstrap/js/popper.js")}}"></script>
<script src="{{asset("vendor/bootstrap/js/bootstrap.min.js")}}"></script>
<script src="{{asset("vendor/select2/select2.min.js")}}"></script>
<script src="{{asset("vendor/tilt/tilt.jquery.min.js")}}"></script>
<script >
    $('.js-tilt').tilt({
        scale: 1.1
    })
</script>
<script src="{{asset("js/main.js")}}"></script>
@endsection

