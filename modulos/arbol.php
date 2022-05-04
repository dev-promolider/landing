<?php
check_conectado();

if(!isset($binario)){
	$binario = $_SESSION['nvirtual'];
}

?>
<h3 style="background:#000;color:white;padding:20px;border-radius:4px;"><i class="fa fa-sitemap"></i> Arbol Binario</h3><hr>
<center>
<div style="flex-wrap:wrap;display:flex;justify-content:center;">
<section style="top:110px;left:60px;display:inline-block;max-width:100px;height:80px;border-left:2px solid #aaa;transform:rotate(45deg);position:relative;flex:1;"></section>
<?php
$su = mysqli_query($connection, "SELECT * FROM datosdeusuarios WHERE nvirtual = '".$_SESSION['nvirtual']."'");
$ru = mysqli_fetch_array($su);
$binario = $ru['nvirtual'];
if(file_exists("img/avatares/".$binario.".jpg")){
	?>
		 <img src="img/avatares/<?=$binario?>.jpg" data-toggle="tooltip" data-placement="bottom" title="<?=nombre_apellido_usuario($binario)?>" class="img-circle" alt="User Image" style="max-width:120px;height:120px;flex:1;" />

	<?php
}else{
	?>
	 	<img src="img/avatares/0.png" data-toggle="tooltip" data-placement="bottom" title="<?=nombre_apellido_usuario($binario)?>" class="img-circle" alt="User Image" style="max-width:120px;height:120px;flex:1;" />
	 <?php
}
?>
<section style="top:110px;left:-60px;display:inline-block;max-width:100px;height:80px;border-right:2px solid #aaa;transform:rotate(-45deg);position:relative;flex:1;"></section>
</div>
    <br>
<div style="flex-wrap:wrap;display:flex;justify-content:center;">
	   <?php
	   		$s = mysqli_query($connection, "SELECT * FROM calificados WHERE patrocinador = '".$binario."' AND lado = 1");
	   		$r=mysqli_fetch_array($s);

	   		if(mysqli_num_rows($s)>0){
	   			?>
	   		<section style="top:80px;left:20px;display:inline-block;max-width:30px;height:50px;border-left:2px solid #aaa;transform:rotate(35deg);position:relative;flex:1;"></section>
	   			<?php

		   		if(file_exists("img/avatares/".$r['nvirtual'].".jpg")){
		   			?>
		   			<a href="#" onclick="ver_user_arbol('<?=$r['nvirtual']?>');">
		   			<img src="img/avatares/<?=$r['nvirtual']?>.jpg" data-toggle="tooltip" data-placement="bottom" title="<?=nombre_apellido_usuario($r['nvirtual'])?>" class="img-circle" alt="User Image" style="max-width:80px;height:80px;flex:1;"/>
		   			</a>
		   			<?php
		   		}else{
		   			?>
		   			<a href="#" onclick="ver_user_arbol('<?=$r['nvirtual']?>');">

		   			<img src="img/avatares/0.png" data-toggle="tooltip" data-placement="bottom" title="<?=nombre_apellido_usuario($r['nvirtual'])?>" class="img-circle" alt="User Image" style="max-width:80px;height:80px;flex:1;"/>
		   			</a>
		   			<?php
		   		}
	   		}

	   		if(mysqli_num_rows($s)>0){
	   ?>
	    <section style="top:80px;left:-20px;display:inline-block;max-width:30px;height:50px;border-right:2px solid #aaa;transform:rotate(-35deg);position:relative;flex:1;"></section>
	    <?php
	}
?>
   	&nbsp;
    <section style='max-width:170px;flex:1;'></section>
   <?php
	   		$s2 = mysqli_query($connection, "SELECT * FROM calificados WHERE patrocinador = '".$binario."' AND lado = 2");
	   		$r2=mysqli_fetch_array($s2);

   if(mysqli_num_rows($s2)>0){
    ?>
    <section style="top:80px;left:20px;display:inline-block;max-width:30px;height:50px;border-left:2px solid #aaa;transform:rotate(35deg);position:relative;flex:1;"></section>

   	  <?php
   	}
	   		if(mysqli_num_rows($s2)>0){

		   		if(file_exists("img/avatares/".$r2['nvirtual'].".jpg")){
		   			?>
		   			<a  href="#" onclick="ver_user_arbol('<?=$r2['nvirtual']?>');">

		   			<img src="img/avatares/<?=$r2['nvirtual']?>.jpg" data-toggle="tooltip" data-placement="bottom" title="<?=nombre_apellido_usuario($r2['nvirtual'])?>" class="img-circle" alt="User Image" style="max-width:80px;height:80px;flex:1;"/>

		   			</a>
		   			<?php
		   		}else{
		   			?>
		   			<a  href="#" onclick="ver_user_arbol('<?=$r2['nvirtual']?>');">

		   			<img src="img/avatares/0.png" data-toggle="tooltip" data-placement="bottom" title="<?=nombre_apellido_usuario($r2['nvirtual'])?>" class="img-circle" alt="User Image" style="max-width:80px;height:80px;flex:1;"/>
		   			</a>
		   			<?php
		   		}
	   		}

	   		if(mysqli_num_rows($s2)>0){
	   ?>
 	 <section style="top:80px;left:-20px;display:inline-block;max-width:30px;height:50px;border-right:2px solid #aaa;transform:rotate(-35deg);position:relative;flex:1;"></section>
<?php
}
?>
</div>
   <br><br>

