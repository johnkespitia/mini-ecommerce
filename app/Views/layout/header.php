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
	<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
		<div class="scrollbar-inner">
			<div class="sidenav-header  align-items-center">
				<a class="navbar-brand" href="javascript:void(0)">
					<img src="/themes/<?= $_ENV["THEME"] ?>/assets/img/brand/brand.png" class="navbar-brand-img" alt="">
				</a>
			</div>
			<div class="navbar-inner">
				<div class="collapse navbar-collapse" id="sidenav-collapse-main">
					<?php if (empty($_SESSION)) { ?>
						<ul class="navbar-nav">
							<li class="nav-item">
								<a class="nav-link" href="/"><i class="fas fa-home  text-primary"></i> Inicio</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="/home/login"><i class="fas fa-sign-in-alt  text-primary"></i> Iniciar Sesión</a>
							</li>
						</ul>
					<?php } else { ?>
						<div class="accordion" id="menuAccordion">
							<div class="card">
								<div class="card-header" id="headingOne">
									<h5 class="mb-0">
										<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#configurations" aria-expanded="true" aria-controls="configurations">
											Configuración
										</button>
									</h5>
								</div>

								<div id="configurations" class="collapse" aria-labelledby="headingOne" data-parent="#menuAccordion">
									<div class="card-body">
										<ul class="navbar-nav">
											<?php if (isset($_SESSION["permissions"]["Roles"]["Listar"]) && $_SESSION["permissions"]["Roles"]["Listar"] == 1) {
											?>
												<li class="nav-item">
													<a class="nav-link" href="/rol/">
														<i class="fas fa-user-tag text-primary"></i> Roles
													</a>
												</li>
											<?php } ?>
											<?php if (isset($_SESSION["permissions"]["Usuarios"]["Listar"]) && $_SESSION["permissions"]["Usuarios"]["Listar"] == 1) {
											?>
												<li class="nav-item">
													<a class="nav-link" href="/user/index">
														<i class="fas fa-users  text-primary"></i> Usuarios
													</a>
												</li>
											<?php } ?>
											<?php if (isset($_SESSION["permissions"]["Ciudades"]["Listar"]) && $_SESSION["permissions"]["Ciudades"]["Listar"] == 1) {
											?>
												<li class="nav-item">
													<a class="nav-link" href="/city/">
														<i class="fas fa-city text-primary"></i> Ciudades
													</a>
												</li>
											<?php } ?>
											<?php if (isset($_SESSION["permissions"]["Tipo de Vehículos"]["Listar"]) && $_SESSION["permissions"]["Tipo de Vehículos"]["Listar"] == 1) {
											?>
												<li class="nav-item">
													<a class="nav-link" href="/cartype/">
														<i class="fa fa-bus text-primary"></i> Tipo de Vehículos
													</a>
												</li>
											<?php } ?>
											<?php if (isset($_SESSION["permissions"]["Combustible"]["Listar"]) && $_SESSION["permissions"]["Combustible"]["Listar"] == 1) {
											?>
												<li class="nav-item">
													<a class="nav-link" href="/fueltype/">
														<i class="fas fa-gas-pump text-primary"></i>Tipos de Combustible
													</a>
												</li>
											<?php } ?>
											<?php if (isset($_SESSION["permissions"]["Línea"]["Listar"]) && $_SESSION["permissions"]["Línea"]["Listar"] == 1) {
											?>
												<li class="nav-item">
													<a class="nav-link" href="/line/">
														<i class="fas fa-truck-monster text-primary"></i> Lineas de Vehículos
													</a>
												</li>
											<?php } ?>
											<?php if (isset($_SESSION["permissions"]["Marca"]["Listar"]) && $_SESSION["permissions"]["Marca"]["Listar"] == 1) {
											?>
												<li class="nav-item">
													<a class="nav-link" href="/brand/">
														<i class="fas fa-copyright text-primary"></i> Marcas de Vehículos
													</a>
												</li>
											<?php } ?>
											<?php if (isset($_SESSION["permissions"]["Tipo de Servicio"]["Listar"]) && $_SESSION["permissions"]["Tipo de Servicio"]["Listar"] == 1) {
											?>
												<li class="nav-item">
													<a class="nav-link" href="/servicetype/">
														<i class="fas fa-flag-checkered text-primary"></i> Tipo de Servicio
													</a>
												</li>
											<?php } ?>
											<?php if (isset($_SESSION["permissions"]["Tipo de Documento"]["Listar"]) && $_SESSION["permissions"]["Tipo de Documento"]["Listar"] == 1) {
											?>
												<li class="nav-item">
													<a class="nav-link" href="/documenttype/">
														<i class="ni ni-book-bookmark text-primary"></i> Tipo de Documento
													</a>
												</li>
											<?php } ?>
											<?php if (isset($_SESSION["permissions"]["Emails Notificacione"]["Listar"]) && $_SESSION["permissions"]["Emails Notificacione"]["Listar"] == 1) {
											?>
												<li class="nav-item">
													<a class="nav-link" href="/notificationemail/">
														<i class="fas fa-envelope-square text-primary"></i> Emails de notificaciones
													</a>
												</li>
											<?php } ?>
											<?php if (isset($_SESSION["permissions"]["Tipo Notificación"]["Listar"]) && $_SESSION["permissions"]["Tipo Notificación"]["Listar"] == 1) {
											?>
												<li class="nav-item">
													<a class="nav-link" href="/carnotificationtype/">
														<i class="far fa-sticky-note text-primary"></i> Tipos de notificaciones
													</a>
												</li>
											<?php } ?>
											<?php if (isset($_SESSION["permissions"]["Eps"]["Listar"]) && $_SESSION["permissions"]["Eps"]["Listar"] == 1) {
											?>
												<li class="nav-item">
													<a class="nav-link" href="/eps/">
													<i class="fas fa-heartbeat text-primary"></i> Eps
													</a>
												</li>
											<?php } ?>
											<?php if (isset($_SESSION["permissions"]["Banco"]["Listar"]) && $_SESSION["permissions"]["Banco"]["Listar"] == 1) {
											?>
												<li class="nav-item">
													<a class="nav-link" href="/bank/">
													<i class="fas fa-piggy-bank text-primary"></i> Bancos
													</a>
												</li>
											<?php } ?>
											<?php if (isset($_SESSION["permissions"]["Area"]["Listar"]) && $_SESSION["permissions"]["Area"]["Listar"] == 1) {
											?>
												<li class="nav-item">
													<a class="nav-link" href="/area/">
													<i class="fas fa-crosshairs text-primary"></i> Area
													</a>
												</li>
											<?php } ?>
											<?php if (isset($_SESSION["permissions"]["Cesantias"]["Listar"]) && $_SESSION["permissions"]["Cesantias"]["Listar"] == 1) {
											?>
												<li class="nav-item">
													<a class="nav-link" href="/cesantia/">
													<i class="fas fa-wallet text-primary"></i> Cesantias
													</a>
												</li>
											<?php } ?>
											<?php if (isset($_SESSION["permissions"]["Pension"]["Listar"]) && $_SESSION["permissions"]["Pension"]["Listar"] == 1) {
											?>
												<li class="nav-item">
													<a class="nav-link" href="/pension/">
													<i class="fas fa-coins text-primary"></i> Pensiones
													</a>
												</li>
											<?php } ?>
											<?php if (isset($_SESSION["permissions"]["Caja de Compensacion"]["Listar"]) && $_SESSION["permissions"]["Caja de Compensacion"]["Listar"] == 1) {
											?>
												<li class="nav-item">
													<a class="nav-link" href="/cajacompensacion/">
													<i class="fas fa-cash-register text-primary"></i> Caja de Compensación
													</a>
												</li>
											<?php } ?>
											<?php if (isset($_SESSION["permissions"]["Arl"]["Listar"]) && $_SESSION["permissions"]["Arl"]["Listar"] == 1) {
											?>
												<li class="nav-item">
													<a class="nav-link" href="/arl/">
													<i class="fas fa-medkit text-primary"></i> ARL
													</a>
												</li>
											<?php } ?>
										</ul>
									</div>
								</div>
							</div>
							<div class="card">
								<div class="card-header" id="headingTwo">
									<h5 class="mb-0">
										<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#parametrization" aria-expanded="false" aria-controls="parametrization">
											Parametrización
										</button>
									</h5>
								</div>
								<div id="parametrization" class="collapse" aria-labelledby="headingTwo" data-parent="#menuAccordion">
									<div class="card-body">
										<ul class="navbar-nav">
											<?php if (isset($_SESSION["permissions"]["Clientes"]["Listar"]) && $_SESSION["permissions"]["Clientes"]["Listar"] == 1) {
											?>
												<li class="nav-item">
													<a class="nav-link" href="/customer/">
														<i class="fas fa-user-tie  text-primary"></i> Clientes
													</a>
												</li>
											<?php } ?>
											<?php if (isset($_SESSION["permissions"]["Propietarios"]["Listar"]) && $_SESSION["permissions"]["Propietarios"]["Listar"] == 1) {
											?>
												<li class="nav-item">
													<a class="nav-link" href="/owner/">
														<i class="far fa-address-book text-primary"></i> Propietarios
													</a>
												</li>
											<?php } ?>
											<?php if (isset($_SESSION["permissions"]["Aliados"]["Listar"]) && $_SESSION["permissions"]["Aliados"]["Listar"] == 1) {
											?>
												<li class="nav-item">
													<a class="nav-link" href="/companyagreement/">
														<i class="far fa-building text-primary"></i> Aliados
													</a>
												</li>
											<?php } ?>
											<?php if (isset($_SESSION["permissions"]["Vehículos"]["Listar"]) && $_SESSION["permissions"]["Vehículos"]["Listar"] == 1) {
											?>
												<li class="nav-item">
													<a class="nav-link" href="/car/">
														<i class="fa fa-car  text-primary"></i> Vehículos
													</a>
												</li>
											<?php } ?>
											<?php if (isset($_SESSION["permissions"]["Empleados"]["Listar"]) && $_SESSION["permissions"]["Empleados"]["Listar"] == 1) {
											?>
												<li class="nav-item">
													<a class="nav-link" href="/employe/">
														<i class="fa fa-address-card  text-primary"></i> Empleados
													</a>
												</li>
											<?php } ?>
										</ul>
									</div>
								</div>
							</div>
							<div class="card">
								<div class="card-header" id="headingThree">
									<h5 class="mb-0">
										<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#operaciones" aria-expanded="false" aria-controls="operaciones">
											Operaciones
										</button>
									</h5>
								</div>
								<div id="operaciones" class="collapse" aria-labelledby="headingThree" data-parent="#menuAccordion">
									<div class="card-body">
										<ul class="navbar-nav">
											<?php if (isset($_SESSION["permissions"]["Planillas"]["Listar"]) && $_SESSION["permissions"]["Planillas"]["Listar"] == 1) {
											?>
												<li class="nav-item">
													<a class="nav-link" href="/report/">
														<i class="fas fa-clipboard-list text-primary"></i> Planillas
													</a>
												</li>
											<?php } ?>
											<?php if (isset($_SESSION["permissions"]["Combustible"]["Listar"]) && $_SESSION["permissions"]["Combustible"]["Listar"] == 1) {
											?>
												<li class="nav-item">
													<a class="nav-link" href="/fuel/">
														<i class="fas fa-gas-pump text-primary"></i> Combustible
													</a>
												</li>
											<?php } ?>
										</ul>
									</div>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</nav>
	<div class="main-content" id="panel">
		<?php if (!empty($_SESSION)) { ?>
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
									<a href="/user/edit/<?= $_SESSION["id"] ?>" class="dropdown-item">
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