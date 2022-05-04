<?php 
include "../config/conection.php";

$s = mysqli_query($connection,"SELECT * FROM datosdeusuarios WHERE nvirtual = '".$_SESSION['nvirtual']."'");
$r = mysqli_fetch_array($s);
?>
<section class="content">

<div class="row">
	<div class="col-lg-3 col-xs-4">

	<div class="box box-primary" style="min-width:120px;max-width:220px;">
		<div class="box-header">
			<h4 class="box-title"><i class="fa fa-calendar"></i> Fechas</h4>
		</div>
		
		<div class="box-body">
			<span style="color:#048"><?=fecha($r['fecharegistro'])?></span><i class="fa fa-question-circle pull-right" data-toggle="tooltip" data-placement="top" title="Fecha de registro"></i><br>
			<?php
			if($r['vence']=="0000-00-00"){
				echo "<i style='color:#048'>Ninguna</i>";
			}else{
				?>
			<span style="color:#048"><?=fecha($r['vence'])?></span>
			<?php
			}
			?>
			<i class="fa fa-question-circle pull-right" data-toggle="tooltip" data-placement="top" title="Proximo Pago"></i>
		</div>
	</div>

	</div>



		<div class="col-lg-2 col-xs-4" style="width:300px;">

	<div class="box box-primary" style="min-width:120px;max-width:220px;">
		<div class="box-header">
			<h4 class="box-title"><i class="fa fa-check"></i> Condicion</h4>
		</div>
			
		<?php
		$activo = esta_activo($_SESSION['nvirtual']);
		$calificado = esta_calificado($_SESSION['nvirtual']);

		if($activo){
			$colora = "green";
		}else{
			$colora = "red";
		}

		if($calificado){
			$colorc = "green";
		}else{
			$colorc = "red";
		}

		?>

		<div class="box-body" style="margin:0">
			Activo <i class="fa fa-circle text-<?=$colora?>"></i><br>
			Calificado <i class="fa fa-circle text-<?=$colorc?>"></i><br>
		</div>
	</div>

	</div>
<!--
	<div class="col-lg-2 col-xs-6">
<a href="http://diplomados.promoliderinternacional.com/wp/" target="_blank">
		<img data-toggle="tooltip" data-placement="bottom" title="Mis Diplomados" src="img/birrete.png" style="max-width:150px;position:relative;bottom:15px;cursor:pointer;"/>
</a>
	</div>
	-->

	<div class="col-lg-2 col-xs-4" style="width:300px;">
		<div class="box box-primary" style="min-width:120px;max-width:220px;">
		<div class="box-header">
			<h4 class="box-title"> Afiliación</h4>
		</div>
		
		<div class="box-body" style="margin:0">
		<?php
		$sdu = mysqli_query($connection,"SELECT * FROM calificados WHERE nvirtual = '".$_SESSION['nvirtual']."'");
		if(mysqli_num_rows($sdu)==0){
			$afiliacion_conectado = "Gratuito";
		}else{
			$rdu = mysqli_fetch_array($sdu);
			$saa = mysqli_query($connection,"SELECT * FROM afiliaciones WHERE id = '".$rdu['calificacion']."'");
			$raa = mysqli_fetch_array($saa);
			$afiliacion_conectado = $raa['nombre'];
		}
		?>
			<?=$afiliacion_conectado?><br>
			&nbsp;
		</div>
	</div>

	</div>

<!--
	<div class="col-lg-3 col-xs-6">
		<div class="box box-primary" style="min-width:120px;max-width:220px;">
		<div class="box-header">
			<h4 class="box-title"><i class="fa fa-trophy"></i> Rango</h4>
		</div>
		
		<div class="box-body" style="position:relative;">
			<img src="img/oro.png" class="img-circle" style="width:75px;height:75px;position:absolute;top:-18px;right:26%;"/>
			&nbsp;<br>&nbsp;
		</div>
	</div>

	</div>

	-->
</div>
</section>

<hr>
<section class="content invoice" style="position:relative;">


