<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="description" content="HealthNav - Your Trusted Healthcare Navigation Partner">
  <meta name="author" content="HealthNav">

  <title>HealthNav</title>
  <!-- Favicon -->
  <link rel="icon" type="image/png" href="{{ asset('assets/images/logo.png') }}">

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

  <!-- Required CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

  <style>
    /* Navbar Styles */
    .navbar {
      background-color: #ffffff;
      box-shadow: none;
      border-bottom: 1px solid #e5e7eb;
      padding: 0.5rem 0;
      height: 60px;
    }
    
    .navbar.scrolled {
      box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
    
    .navbar-brand {
      display: flex;
      align-items: center;
      font-weight: 600;
      color: #111827 !important;
      padding: 0;
    }
    
    .navbar-brand img {
      height: 35px;
      margin-right: 8px;
    }
    
    .navbar-brand span {
      font-size: 1.25rem;
      color: #111827;
      -webkit-text-fill-color: initial;
      background: none;
      font-family: 'Poppins', sans-serif;
    }
    
    .nav-link {
      color: #4b5563 !important;
      font-weight: 500;
      padding: 0.5rem 1rem;
      font-size: 0.95rem;
      transition: color 0.2s ease;
    }
    
    .nav-link:hover {
      color: #111827 !important;
    }
    
    .nav-link::after {
      display: none;
    }

    /* Search Bar */
    .navbar .search-box {
      position: relative;
      margin-right: 1rem;
    }

    .navbar .search-input {
      padding: 0.5rem 1rem 0.5rem 2.5rem;
      border: 1px solid #e5e7eb;
      border-radius: 6px;
      width: 250px;
      font-size: 0.9rem;
      color: #4b5563;
    }

    .navbar .search-icon {
      position: absolute;
      left: 0.75rem;
      top: 50%;
      transform: translateY(-50%);
      color: #9ca3af;
      font-size: 0.9rem;
    }

    /* User Profile */
    .navbar .user-profile {
      width: 35px;
      height: 35px;
      border-radius: 50%;
      overflow: hidden;
    }

    .navbar .user-profile img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    /* Remove header top bar */
    .header-top-bar {
      display: none;
    }

    /* Admin Sidebar */
    .admin-sidebar {
      min-height: 100vh;
      background: #26355D;
      color: white;
    }

    .admin-sidebar .nav-link {
      color: white !important;
      padding: 0.5rem 1rem;
      margin: 0.2rem 0;
    }

    .admin-sidebar .nav-link:hover {
      background: rgba(255,255,255,0.1);
    }
    
    /* Layout */
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
      overflow-x: hidden;
    }

    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    main {
      flex: 1 0 auto;
      min-height: calc(100vh - 60px - 400px); /* Adjust based on footer height */
      padding-bottom: 3rem; /* Add padding to prevent content from touching footer */
    }

    .admin-sidebar,
    .main-content {
      min-height: 100vh;
    }

    .container {
      max-width: 100%;
      padding-left: 1rem;
      padding-right: 1rem;
    }

    /* Main Content */
    .main-content {
      min-height: calc(100vh - 60px);
      padding-top: 60px;
    }
    
    /* Footer Styles */
    .footer {
      flex-shrink: 0;
      background-color: #26355D;
      color: white;
      padding: 2rem 0;
      width: 100%;
      position: relative;
      bottom: 0;
      left: 0;
      z-index: 10;
    }
    
    .footer-logo img {
      height: 50px;
      margin-bottom: 1rem;
    }
    
    .footer-links {
      list-style: none;
      padding: 0;
    }
    
    .footer-links li {
      margin-bottom: 0.5rem;
    }
    
    .footer-links a {
      color: white;
      text-decoration: none;
      transition: all 0.3s ease;
    }
    
    .footer-links a:hover {
      color: #4A90E2;
    }
    
    .social-links a {
      color: white;
      margin-right: 1rem;
      font-size: 1.5rem;
      transition: all 0.3s ease;
    }
    
    .social-links a:hover {
      color: #4A90E2;
      transform: translateY(-3px);
    }

    /* User Profile Dropdown */
    .navbar .user-profile-dropdown {
      display: flex;
      align-items: center;
      padding: 8px 12px;
      border: 1px solid #e5e7eb;
      border-radius: 6px;
      cursor: pointer;
      transition: all 0.2s ease;
      background: white;
      min-width: 160px;
    }

    .navbar .user-profile-dropdown:hover {
      border-color: #d1d5db;
      background: #f9fafb;
    }

    .navbar .user-profile-wrapper {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .navbar .user-profile {
      width: 32px;
      height: 32px;
      border-radius: 50%;
      overflow: hidden;
      flex-shrink: 0;
    }

    .navbar .user-profile img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .navbar .user-name {
      font-size: 0.9rem;
      color: #111827;
      font-weight: 500;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      max-width: 150px;
    }

    .navbar .dropdown-toggle {
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 0;
      border: none;
      background: none;
    }

    .navbar .dropdown-toggle::after {
      margin-left: auto;
      color: #6b7280;
      border-top: 0.3em solid;
    }

    .navbar .dropdown-menu {
      margin-top: 0.5rem;
      border: 1px solid #e5e7eb;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
      border-radius: 6px;
      min-width: 200px;
      padding: 0.5rem;
      transform: translateY(10px);
      right: 0;
      left: auto;
    }

    .navbar .dropdown-item {
      padding: 0.625rem 1rem;
      color: #4b5563;
      font-size: 0.9rem;
      display: flex;
      align-items: center;
      border-radius: 4px;
    }

    .navbar .dropdown-item i {
      margin-right: 0.75rem;
      width: 16px;
      color: #6b7280;
    }

    .navbar .dropdown-item:hover {
      background: #f3f4f6;
      color: #111827;
    }

    .navbar .dropdown-item:active {
      background: #f3f4f6;
      color: #111827;
    }

    .navbar .dropdown-divider {
      margin: 0.5rem 0;
      border-color: #e5e7eb;
    }

    /* Preloader */
    #preloader {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: #ffffff;
      z-index: 9999;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: opacity 0.5s ease;
    }

    #preloader.fade-out {
      opacity: 0;
    }

    .loader {
      position: relative;
      width: 60px;
      height: 60px;
    }

    .loader:before,
    .loader:after {
      content: '';
      position: absolute;
      border-radius: 50%;
      animation: pulse 1.8s ease-in-out infinite;
    }

    .loader:before {
      width: 100%;
      height: 100%;
      background: rgba(38, 53, 93, 0.5);
      animation-delay: -0.9s;
    }

    .loader:after {
      width: 100%;
      height: 100%;
      background: rgba(74, 144, 226, 0.5);
      animation-delay: 0s;
    }

    @keyframes pulse {
      0% {
        transform: scale(0);
        opacity: 1;
      }
      100% {
        transform: scale(1);
        opacity: 0;
      }
    }
  </style>

  @stack('styles')
