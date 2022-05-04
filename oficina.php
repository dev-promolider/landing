<?php

include "config/conection.php";

if(isset($_SESSION['nvirtual']))
{
    redir("index.php");
    exit();
}

if(isset($_GET['usuario']) && $_GET['usuario']!="")
{
	if(nombre_apellido_usuario($_GET['usuario']) != "0")
	{
		$ref = $_GET['usuario'];
	
		if(file_exists("img/avatares/".$ref.".jpg"))
		{
			$avatar = $ref.".jpg";
			$usuario = "<center><img class='img-responsive img-circle' width='30%'' height='30%'' src='img/avatares/".$avatar."'/><font color='white'>".nombre_apellido_usuario($ref)."</font><center>";
		}
		else
		{
			$usuario = "<center><img class='img-responsive img-circle' width='30%'' height='30%'' src='img/avatares/0.jpg/><font color='white'>".nombre_apellido_usuario($ref)."</font><center>";
		}	
	}
	
}
else
{
	$usuario = "";
}

if(isset($_GET['ref']) && $_GET['ref']!="")
{
	if(nombre_apellido_usuario($_GET['ref']) != "0")
	{
		$ref = $_GET['ref'];
	
		if(file_exists("img/avatares/".$ref.".jpg"))
		{
			$avatar = $ref.".jpg";
			$usuario = "<center><img class='img-responsive img-circle' width='30%'' height='30%'' src='img/avatares/".$avatar."'/><font color='white'>".nombre_apellido_usuario($ref)."<center>";
		}
		else
		{
			$usuario = "<center><img class='img-responsive img-circle' width='30%'' height='30%'' src='img/avatares/0.png'/><font color='white'>".nombre_apellido_usuario($ref)."</font><center>";
		}
	}
		
}
else
{
	$usuario = "";
}

?>


