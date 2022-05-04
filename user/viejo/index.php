
<?php
include "../config/conection.php";

	//Author: promolider
	//Author URL: https://promolider.org
	//License: Blockchain Sistems 3.0 Lima Peru

if(!isset($ref)){

redir("../");

}

if(isset($_GET['ref']) && $_GET['ref']!="")
{
	if(nombre_apellido_usuario($_GET['ref']) != "0")
	{
		$ref = $_GET['ref'];
	
		if(file_exists("../img/avatares/".$ref.".jpg"))
		{
			$avatar = $ref.".jpg";
			$usuario = "<font color='white' style='position:relative;vertical-align: middle;' >".nombre_apellido_usuario($ref)."</font>";
			
			//$usuario = "<font color='white' style='position:relative;top:10px;'>".nombre_apellido_usuario($ref)."</font>";
			$foto="<img  style='display:inline-block;width:35px;height:35px;position:relative;top:10px;border-radius:50%;' src='../img/avatares/".$avatar."'/>";
		}
		else
		{
			$usuario = "<font color='white' style='position:relative;'>".nombre_apellido_usuario($ref)."</font>";
			$foto="<img  style='display:inline-block;width:35px;height:35px;position:relative;border-radius:50%;' src='../img/avatares/0.png'/>";


		}
	}
		
}
?>
<!DOCTYPE html>
<html lang="en">
<!-- Head -->
<head>
	<link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
<link rel="manifest" href="favicon/site.webmanifest">
<link rel="mask-icon" href="favicon/safari-pinned-tab.svg" color="#5bbad5">
<link rel="shortcut icon" href="favicon/favicon.ico">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="msapplication-config" content="favicon/browserconfig.xml">
<meta name="theme-color" content="#ffffff">

<title>Promolíder |USUARIO</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
<meta name="description" content="Mercadeo en red,oportunidad de negocio, Multinivel nuevo, Formacion de Lideres,Ganar dinero, Coaching, inversion, trading, Marketing digital, certificacion.">
<meta name="keywords" content="Mercadeo en red,oportunidad de negocio, Multinivel nuevo, Formacion de Lideres,Ganar dinero, Coaching, inversion, trading, Marketing digital, certificacion"/>

<meta property="og:title"   content="Mercadeo en red,oportunidad de negocio, Multinivel nuevo, Formacion de Lideres,Ganar dinero, Coaching, inversion, trading, Marketing digital, certificacion">
	<meta property="og:url" content="https://promolider.rf.gd/sistema/user/?ref=">
	<meta property="og:description" content="Mercadeo en red,oportunidad de negocio, Multinivel nuevo, Formacion de Lideres,Ganar dinero, Coaching, inversion, trading, Marketing digital, certificacion.">
	<meta property="og:image"  content="https://images/bg/bg.jpg">
	<meta property="og:type"  content="website">	
	<meta property="og:site_name" content="">
	<meta property="og:locale" content="es_PE">

<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="all" /><!-- for testimonials -->

<!-- default css files -->
	<link rel="stylesheet" href="css/bootstrap.css" type="text/css" media="all">
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
	<link rel="stylesheet" href="css/font-awesome.min.css" />
<!-- default css files -->
	
<!--web font-->
<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
<!--//web font-->
<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '233950517442703');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=233950517442703&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->

	
</head

<!-- Body -->
<body>

