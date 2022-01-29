<!DOCTYPE html>
<html>
<head>
	<title><?= $_ENV["SITE_NAME"] ?></title>
	<meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!--  Fonts and icons  -->
    <!--     Fonts and icons     -->
	<link rel="icon" href="/themes/<?= $_ENV["THEME"] ?>/assets/img/brand/favicon.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="/themes/<?= $_ENV["THEME"] ?>/assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="/themes/<?= $_ENV["THEME"] ?>/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Page plugins -->
  <!-- Argon CSS -->
  <link rel="stylesheet" href="/themes/<?= $_ENV["THEME"] ?>/assets/css/argon.css?v=1.2.0" type="text/css">
  <link rel="stylesheet" href="/themes/<?= $_ENV["THEME"] ?>/assets/css/custom.css" type="text/css">
  <script src="/themes/<?= $_ENV["THEME"] ?>/assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="/themes/<?= $_ENV["THEME"] ?>/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="/themes/<?= $_ENV["THEME"] ?>/assets/vendor/js-cookie/js.cookie.js"></script>
<script src="/themes/<?= $_ENV["THEME"] ?>/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
<script src="/themes/<?= $_ENV["THEME"] ?>/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
<!-- Optional JS -->
<script src="/themes/<?= $_ENV["THEME"] ?>/assets/vendor/chart.js/dist/Chart.min.js"></script>
<script src="/themes/<?= $_ENV["THEME"] ?>/assets/vendor/chart.js/dist/Chart.extension.js"></script>
<!-- Argon JS -->
<script src="/themes/<?= $_ENV["THEME"] ?>/assets/js/argon.js?v=1.2.0"></script>
<script src="/libs/datetimepicker/build/jquery.datetimepicker.full.js"></script>

    
</head>
<body>
	<div class="main-content" id="panel">
	<?php if(!empty($_SESSION)){ ?>
		<nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
      		<div class="container-fluid">
        		<div class="collapse navbar-collapse" id="navbarSupportedContent">
          			
          			<!-- Navbar links -->
          			<ul class="navbar-nav align-items-center  ml-md-auto ">
            			<li class="nav-item d-xl-none">
              			<!-- Sidenav toggler -->
              				<div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                				<div class="sidenav-toggler-inner">
                  					<i class="sidenav-toggler-line"></i>
									<i class="sidenav-toggler-line"></i>
									<i class="sidenav-toggler-line"></i>
                				</div>
              				</div>
            			</li>
            			<li class="nav-item d-sm-none">
              				<a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                				<i class="ni ni-zoom-split-in"></i>
              				</a>
            			</li>
          			</ul>
          			<ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
            			<li class="nav-item dropdown">
              				<a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                				<div class="media align-items-center">
                  					<span class="avatar avatar-sm rounded-circle">
										  <img src="/themes/<?= $_ENV["THEME"] ?>/assets/img/theme/usericon.png" />                    
                  					</span>
                  					<div class="media-body  ml-2  d-none d-lg-block">
                    					<span class="mb-0 text-sm  font-weight-bold"><?= $_SESSION["name"] ?></span>
                  					</div>
                				</div>
              				</a>
              				<div class="dropdown-menu  dropdown-menu-right ">
                				<div class="dropdown-header noti-title">
				                  <h6 class="text-overflow m-0">Bienvenido!</h6>
                				</div>
                				<a href="/user/edit/<?= $_SESSION["id"]?>" class="dropdown-item">
                  					<i class="ni ni-single-02"></i>
                  					<span>Mi Usuario</span>
                				</a>
                				<div class="dropdown-divider"></div>
                					<a href="/home/logout" class="dropdown-item">
                  					<i class="ni ni-user-run"></i>
                  					<span>Cerrar Sesión</span>
                				</a>
              				</div>
            			</li>
          			</ul>
				</div>
      		</div>
		</nav>
		<?php } ?>
				