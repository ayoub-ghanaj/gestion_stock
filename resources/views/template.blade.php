<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png')}}">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/default-garage.png')}}">
  <title>
    garages
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('assets/css/nucleo-icons.css')}}" rel="stylesheet" />
  <link href="{{ asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{ asset('assets/css/nucleo-svg.css" rel="stylesheet')}}" />
  <!-- CSS Files -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
  <link id="pagestyle" href="{{ asset('assets/css/soft-ui-dashboard.css?v=1.0.6')}}" rel="stylesheet" />
  <!-- sweet alert-->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <!--jQuery-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <!--js-->
  <script src="/assets/js/garages.js"></script>
</head>
<body class="g-sidenav-show  bg-gray-100">
    <div class="wrapper d-flex align-items-stretch " style="height: 100%;position: fixed;">
        <nav id="sidebar" class="active">
                <h1 class="txtalic"><a  id="sidebarCollapse" class="mrgauto pointer fa fa-bars sandwich" style=""></a></h1>
        <ul class="list-unstyled components mb-5">
        <li class="active">
            <a href="/garages"><span class="fa fa-home"></span> Home</a>
        </li>
        <li>
            <a href="/profile"><span class="fa fa-user"></span> Profile</a>
        </li>
        <li>
            <a class="dropdown-toggle"  id="navbarDropdown" role="button" data-bs-toggle="dropdown" >
                <span class="fa fa-folder "></span>Garages
            </a>
            <ul class="dropdown-menu dropdown-menuy lily dropper-list " aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item dropdown-itemy " href="#">Account</a></li>
            </ul>
        </li>
        </ul>

        <div class="footer">
        </div>
        </nav>

    <!-- Page Content  -->
  <div id="content" class="">

    <nav class="navbar navbar-light bg-light   " style="max-width: calc(100% - 53px); min-height: 80px; max-height: 80px ;margin: 0; ">
      <div class="container-fluid">

        <button type="button" id="sidebarCollapse2" class="btn btn-primary navrg" style="display: none;     position: absolute;">
          <i class="fa fa-bars"></i>
          <span class="sr-only">Toggle Menu</span>
        </button>
        <div class=" avatar-group mt-2 aliright" id="navbarSupportedContent">
            <div class="dropdown">
            <a  class="avatar avatar-m rounded-circle dropdown-toggle" data-bs-placement="bottom" title="{{Auth::user()->name}}"  role="button" data-bs-toggle="dropdown" id="navbarDropdown22" >
                <img src="{{Auth::user()->image? asset( Auth::user()->image) : asset('/assets/img/default-garage.png')}}" alt="{{Auth::user()->name}}">
            </a>
            <ul class="dropdown-menu droper lif8f9fa" aria-labelledby="navbarDropdown22" style="background-color: #00000000; box-shadow: 0px 0px;">
                <li><a class="dropdown-item texcol" href="/profile">Account</a></li>
                <li>
                    <form action="/logout" method="post">
                        @csrf
                        <input type="submit" class="dropdown-item btn btn-danger texcol " value="Logout">
                    </form>
                </li>
            </ul>
            </div>
        </div>
      </div>
    </nav>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg  " style="max-width: calc(100% - 53px) ;">

        <!--content-->
       @yield('content')
       <!-- content-->

     </main>
   </div>
    </div>

  <!--   Core JS Files   -->
  <script src="{{ asset('assets/js/core/popper.min.js')}}"></script>
  <script src="{{ asset('assets/js/core/bootstrap.min.js')}}"></script>
  <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
  <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
  <script src="{{ asset('assets/js/plugins/chartjs.min.js')}}"></script>
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('assets/js/soft-ui-dashboard.min.js?v=1.0.6')}}"></script>

  <script>
    $(document).ready(function () {
        $('#sidebarCollapse2').on('click', function () {
            $(".navrg").hide();
        $('#sidebar').toggleClass('active');
        $(".fa-bars").text("CGO");
        $(".fa-bars").css("font-size" , '70px');
        $('#sidebarCollapse').toggleClass('fa-bars');
        $(".fa-bars").text("");
        $(".fa-bars").css("font-size" , '30px');
        if ( !$("#sidebar").hasClass("active")){
            $('#sidebar').css({ "position" : "fixed", "z-index": "3" , "height" : "100%" });
            $('.main-content').css('max-width', 'calc(100% - 0px)');
        }else{
            $('.main-content').css('max-width', `calc(100% - ${widthy}px)`);
            $('#sidebar').hide();
        $('#sidebar').css({ "position" : "relative", "z-index": "3" , "height" : "100%" });
        setTimeout(function() {
            $('#sidebar').show();
        },10);
        }
        });
    });
    (function($) {

"use strict";

var fullHeight = function() {

    $('.js-fullheight').css('height', $(window).height());
    $(window).resize(function(){
        if ( !$("#sidebar").hasClass("active") && $(window).width() < 992 ){
            $(".navrg").show();
            $("#sidebarCollapse").text("");
        }else{
            if ( !$("#sidebar").hasClass("active") ){
                $("#sidebarCollapse").text("CGO");
            }
            $(".navrg").hide();
        }
        $('.js-fullheight').css('height', $(window).height());
    });

};
fullHeight();

$('#sidebarCollapse').on('click', function () {
    $('#sidebar').toggleClass('active');
    $(".fa-bars").text("CGO");
    $(".fa-bars").css("font-size" , '70px');
    $('#sidebarCollapse').toggleClass('fa-bars');
    if ( !$("#sidebar").hasClass("active") && $(window).width() < 992 ){
        $(".navrg").show();
        $("#sidebarCollapse").text("");
    }
    $(".fa-bars").css("font-size" , '30px');
    $(".fa-bars").text("");
    if ( !$("#sidebar").hasClass("active")){
        $('#sidebar').css({ "position" : "fixed", "z-index": "3" , "height" : "100%" });
        $('.main-content').css('max-width', 'calc(100% - 0px)');
    }else{
        $('.main-content').css('max-width', `calc(100% - ${widthy}px)`);
        $('#sidebar').hide();
        $('#sidebar').css({ "position" : "relative", "z-index": "3" , "height" : "100%" });
        setTimeout(function() {
            $('#sidebar').show();
        },10);
    }
});

})(jQuery);

  </script>
</body>

</html>