<!-- banner -->
	<div class=" banner">
		<div class="wthree-different-dot">
			<!-- header -->
			<div class="header">
				<div class="container">
					<nav class="navbar navbar-default">
						<div class="navbar-header">
						  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						  </button>
							<div class="w3layouts-logo">
								<h1><a href="index.html"><span>p</span>promolíder</a></h1>
							</div>
						</div>

						<!-- Collect the nav links, forms, and other content for toggling -->
						
						<div class="collapse navbar-collapse nav-wil" id="bs-example-navbar-collapse-1">
							<nav>
								<ul class="nav navbar-nav">
									<li class="active"><a href="../index.html">Inicio</a></li>
									<li><a href="../about.html"target="_blank">Quiénes Somos</a></li>
									<li><a href="../gallery.html"target="_blank">INFOPRODUCTOS</a></li>
								<!--<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-hover="Pages" data-toggle="dropdown">UNIVERSIDAD <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a href="icons.html">Icons</a></li>
										<li><a href="typography.html">Short Codes</a></li>-->
									<!--</ul>
							  </li>--><li><a href="https://promolider.org/universidad/index.php"target="_blank">UNIVERSIDAD</a></li>
							  <li><a href="../login.php"target="_blank">INICIAR SESIÓN </a></li>
									<li><a href="../register/?ref=<?=$ref?>">Registrate</a></li>
								</ul>
							</nav>
							
							
						</div>
						<!-- /.navbar-collapse -->
					</nav>
                    <div class="col-lg-4" style="display:flex; flex-wrap:wrap; float:right;">
                    		<button type="button" class="btn btn-warning" style="flex:1; min-width:50px; margin:6px;">Patrocinador</button>
                            <button type="button" class="btn btn-success" style="flex:1; min-width:30px;margin:6px;">
                             <a href="../register/?ref=<?=$ref?>"><?=$usuario?></a>
                            </button>
                            <a style="flex:1; min-width:30px;margin:7px;"><?=$foto?></a>
                    </div>
				</div>
			</div>
			<!-- //header -->
			<div class="banner-top">
					<div class="slider">
						<div class="callbacks_container">
							<ul class="rslides callbacks callbacks1" id="slider4">
								<li>	
								<div class="wthree-different-dot">
									<div class="banner_text">
									<div class="container">
										<span>red </span>
										<h2>Educativa</h2>
										<div class="more-button text-center">
											<a href="#" class="hvr-bounce-to-bottom scroll" data-toggle="modal" data-target="#myModal1">Leer más</a>
										</div>
										<div class="thim-click-to-bottom">
											<a href="#welcome" class="scroll">
												<i class="fa  fa-chevron-down"></i>
											</a>
										</div>
									</div>
									</div>
								</div>
								</li>
								<li>
								<div class="wthree-different-dot">	
									<div class="banner_text">
									<div class="container">
										<span>red</span>
										<h3>empresarial</h3>
										<div class="more-button text-center">
											<a href="#" class="hvr-bounce-to-bottom scroll" data-toggle="modal" data-target="#myModal1">leer más</a>
										</div>
										<div class="thim-click-to-bottom">
											<a href="#welcome" class="scroll">
												<i class="fa  fa-chevron-down"></i>
											</a>
										</div>
									</div>
									</div>
									</div>
								</li>
								<li>	
								<div class="wthree-different-dot">
									<div class="banner_text">
									<div class="container">
										<span>red</span>
										<h3>monetizada</h3>
										<div class="more-button text-center">
											<a href="#" class="hvr-bounce-to-bottom scroll" data-toggle="modal" data-target="#myModal1">Leer más</a>
										</div>
										<div class="thim-click-to-bottom">
											<a href="#welcome" class="scroll">
												<i class="fa  fa-chevron-down"></i>
											</a>
										</div>
									</div>
									</div>
									</div>
								</li>
								<li>	
								<div class="wthree-different-dot">
									<div class="banner_text">
									<div class="container">
										<span>red</span>
										<h3>inversión</h3>
										<div class="more-button text-center">
											<a href="#" class="hvr-bounce-to-bottom scroll" data-toggle="modal" data-target="#myModal1">leer más</a>
										</div>
										<div class="thim-click-to-bottom">
											<a href="#welcome" class="scroll">
												<i class="fa  fa-chevron-down"></i>
											</a>
										</div>
									</div>
									</div>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		<div class="clearfix"></div>
		</div>
	<!-- //banner -->