</head>

<body id="top" class="antialiased">

<!-- Preloader -->
<div id="preloader">
  <div class="loader"></div>
</div>

<!-- Header Start -->
<header class="header-wrapper">
  <nav class="navbar navbar-expand-lg navbar-light fixed-top">
    <div class="container">
      <a class="navbar-brand" href="{{ route('main') }}">
        <img src="{{ asset('assets/images/logo.png') }}" alt="HealthNav Logo">
        <span>HealthNav</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('main') }}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('hospitals.index') }}">Hospital</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('about') }}">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('contact') }}">Contact</a>
          </li>
        </ul>
        <div class="ms-auto d-flex align-items-center">
          <div class="search-box">
            <i class="fas fa-search search-icon"></i>
            <input type="text" class="search-input" placeholder="Search...">
          </div>
          @auth
            <div class="dropdown">
              <button class="user-profile-dropdown dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="user-profile-wrapper">
                  <div class="user-profile">
                    <img src="{{ asset('assets/images/default-avatar.jpg') }}" alt="User Profile">
                  </div>
                  <span class="user-name">{{ Auth::user()->name }}</span>
                </div>
              </button>
              <ul class="dropdown-menu dropdown-menu-end">
                <li>
                  <a class="dropdown-item" href="{{ route('user.profile.show') }}">
                    <i class="fas fa-user"></i> My Profile
                  </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                  <form action="{{ route('user.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item">
                      <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                  </form>
                </li>
              </ul>
            </div>
          @else
            <a class="nav-link" href="{{ route('user.login') }}">Login</a>
          @endauth
        </div>
      </div>
    </div>
  </nav>
