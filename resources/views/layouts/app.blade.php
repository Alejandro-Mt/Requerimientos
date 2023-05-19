<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SMART PLANNER') }}</title>

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset("assets/images/logo-icon-it.png")}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset("assets/css/style.min.css")}}">
</head>
<body>
    <div id="app">
      <main>
          @yield('content')
      </main>
    </div>
</body>
<!-- -------------------------------------------------------------- -->
<!-- All Required js -->
<!-- -------------------------------------------------------------- -->
<script src="{{asset("assets/libs/jquery/dist/jquery.min.js")}}"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{asset("assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js")}}"></script>
<!-- -------------------------------------------------------------- -->
<!-- This page plugin js -->
<!-- -------------------------------------------------------------- -->
<!--Custom JavaScript -->
<script src="{{asset("assets/js/feather.min.js")}}"></script>
<script src="{{asset("assets/js/custom.min.js")}}"></script>
<script>
  // ==============================================================
  // Login and Recover Password
  // ==============================================================
  $('#to-recover').on('click', function () {
    $('#loginform').slideUp();
    $('#recoverform').fadeIn();
  });
</script>

</html>