<div style="flex-wrap:wrap;display:flex;justify-content:center;">
	   <?php
	   		$s3 = mysqli_query($connection, "SELECT * FROM calificados WHERE patrocinador = '".$r['nvirtual']."' AND lado = 1");
	   		$r3=mysqli_fetch_array($s3);

	   		if(mysqli_num_rows($s3)>0){

		   		if(file_exists("img/avatares/".$r3['nvirtual'].".jpg")){
		   			?>
		   			<a  href="#" onclick="ver_user_arbol('<?=$r3['nvirtual']?>');">

		   			<img src="img/avatares/<?=$r3['nvirtual']?>.jpg" data-toggle="tooltip" data-placement="bottom" title="<?=nombre_apellido_usuario($r3['nvirtual'])?>" class="img-circle" alt="User Image" style="max-width:80px;height:80px;flex:1;"/>
		   			</a>
		   			<?php
		   		}else{
		   			?>
		   			<a  href="#" onclick="ver_user_arbol('<?=$r3['nvirtual']?>');">

		   			<img src="img/avatares/0.png" data-toggle="tooltip" data-placement="bottom" title="<?=nombre_apellido_usuario($r3['nvirtual'])?>" class="img-circle" alt="User Image" style="max-width:80px;height:80px;flex:1;"/>
		   			</a>
		   			<?php
		   		}
		   	}else{
		   		echo "<section style='max-width:80px;display:inline-block;flex:1;'>&nbsp;</section>";
		   	}

	   		echo " <section style='max-width:40px;display:inline-block;flex:1;'></section>";

	   		$s3i = mysqli_query($connection, "SELECT * FROM calificados WHERE patrocinador = '".$r['nvirtual']."' AND lado = 2");
	   		$r3i=mysqli_fetch_array($s3i);

	   		if(mysqli_num_rows($s3i)>0){

		   		if(file_exists("img/avatares/".$r3i['nvirtual'].".jpg")){
		   			?>
		   			<a  href="#" onclick="ver_user_arbol('<?=$r3i['nvirtual']?>');">

		   			<img src="img/avatares/<?=$r3i['nvirtual']?>.jpg" data-toggle="tooltip" data-placement="bottom" title="<?=nombre_apellido_usuario($r3i['nvirtual'])?>" class="img-circle" alt="User Image" style="max-width:80px;height:80px;flex:1;"/>
		   			</a>
		   			<?php
		   		}else{
		   			?>
		   			<a  href="#" onclick="ver_user_arbol('<?=$r3i['nvirtual']?>');">

		   			<img src="img/avatares/0.png" data-toggle="tooltip" data-placement="bottom" title="<?=nombre_apellido_usuario($r3i['nvirtual'])?>" class="img-circle" alt="User Image" style="max-width:80px;height:80px;flex:1;"/>
		   			</a>
		   			<?php
		   		}
	   		}else{
	   			echo "<section style='max-width:80px;display:inline-block;flex:1;'>&nbsp;</section>";
	   		}

	   ?>

   	&nbsp;
    <section style='max-width:120px;flex:1;'></section>

   	  <?php
	   		$s4 = mysqli_query($connection, "SELECT * FROM calificados WHERE patrocinador = '".$r2['nvirtual']."' AND lado = 1");
	   		$r4=mysqli_fetch_array($s4);

	   		if(mysqli_num_rows($s4)>0){

		   		if(file_exists("img/avatares/".$r4['nvirtual'].".jpg")){
		   			?>
		   			<a  href="#" onclick="ver_user_arbol('<?=$r4['nvirtual']?>');">

		   			<img src="img/avatares/<?=$r4['nvirtual']?>.jpg" data-toggle="tooltip" data-placement="bottom" title="<?=nombre_apellido_usuario($r4['nvirtual'])?>" class="img-circle" alt="User Image" style="max-width:80px;height:80px;flex:1;"/>
		   			</a>
		   			<?php
		   		}else{
		   			?>
		   			<a  href="#" onclick="ver_user_arbol('<?=$r4['nvirtual']?>');">

		   			<img src="img/avatares/0.png" data-toggle="tooltip" data-placement="bottom" title="<?=nombre_apellido_usuario($r4['nvirtual'])?>" class="img-circle" alt="User Image" style="max-width:80px;height:80px;flex:1;"/>
		   			</a>
		   			<?php
		   		}
		   	}else{
		   		echo "<section style='max-width:80px;display:inline-block;flex:1;'>&nbsp;</section>";
		   	}

			echo " <section style='max-width:40px;display:inline-block;flex:1;'></section>";

	   		$s4i = mysqli_query($connection, "SELECT * FROM calificados WHERE patrocinador = '".$r2['nvirtual']."' AND lado = 2");

	   		$r4i=mysqli_fetch_array($s4i);

	   		if(mysqli_num_rows($s4i)>0){

		   		if(file_exists("img/avatares/".$r4i['nvirtual'].".jpg")){
		   			?>
		   			<a  href="#" onclick="ver_user_arbol('<?=$r4i['nvirtual']?>');">

		   			<img src="img/avatares/<?=$r4i['nvirtual']?>.jpg" data-toggle="tooltip" data-placement="bottom" title="<?=nombre_apellido_usuario($r4i['nvirtual'])?>" class="img-circle" alt="User Image" style="max-width:80px;height:80px;flex:1;"/>
		   			</a>
		   			<?php
		   		}else{
		   			?>
		   			<a  href="#" onclick="ver_user_arbol('<?=$r4i['nvirtual']?>');">

		   			<img src="img/avatares/0.png" data-toggle="tooltip" data-placement="bottom" title="<?=nombre_apellido_usuario($r4i['nvirtual'])?>" class="img-circle" alt="User Image" style="max-width:80px;height:80px;flex:1;"/>
		   			</a>
		   			<?php
		   		}
	   		}else{
	   			echo "<section style='max-width:80px;display:inline-block;flex:1;'>&nbsp;</section>";
	   		}
	   ?>

