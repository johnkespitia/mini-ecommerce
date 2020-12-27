<!DOCTYPE html>
<html>
<head>
	<title><?= $_ENV["SITE_NAME"] ?></title>
	<meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!--  Fonts and icons  -->
    <!--     Fonts and icons     -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet">
	<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
	

    <!-- Black Dashboard CSS -->
    <link href="/themes/<?= $_ENV["THEME"] ?>/assets/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />
</head>
<body>
	<div class="container-fluid">
		<nav class="navbar navbar-expand-lg bg-white">
			<div class="container">
				<a class="navbar-brand" href="#"><?= $_ENV["SITE_NAME"] ?></a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-bar navbar-kebab"></span>
				<span class="navbar-toggler-bar navbar-kebab"></span>
				<span class="navbar-toggler-bar navbar-kebab"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNav">
					<ul class="navbar-nav">
						<li class="nav-item">
							<a class="nav-link" href="/">Home</a>
						</li>
						<?php if(empty($_SESSION)){ ?>
							<li class="nav-item">
								<a class="nav-link" href="/home/login">Login</a>
							</li>	
						<?php }else{ 
							if($_SESSION["rol_id"] == 1){ ?>
							<li class="nav-item">
								<a class="nav-link" href="/customer/index">Admin Users</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="/generalsettings/index">General Configs</a>
							</li>
						<?php } else{ ?>
							<li class="nav-item">
								<a class="nav-link" href="/checker/index">Check Cards</a>
							</li>
						<?php
							} ?>
							<li class="nav-item">
								<a class="nav-link" href="/home/logout">Logout</a>
							</li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</nav>
