<header class="topbar">
  <nav class="navbar top-navbar navbar-expand-md">
      <div class="navbar-header"> 
          <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
            <i class="ri-close-line fs-6 ri-menu-2-line"></i>
          </a> 
          <!-- ============================================================== -->
          <!-- Logo -->
          <!-- ============================================================== -->
          <a class="navbar-brand" href={{route('home') }}>
              <!-- Logo icon -->
              <b class="logo-icon">
                  <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                  <!-- Dark Logo icon -->
                  <img src={{asset("assets/images/logo-icon.png")}} alt="homepage" class="dark-logo" width="40" height="60"/>
                  <!-- Light Logo icon -->
                  <img src={{asset("assets/images/icon.png")}} alt="homepage" class="light-logo" width="40" height="50"/>
                  <!--End Logo icon -->
                  <!-- Logo text -->
              </b>
              <!--End Logo icon -->
              <!-- Logo text -->
              <span class="logo-text">
                  <!-- dark Logo text -->
                  <img src="{{asset("assets/images/logo-text2.png")}}" alt="homepage" class="dark-logo" width="110" height="70"/>
                  <!-- Light Logo text -->
                  <img src="{{asset("assets/images/logo-text.png")}}" class="light-logo" alt="homepage" width="110" height="70"/>
              </span>
              <!--End Logo icon -->
          </a>
          <!-- ============================================================== -->
          <!-- End Logo -->
          <!-- ============================================================== -->
          <!-- ============================================================== -->
          <!-- Toggle which is visible on mobile only -->
          <!-- ============================================================== -->
          <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="ri-more-line fs-6"></i>
          </a>
      </div>
      <!-- ============================================================== -->
      <!-- End Logo -->
      <!-- ============================================================== -->
      <div class="navbar-collapse collapse" id="navbarSupportedContent">
          <!-- ============================================================== -->
          <!-- toggle and nav items -->
          <!-- ============================================================== -->
          <ul class="navbar-nav me-auto">
            <li class="nav-item d-none d-md-block">
                <a class="nav-link sidebartoggler waves-effect waves-dark" href="javascript:void(0)">
                    <i data-feather="menu" class="mdi mdi-menu font-24"></i>
                </a>
            </li>
            
              <!-- ============================================================== -->
              <!-- create new -->
              <!-- ============================================================== -->
              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <span class="d-none d-md-block">Nuevo <i class="fa fa-angle-down"></i></span>
                      <span class="d-block d-md-none"><i class="fa fa-plus"></i></span>
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <!--<li><a class="dropdown-item" href="{{('formatos.new')}}">Bug</a></li>
                      <li><a class="dropdown-item" href="{{('formatos.incidencias.new')}}">Incidencia</a></li>-->
                      <li><a class="dropdown-item mdi mdi-chart-areaspline" href="{{route('NuevaMaqueta')}}">Maquetado</a></li>
                      <li><a class="dropdown-item mdi mdi-content-paste" href="{{route('Nuevo')}}">Requerimiento</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item mdi mdi-developer-board" href="{{route('Editar')}}">Seguimiento</a></li>
                  </ul>
              </li>
              <!-- ============================================================== -->
              <!-- Search -->
              <!-- ============================================================== -->
              <li class="nav-item d-none d-md-block search-box"> 
                  <a class="nav-link d-none d-md-block waves-effect waves-dark" href="javascript:void(0)">
                      <i class="ti-search"></i>
                  </a>
                  <form class="app-search">
                      <input type="text" class="form-control" placeholder="Search &amp; enter"> 
                      <a class="srh-btn">
                          <i data-feather="x" class="ti-close"></i>
                      </a>
                  </form>
              </li>
          </ul>
          <!-- ============================================================== -->
          <!-- Right side toggle and nav items -->
          <!-- ============================================================== -->
          <ul class="navbar-nav justify-content-end">
              <!-- ============================================================== -->
              <!-- Comment -->
              <!-- ============================================================== -->
              <!--<li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="mdi mdi-bell font-24"></i>
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <li><a class="dropdown-item" href="#">Action</a></li>
                      <li><a class="dropdown-item" href="#">Another action</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="#">Something else here</a></li>
                  </ul>
              </li>-->
              <!-- ============================================================== -->
              <!-- End Comment -->
              <!-- ============================================================== -->
              <!-- ============================================================== -->
              <!-- Messages -->
              <!-- ============================================================== -->
              <!--<li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" id="2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="font-24 mdi mdi-comment-processing"></i>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end mailbox animated bounceInDown" aria-labelledby="2">
                      <ul class="list-style-none">
                          <li>
                              <div class="">
                                  <-- Message --
                                  <a href="javascript:void(0)" class="link border-top">
                                      <div class="d-flex no-block align-items-center p-10">
                                          <span class="btn btn-success btn-circle"><i
                                                  class="ti-calendar"></i></span>
                                          <div class="ms-2">
                                              <h5 class="mb-0">Event today</h5>
                                              <span class="mail-desc">Just a reminder that event</span>
                                          </div>
                                      </div>
                                  </a>
                                  <-- Message --
                                  <a href="javascript:void(0)" class="link border-top">
                                      <div class="d-flex no-block align-items-center p-10">
                                          <span class="btn btn-info btn-circle"><i
                                                  class="ti-settings"></i></span>
                                          <div class="ms-2">
                                              <h5 class="mb-0">Settings</h5>
                                              <span class="mail-desc">You can customize this template</span>
                                          </div>
                                      </div>
                                  </a>
                                  <-- Message --
                                  <a href="javascript:void(0)" class="link border-top">
                                      <div class="d-flex no-block align-items-center p-10">
                                          <span class="btn btn-primary btn-circle"><i
                                                  class="ti-user"></i></span>
                                          <div class="ms-2">
                                              <h5 class="mb-0">Pavan kumar</h5>
                                              <span class="mail-desc">Just see the my admin!</span>
                                          </div>
                                      </div>
                                  </a>
                                  <-- Message --
                                  <a href="javascript:void(0)" class="link border-top">
                                      <div class="d-flex no-block align-items-center p-10">
                                          <span class="btn btn-danger btn-circle"><i
                                                  class="fa fa-link"></i></span>
                                          <div class="ms-2">
                                              <h5 class="mb-0">Luanch Admin</h5>
                                              <span class="mail-desc">Just see the my new admin!</span>
                                          </div>
                                      </div>
                                  </a>
                              </div>
                          </li>
                      </ul>
                  </ul>
              </li>-->
              <!-- ============================================================== -->
              <!-- End Messages -->
              <!-- ============================================================== -->

              <!-- ============================================================== -->
              <!-- User profile and search -->
              <!-- ============================================================== -->
              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if (Auth::user()->avatar == NULL)
                      <img src="{{asset("assets/images/users/1.jpg")}}" alt="user" class="profile-pic rounded-circle" width="30"/> 
                    @else
                      <img src="{{asset(Auth::user()->avatar)}}" alt="user" class="profile-pic rounded-circle" width="30"/>    
                    @endif
                  </a>
                  <div class="dropdown-menu dropdown-menu-end user-dd animated flipInY">
                      <div class="d-flex no-block align-items-center p-3 bg-primary text-white mb-2">
                          <div class="">
                            @if (Auth::user()->avatar == NULL)
                              <img src="{{asset("assets/images/users/1.jpg")}}" alt="user" class="rounded-circle" width="60"/> 
                            @else
                              <img src="{{asset(Auth::user()->avatar)}}" alt="user" class="rounded-circle" width="60"/>    
                            @endif
                          </div>
                          <div class="ms-2">
                              <h4 class="mb-0 text-white">{{Auth::user()->nombre}}</h4>
                              <p class="mb-0">{{Auth::user()->email}}</p>
                          </div>
                      </div>
                      <a class="dropdown-item" href="{{route('profile',Auth::user()->id)}}">
                          <i data-feather="user" class="feather-sm text-info me-1 ms-1"></i>
                          {{ Auth::user()->nombre }}
                      </a>
                      <!--<a class="dropdown-item" href="javascript:void(0)"><i class="ti-wallet me-1 ms-1"></i>
                          My Balance</a>
                      <a class="dropdown-item" href="javascript:void(0)"><i class="ti-email me-1 ms-1"></i>
                          Inbox</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="javascript:void(0)"><i
                              class="ti-settings me-1 ms-1"></i> Account Setting</a>
                      <div class="dropdown-divider"></div>-->
                      <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                          <i class="fa fa-power-off me-1 ms-1" ></i>
                          {{ __('Salir') }}
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                          @csrf
                      </form>
                      <!--<div class="dropdown-divider"></div>
                      <div class="ps-4 p-10"><a href="javascript:void(0)"
                              class="btn btn-sm btn-success btn-rounded text-white">View Profile</a></div>-->
                  </div>
              </li>
              <!-- ============================================================== -->
              <!-- User profile and search -->
              <!-- ============================================================== -->
          </ul>
      </div>
  </nav>
</header>