<section style="position:absolute;left:8px;top:75px;">
Ajuste de pierna<br>
<?php
                                        if(pierna($_SESSION['nvirtual'])==1){
                                            ?>
                                                <button class="btn btn-flat btn-primary" onclick="ajustar_pierna(1);" id="btnizquierda">Izquierda</button><button id="btnderecha" onclick="ajustar_pierna(2);" class="btn btn-flat btn-default">Derecha</button>
                                            <?php
                                        }else{
                                            ?>
                                                <button class="btn btn-flat btn-default" onclick="ajustar_pierna(1);" id="btnizquierda">Izquierda</button><button id="btnderecha" onclick="ajustar_pierna(2);" class="btn btn-flat btn-primary">Derecha</button>
                                            <?php
                                        }
                                        ?>
</section>

<section style="position:absolute;right:5px;top:5px;">

		<div class="box box-solid box-black text-white" style="background:#000">
		<div class="box-header" style="color:#fff">
			&nbsp; <small> Bono de Crecimiento</small>
			<br>
			<center style="font-size:18px;font-weight:bold;"><?=bono_crecimiento($_SESSION['nvirtual'])?> $</center>
		</div>
	</div>
</section>

<section style="position:absolute;right:138px;top:5px;">

		<div class="box box-solid box-black text-white" style="background:black;color:#fff;min-width:120px;max-width:220px;" >
		<div class="box-header" style="color:#fff">
			&nbsp; &nbsp; &nbsp; &nbsp;<small> Bono de Inicio</small>
			<br>
			<center style="font-size:18px;font-weight:bold;"><?=bono_inicio($_SESSION['nvirtual'])?> $</center>
			
		</div>
	</div>
</section>

<section style="position:absolute;right:559px;top:5px;">

		<div class="box box-solid box-black text-white" style="background:black;min-width:120px;max-width:220px;">
		<div class="box-header" style="color:#fff">
			&nbsp; <small> Bono de Efectivo R&aacute;pido</small>
			<br>
			<center>
			<span style="font-size:18px;">
			<?php
			$s = mysqli_query($connection,"SELECT * FROM cont_ber WHERE nvirtual = '".$_SESSION['nvirtual']."'");
			$r = mysqli_fetch_array($s);
			if($r['monto']==""){
			echo "0 $";
			}else{
				echo $r['monto'];
			}
			?>
			</span>
			</center>
		</div>
	</div>
</section>

<section style="position:absolute;right:430px;top:5px;">
	<div class="box box-solid box-black" style="background:#000;color:#fff;min-width:120px;max-width:220px;">
	<div class="box-header" style="color:#fff">
		&nbsp; &nbsp; &nbsp; <small> Bono Mercadeo</small>
		<br>
		<center>
		<span style="font-size:18px;">
		<?php
		$sbm = mysqli_query($connection,"SELECT * FROM log_mer WHERE nvirtual = '".$_SESSION['nvirtual']."'");
		if(mysqli_num_rows($sbm)>0){
			$rbm = mysqli_fetch_array($sbm);
			echo $rbm['cant'];
		}else{
			echo "0 $";
		}
		?>
		</span>
		</center>
	</div>
	</div>
</section>

<section style="position:absolute;right:268px;top:5px;">
	<div class="box box-solid box-black" style="background:black;min-width:120px;max-width:220px;">
	<div class="box-header" style="color:#fff">
		&nbsp; <small> Bono Mercadeo Residual</small>
		<br>
		<center>
		<span style="font-size:18px;">
		<?php
		$sbmr = mysqli_query($connection,"SELECT * FROM log_merr WHERE nvirtual = '".$_SESSION['nvirtual']."'");
		if(mysqli_num_rows($sbmr)>0){
			$rbmr = mysqli_fetch_array($sbmr);
			echo $rbmr['cant'];
		}else{
			echo "0 $";
		}
		?>
		</span>
		</center>
	</div>
	</div>
</section>

