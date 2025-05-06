<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="HealthNav - Your Trusted Healthcare Navigation Partner">
  <meta name="author" content="HealthNav">

  <title>HealthNav | Your Healthcare Journey Partner</title>

  <!-- Favicon -->
  <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/icofont/icofont.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/slick-carousel/slick/slick.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/slick-carousel/slick/slick-theme.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/animate/animate.min.css') }}">

  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

</head>

<body id="top" class="antialiased">

<!-- Preloader -->
<div id="preloader">
  <div class="loader"></div>
</div>

<!-- Header Start -->
<header class="header-wrapper">
  <div class="header-top-bar bg-gradient">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6">
          <ul class="top-bar-info list-inline-item pl-0 mb-0">
            <li class="list-inline-item">
              <a href="mailto:healthnav@care.com" class="text-white">
                <i class="icofont-envelope mr-2"></i>healthnav@care.com
              </a>
            </li>
            <li class="list-inline-item">
              <i class="icofont-location-pin mr-2"></i>Yogyakarta, Indonesia
            </li>
          </ul>
        </div>
        <div class="col-lg-6">
          <div class="text-lg-right top-right-bar mt-2 mt-lg-0">
            <a href="tel:+62-877-3903-5397" class="text-white">
              <i class="icofont-phone-circle mr-2"></i>
              <span>Hotline: </span>
              <span class="font-weight-bold">+62 877-3903-5397</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <nav class="navbar navbar-expand-lg navigation nav-transparent" id="navbar">
    <div class="container">
      <a class="navbar-brand" href="{{ route('main') }}">
        <img src="{{ asset('assets/images/logo.png') }}" alt="HealthNav Logo" class="img-fluid main-logo">
      </a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarmain">
        <span class="icofont-navigation-menu"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarmain">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('main') }}">Home</a>
          </li>
          <li class="nav-item {{ Request::is('about') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('about') }}">About</a>
          </li>
          <li class="nav-item {{ Request::is('contact') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('contact') }}">Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link btn btn-main-2 btn-round-full" href="{{ route('user.login') }}">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>
<!-- Header End -->

<main>
  @yield('content')
</main>

<!-- Footer Start -->
<footer class="footer section bg-gray-100">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-6 mb-5">
        <div class="footer-widget">
          <h6 class="mb-4 text-capitalize">About HealthNav</h6>
          <p class="mb-3">We are your trusted partner in your healthcare journey, providing safe, comfortable, and high-quality international medical services.</p>
          <p class="text-muted mb-4">Your health is our top priority. With HealthNav, you can undergo medical care with complete confidence and peace of mind.</p>
          <p class="mb-2"><i class="icofont-location-pin mr-2"></i>Jl. Laksda Adisucipto No.32-34, Demangan, Yogyakarta</p>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 mb-5">
        <div class="footer-widget">
          <h6 class="mb-4">Quick Links</h6>
          <ul class="list-unstyled footer-menu">
            <li><a href="{{ route('main') }}">Home</a></li>
            <li><a href="{{ route('about') }}">About Us</a></li>
            <li><a href="{{ route('contact') }}">Contact</a></li>
            <li><a href="#">Terms & Conditions</a></li>
            <li><a href="#">Privacy Policy</a></li>
          </ul>
        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="footer-widget">
          <div class="mb-4">
            <img src="{{ asset('assets/images/logoo.png') }}" alt="HealthNav" class="img-fluid footer-logo">
          </div>
          <ul class="list-inline footer-socials">
            <li class="list-inline-item">
              <a href="#" data-toggle="tooltip" title="Follow us on Facebook"><i class="icofont-facebook"></i></a>
            </li>
            <li class="list-inline-item">
              <a href="#" data-toggle="tooltip" title="Follow us on Twitter"><i class="icofont-twitter"></i></a>
            </li>
            <li class="list-inline-item">
              <a href="#" data-toggle="tooltip" title="Follow us on LinkedIn"><i class="icofont-linkedin"></i></a>
            </li>
            <li class="list-inline-item">
              <a href="#" data-toggle="tooltip" title="Follow us on Instagram"><i class="icofont-instagram"></i></a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <div class="footer-bottom">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="copyright text-center">
            <p class="mb-0">&copy; {{ date('Y') }} HealthNav. All Rights Reserved.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
<!-- Footer End -->

<!-- Back to top button -->
<a href="#top" class="back-to-top" id="backToTop" data-toggle="tooltip" title="Back to Top">
  <i class="icofont-simple-up"></i>
</a>

<!-- Essential Scripts -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/plugins/slick-carousel/slick/slick.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery.easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('assets/plugins/waypoints/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('assets/plugins/counter-up/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('assets/plugins/wow/wow.min.js') }}"></script>

<!-- Google Map -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY"></script>
<script src="{{ asset('assets/js/map.js') }}"></script>

<!-- Custom Script -->
<script src="{{ asset('assets/js/script.js') }}"></script>
<script src="{{ asset('assets/js/contact.js') }}"></script>

<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>

</body>
</html>