<!-- Modal1 -->
						<div class="modal fade" id="myModal1" tabindex="-1" role="dialog">
							<div class="modal-dialog">
							<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4>Promolíder</h4>
										<img src="images/b2.jpg" alt=" " class="img-responsive">
										<h5>Educación online y negocio. </h5>
										<p>Somos  la primera red educativa que integra un sistema de ganacias dirigido a personas que quieran cambiar sus vidas, desaprendiendo creencias limitantes y reaprendiendo nuevos patrones que lo lleven al èxito y empoderen para enseñar a otros con estartegias altamente comprobadas como lo es el Coaching, la PNL, La Neurociencia e Inteligencia Emocional entre otros, con la oportunidad de obtener un modelo de negocio que le permita generar ingresos exponenciales extras. 
										</p>
									</div>
								</div>
							</div>
						</div>
<!-- //Modal1 -->

<!-- welcome -->

<div class="about" id="Bienvenidos">
	<div class="container">
		<h3> PROMOLÍDER Primera red educativa monetizada</h3>
		<h3><span> Bienvenidos </span> a tu empresa</h3>
		<div class="col-md-6 aboutleft">
			<h3>¿Te imaginas poder ganar dinero mientras te formas, capacitas o te certificas?</h3>
			<p>PROMOLÍDER te ofrece una plataforma educativa online y un sistema de ganancias altamente comprobado, acompañado de un equipo de profesionales e investigadores en las áreas de desarrollo y crecimiento personal, tomando como base el Coaching, la neurociencia y una cartera de cursos, talleres, y diplomados con certificación Universitaria.

</p>
			<p>Al ser miembro de esta Red, tendrás descuentos de hasta un 50% en todos los infoproductos (cursos, talleres, seminarios, diplomados)  y  ganancias de hasta un 45% de tu red de referidos.</p>
			<p>En PROMOLÍDER hemos unido dos megas tendencias como lo son la industria  del E-learni  con una facturación anual de 51.5 Billones de Dólares  y la industria del Network Marketing con ingresos de 2 Trillones de Dólares al año,  cada día son más las miles de persona  que se unen a esta tendencia</p>
			<p>Y tú, estás dispuestos a dar un cambio en tu vida? educando tu mente, capacitándote con herramientas efectivas y obtener grandes beneficios economicos de por vida. Ingresa hoy mismo.</p>
		</div>
		<div class="col-md-6 aboutright">
			<img src="images/about.jpg" alt="" />
			<div class="aboutimg">
				<img src="images/aboutimg.jpg" alt="" />
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<!-- welcome -->

<!-- services -->
	<div class="services" id="services">
		<div class="container">
			<div class="w3l-heading">
				<h3>Qué hacemos</h3>
			</div>
			<div class="services-grids">
				<div class="col-md-3 wthree-services-grid">
					<div class="wthree-services-icon">
						<i class="fa fa-desktop" aria-hidden="true"></i>
					</div>
					<div class="wthree-services-info">
						<h5>Educación online</h5>
						<span></span>
						<p>Disponible las 24 Horas del día, desde la comodidad de tu hogar u oficina, para que te formes en tu tiempo libre. </p>
					</div>
				</div>
				<div class="col-md-3 wthree-services-grid">
					<div class="wthree-services-icon">
						<i class="fa fa-clone" aria-hidden="true"></i>
					</div>
					<div class="wthree-services-info">
						<h5>Certificación Universitaria</h5>
						<span></span>
						<p>Contamos con respaldo de universidades reconocidas  a nivel internacional. </p>
					</div>
				</div>
				<div class="col-md-3 wthree-services-grid">
					<div class="wthree-services-icon">
						<i class="fa fa-sitemap" aria-hidden="true"></i>
					</div>
					<div class="wthree-services-info">
						<h5>Oportunidad de Negocio</h5>
						<span></span>
						<p>Novedoso Plan de Compensación que consolidan tu éxito financiero. </p>
					</div>
				</div>
				<div class="col-md-3 wthree-services-grid">
					<div class="wthree-services-icon">
						<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
					</div>
					<div class="wthree-services-info">
						<h5>Variedad de Contenidos</h5>
						<span></span>
						<p>Contamos con cursos, talleres, diplomados y especiaizaciones, en plataforma 100% online, certificados universitariamente. </p>
					</div>
				</div>
				<div class="clearfix"> </div>
				
				<div class="services-bottom-grids">
					<div class="col-md-4 wthree-services-grid">
						<div class="wthree-services-icon">
							<i class="fa fa-btc" aria-hidden="true"></i>
						</div>
						<div class="wthree-services-info">
							<h5>Inversión y trading</h5>
							<span></span>
							<p>Capacitación actualizada en criptomonedas, inversión en bolsa, tiempo real del Mercado Forex, Motores de inversíon eficiciente. </p>
						</div>
					</div>
					<div class="col-md-4 wthree-services-grid">
						<div class="wthree-services-icon">
							<i class="fa fa-signing" aria-hidden="true"></i>
						</div>
						<div class="wthree-services-info">
							<h5>Sistema de Ganancia</h5>
							<span></span>
							<p>Innovador plan de ganancias con 16 forma de beneficiar a nuestros asociados . </p>
						</div>
					</div>
					<div class="col-md-4 wthree-services-grid">
						<div class="wthree-services-icon">
							<i class="fa fa-suitcase" aria-hidden="true"></i>
						</div>
						<div class="wthree-services-info">
							<h5>Premios</h5>
							<span></span>
							<p>Viajes nacionales e internacionales en la escala de ascensos. </p>
						</div>
					</div>
				<div class="clearfix"> </div>
				</div>
			</div>
				<div class="clearfix"> </div>
		</div>
	</div>
