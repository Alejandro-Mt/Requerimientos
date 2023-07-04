<!-- -------------------------------------------------------------- -->
    <!-- customizer Panel -->
    <!-- -------------------------------------------------------------- -->
    <aside class="customizer">
      <a class="service-panel-toggle">
        <i data-feather="settings" class="feather-sm fa fa-spin"></i>
      </a>
      <div class="customizer-body ps-container" data-ps-id="8d54544e-ed80-b8d1-9999-4ca12146f036">
        <ul class="nav customizer-tab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><i class="ri-tools-fill fs-6"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" href="#chat" role="tab" aria-controls="chat" aria-selected="false"><i class="ri-message-3-line fs-6"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false"><i class="ri-timer-line fs-6"></i></a>
          </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
          <!-- Tab 1 -->
          <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="p-3 border-bottom">
              <!-- Sidebar -->
              <h5 class="font-weight-medium mb-2 mt-2">Layout Settings</h5>
              <div class="form-check mt-3">
                <input type="checkbox" name="theme-view" class="form-check-input" id="theme-view" @if(Auth::user()->theme == 1) checked @endif>
                <label class="form-check-label" for="theme-view">
                  <span>Dark Theme</span>
                </label>
              </div>
              <div class="form-check mt-2">
                <input type="checkbox" class="sidebartoggler form-check-input" name="collapssidebar" id="collapssidebar" @if(Auth::user()->sidebar == 1) checked @endif>
                <label class="form-check-label" for="collapssidebar">
                  <span>Collapse Sidebar</span>
                </label>
              </div>
              <div class="form-check mt-2">
                <input type="checkbox" name="sidebar-position" class="form-check-input" id="sidebar-position" @if(Auth::user()->fix_sidebar == 1) checked @endif>
                <label class="form-check-label" for="sidebar-position">
                  <span>Fixed Sidebar</span>
                </label>
              </div>
              <div class="form-check mt-2">
                <input type="checkbox" name="header-position" class="form-check-input" id="header-position" @if(Auth::user()->fix_head == 1) checked @endif>
                <label class="form-check-label" for="header-position">
                  <span>Fixed Header</span>
                </label>
              </div>
              <div class="form-check mt-2">
                <input type="checkbox" name="boxed-layout" class="form-check-input" id="boxed-layout" @if(Auth::user()->box == 1) checked @endif>
                <label class="form-check-label" for="boxed-layout">
                  <span>Boxed Layout</span>
                </label>
              </div>
            </div>
            <div class="p-3 border-bottom">
              <!-- Logo BG -->
              <h5 class="font-weight-medium mb-2 mt-2">Logo Backgrounds</h5>
              <ul class="theme-color m-0 p-0">
                <li class="theme-item list-inline-item me-1">
                  <a href="javascript:void(0)" class="theme-link rounded-circle d-block" data-logobg="skin1"></a>
                </li>
                <li class="theme-item list-inline-item me-1">
                  <a href="javascript:void(0)" class="theme-link rounded-circle d-block" data-logobg="skin2"></a>
                </li>
                <li class="theme-item list-inline-item me-1">
                  <a href="javascript:void(0)" class="theme-link rounded-circle d-block" data-logobg="skin3"></a>
                </li>
                <li class="theme-item list-inline-item me-1">
                  <a href="javascript:void(0)" class="theme-link rounded-circle d-block" data-logobg="skin4"></a>
                </li>
                <li class="theme-item list-inline-item me-1">
                  <a href="javascript:void(0)" class="theme-link rounded-circle d-block" data-logobg="skin5"></a>
                </li>
                <li class="theme-item list-inline-item me-1">
                  <a href="javascript:void(0)" class="theme-link rounded-circle d-block" data-logobg="skin6"></a>
                </li>
              </ul>
              <!-- Logo BG -->
            </div>
            <div class="p-3 border-bottom">
              <!-- Navbar BG -->
              <h5 class="font-weight-medium mb-2 mt-2">Navbar Backgrounds</h5>
              <ul class="theme-color m-0 p-0">
                <li class="theme-item list-inline-item me-1">
                  <a href="javascript:void(0)" class="theme-link rounded-circle d-block" data-navbarbg="skin1"></a>
                </li>
                <li class="theme-item list-inline-item me-1">
                  <a href="javascript:void(0)" class="theme-link rounded-circle d-block" data-navbarbg="skin2"></a>
                </li>
                <li class="theme-item list-inline-item me-1">
                  <a href="javascript:void(0)" class="theme-link rounded-circle d-block" data-navbarbg="skin3"></a>
                </li>
                <li class="theme-item list-inline-item me-1">
                  <a href="javascript:void(0)" class="theme-link rounded-circle d-block" data-navbarbg="skin4"></a>
                </li>
                <li class="theme-item list-inline-item me-1">
                  <a href="javascript:void(0)" class="theme-link rounded-circle d-block" data-navbarbg="skin5"></a>
                </li>
                <li class="theme-item list-inline-item me-1">
                  <a href="javascript:void(0)" class="theme-link rounded-circle d-block" data-navbarbg="skin6"></a>
                </li>
              </ul>
              <!-- Navbar BG -->
            </div>
            <div class="p-3 border-bottom">
              <!-- Sigebar BG -->
              <h5 class="font-weight-medium mb-2 mt-2">Sidebar Backgrounds</h5>
              <ul class="theme-color m-0 p-0">
                <li class="theme-item list-inline-item me-1">
                  <a href="javascript:void(0)" class="theme-link rounded-circle d-block" data-sidebarbg="skin1"></a>
                </li>
                <li class="theme-item list-inline-item me-1">
                  <a href="javascript:void(0)" class="theme-link rounded-circle d-block" data-sidebarbg="skin2"></a>
                </li>
                <li class="theme-item list-inline-item me-1">
                  <a href="javascript:void(0)" class="theme-link rounded-circle d-block" data-sidebarbg="skin3"></a>
                </li>
                <li class="theme-item list-inline-item me-1">
                  <a href="javascript:void(0)" class="theme-link rounded-circle d-block" data-sidebarbg="skin4"></a>
                </li>
                <li class="theme-item list-inline-item me-1">
                  <a href="javascript:void(0)" class="theme-link rounded-circle d-block" data-sidebarbg="skin5"></a>
                </li>
                <li class="theme-item list-inline-item me-1">
                  <a href="javascript:void(0)" class="theme-link rounded-circle d-block" data-sidebarbg="skin6"></a>
                </li>
              </ul>
              <!-- Sidebar BG -->
            </div>
          </div>
          <!-- End Tab 1 -->
        </div>
        <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;">
          <div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px;">
          <div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div>
        </div>
      </div>
    </aside>
    
    <div class="chat-windows"></div>
    <script>
      $(document).ready(function() {
        var theme;
        var sidebar;
        var fix_sidebar;
        var fix_head;
        var box;
        var logo_color;
        var nav_color;
        var sidebar_color;

        $('#theme-view').click(function() {
          console.log($(this).prop('checked'))
          if($(this).prop('checked')){theme = 1}else{theme = 0};
          // Función para enviar la solicitud AJAX
          $.ajax({
            url: 'configuracion', // URL a la que se enviará la solicitud AJAX
            type: 'GET', // Método de la solicitud (puede ser GET, POST, PUT, DELETE, etc.)
            data: {var: 'theme', val: theme},
            error: function(xhr, status, error) {
              // Se ejecuta si ocurre un error en la solicitud AJAX
              console.error('Ha ocurrido un error', );
            }
          });
        });
    
        $('#collapssidebar').click(function() {
          if($(this).prop('checked')){sidebar = 1}else{sidebar = 0};
          // Función para enviar la solicitud AJAX
          $.ajax({
            url: 'configuracion', // URL a la que se enviará la solicitud AJAX
            type: 'GET', // Método de la solicitud (puede ser GET, POST, PUT, DELETE, etc.)
            data: {var: 'sidebar', val: sidebar},
            error: function(xhr, status, error) {
              // Se ejecuta si ocurre un error en la solicitud AJAX
              console.error('Ha ocurrido un error');
            }
          });
        });
    
        $('#sidebar-position').click(function() {
          if($(this).prop('checked')){fix_sidebar = 1}else{fix_sidebar = 0};
          // Función para enviar la solicitud AJAX
          $.ajax({
            url: 'configuracion', // URL a la que se enviará la solicitud AJAX
            type: 'GET', // Método de la solicitud (puede ser GET, POST, PUT, DELETE, etc.)
            data: {var: 'fix_sidebar', val: fix_sidebar},
            error: function(xhr, status, error) {
              // Se ejecuta si ocurre un error en la solicitud AJAX
              console.error('Ha ocurrido un error');
            }
          });
        });
    
        $('#header-position').click(function() {
          if($(this).prop('checked')){fix_head = 1}else{fix_head = 0};
          // Función para enviar la solicitud AJAX
          $.ajax({
            url: 'configuracion', // URL a la que se enviará la solicitud AJAX
            type: 'GET', // Método de la solicitud (puede ser GET, POST, PUT, DELETE, etc.)
            data: {var: 'fix_head', val: fix_head},
            error: function(xhr, status, error) {
              // Se ejecuta si ocurre un error en la solicitud AJAX
              console.error('Ha ocurrido un error');
            }
          });
        });
    
        $('#boxed-layout').click(function() {
          if($(this).prop('checked')){box = 1}else{box = 0};
          // Función para enviar la solicitud AJAX
          $.ajax({
            url: 'configuracion', // URL a la que se enviará la solicitud AJAX
            type: 'GET', // Método de la solicitud (puede ser GET, POST, PUT, DELETE, etc.)
            data: {var: 'box', val: box},
            error: function(xhr, status, error) {
              // Se ejecuta si ocurre un error en la solicitud AJAX
              console.error('Ha ocurrido un error');
            }
          });
        });
    
        $('.theme-link').click(function(event) {
          logo_color = $(this).attr('data-logobg');
          nav_color = $(this).attr('data-navbarbg');
          sidebar_color = $(this).attr('data-sidebarbg');
          if (logo_color) {
            $.ajax({
              url: 'configuracion', // URL a la que se enviará la solicitud AJAX
              type: 'GET', // Método de la solicitud (puede ser GET, POST, PUT, DELETE, etc.)
              data: {var: 'logo_color', val: logo_color},
              error: function(xhr, status, error) {
                // Se ejecuta si ocurre un error en la solicitud AJAX
                console.error('Ha ocurrido un error');
              }
            });
          }
          if (nav_color) {
            $.ajax({
              url: 'configuracion', // URL a la que se enviará la solicitud AJAX
              type: 'GET', // Método de la solicitud (puede ser GET, POST, PUT, DELETE, etc.)
              data: {var: 'nav_color', val: nav_color},
              error: function(xhr, status, error) {
                // Se ejecuta si ocurre un error en la solicitud AJAX
                console.error('Ha ocurrido un error');
              }
            });
          }

          if (sidebar_color) {
            $.ajax({
              url: 'configuracion', // URL a la que se enviará la solicitud AJAX
              type: 'GET', // Método de la solicitud (puede ser GET, POST, PUT, DELETE, etc.)
              data: {var: 'sidebar_color', val: sidebar_color},
              error: function(xhr, status, error) {
                // Se ejecuta si ocurre un error en la solicitud AJAX
                console.error('Ha ocurrido un error');
              }
            });
          }
        });
      });
    </script>    