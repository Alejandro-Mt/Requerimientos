<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
      <div class="navbar-header">
        <!-- This is for the sidebar toggle which is visible on mobile only -->
        <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
          <i class="ri-close-line fs-6 ri-menu-2-line"></i>
        </a>
        <!-- -------------------------------------------------------------- -->
        <!-- Logo -->
        <!-- -------------------------------------------------------------- -->
        <a class="navbar-brand" href="{{route('home') }}">
          <!-- Logo icon -->
          <b class="logo-icon">
            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
            <!-- Dark Logo icon -->
            <img src={{asset("assets/images/logo-icon.png")}} alt="homepage" class="dark-logo" width="40" height="60"/>
            <!-- Light Logo icon -->
            <img src="{{asset("assets/images/logo-icon.png")}}" alt="homepage" class="light-logo" width="40" height="40"/>
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
        </a>
        <!-- -------------------------------------------------------------- -->
        <!-- End Logo -->
        <!-- -------------------------------------------------------------- -->
        <!-- -------------------------------------------------------------- -->
        <!-- Toggle which is visible on mobile only -->
        <!-- -------------------------------------------------------------- -->
        <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <i class="ri-more-line fs-6"></i>
        </a>
      </div>
      <!-- -------------------------------------------------------------- -->
      <!-- End Logo -->
      <!-- -------------------------------------------------------------- -->
      <div class="navbar-collapse collapse" id="navbarSupportedContent">
        <!-- -------------------------------------------------------------- -->
        <!-- toggle and nav items -->
        <!-- -------------------------------------------------------------- -->
        <ul class="navbar-nav me-auto">
          <li class="nav-item d-none d-md-block">
            <a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar">
              <i data-feather="menu" class="feather-sm"></i>
            </a>
          </li>
          <!-- -------------------------------------------------------------- -->
          <!-- create new -->
          <!-- -------------------------------------------------------------- -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="d-none d-md-block">Nuevo 
                <i data-feather="chevron-down" class="feather-sm"></i>
              </span>
              <span class="d-block d-md-none">
                <i data-feather="plus" class="feather-sm"></i>
              </span>
            </a>
            <div class="dropdown-menu dropdown-menu-animate-up" aria-labelledby="navbarDropdown">
              <li>
                <a class="dropdown-item mdi mdi-chart-areaspline" href="{{route('NuevaMaqueta')}}">Maquetado</a>
              </li>
              <li>
                <a class="dropdown-item mdi mdi-content-paste" href="{{route('Nuevo')}}">Requerimiento</a>
              </li>
              <div class="dropdown-divider"></div>
              <li>
                <a class="dropdown-item mdi mdi-developer-board" href="{{route('Editar')}}">Seguimiento</a>
              </li>
            </div>
          </li>
          <!-- -------------------------------------------------------------- -->
          <!-- Search -->
          <!-- -------------------------------------------------------------- -->
          <li class="nav-item search-box">
            <a class="nav-link waves-effect waves-dark" href="javascript:(0)">
              <i data-feather="search" class="feather-sm"></i>
            </a>
            <form class="app-search position-absolute">
              <input type="text" class="form-control" placeholder="Buscar &amp; Insertar" />
              <a class="srh-btn">
                <i data-feather="x" class="feather-sm"></i>
              </a>
            </form>
          </li>
        </ul>
        <!-- -------------------------------------------------------------- -->
        <!-- Right side toggle and nav items -->
        <!-- -------------------------------------------------------------- -->
        <ul class="navbar-nav">
          <!-- -------------------------------------------------------------- -->
          <!-- create new -->
          <!-- -------------------------------------------------------------- -->
          <!-- -------------------------------------------------------------- -->
          <!-- Comment -->
          <!-- -------------------------------------------------------------- -->
          <!--<li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i data-feather="bell" class="feather-sm"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-end mailbox dropdown-menu-animate-up">
              <span class="with-arrow"><span class="bg-primary"></span></span>
              <ul class="list-style-none">
                <li>
                  <div class="drop-title bg-primary text-white">
                    <h4 class="mb-0 mt-1">4 New</h4>
                    <span class="fw-light">Notifications</span>
                  </div>
                </li>
                <li>
                  <div class="message-center notifications">-->
                    <!-- Message -->
                    <!--<a href="#" class="message-item">
                      <span class="btn btn-light-danger text-danger btn-circle">
                        <i data-feather="link" class="feather-sm fill-white"></i>
                      </span>
                      <div class="mail-contnet">
                        <h5 class="message-title">Luanch Admin</h5>
                        <span class="mail-desc">Just see the my new admin!</span>
                        <span class="time">9:30 AM</span>
                      </div>
                    </a>
                  </div>
                </li>
                <li>
                  <a class="nav-link text-center mb-1 text-dark" href="#">
                    <strong>Check all notifications</strong>
                    <i data-feather="chevron-right" class="feather-sm"></i>
                  </a>
                </li>
              </ul>
            </div>
          </li>-->
          <!-- -------------------------------------------------------------- -->
          <!-- End Comment -->
          <!-- -------------------------------------------------------------- -->
          <!-- -------------------------------------------------------------- -->
          <!-- Messages -->
          <!-- -------------------------------------------------------------- -->
          <!--<li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle waves-effect waves-dark"
              href=""
              id="2"
              data-bs-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              <i data-feather="message-square" class="feather-sm"></i>
            </a>
            <div
              class="dropdown-menu dropdown-menu-end mailbox dropdown-menu-animate-up"
              aria-labelledby="2"
            >
              <span class="with-arrow"><span class="bg-danger"></span></span>
              <ul class="list-style-none">
                <li>
                  <div class="drop-title text-white bg-danger">
                    <h4 class="mb-0 mt-1">5 New</h4>
                    <span class="fw-light">Messages</span>
                  </div>
                </li>
                <li>
                  <div class="message-center message-body">-->
                    <!-- Message -->
                    <!--<a href="#" class="message-item">
                      <span class="user-img">
                        <img
                          src="../../assets/images/users/1.jpg"
                          alt="user"
                          class="rounded-circle"
                        />
                        <span class="profile-status online pull-right"></span>
                      </span>
                      <div class="mail-contnet">
                        <h5 class="message-title">Pavan kumar</h5>
                        <span class="mail-desc">Just see the my admin!</span>
                        <span class="time">9:30 AM</span>
                      </div>
                    </a>
                  </div>
                </li>
                <li>
                  <a class="nav-link text-center link text-dark" href="#">
                    <b>See all e-Mails</b>
                    <i data-feather="chevron-right" class="feather-sm"></i>
                  </a>
                </li>
              </ul>
            </div>
          </li>-->
          <!-- -------------------------------------------------------------- -->
          <!-- End Messages -->
          <!-- -------------------------------------------------------------- -->
          <!-- -------------------------------------------------------------- -->
          <!-- User profile and search -->
          <!-- -------------------------------------------------------------- -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="{{asset(Auth::user()->avatar)}}" alt="user" width="30" class="profile-pic rounded-circle">
            </a>
            <div class="dropdown-menu dropdown-menu-end user-dd animated flipInY">
                <div class="d-flex no-block align-items-center p-3 bg-primary text-white mb-2">
                    <div class="">
                        <img src="{{asset(Auth::user()->avatar)}}" alt="user" class="rounded-circle" width="60"/>
                    </div>
                    <div class="ms-2">
                        <h4 class="mb-0 text-white">{{Auth::user()->nombre}}</h4>
                        <p class="mb-0">{{Auth::user()->puesto}}</p>
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
          <!-- -------------------------------------------------------------- -->
          <!-- User profile and search -->
          <!-- -------------------------------------------------------------- -->
        </ul>
      </div>
    </nav>
</header>
