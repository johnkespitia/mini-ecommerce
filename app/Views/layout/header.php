<!DOCTYPE html>
<html>
<head>
	<title><?= $_ENV["SITE_NAME"] ?></title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		  <a class="navbar-brand" href="#"><?= $_ENV["SITE_NAME"] ?></a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>

		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav mr-auto">
		      <li class="nav-item">
		        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="/customer/">Clientes</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="/product/">Productos</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="/order/">Pedidos</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="/report/">Reportes</a>
		      </li>
		    </ul>
		  </div>
		</nav>