<!-- //services -->

<!-- team -->
<div class="team-section">
	 		      <div class="container">
			<div class="w3l-heading">
				<h3>nuestro equipo</h3>
			</div>
		      <div class="team-row">
				<div class="col-md-3 team-grids">
					<div class="team-img">
						<img class="img-responsive" src="images/gio1.jpg" alt="">
						<div class="captn">
							<ul class="top-links">
									<li><a href="https://www.facebook.com/giovany.pernia"><i class="fa fa-facebook"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter"></i></a></li>
									
									<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
								</ul>
						
						</div>
					</div>
					<div class="team-agile">
						<h4>Giovany Pernia</h4>
						<p>Coach, CEO, Estratega de expansión y crecimiento, empresario con más de 20 años de reconocida trayectoria, impulsador de negocios rentables y auto sustentable.</p>
					</div>
				</div>
				<div class="col-md-3 team-grids">
					<div class="team-img">
						<img class="img-responsive" src="images/gio2.jpg" alt="">
						<div class="captn">
							<ul class="top-links">
									<li><a href="https://www.facebook.com/freddyalberto.maldonado"><i class="fa fa-facebook"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter"></i></a></li>
									
									<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
								</ul>
						
						</div>
					</div>
					<div class="team-agile">
						<h4>Freddy Maldonado </h4>
						<p>Director de formación y expansión, programador neuro líder biodecodificador, coordinador de programa de crecimiemto acelerado .</p>
					</div>
				</div>
				<div class="col-md-3 team-grids">
					<div class="team-img">
						<img class="img-responsive" src="images/t3.jpg" alt="">
						<div class="captn">
							<ul class="top-links">
									<li><a href="https://www.facebook.com/henry.j.fuenmayor.5"><i class="fa fa-facebook"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter"></i></a></li>
									
									<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
								</ul>
						
						</div>
					</div>
					<div class="team-agile">
						<h4>Henry Rodríguez</h4>
						<p>Consultor- Estratega Digital, Community Management, Educador y Redacctor Creativo para Redes Sociales.</p>
					</div>
				</div>
				<div class="col-md-3 team-grids">
					<div class="team-img">
						<img class="img-responsive" src="images/t4.jpg" alt="">
						<div class="captn">
							<ul class="top-links">
									<li><a href="#"><i class="fa fa-facebook"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter"></i></a></li>
									
									<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
								</ul>
						
						</div>
					</div>
					<div class="team-agile">
						<h4>Gladys Luján</h4>
						<p>Coordinador académico, diseñadora instruccional e-learning, planeación y mejora continua con más de doce años de destacada experiencia en el ramo educativo y empresarial.</p>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div> 
		</div>	
</div>		
<!-- //team -->

