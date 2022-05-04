<?php
include "../config/conection.php";

//Author: promolider
//Author URL: https://promolider.org
//License: Blockchain Sistems 3.0 Lima Peru

if (!isset($ref)) {

	redir("../");
}

if (isset($_GET['ref']) && $_GET['ref'] != "") {
	if (nombre_apellido_usuario($_GET['ref']) != "0") {
		$ref = $_GET['ref'];

		if (file_exists("../img/avatares/" . $ref . ".jpg")) {
			$avatar = $ref . ".jpg";
			$usuario = nombre_apellido_usuario($ref);

			//$usuario = "<font color='white' style='position:relative;top:10px;'>".nombre_apellido_usuario($ref)."</font>";
			$foto = "<img style='width:35px;height:35px;top:0px;border-radius:50%;' src='../img/avatares/" . $avatar . "'/>";
		} else {
			$usuario = "<font'>" . nombre_apellido_usuario($ref) . "</font>";
			$foto = "<img style='width:35px;height:35px;border-radius:50%;' src='../img/avatares/0.png'/>";
		}
	}
}
?>
<!DOCTYPE html>
<html lang="es">
<!-- Head -->

<head>
	<title>Promolíder | Usuario</title>

	<!-- Meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="keywords" content="promolider" />
	<meta name="description" content="Mercadeo en red,oportunidad de negocio, Multinivel nuevo, Formacion de Lideres,Ganar dinero, Coaching, inversion, trading, Marketing digital, certificacion.">
	<meta name="keywords" content="Mercadeo en red,oportunidad de negocio, Multinivel nuevo, Formacion de Lideres,Ganar dinero, Coaching, inversion, trading, Marketing digital, certificacion" />
	
	<!-- Meta tags manifest icon -->
	<link rel="apple-touch-icon" sizes="180x180" href="../../favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="../../favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="../../favicon/favicon-16x16.png">
	<link rel="mask-icon" href="../../favicon/safari-pinned-tab.svg" color="#5bbad5">
	<link rel="manifest" href="../../favicon/site.webmanifest">

	<!-- Property tags -->
	<meta property="og:title" content="Mercadeo en red,oportunidad de negocio, Multinivel nuevo, Formacion de Lideres,Ganar dinero, Coaching, inversion, trading, Marketing digital, certificacion">
	<meta property="og:url" content="https://promolider.org">
	<meta property="og:description" content="Mercadeo en red,oportunidad de negocio, Multinivel nuevo, Formacion de Lideres,Ganar dinero, Coaching, inversion, trading, Marketing digital, certificacion.">
	<meta property="og:image" content="https://images/bg/bg.jpg">
	<meta property="og:type" content="website">
	<meta property="og:site_name" content="">
	<meta property="og:locale" content="es_PE">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<!-- Custom CSS-->
	<link rel="stylesheet" href="css/style.css"/>
	<link rel="stylesheet" href="css/custom.css">

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

	<!-- Favicon Icon -->
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.png"/>

	<!-- Fonts -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">

	<!-- Slick Carrousel CSS -->
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
</head>

<body>
	<div class="container-fluid p-0">
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<div class="d-flex w-100 justify-content-between">
				<a href="https://www.promolider.org/" class="navbar-brand ml-3 ml-md-5 ml-lg-5">
					<img class="logo-promolider" src="images/header-logo-custom2.png">
				</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar9">
					<span class="navbar-toggler-icon"></span>
				</button>
			</div>
			<div class="navbar-collapse collapse text-center mt-md-4 mt-lg-0" id="navbar9">
				<ul class="navbar-nav mx-auto">
					<li class="nav-item px-2 py-1 my-2 my-md-0 mx-2">
						<a class="nav-link text-uppercase text-white text-responsive" href="../user/index.php?ref=gioper">Inicio</a>
					</li>
					<li class="nav-item dropdown px-2 py-1 my-2 my-md-0">
						<a class="nav-link dropdown-toggle text-uppercase text-white" target="_blank" href="https://promolider.org/universidad/index.php" id="navbarDropdown"
							role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Categorias
						</a>
						<div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
							<a class="dropdown-item mx-2 w-auto text-uppercase text-white" target="_blank" href="https://promolider.org/universidad/index.php">School</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item mx-2 w-auto text-uppercase text-white" target="_blank" href="https://promolider.org/universidad/index.php">Academy</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item mx-2 w-auto text-uppercase text-white" target="_blank" href="https://promolider.org/universidad/index.php">University</a>
						</div>
					</li>
					<li class="nav-item px-2 py-1 my-2 my-md-0 mx-2">
						<a class="nav-link text-uppercase text-white" href="https://promolider.org/universidad/index.php" target="_blank">Universidad</a>
					</li>
					<li class="nav-item px-2 py-1 my-2 my-md-0 mx-2">
						<a class="nav-link text-uppercase text-white" href="../register/?ref=<?=$ref?>" target="_blank">Registro</a>
					</li>
					<li class="nav-item px-2 py-1 my-2 my-md-0 mx-2">
						<a class="nav-link text-uppercase text-white" href="../login.php" target="_blank">Iniciar&nbsp;sesión</a>
					</li>
					<li class="nav-item mx-auto px-2 py-0 hover-except my-2 my-md-0 btn btn-group btn-success">
						<p class="text-center my-auto mx-3">
							<?=str_replace(' ', '&nbsp;',$usuario)?>
						</p>
						<a class="nav-link text-uppercase text-white px-3 py-2" href="#">
							<?=$foto?>
						</a>
					</li>
				</ul>
			</div>
		</nav>
	</div>