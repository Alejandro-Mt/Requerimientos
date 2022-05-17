@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <span class="login100-form-title">{{ __('Registrar') }}</span>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="nombre" 
                                class="col-md-4 col-form-label text-md-left">{{ __('Nombre') }}</label>
                            <input id="nombre" type="text" class="text-capitalize input100 col-md-8 @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" required autocomplete="nombre" autofocus>

                            @error('nombre')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="apaterno" 
                                class="col-md-4 col-form-label text-md-left">{{ __('Apellido Paterno') }}</label>
                            <input id="apaterno" type="text" class="text-capitalize input100 col-md-8 @error('apaterno') is-invalid @enderror" name="apaterno" value="{{ old('apaterno') }}" required autocomplete="apaterno" autofocus>

                            @error('apaterno')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="amaterno" 
                                class="col-md-4 col-form-label text-md-left">{{ __('Apellido Materno') }}</label>
                            <input id="amaterno" type="text" class="text-capitalize input100 col-md-8 @error('amaterno') is-invalid @enderror" name="amaterno" value="{{ old('amaterno') }}" required autocomplete="apaterno" autofocus>

                            @error('amaterno')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-left">{{ __('Correo') }}</label>
                            <input id="email" type="email" class="input100 col-md-8 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-left">{{ __('Contraseña') }}</label>
                            <input id="password" type="password" class="input100 col-md-8 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-left">{{ __('Confirmar Contraseña') }}</label>
                            <input id="password-confirm" type="password" class="input100 col-md-8" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="login100-form-btn">
                                    {{ __('Registrar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