<!-- servicesbottom -->
<!-- Counter -->
	<div class="col-md-6 services-bottom">
			<div class="col-md-6 agileits_w3layouts_about_counter_left">
				<div class="countericon">
					<i class="glyphicon glyphicon-tasks" aria-hidden="true"></i>
				</div>
				<div class="counterinfo">
					<p class="counter">436</p> 
					<h3>promolíder</h3>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="col-md-6 agileits_w3layouts_about_counter_left">
				<div class="countericon">
					<i class="glyphicon glyphicon-erase" aria-hidden="true"></i>
				</div>
				<div class="counterinfo">
					<p class="counter">147</p> 
					<h3>premios</h3>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="clearfix"> </div>
			<div class="col-md-6 agileits_w3layouts_about_counter_left">
				<div class="countericon">
					<i class="fa fa-calendar" aria-hidden="true"></i>
				</div>
				<div class="counterinfo">
					<p class="counter">10</p>
					<h3>años de experiencia</h3>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="col-md-6 agileits_w3layouts_about_counter_left">
				<div class="countericon">
					<i class="fa fa-thumbs-up" aria-hidden="true"></i>
				</div>
				<div class="counterinfo">
					<p class="counter">150</p>
					<h3>administración</h3>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="clearfix"> </div>
	</div>
<!-- //Counter -->
<!-- Clients -->
	<div class=" col-md-6 clients">
			<h3>Testimonios</h3>
			<span></span>
			<section class="slider">
				<div class="flexslider">
					<ul class="slides">
						<li>
								<p>Luego de estar por varias empresas de mercadeo en red, entendí que sin la formación y la capacitación constante, no hay cambios. En PROMOLÍDER encontre la combinación perfecta: formación y mi propio negocio. .</p>
								<div class="client">
									<img src="images/c1.jpg" alt="" />
									<h5>Santa Cruz Vidarte</h5>
									<div class="clearfix"> </div>
								</div>
						</li>
						<li>
								<p>Me costaba mucho relacionarme con otras personas.  Con mi formaciòn en Coaching descubrí mis creencias limitantes y me ayudo a despertar mi talento, cada día tengo más amigos.  .</p>
								<div class="client">
								<img src="images/c2.jpg" alt="" />
									<h5>Vannesa Vega</h5>
									<div class="clearfix"> </div>
								</div>
						</li>
						<li>
								<p>Cuando me hablaron de PROMOLÍDER, lo primero que pense fue en ventas, productos y cajas, jajajaja. Tener mi negocio de capacitacion y ganar dinero por cambiar mi forma de pensar, es todo lo que estaba buscando... .</p>
								<div class="client">
								<img src="images/c3.jpg" alt="" />
									<h5>Chris Mariangel Tigrera</h5>
									<div class="clearfix"> </div>
								</div>
						</li>
						<li>
							
								<p>Para mi, estar actualizado con la información a través la capacitacion, es tener poder ante los demás .</p>
								<div class="client">
								<img src="images/c4.jpg" alt="" />
									<h5>Reinaldo Meza</h5>
									<div class="clearfix"> </div>
								</div>
						</li>
					</ul>
				</div>
			</section>
</div>
			<div class="clearfix"> </div>
<!-- //Clients -->
<div class="statbottom">
	<div class="container">
		<h3>El propósito de Promolíder es formar Líderes de Negocio. </h3>
		<p>Nuestro CEO, Coach Giovany Pernia mantiene el objetivo claro de construir la red educativa monetizada con personas que deseen cambiar su forma de pensar, manteniendo la llama ardiente de la libertad financierea, por ello te invita a suscribirte en nuestros canales informativos.  .</p>
		<div class="more-button text-center">
			<a href="#" class="hvr-bounce-to-bottom scroll" data-toggle="modal" data-target="#myModal1">leer más </a>
		</div>
	</div>
</div>
<!-- //servicesbottom -->

<!-- subscribe section -->
<section class="subscribe" id="subscribe">
	<div class="container">
		<h3>Suscribete </h3>
	</div>
	<form action="#" method="post" class="newsletter">
		<input class="email" type="email" placeholder="Enter Your Email..." required="">
		<input type="submit" class="submit" value="subscribe">
	</form>