</div>
</center>
<br>

<?php
if(isset($binario) && $binario != $_SESSION['nvirtual']){
	$sa = mysqli_query($connection,"SELECT * FROM calificados WHERE nvirtual = '$binario'");
	$ra = mysqli_fetch_array($sa);
	$anterior = $ra['patrocinador_binario'];
	echo "<buttom class='btn btn-success' onclick='window.location=\"?p=arbol\";'><i class='fa fa-reply'></i> Regresar a mi Arbol</buttom>";
	echo "&nbsp;";
	echo "<buttom class='btn btn-success' onclick='window.location=\"?p=arbol&binario=$anterior\";'><i class='fa fa-chevron-up'></i> Subir un nivel</buttom>";
}
?>
<br><br>

<table class="table table-striped">
<tr>
<th colspan="1000"  class="bg-green"><center><h4>Mis Directos</h4></center></th>
</tr>

	<tr>
		<th>Nombre</th>
		<th>Pierna Afiliacion</th>
		<th>Patrocinador Binario</th>
		<th>Fecha de Inscripcion</th>
		<th>Fecha de Vencimiento</th>
		<th>Activo</th>
		<th>Calificado</th>
	</tr>
<?php
$smd = mysqli_query($connection,"SELECT * FROM datosdeusuarios WHERE patrocinador = '".$_SESSION['nvirtual']."' AND nvirtual != '".$_SESSION['nvirtual']."'");
while($rmd=mysqli_fetch_array($smd)){

$sasa = mysqli_query($connection,"SELECT * FROM calificados WHERE nvirtual = '".$rmd['nvirtual']."'");
$rara = mysqli_fetch_array($sasa);

if($rara['lado']==1){
	$piernaafiliacion = "Izquierda";
}elseif($rara['lado']==2){
	$piernaafiliacion = "Derecha";
}else{
	$piernaafiliacion = "Desconocida";
}
	if(esta_activo($rmd['nvirtual'])){
		$act = "<i class='fa fa-circle text-green'></i>";
	}else{
		$act = "<i class='fa fa-circle text-red'></i>";
	}

	if(esta_calificado($rmd['nvirtual'])){
		$cal = "<i class='fa fa-circle text-green'></i>";
	}else{
		$cal = "<i class='fa fa-circle text-red'></i>";
	}
	?>
	<tr>
		<td><?=nombre_apellido_usuario($rmd['nvirtual'])?></td>
		<td><?=$piernaafiliacion?></td>
		<td><?=nombre_apellido_usuario($rmd['patrocinador_binario'])?></td>
		<td><?=fecha($rmd['fecharegistro'])?></td>
		<td><?=fecha($rmd['vence'])?></td>
		<td><?=$act?></td>
		<td><?=$cal?></td>
	</tr>
	<?php
}
?>
</table>