<marquee style="position:absolute;top:-50px;font-size:25px;font-weight:bold;color:red;">
<?php
$smsj = mysqli_query($connection,"SELECT * FROM mensaje WHERE estado = 1 ORDER BY fecha DESC");

while($rmsj=mysqli_fetch_array($smsj)){
?>
<?=$rmsj['mensaje']?>
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
<?php
}
?>
</marquee>

<h3><a target="_blank" data-toggle="tooltip" data-placement="top" title="Click para ampliar" href="./arboluninivel.php"><i class="fa fa-sitemap"></i> Arbol Uninivel<br></a></h3>
<hr>
<center>
<section style="top:50px;display:inline-block;width:100px;border-top:2px solid #aaa;height:80px;border-left:2px solid #aaa;position:relative;"></section>
<?php
$su = mysqli_query($connection,"SELECT * FROM datosdeusuarios WHERE nvirtual = '".$_SESSION['nvirtual']."'");
$ru = mysqli_fetch_array($su);
$binario = $ru['nvirtual'];
if(file_exists("img/avatares/".$binario.".jpg")){
	?>
		 <img src="img/avatares/<?=$binario?>.jpg" data-toggle="tooltip" data-placement="bottom" title="<?=nombre_apellido_usuario($binario)?>" class="img-circle" alt="User Image" style="width:120px;height:120px;" />

	<?php
}else{
	?>
	 	<img src="img/avatares/0.png" data-toggle="tooltip" data-placement="bottom" title="<?=nombre_apellido_usuario($binario)?>" class="img-circle" alt="User Image" style="width:120px;height:120px;" />
	 <?php
}
?>
<section style="top:50px;display:inline-block;width:100px;border-top:2px solid #aaa;height:80px;border-right:2px solid #aaa;position:relative;"></section>

    <br>
  
   <section style="width:34%;display:inline-block;">
  
	   <?php
	   		$s = mysqli_query($connection,"SELECT * FROM calificados WHERE patrocinador = '".$binario."' AND lado = 1");
	   		$r=mysqli_fetch_array($s);

	   		if(mysqli_num_rows($s)>0){
	   			?>
	   			 <section style="top:50px;display:inline-block;width:30px;border-top:2px solid #aaa;height:50px;border-left:2px solid #aaa;position:relative;"></section>
	   			<?php
	   		
		   		if(file_exists("img/avatares/".$r['nvirtual'].".jpg")){
		   			?>
		   			<a href="#" onclick="ver_user_arbol('<?=$r['nvirtual']?>');">
		   			<img src="img/avatares/<?=$r['nvirtual']?>.jpg" data-toggle="tooltip" data-placement="bottom" title="<?=nombre_apellido_usuario($r['nvirtual'])?>" class="img-circle" alt="User Image" style="width:80px;height:80px"/>
		   			</a>
		   			<?php
		   		}else{
		   			?>
		   			<a href="#" onclick="ver_user_arbol('<?=$r['nvirtual']?>');">
		   			
		   			<img src="img/avatares/0.png" data-toggle="tooltip" data-placement="bottom" title="<?=nombre_apellido_usuario($r['nvirtual'])?>" class="img-circle" alt="User Image" style="width:80px;height:80px"/>
		   			</a>
		   			<?php
		   		}
	   		}

	   		if(mysqli_num_rows($s)>0){
	   ?>
	    <section style="top:50px;display:inline-block;width:30px;border-top:2px solid #aaa;height:50px;border-right:2px solid #aaa;position:relative;"></section>
	    <?php
	}