</section>
<!-- //subscribe section -->

<!-- footer -->
<div class="footer">
	<div class="container">
		<div class="col-md-4 footerleft">
			<h3>Toma acción</h3>
		<p>Únete a nuestra maravillosa oportunidad y conoce personas extraordinarias   .</p>
		<p>Los miembros  de nuestra red disfrutan de 
entrenamientos, capacitacion acelerada y apoyo
especializado. En PROMOLÍDER la consigna es: Juntos
alcanzamos la grandeza.</p>
		</div>
		<div class="col-md-4 footermiddle">
			<h3>lima Perú</h3>
			<p></p>
			<p></p>
			<p class="phone">Teléfono: +51(01) 4833997</p>
			<p class="phone">Whastapp: +051 995668600</p>
			<p class="phone">Correo: <a href="mailto:info@example.com">promoliderorg@gmail.com</a></p>
		</div>
		<div class="col-md-4 footerright">
			<h3>Twitter </h3>
			<ul class="w3agile_footer_grid_list">
				<li> promolíder se expande por latino america<a href="https://twitter.com/Promoliderorg">promoliderorg.com</a>.
				<span><i class="fa fa-twitter" aria-hidden="true"></i> 02 2017 ago</span></li>
				<li>nueva sede en lima perú <a href="https://twitter.com/Promoliderorg">promoliderorg.com</a> .
				<span><i class="fa fa-twitter" aria-hidden="true"></i> 03 2017 ago</span></li>
			</ul>
		</div>
		<div class="clearfix"> </div>
	</div>
</div>
<!-- //footer -->

<!-- copyright -->
<div class="wthree_copy_right">
	<div class="container">
		<p>© 2017 promolíder.  |  <a href="http://w3layouts.com/"></a></p>
			
	</div>
</div>
<!-- //copyright -->

<!-- Default-JavaScript-File -->
	<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
<!-- //Default-JavaScript-File -->
	
<!-- scrolling script -->
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script> 
<!-- //scrolling script -->

					<!--banner Slider starts Here-->
						<script src="js/responsiveslides.min.js"></script>
						<script>
							// You can also use "$(window).load(function() {"
							$(function () {
							  // Slideshow 4
							  $("#slider4").responsiveSlides({
								auto: true,
								pager:true,
								nav:true,
								speed: 500,
								namespace: "callbacks",
								before: function () {
								  $('.events').append("<li>before event fired.</li>");
								},
								after: function () {
								  $('.events').append("<li>after event fired.</li>");
								}
							  });
						
							});
						 </script>
					<!--banner Slider ends Here-->
			
				
		<!-- Stats-Number-Scroller-Animation-JavaScript -->
				<script src="js/waypoints.min.js"></script> 
				<script src="js/counterup.min.js"></script> 
				<script>
					jQuery(document).ready(function( $ ) {
						$('.counter').counterUp({
							delay: 100,
							time: 1000
						});
					});
				</script>
		<!-- //Stats-Number-Scroller-Animation-JavaScript -->


	<script src="js/SmoothScroll.min.js"></script>
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>
	<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function() {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
			*/
								
			$().UItoTop({ easingType: 'easeOutQuart' });
								
			});
	</script>
<!-- //here ends scrolling icon -->

			<!-- FlexSlider-JavaScript -->
	<script defer src="js/jquery.flexslider.js"></script>
	<script type="text/javascript">
		$(function(){
			SyntaxHighlighter.all();
				});
				$(window).load(function(){
				$('.flexslider').flexslider({
					animation: "slide",
					start: function(slider){
						$('body').removeClass('loading');
					}
			});
		});
	</script>
	<!-- //FlexSlider-JavaScript -->

</body>
<!-- //Body -->
<!-- </html>
	Industrious by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->

<html lang="es-ES"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Promolider</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../../assets/css/main.css" />
		<link rel="icon" href="http://promoliderv.org/img/iso2.png" />