</header>
<!-- Header End -->

<main>
  @if(auth()->check() && auth()->user()->is_admin && request()->is('admin*'))
    <div class="container-fluid">
      <div class="row">
        <!-- Admin Sidebar -->
        <div class="col-md-3 col-lg-2 admin-sidebar">
          <div class="position-sticky pt-3">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                  <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.hospitals.index') }}">
                  <i class="fas fa-hospital"></i> Hospitals
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.users.index') }}">
                  <i class="fas fa-users"></i> Users
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.registrations.index') }}">
                  <i class="fas fa-clipboard-list"></i> Registrations
                </a>
              </li>
            </ul>
          </div>
        </div>
        <!-- Admin Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
          @yield('content')
        </main>
      </div>
    </div>
  @else
    <div class="container">
      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
          {{ session('error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      @yield('content')
    </div>
  @endif
</main>

<!-- Footer Start -->
<footer class="footer">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <div class="footer-logo">
          <img src="{{ asset('assets/images/logo.png') }}" alt="HealthNav Logo" style="filter: brightness(0) invert(1);">
          <p>Your trusted partner in medical tourism. We provide comprehensive medical check-up packages combined with exciting tourism experiences.</p>
        </div>
      </div>
      <div class="col-md-4">
        <h5>Quick Links</h5>
        <ul class="footer-links">
          <li><a href="{{ route('about') }}">About Us</a></li>
          <li><a href="{{ route('hospitals.index') }}">Our Hospitals</a></li>
          <li><a href="{{ route('services') }}">Services</a></li>
          <li><a href="{{ route('contact') }}">Contact Us</a></li>
          <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
        </ul>
      </div>
      <div class="col-md-4">
        <h5>Connect With Us</h5>
        <div class="social-links">
          <a href="#"><i class="fab fa-facebook"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-linkedin"></i></a>
        </div>
        <div class="mt-3">
          <p><i class="fas fa-phone"></i> +62 274 123456</p>
          <p><i class="fas fa-envelope"></i> info@healthnav.com</p>
          <p><i class="fas fa-map-marker-alt"></i> Yogyakarta, Indonesia</p>
        </div>
      </div>
    </div>
    <hr class="mt-4" style="border-color: rgba(255,255,255,0.1);">
    <div class="text-center mt-4">
      <p>&copy; {{ date('Y') }} HealthNav. All rights reserved.</p>
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

<script>
  // Navbar scroll effect
  window.addEventListener('scroll', function() {
    if (window.scrollY > 50) {
      document.querySelector('.navbar').classList.add('scrolled');
    } else {
      document.querySelector('.navbar').classList.remove('scrolled');
    }
  });
</script>

<script>
// Preloader
window.addEventListener('load', function() {
  const preloader = document.getElementById('preloader');
  preloader.classList.add('fade-out');
  setTimeout(() => {
    preloader.style.display = 'none';
  }, 500);
});

// Prevent form resubmission on refresh
if (window.history.replaceState) {
  window.history.replaceState(null, null, window.location.href);
}
</script>

@stack('scripts')
</body>
</html>