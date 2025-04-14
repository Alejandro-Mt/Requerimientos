$(function () {
  "use strict";
  var lb = $('#nav-header').attr('data-logobg');
  var nb = $('#navbarSupportedContent').attr('data-navbarbg');;
  var sc = $('#left-sidebar').attr('data-sidebarbg');
  $("#main-wrapper").AdminSettings({
    Theme: false, // this can be true or false ( true means dark and false means light ),
    Layout: "vertical",
    // IS HERE //
    LogoBg: lb, // You can change the Value to be skin1/skin2/skin3/skin4/skin5/skin6
    NavbarBg: nb, // You can change the Value to be skin1/skin2/skin3/skin4/skin5/skin6
    SidebarType: "full", // You can change it full / mini-sidebar / iconbar / overlay
    SidebarColor:  sc, // You can change the Value to be skin1/skin2/skin3/skin4/skin5/skin6
    SidebarPosition: true, // it can be true / false ( true means Fixed and false means absolute )
    HeaderPosition: true, // it can be true / false ( true means Fixed and false means absolute )
    BoxedLayout: false, // it can be true / false ( true means Boxed and false means Fluid )
  });
});