<body>
		<!-- Header 
		<header id="header">
			<a class="logo" href="#" style="text-align:center;"><?=$usuario?></a></li>
			<nav>
				<a href="#menu">Menu</a>
			</nav>
		</header>

	
		<nav id="menu">
			<ul class="links">
			    <li><a href="#" style="text-align:center;"><?=$foto?></a></li>
				<li><a href="#" style="text-align:center;"><?=$usuario?></a></li>
				<li><a href="../register/?ref=<?=$ref?>" style="text-align:center;">Registrate</a></li>
				<li><a href="http://promoliderv.org/sistema/login.php" style="text-align:center;">Login</a></li>
			</ul>
		</nav>

		<!-- Banner -->
		<!--	<section id="banner">
				<div class="inner">
					<h1>OFICINA VIRTUAL</h1>
					<p>¡ELEVA TU ÉXITO!</p>
				</div>
				<video autoplay loop muted playsinline src="../../images/banner.mp4"></video>
			</section> -->

		<!-- Highlights -->
		<!--	<section class="wrapper">
				<div class="inner">
					<header class="special">
						<h2>¿TE IMAGINAS PODER GANAR DINERO MIENTRAS TE FORMAS, CAPACITAS O TE CERTIFICAS?</h2>
						<p>.PROMOLÍDER Te Ofrece Una Plataforma Educativa Online Y Un Sistema De Ganancias Altamente Comprobado, Acompañado De Un Equipo De Profesionales E Investigadores En Las Áreas De Desarrollo Y Crecimiento Personal, Tomando Como Base El Coaching, La Neurociencia Y Una Cartera De Cursos, Talleres, Y Diplomados Con Certificación Universitaria.

Al Ser Miembro De Esta Red, Tendrás Descuentos De Hasta Un 50% En Todos Los Infoproductos (Cursos, Talleres, Seminarios, Diplomados) Y Ganancias De Hasta Un 45% De Tu Red De Referidos.

En PROMOLÍDER Hemos Unido Dos Megas Tendencias Como Lo Son La Industria Del E-Learni Con Una Facturación Anual De 51.5 Billones De Dólares Y La Industria Del Network Marketing Con Ingresos De 2 Trillones De Dólares Al Año, Cada Día Son Más Las Miles De Persona Que Se Unen A Esta Tendencia

