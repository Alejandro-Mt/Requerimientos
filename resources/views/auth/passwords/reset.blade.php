@extends('layouts.app')

@section('content')    
  <div class="main-wrapper">
    <!-- -------------------------------------------------------------- -->
    <!-- Login box.scss -->
    <!-- -------------------------------------------------------------- -->
      <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background: url({{asset('assets/images/bg_log_in.png')}}) no-repeat center center">
        <div class="auth-box card">
          <div id="loginform">
            <div class="logo">
              <span class="db">
                <img src="{{asset('assets/images/logo-icon-it.png')}}" alt="logo" width="50"/>
              </span>
              <h5 class="font-medium mb-3">Restaurar Contraseña</h5>
            </div>
            <form method="POST" action="{{ route('password.update') }}">
              @csrf
              <!-- Form -->
              <div class="row">
                <div class="col-12">
                    <form name="login" class="form-horizontal mt-3" id="loginform" method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="basic-addon1">
                        <i data-feather="user" class="feather-sm"></i>
                      </span>
                      <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" placeholder="Usuario" value="{{ old('email') }}" required autocomplete="email" autofocus>
                      @error('email')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="basic-addon2">
                        <i data-feather="edit-2" class="feather-sm"></i>
                      </span>
                      <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" placeholder="Contraseña" required autocomplete="current-password">
                      @error('password')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="basic-addon2">
                        <i data-feather="lock" class="feather-sm me-1"></i>
                      </span>
                      <input id="password-confirm" type="password" class="form-control form-control-lg @error('password-confirm') is-invalid @enderror" name="password-confirm" placeholder="Confirmación" required autocomplete="current-password">
                      @error('password-confirm')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                    <div class="mb-3 text-center">
                      <div class="col-xs-12 pb-3">
                        <button class="btn d-block w-100 btn-lg btn-info font-medium" type="submit">
                          Cambiar contraseña
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
  </div>
@endsection
