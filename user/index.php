<?php include_once('includes/header.php') ?>

	<div class="container my-5">
		<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
			<ol class="carousel-indicators">
				<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
				<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
				<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
				<li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
			</ol>
			<div class="carousel-inner">
				<div class="carousel-item active">
					<img src="images/banner1.jpg" class="d-block w-100" alt="...">
					<div class="carousel-caption d-none d-md-block">
						<h5 class="text-white">Neuroemprendimiento</h5>
						<p class="text-white">
							Para que frente a las demás opciones de igual o similar característica a la tuya, sepas como inspirar adecuadamente a la mente de la gente
						</p>
					</div>
				</div>
				<div class="carousel-item">
					<img src="images/banner2.jpg" class="d-block w-100" alt="...">
					<div class="carousel-caption d-none d-md-block">
						<h5 class="text-dark">Coaching</h5>
						<p class="text-dark">
							Potencia tu autoconocimiento y la perspectiva con la que observas tu entorno. Fortalece tu esencia y la capacidad de llevarlos a la acción para mejorar tu desempeño, lograr un mejor balance y enriquecer tu calidad de vida.
						</p>
					</div>
				</div>
				<div class="carousel-item">
					<img src="images/banner1.jpg" class="d-block w-100" alt="...">
					<div class="carousel-caption d-none d-md-block">
						<h5 class="text-white">Marketing Digital</h5>
						<p class="text-white">
							Adquiere nuevas herramientas y habilidades del Marketing Digital para aplicarlas en tus objetivos profesionales y personales hoy. Recibirás orientación directa de nuestros expertos profesores.
						</p>
					</div>
				</div>
				<div class="carousel-item">
					<img src="images/banner2.jpg" class="d-block w-100" alt="...">
					<div class="carousel-caption d-none d-md-block">
						<h5 class="text-dark">Coaching</h5>
						<p class="text-dark">
							Potencia tu autoconocimiento y la perspectiva con la que observas tu entorno. Fortalece tu esencia y la capacidad de llevarlos a la acción para mejorar tu desempeño, lograr un mejor balance y enriquecer tu calidad de vida.
						</p>
					</div>
				</div>
			</div>
			<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
			<div class="card"></div>
		</div>
	</div>

	<div class="container my-2">
		<div class="content">
			<!-- Seccion diplomados -->
			<div class="content-top">
				<h2 class="future">Diplomados</h2>
				<div class="row content-top-in">
					<div class="col-12 my-3 my-lg-0 col-md-6 col-lg-3">
						<div class="col-md">
							<a href="p1.php?ref=<?=$ref?>"><img src="images/pi1.jpg" alt="" /></a>
							<div class="top-content">
								<h5><a href="p1.php?ref=<?=$ref?>">Coaching Personal</a></h5>
								<div class="white">
									<a href="p1.php?ref=<?=$ref?>" class="hvr-shutter-in-vertical hvr-shutter-in-vertical2 ">
										Conoce más
									</a>
									<p class="dollar"><span class="in-dollar">$</span><span>9</span><span>9</span></p>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-12 my-3 my-lg-0 col-md-6 col-lg-3">
						<div class="col-md">
							<a href="p2.php?ref=<?=$ref?>"><img src="images/pi2.jpg" alt="network-marketing" /></a>
							<div class="top-content">
								<h5><a href="p2.php?ref=<?=$ref?>">Network Marketing</a></h5>
								<div class="white">
									<a href="p2.php?ref=<?=$ref?>" class="hvr-shutter-in-vertical hvr-shutter-in-vertical2 ">
										Conoce más
									</a>
									<p class="dollar"><span class="in-dollar">$</span><span>9</span><span>9</span></p>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-12 my-3 my-lg-0 col-md-6 col-lg-3">
						<div class="col-md">
							<a href="p3.php?ref=<?=$ref?>"><img src="images/pi3.jpg" alt="" /></a>
							<div class="top-content">
								<h5><a href="p3.php?ref=<?=$ref?>">Marketing Digital</a></h5>
								<div class="white">
									<a href="p3.php?ref=<?=$ref?>" class="hvr-shutter-in-vertical hvr-shutter-in-vertical2 ">
										Conoce más
									</a>
									<p class="dollar"><span class="in-dollar">$</span><span>9</span><span>9</span></p>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-12 my-3 my-lg-0 col-md-6 col-lg-3">
						<div class="col-md">
							<a href="p4.php?ref=<?=$ref?>"><img src="images/pi4.jpg" alt="" /></a>
							<div class="top-content">
								<h5><a href="p4.php?ref=<?=$ref?>"">Marca Personal</a></h5>
								<div class="white">
									<a href="p4.php?ref=<?=$ref?>" class="hvr-shutter-in-vertical hvr-shutter-in-vertical2 ">
										Conoce más
									</a>
									<p class="dollar"><span class="in-dollar">$</span><span>9</span><span>9</span></p>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<?php include_once('includes/cursos-recomendados.php'); ?>
			<div class="container-fluid">
				<ul class="start">
					<li><a href="#"><i></i></a></li>
					<li><span>1</span></li>
					<li class="arrow"><a href="#">2</a></li>
					<li class="arrow"><a href="#">3</a></li>
					<li class="arrow"><a href="#">4</a></li>
					<li class="arrow"><a href="#">5</a></li>
					<li><a href="#"><i class="next"> </i></a></li>
				</ul>
			</div>
		</div>
	</div>


<?php include_once('includes/footer.php'); ?>