Y Tú, Estás Dispuestos A Dar Un Cambio En Tu Vida? Educando Tu Mente, Capacitándote Con Herramientas Efectivas Y Obtener Grandes Beneficios Economicos De Por Vida. Ingresa Hoy Mismo.</p>
					</header>
					<div class="highlights">
						<section>
							<div class="content">
								<header>
									<a href="#" class="icon fa-line-chart"><span class="label">Icon</span></a>
									<h3>RENTABILIDAD</h3>
								</header>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta, esse? Veniam aperiam similique fugit sint, maxime illo magnam voluptatem expedita obcaecati harum laborum tenetur nam impedit atque, cum corporis repellat..</p>
							</div>
						</section>
						<section>
							<div class="content">
								<header>
									<a href="#" class="icon fa-paper-plane-o"><span class="label">Icon</span></a>
									<h3>QUIÉNES SOMOS</h3>
								</header>
								<p> PROMOLÍDER, Con Más De Ocho Años En El Mercado De La Formación Y Capacitación Ha Concebido Programas Educativos Con La Intención De Profundizar En El Desarrollo Del Potencial Emocional Del Individuo, Entendiendo Que El Bienestar De Éste Lo Compone También Su Economía, Por Ello En Año 2017 Lanza La Oportunidad De Negocio En La Que Te Capacitas, Entrenas, Certificas Y Obtienes Ingresos Monetarios.</p>
							</div>
						</section>
						<section>
							<div class="content">
								<header>
									<a href="#" class="icon fa-vcard-o"><span class="label">Icon</span></a>
									<h3>Formamos Líderes De Negocios De Alto Impacto</h3>
								</header>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus incidunt sit mollitia consequatur inventore nisi consectetur, magni fugiat debitis enim! Obcaecati modi sit adipisci nostrum, corporis consequatur ullam eligendi iusto..</p>
							</div>
						</section>
					</div>
				</div>
			</section>

		<!-- CTA -->
		<!--	<section id="cta" class="wrapper">
				<div class="inner">
					<h2>Visión</h2>
					<p>PROMOLÍDER mantine su plataforma educativa actualizada, con las últimas tendencias en cursos, talleres y diplomados a nivel mundial. Incluye los programas de criptomonedas e inversiones en los mercados de divisa, contando con expertos reconocidos en cada área, para que puedas hacer de esta experiencia un negocio rentable cuando refieres a tus amigos</p>
				</div>
			</section>

		<!-- Testimonials -->
		<!--	<section class="wrapper">
				<div class="inner">
					<header class="special">
						<h2>vidarte</h2>
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima impedit accusamus, odit eius ducimus nisi eos culpa, veritatis a fugit doloremque, vel ipsa fuga pariatur tenetur rem, voluptatum id consectetur.
						</p>
					</header>
					<div class="testimonials">
						<section>
							<div class="content">
								<blockquote>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim omnis, consectetur cumque vel, corporis asperiores exercitationem maxime</p>
								</blockquote>
								<div class="author">
									<div class="image">
										<img src="../../images/pic01.jpg" alt="" />
									</div>
									<p class="credit">- <strong>Lorena chu</strong> <span>CEO - Promolider.</span></p>
								</div>
							</div>
						</section>
						<section>
							<div class="content">
								<blockquote>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim omnis, consectetur cumque vel, corporis asperiores exercitationem maxime .</p>
								</blockquote>
								<div class="author">
									<div class="image">
										<img src="../../images/pic03.jpg" alt="" />
									</div>
									<p class="credit">- <strong>Raul santino</strong> <span>CEO - Promolider.</span></p>
								</div>
							</div>
						</section>
						<section>
							<div class="content">
								<blockquote>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim omnis, consectetur cumque vel, corporis asperiores exercitationem maxime!</p>
								</blockquote>
								<div class="author">
									<div class="image">
										<img src="../../images/pic02.jpg" alt="" />
									</div>
									<p class="credit">- <strong>Janet Smith</strong> <span>CEO - Promolider.</span></p>
								</div>
							</div>
						</section>
					</div>
				</div>
			</section>

		<!-- Footer -->
		<!--	<footer id="footer">
				<div class="inner">
					<div class="content">
						<section>
							<h3>Acerca de Promolider</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic provident odit rerum possimus, laudantium eaque maxime totam aliquam ipsum. Error totam, iusto rerum dolorum, adipisci ut quod quisquam laudantium culpa?Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vel rem modi consequatur, nisi dolorum deleniti sunt officiis quis labore molestias voluptatum officia natus corporis libero consectetur, dolor nobis, id nostrum..</p>
						</section>
						<section>
							<h4>Mapa de navegación</h4>
							<ul class="alt">
								<li><a href="#">Home.</a></li>
								<li><a href="#">Blog.</a></li>
								<li><a href="#">Contacto.</a></li>
								<li><a href="#">Login.</a></li>
							</ul>
						</section>
						<section>
							<h4>Magna sed ipsum</h4>
							<ul class="plain">
								<li><a href="#"><i class="icon fa-twitter">&nbsp;</i>Twitter</a></li>
								<li><a href="#"><i class="icon fa-facebook">&nbsp;</i>Facebook</a></li>
								<li><a href="#"><i class="icon fa-instagram">&nbsp;</i>Instagram</a></li>
							</ul>
						</section>
					</div>
					<div class="copyright">
						&copy; Promolider (cpz).
					</div>
				</div>
			</footer>

		<!-- Scripts -->
		<!--	<script src="../../assets/js/jquery.min.js"></script>-->
			<script src="../../assets/js/browser.min.js"></script>
			<script src="../../assets/js/breakpoints.min.js"></script>
			<script src="../../assets/js/util.js"></script>
			<script src="../../assets/js/main.js"></script>
</body>
<!-- //Body -->
	</body>
</html>
