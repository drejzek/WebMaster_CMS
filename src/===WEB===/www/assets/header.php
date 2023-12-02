<!DOCTYPE html>
<html lang="en">
<base href="http://localhost/exploreblog/">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>PhotoFolio Bootstrap Template - Index</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="www/assets/img/favicon.png" rel="icon">
  <link href="www/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Cardo:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="www/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="www/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="www/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="www/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="www/assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="www/assets/css/main.css" rel="stylesheet">

  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
  <!-- Make sure you put this AFTER Leaflet's CSS -->
 <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>



  <!-- =======================================================
  * Template Name: PhotoFolio
  * Updated: Jul 27 2023 with Bootstrap v5.3.1
  * Template URL: https://bootstrapmade.com/photofolio-bootstrap-photography-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div id="map" style="display:none;height:100px;"></div>
    <script>
      const map = L.map('map').fitWorld();

      const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

      function onLocationFound(e) {
        const radius = e.accuracy / 2;

        const locationMarker = L.marker(e.latlng).addTo(map)
          .bindPopup(`You are within ${radius} meters from this point`).openPopup();

        const locationCircle = L.circle(e.latlng, radius).addTo(map);

        //location.href = 'auth.php?c=' + e.latlng.toString().replace('LatLng(', '').replace(')', '');
      }

      function onLocationError(e) {
        alert(e.message);
      }
      map.on('locationfound', onLocationFound);
	    map.on('locationerror', onLocationError);

	    map.locate({setView: true, maxZoom: 16}); 
    </script>
    <div class="container-fluid d-flex align-items-center justify-content-between">

      <a href="." class="logo d-flex align-items-center  me-auto me-lg-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="www/assets/img/logo.png" alt=""> -->
        <i class="bi bi-camera"></i>
        <h1>ExploreBlog</h1>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="." class="active">Home</a></li>
          <li><a href="about.php">O mně</a></li>
          <li><a href="contact.php">Kontakt</a></li>
          <li><a href="eshop/">Obchod lokací</a></li>
          <li class="dropdown"><a href="#"><span>Účet</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <li><a href="auth/?m=user">Přihlášení</a></li>
              <li><a href="auth/reg">Registrace</a></li>
            </ul>
          </li>
        </ul>
      </nav><!-- .navbar -->

      <div class="header-social-links">
        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
      </div>
      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
  </header><!-- End Header -->

  <?php
  $s = "none";
  if(isset($_SESSION['p'])){
    if($_SESSION['p'] == true){
      $s = "block";
    }
  }
  
  ?>
  <div class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle" style="display:<?php echo $s?>">
      <button class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center"
              id="bd-theme"
              type="button"
              aria-expanded="false"
              data-bs-toggle="dropdown"
              aria-label="Toggle theme (auto)">
        <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
      </button>
      <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
        <li>
          <a href="../?end-view">Zpět do systému</a>
        </li>
      </ul>
    </div>