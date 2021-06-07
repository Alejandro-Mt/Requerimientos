@extends('layouts.app')

@section('content')
<div class="row justify-content-center wrap-login100">
    <span class="login100-form-title">{{ __('Registrar') }}</span>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-left">{{ __('Nombre') }}</label>
            <input id="name" type="text" class="input100 col-md-8 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('name')
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

@endsection
