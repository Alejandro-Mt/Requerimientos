@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{asset("vendor/bootstrap/css/bootstrap.min.css")}}">
    
    

    <div class="main-wrapper">
      <!-- -------------------------------------------------------------- -->
      <!-- Login box.scss -->
      <!-- -------------------------------------------------------------- -->
      <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-image" style="background: url({{asset('assets/images/bg_log_in.png')}}) no-repeat center center">
        <div class="auth-box card">
          <div id="loginform">
            <div class="logo">
              <span class="db">
                <img src="{{asset('assets/images/logo-icon-it.png')}}" alt="logo" width="50"/>
              </span>
              <h5 class="font-medium mb-3">Sign In</h5>
            </div>
            <!-- Form -->
            <div class="row">
              <div class="col-12">
                  <form name="login" class="form-horizontal mt-3" id="loginform" method="POST" action="{{ route('login') }}">
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
                  <div class="mb-3 row">
                    <div class="col-md-12">
                      <div class="form-check d-flex align-items-center">
                        <input class="form-check-input" type="checkbox" name="remember" id="customCheck1" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="customCheck1">Recordarme</label>
                        <a href="javascript:void(0)" id="to-recover" class="text-dark ms-auto d-flex align-items-center">
                          <i data-feather="lock" class="feather-sm me-1"></i> Recuperar cont!
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="mb-3 text-center">
                    <div class="col-xs-12 pb-3">
                      <button class="btn d-block w-100 btn-lg btn-info font-medium" type="submit">
                        Iniciar sesión
                      </button>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 mt-2 text-center">
                      <div class="social">
                        <!--<a href="javascript:void(0)" class="btn btn-facebook" data-bs-toggle="tooltip" title="" data-original-title="Login with Facebook">
                          <i aria-hidden="true" class="ri-facebook-box-fill fs-4"></i>
                        </a>-->
                        <a href={{ route('auth.google') }} class="btn btn-googleplus">
                          <i aria-hidden="true" class="ri-google-fill fs-4"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                  <!--<div class="mb-3 mb-0 mt-2">
                    <div class="col-sm-12 text-center">
                      Don't have an account?
                      <a href="authentication-register1.html" class="text-info ms-1"
                        ><b>Sign Up</b></a
                      >
                    </div>
                  </div>-->
                </form>
              </div>
            </div>
          </div>
          <div id="recoverform">
            <div class="logo">
              <span class="db"><img src="{{asset("assets/images/logo-icon-it.png")}}" alt="logo" width="50" /></span>
              <h5 class="font-medium mb-3">Recuperar Contraseña</h5>
              <span>Ingresa tu correo y te enviaremos las instrucciones!</span>
            </div>
            <div class="row mt-3">
              <!-- Form -->
              <form class="col-12" name="pwd" action="{{ route('password.email') }}" method="POST">
                @csrf
                <!-- email -->
                <div class="mb-3 row">
                  <div class="col-12">
                    <input class="form-control form-control-lg @error('email') is-invalid @enderror" type="email" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus placeholder="Usuario"/>
                  </div>
                </div>
                <!-- pwd -->
                <div class="row mt-3">
                  <div class="col-12">
                    <button class="btn d-block w-100 btn-lg btn-light-danger text-danger" type="submit" name="action">
                      Restaurar
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- -------------------------------------------------------------- -->
      <!-- Login box.scss -->
      <!-- -------------------------------------------------------------- -->
    </div>
@endsection 



