<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
    <title>Indicadores</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset("assets/images/topicon.png")}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset("assets/extra-libs/DataTables/css/dataTables.bootstrap4.css")}}"/>
    <link rel="stylesheet" href="{{asset("assets/libs/fullcalendar/dist/fullcalendar.min.css")}}"  />
    <link rel="stylesheet" href="{{asset("assets/extra-libs/calendar/calendar.css")}}" />
    <link rel="stylesheet" href="{{asset("assets/libs/bootstrap/dist/css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/libs/select2/dist/css/select2.min.css")}}">
    <link href="{{asset("assets/libs/jquery-steps/jquery.steps.css")}}"/>
    <link rel="stylesheet" href="{{asset("assets/libs/jquery-steps/steps.css")}}"/>
    <link rel="stylesheet" href="{{asset("assets/css/style.min.css")}}">
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
	<!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
	<!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        @include('layouts.header')
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        @include('layouts.sidebar')
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                @yield('content')
            </div>
            <!-- ============================================================== -->
            <!-- End Container -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper -->
        <!-- ============================================================== -->
        @include('layouts.rightbar')
        @include('layouts.footer')
	</div>
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{asset("assets/libs/jquery/dist/jquery.min.js")}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset("assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js")}}"></script>
    <!-- apps -->
    <script src="{{asset("assets/js/app.min.js")}}"></script>
    <script src="{{asset("assets/js/app.init.js")}}"></script>
    <script src="{{asset("assets/js/app-style-switcher.js")}}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{asset("assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js")}}"></script>
    <script src="{{asset("assets/extra-libs/sparkline/sparkline.js")}}"></script>
    <!--Wave Effects -->
    <script src="{{asset("assets/js/waves.js")}}"></script>
    <!--Menu sidebar -->
    <script src="{{asset("assets/js/sidebarmenu.js")}}"></script>
    <!--Custom JavaScript -->
    <script src="{{asset("assets/js/feather.min.js")}}"></script>
    <script src="{{asset("assets/js/custom.min.js")}}"></script>
    <script src="{{asset("assets/libs/jquery-steps/build/jquery.steps.min.js")}}"></script>
    <script src="{{asset("assets/libs/jquery-validation/dist/jquery.validate.min.js")}}"></script>
    <!-- Custom JavaScript -
    <script src="{{asset("assets/libs/apexcharts/dist/apexcharts.min.js")}}"></script>
    <!--This page JavaScript -->
    <!-- <script src="{{asset("assets/js/pages/dashboards/dashboard1.js")}}"></script> -
    <script src="{{asset("assets/js/pages/dashboards/dashboard2.js")}}"></script>-->
    <!-- Charts js Files -->
    
    <script src="{{asset("assets/js/jquery.ui.touch-punch-improved.js")}}"></script>
    <script src="{{asset("assets/js/jquery-ui.min.js")}}"></script>
    <script src="{{asset("assets/libs/moment/min/moment.min.js")}}"></script>
    <script src="{{asset("assets/libs/fullcalendar/dist/fullcalendar.min.js")}}"></script>
    <script src="{{asset("assets/libs/fullcalendar/dist/locale/es.js")}}"></script>
    <script src="{{asset("assets/js/pages/calendar/cal-init.js")}}"></script>
    <script src="{{asset("assets/libs/select2/dist/js/select2.full.min.js")}}"></script>
    <script src="{{asset("assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js")}}"></script>
    <script>
        //***********************************//
        // For select 2
        //***********************************//
        $(".select2").select2();

        /*colorpicker*/
        $('.demo').each(function () {
            //
            // Dear reader, it's actually very easy to initialize MiniColors. For example:
            //
            //  $(selector).minicolors();
            //
            // The way I've done it below is just for the demo, so don't get confused
            // by it. Also, data- attributes aren't supported at this time...they're
            // only used for this demo.
            //
            $(this).minicolors({
                control: $(this).attr('data-control') || 'hue',
                position: $(this).attr('data-position') || 'bottom left',

                change: function (value, opacity) {
                    if (!value) return;
                    if (opacity) value += ', ' + opacity;
                    if (typeof console === 'object') {
                        console.log(value);
                    }
                },
                theme: 'bootstrap'
            });

        });
        /*datwpicker*/
        jQuery('.mydatepicker').datepicker({
            autoclose: true,
            todayHighlight: true});
        /*jQuery('#datepicker-autoclose').datepicker({
            autoclose: true,
            todayHighlight: true
        });
        var quill = new Quill('#editor', {
            theme: 'snow'
        });*/

    </script>
    <script src="{{asset("assets/extra-libs/DataTables/js/jquery.dataTables.min.js")}}"></script>
    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
    <script src="{{asset("assets/js/pages/datatable/datatable-advanced.init.js")}}"></script>
    <script>  
        var form = $("#example-advanced-form").show();
        //Custom design form example
        $(".tab-wizard").steps({
          headerTag: "h6",
          bodyTag: "section",
          transitionEffect: "fade",
          titleTemplate: '<span class="step">#index#</span> #title#'
        });
    </script>

</body>

</html>