?>

   </section>
   	&nbsp;
   <section style="width:34%;display:inline-block;">
   <?php
	   		$s2 = mysqli_query($connection,"SELECT * FROM calificados WHERE patrocinador = '".$binario."' AND lado = 2");
	   		$r2=mysqli_fetch_array($s2);

   if(mysqli_num_rows($s2)>0){
    ?>
    <section style="top:50px;display:inline-block;width:30px;border-top:2px solid #aaa;height:50px;border-left:2px solid #aaa;position:relative;"></section>

   	  <?php
   	}
	   		if(mysqli_num_rows($s2)>0){
		   		
		   		if(file_exists("img/avatares/".$r2['nvirtual'].".jpg")){
		   			?>
		   			<a  href="#" onclick="ver_user_arbol('<?=$r2['nvirtual']?>');">
		   			
		   			<img src="img/avatares/<?=$r2['nvirtual']?>.jpg" data-toggle="tooltip" data-placement="bottom" title="<?=nombre_apellido_usuario($r2['nvirtual'])?>" class="img-circle" alt="User Image" style="width:80px;height:80px"/>
		   			
		   			</a>
		   			<?php
		   		}else{
		   			?>
		   			<a  href="#" onclick="ver_user_arbol('<?=$r2['nvirtual']?>');">
		   			
		   			<img src="img/avatares/0.png" data-toggle="tooltip" data-placement="bottom" title="<?=nombre_apellido_usuario($r2['nvirtual'])?>" class="img-circle" alt="User Image" style="width:80px;height:80px"/>
		   			</a>
		   			<?php
		   		}
	   		}
	   		
	   		if(mysqli_num_rows($s2)>0){
	   ?>
 	 <section style="top:50px;display:inline-block;width:30px;border-top:2px solid #aaa;height:50px;border-right:2px solid #aaa;position:relative;"></section>
<?php
}
?>
  
   </section>
   <br><br>




   <section style="width:34%;display:inline-block;">
	   <?php
	   		$s3 = mysqli_query($connection,"SELECT * FROM calificados WHERE patrocinador = '".$r['nvirtual']."' AND lado = 1");
	   		$r3=mysqli_fetch_array($s3);

	   		if(mysqli_num_rows($s3)>0){
	   		
		   		if(file_exists("img/avatares/".$r3['nvirtual'].".jpg")){
		   			?>
		   			<a  href="#" onclick="ver_user_arbol('<?=$r3['nvirtual']?>');">
	   			
		   			<img src="img/avatares/<?=$r3['nvirtual']?>.jpg" data-toggle="tooltip" data-placement="bottom" title="<?=nombre_apellido_usuario($r3['nvirtual'])?>" class="img-circle" alt="User Image" style="width:80px;height:80px"/>
		   			</a>
		   			<?php
		   		}else{
		   			?>
		   			<a  href="#" onclick="ver_user_arbol('<?=$r3['nvirtual']?>');">
	   			
		   			<img src="img/avatares/0.png" data-toggle="tooltip" data-placement="bottom" title="<?=nombre_apellido_usuario($r3['nvirtual'])?>" class="img-circle" alt="User Image" style="width:80px;height:80px"/>
		   			</a>
		   			<?php
		   		}
		   	}else{
		   		echo "<section style='width:80px;display:inline-block;'>&nbsp;</section>";
		   	}

	   		echo " <section style='width:40px;display:inline-block;'></section>";

	   		$s3i = mysqli_query($connection,"SELECT * FROM calificados WHERE patrocinador = '".$r['nvirtual']."' AND lado = 2");
	   		$r3i=mysqli_fetch_array($s3i);

	   		if(mysqli_num_rows($s3i)>0){
		   		
		   		if(file_exists("img/avatares/".$r3i['nvirtual'].".jpg")){
		   			?>
		   			<a  href="#" onclick="ver_user_arbol('<?=$r3i['nvirtual']?>');">
	   			
		   			<img src="img/avatares/<?=$r3i['nvirtual']?>.jpg" data-toggle="tooltip" data-placement="bottom" title="<?=nombre_apellido_usuario($r3i['nvirtual'])?>" class="img-circle" alt="User Image" style="width:80px;height:80px"/>
		   			</a>
		   			<?php
		   		}else{
		   			?>
		   			<a  href="#" onclick="ver_user_arbol('<?=$r3i['nvirtual']?>');">
	   			
		   			<img src="img/avatares/0.png" data-toggle="tooltip" data-placement="bottom" title="<?=nombre_apellido_usuario($r3i['nvirtual'])?>" class="img-circle" alt="User Image" style="width:80px;height:80px"/>
		   			</a>
		   			<?php
		   		}
	   		}else{
	   			echo "<section style='width:80px;display:inline-block;'>&nbsp;</section>";
	   		}

	   ?>
   </section>




   	&nbsp;




   <section style="width:34%;display:inline-block;">
   	  <?php
	   		$s4 = mysqli_query($connection,"SELECT * FROM calificados WHERE patrocinador = '".$r2['nvirtual']."' AND lado = 1");
	   		$r4=mysqli_fetch_array($s4);

	   		if(mysqli_num_rows($s4)>0){
	   		
		   		if(file_exists("img/avatares/".$r4['nvirtual'].".jpg")){
		   			?>
		   			<a  href="#" onclick="ver_user_arbol('<?=$r4['nvirtual']?>');">
	   			
		   			<img src="img/avatares/<?=$r4['nvirtual']?>.jpg" data-toggle="tooltip" data-placement="bottom" title="<?=nombre_apellido_usuario($r4['nvirtual'])?>" class="img-circle" alt="User Image" style="width:80px;height:80px"/>
		   			</a>
		   			<?php
		   		}else{
		   			?>
		   			<a  href="#" onclick="ver_user_arbol('<?=$r4['nvirtual']?>');">
	   			
		   			<img src="img/avatares/0.png" data-toggle="tooltip" data-placement="bottom" title="<?=nombre_apellido_usuario($r4['nvirtual'])?>" class="img-circle" alt="User Image" style="width:80px;height:80px"/>
		   			</a>
		   			<?php
		   		}
		   	}else{
		   		echo "<section style='width:80px;display:inline-block;'>&nbsp;</section>";
		   	}

			echo " <section style='width:40px;display:inline-block;'></section>";
	   	

	   		$s4i = mysqli_query($connection,"SELECT * FROM calificados WHERE patrocinador = '".$r2['nvirtual']."' AND lado = 2");
	   		
	   		$r4i=mysqli_fetch_array($s4i);

	   		if(mysqli_num_rows($s4i)>0){
		   		
		   		if(file_exists("img/avatares/".$r4i['nvirtual'].".jpg")){
		   			?>
		   			<a  href="#" onclick="ver_user_arbol('<?=$r4i['nvirtual']?>');">
	   			
		   			<img src="img/avatares/<?=$r4i['nvirtual']?>.jpg" data-toggle="tooltip" data-placement="bottom" title="<?=nombre_apellido_usuario($r4i['nvirtual'])?>" class="img-circle" alt="User Image" style="width:80px;height:80px"/>
		   			</a>
		   			<?php
		   		}else{
		   			?>
		   			<a  href="#" onclick="ver_user_arbol('<?=$r4i['nvirtual']?>');">
	   			
		   			<img src="img/avatares/0.png" data-toggle="tooltip" data-placement="bottom" title="<?=nombre_apellido_usuario($r4i['nvirtual'])?>" class="img-circle" alt="User Image" style="width:80px;height:80px"/>
		   			</a>
		   			<?php
		   		}
	   		}else{
	   			echo "<section style='width:80px;display:inline-block;'>&nbsp;</section>";
	   		}	
	   ?>
   </section>



</center>
</section>
<center>
<button class="btn btn-primary" data-toggle="modal" data-target="#compose-modal" onclick="volumenizquierdo_conectado();">
Volumen Izquierdo
</button>
<button class="btn btn-success" title="Directos Izquierdos" data-toggle="modal" data-target="#compose-modal" onclick="directosizquierda_conectado();">
<i class="fa fa-users"></i>
</button>

<section style="width:170px;display:inline-block;">
	&nbsp;
</section>

<button class="btn btn-success" title="Directos Derechos" data-toggle="modal" data-target="#compose-modal" onclick="directosderecho_conectado();">
<i class="fa fa-users"></i>
</button>
<button class="btn btn-primary" data-toggle="modal" data-target="#compose-modal" onclick="volumenderecho_conectado();">
Volumen Derecho
</button>
</center>
<br><br>