<!DOCTYPE html>
	<html lang="es">
	<head>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>PROMOLIDER INTERACIONAL</title>

		<link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="lib/css/bootstrap.min.css">

		<!-- Optional theme -->
		<link rel="stylesheet" href="lib/css/bootstrap.theme.min.css">


		<!-- Custom Theme Promolider -->
		<link rel="stylesheet" href="lib/css/promolider.css">


		<script src="lib/js/jquery.min.js"></script>

		<!-- Latest compiled and minified JavaScript -->
		<script src="lib/js/bootstrap.min.js"></script>

		<script src="lib/js/promolider.js"></script>

		

	
	</head>

	<body>


	<!-- Modal -->
	<div id="formPop" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Inicio de Sesión</h4>
	        <ul class="nav nav-pills">
	        	<li attr-id="login"><a href="javascript:;" class="tipoFormulario" attr-id="login">> Login</a></li>
	            <li attr-id="registro" class="active"><a href="./register/?ref=<?=$ref?>" attr-id="registro">> Registro</a></li>
	            
	      	</ul>
	      </div>
	      <div class="modal-body">


	        <form role="form" id="registro" class="formRegistro">

	        <label class="full-size-title box-padding-small">Datos Personales</label>

	        <input type="hidden" name="funcion" value="agregarUsuario">

			  	
			   	<div class="col-md-12 pull-left"><br><button type="submit" style="display: block; width: 100%;" class="btn btn-primary">Registrarse</button><br><br></div>
			  	

			</form>

			<form role="form" id="login" class="hidden formLogin">
			<input type="hidden" name="funcion" value="loginUsuario">
			  <div class="form-group">
			    <label for="usuario">Usuario :</label>
			    <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Ingrese un usuario">
			  </div>
			  <div class="form-group">
			    <label for="pwd">Contraseña :</label>
			    <input type="password" class="form-control" id="pwd" name="contrasena" placeholder="Contraseña">
			  </div>

			  <input type="hidden" class="form-control" name="referido" value="<?php echo $referido;?>">

			  <div class="alert box-margin-topbot col-md-12" id="info-login">
			  
				</div> 

			  <button type="submit" class="btn btn-default">Iniciar Sesion</button>
			</form>


	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	      </div>
	    </div>

	  </div>
	</div>

	<input type="text" class="hidden" id="idproducto" value="">
	<input type="text" class="hidden" id="idtipocuenta" value="">

	<div class="container-fluid">

		<div class="row bg-darkgray vertical-align box-padding-small">


			<div class="col-md-4 col-xs-12 col-md-offset-1 box-padding-small">
				<a href="#"><img class="img-responsive" src="img/logo.png"></a>
			</div><!--

			--><div class="col-md-4 col-xs-12 box-padding-small">
				<?php echo $usuario; ?>
			</div><!--
			

			--><div class="col-md-4 col-xs-12 box-padding-small">
				
				<ul class="nav nav-pills" id="header-menu">
		            <li class="active"><a href="./login/" class="tipoFormulario btn-nocomprar" attr-id="login">Login</a></li>
		            <li><a href="./register/?ref=<?=$ref?>" class="tipoFormulario btn-nocomprar" attr-id="registro">Registro</a></li>
		      	</ul>


	      	</div>

		</div>

		<div class="row bg-dark box-padding-topbot">

		

			<div class="col-md-12">

				<div class="col-md-6 box-padding-topbot">

					<img src="img/reg-networkmarketing.jpg" class="img-responsive hvr-grow img-rounded">

				</div>

				<div class="col-md-6 box-padding-topbot">

					<div class="panel panel-primary">
			            <div class="panel-heading">
			              <h3 class="panel-title">NETWORK MARKETING</h3>
			            </div>
			            <div class="panel-body">
			              	<div class="col-md-12">El Network Marketing es una innovadora estrategia de mercado en la que se fomenta la distribución de productos y servicios directos del fabricante al consumidor, incentivando al negociante con beneficios originados por sus propias ventas y por las de los distribuidores que forman parte de su estructura organizativa.
			              	</div>
							<div class="col-md-12">
							<a href="./register/?ref=<?=$ref?>&compra=12"><button type="button" class="btn btn-yellow btn-lg btn-comprar box-margin-topbot" attr-id="12">Comprar</button></a>
							</div>
			            </div>
		          	</div>

				</div>

			</div>

			<div class="col-md-12">

				<div class="col-md-6 box-padding-topbot">

					<img src="img/reg-coaching.jpg" class="img-responsive hvr-grow img-rounded">


				</div>

				<div class="col-md-6 box-padding-topbot">

					<div class="panel panel-primary">
			            <div class="panel-heading">
			              <h3 class="panel-title">COACHING</h3>
			            </div>
			            <div class="panel-body">
			              	<div class="col-md-12">El Diplomado de Coaching también conocido como Life Coaching, es una formación de alto nivel, orientado a generar un proceso de transformación personal y profesional, aumentar nuestro poder de acción a través del desarrollo de la capacidad de aprendizaje, habilidades de inteligencia emocional, corporal, y destrezas de creatividad, liderazgo y comunicación efectiva.  El Coaching te ayuda a desarrollar nuevos hábitos y a mejorar tu proactividad y tu liderazgo.</div>

							<div class="col-md-12">
							<a href="./register/?ref=<?=$ref?>&compra=13"><button type="button" class="btn btn-yellow btn-lg btn-comprar box-margin-topbot" attr-id="13">Comprar</button></a>
							</div>
			            </div>
		          	</div>

				</div>

			</div>

			<div class="col-md-12">

				<div class="col-md-6 box-padding-topbot">

					<img src="img/community-manager.png" class="img-responsive hvr-grow img-rounded">


				</div>

				<div class="col-md-6 box-padding-topbot">

					<div class="panel panel-primary">
			            <div class="panel-heading">
			              <h3 class="panel-title">COMMUNITY MANAGER</h3>
			            </div>
			            <div class="panel-body">
			              	<div class="col-md-12">
			              	En nuestro Curso de Community Manager podrás dominar de manera efectiva los aspectos estratégicos de las redes sociales, incluyendo la planificación, generación y manejo de los contenidos así como el uso adecuado de las herramientas de gestión y monitoreo.
			              	</div>
			              	<div class="col-md-12">
							<a href="./register/?ref=<?=$ref?>&compra=14"><button type="button" class="btn btn-yellow btn-lg btn-comprar box-margin-topbot" attr-id="14">Comprar</button></a>
							</div>
			            </div>
		          	</div>

				</div>

			</div>

			

		</div>

	</div>

	<footer class="footer">
      <div class="container">
        <p class="text-muted">Promolider Internacional.</p>
      </div>
    </footer>




    </nav>

