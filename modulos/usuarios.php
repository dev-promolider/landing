<?php
check_admin();


if(isset($ver)){

	?>

	<div class="content invoice">
<h3><i class="fa fa-users"></i> Lista de usuarios</h3>
<hr>
<div class="form-group">
<input type="text" class="form-control" placeholder="Escriba el Nombre, apellido, correo o Usuario a buscar" onkeyup="buscarusuario();" id="busqueda"/>
</div>
<section id="listausuarios">
<table class="table table-striped">
<tr>
<th>Usuario</th>
<th>Nombre</th>
<th>Apelido</th>
<th>Correo</th>
<th>Afiliacion</th>
<th>Patrocinador</th>
<th>Vol. Izquierdo</th>
<th>Vol. Derecho</th>
<th>Telefono</th>
<th><i class="fa fa-cog"></i></th>
</tr>

	<?php

if($ver=="activos"){


$s = mysqli_query($connection,"SELECT * FROM datosdeusuarios ORDER BY identificador DESC");

while($r=mysqli_fetch_array($s)){

	$sc = mysqli_query($connection,"SELECT * FROM calificados WHERE nvirtual = '".$r['nvirtual']."'");
	$rc = mysqli_fetch_array($sc);

	$sa = mysqli_query($connection,"SELECT * FROM afiliaciones WHERE id = '".$rc['calificacion']."'");
	$ra = mysqli_fetch_array($sa);

	$afiliacion = $ra['nombre'];

	$tpi=0;
	$spi = mysqli_query($connection,"SELECT * FROM puntos_por_dar WHERE nvirtual = '".$r['nvirtual']."' AND pierna = 1");
	while($rpi=mysqli_fetch_array($spi)){
		$tpi = $tpi + $rpi['puntos'];
	}

	$tpd=0;
	$spd = mysqli_query($connection,"SELECT * FROM puntos_por_dar WHERE nvirtual = '".$r['nvirtual']."' AND pierna = 2");
	while($rpd=mysqli_fetch_array($spd)){
		$tpd = $tpd + $rpd['puntos'];
	}
	
	$sbi = mysqli_query($connection,"SELECT * FROM billetera WHERE nvirtual = '".$r['nvirtual']."'");
	$rbi = mysqli_fetch_Array($sbi);
	$billetera = $rbi['cant'];
	
	if(esta_activo($r['nvirtual'])){
		$color = "green";
		?>
	<tr>
		<td><table><tr><td><i class="fa fa-circle" style="color:<?=$color?>;"></i></td><td>&nbsp; <?=$r['nvirtual']?></td></tr></table></td>
		<td><?=nombre_usuario($r['nvirtual'])?></td>
		<td><?=apellido_usuario($r['nvirtual'])?></td>
		<td><?=$r['correo']?></td>
		<td><?=$afiliacion?></td>
		<td><span data-toggle="tooltip" data-placement="top" ttle="<?=nombre_apellido_usuario($r['patrocinador'])?>"><?=$r['patrocinador']?></span></td>
		<td><center><?=$tpi?></center></td>
		<td><center><?=$tpd?></center></td>
		<td><?=$r['telefono']?></td>
		<td><a href="?p=transladar_fondos_admin&nvirtual=<?=$r['nvirtual']?>" data-toggle="tooltip" data-placement="top" title="Transladar Fondos"><i class="fa fa-sign-out"></i></a></td>
	</tr>
		<?php
	}
}
?>
</table>
<section id="listausuarios">
<?php

}

if($ver=="inactivos"){


$s = mysqli_query($connection,"SELECT * FROM datosdeusuarios ORDER BY identificador DESC");

while($r=mysqli_fetch_array($s)){

	$sc = mysqli_query($connection,"SELECT * FROM calificados WHERE nvirtual = '".$r['nvirtual']."'");
	$rc = mysqli_fetch_array($sc);

	$sa = mysqli_query($connection,"SELECT * FROM afiliaciones WHERE id = '".$rc['calificacion']."'");
	$ra = mysqli_fetch_array($sa);

	$afiliacion = $ra['nombre'];

	$tpi=0;
	$spi = mysqli_query($connection,"SELECT * FROM puntos_por_dar WHERE nvirtual = '".$r['nvirtual']."' AND pierna = 1");
	while($rpi=mysqli_fetch_array($spi)){
		$tpi = $tpi + $rpi['puntos'];
	}

	$tpd=0;
	$spd = mysqli_query($connection,"SELECT * FROM puntos_por_dar WHERE nvirtual = '".$r['nvirtual']."' AND pierna = 2");
	while($rpd=mysqli_fetch_array($spd)){
		$tpd = $tpd + $rpd['puntos'];
	}
	
	$sbi = mysqli_query($connection,"SELECT * FROM billetera WHERE nvirtual = '".$r['nvirtual']."'");
	$rbi = mysqli_fetch_Array($sbi);
	$billetera = $rbi['cant'];
	
	if(!esta_activo($r['nvirtual'])){
		$color = "red";
		?>
	<tr>
		<td><table><tr><td><i class="fa fa-circle" style="color:<?=$color?>;"></i></td><td>&nbsp; <?=$r['nvirtual']?></td></tr></table></td>
		<td><?=nombre_usuario($r['nvirtual'])?></td>
		<td><?=apellido_usuario($r['nvirtual'])?></td>
		<td><?=$r['correo']?></td>
		<td><?=$afiliacion?></td>
		<td><span data-toggle="tooltip" data-placement="top" ttle="<?=nombre_apellido_usuario($r['patrocinador'])?>"><?=$r['patrocinador']?></span></td>
		<td><center><?=$tpi?></center></td>
		<td><center><?=$tpd?></center></td>
		<td>S/.<?=$billetera?></td>
		<td><?=$r['telefono']?></td>
		<td><a href="?p=transladar_fondos_admin&nvirtual=<?=$r['nvirtual']?>" data-toggle="tooltip" data-placement="top" title="Transladar Fondos"><i class="fa fa-sign-out"></i></a></td>
	</tr>
		<?php
	}
}

?>
</table>
<section id="listausuarios">
<?php

}














}else{

?>
<div class="content invoice">
<h3><i class="fa fa-users"></i> Lista de usuarios</h3>
<hr>
<div class="form-group">
<input type="text" class="form-control" placeholder="Escriba el Nombre, apellido, correo o Usuario a buscar" onkeyup="buscarusuario();" id="busqueda"/>
</div>
<section id="listausuarios">
<table class="table table-striped">
<tr>
<th>Usuario</th>
<th>Nombre</th>
<th>Apelido</th>
<th>Correo</th>
<th>Afiliacion</th>
<th>Patrocinador</th>
<th>Vol. Izquierdo</th>
<th>Vol. Derecho</th>
<th>Billetera</th>
<th>Telefono</th>
<th><i class="fa fa-cog"></i></th>
</tr>
<?php


if(!isset($pag)){
	$pag=1;
}
$pv = $pag;

$pag--;

if($pag!=0){
	$pag = $pag * 15;
}

$sptotal = mysqli_query($connection,"SELECT * FROM datosdeusuarios");

$s = mysqli_query($connection,"SELECT * FROM datosdeusuarios ORDER BY identificador DESC LIMIT $pag,15");

$total = mysqli_num_rows($sptotal) / 15;

while($r=mysqli_fetch_array($s)){

	$sc = mysqli_query($connection,"SELECT * FROM calificados WHERE nvirtual = '".$r['nvirtual']."'");
	$rc = mysqli_fetch_array($sc);

	$sa = mysqli_query($connection,"SELECT * FROM afiliaciones WHERE id = '".$rc['calificacion']."'");
	$ra = mysqli_fetch_array($sa);

	$afiliacion = $ra['nombre'];

	$tpi=0;
	$spi = mysqli_query($connection,"SELECT * FROM puntos_por_dar WHERE nvirtual = '".$r['nvirtual']."' AND pierna = 1");
	while($rpi=mysqli_fetch_array($spi)){
		$tpi = $tpi + $rpi['puntos'];
	}

	$tpd=0;
	$spd = mysqli_query($connection,"SELECT * FROM puntos_por_dar WHERE nvirtual = '".$r['nvirtual']."' AND pierna = 2");
	while($rpd=mysqli_fetch_array($spd)){
		$tpd = $tpd + $rpd['puntos'];
	}
	
	$sbi = mysqli_query($connection,"SELECT * FROM billetera WHERE nvirtual = '".$r['nvirtual']."'");
	$rbi = mysqli_fetch_Array($sbi);
	$billetera = $rbi['cant'];
	
	if(esta_activo($r['nvirtual'])){
		$color = "green";
	}else{
		$color = "red";
	}
	
	
	

	?>
	<tr>
		<td><table><tr><td><i class="fa fa-circle" style="color:<?=$color?>;"></i></td><td>&nbsp; <?=$r['nvirtual']?></td></tr></table></td>
		<td><?=nombre_usuario($r['nvirtual'])?></td>
		<td><?=apellido_usuario($r['nvirtual'])?></td>
		<td><?=$r['correo']?></td>
		<td><?=$afiliacion?></td>
		<td><span data-toggle="tooltip" data-placement="top" ttle="<?=nombre_apellido_usuario($r['patrocinador'])?>"><?=$r['patrocinador']?></span></td>
		<td><center><?=$tpi?></center></td>
		<td><center><?=$tpd?></center></td>
		<td>S/. <?=$billetera?></td>
		<td><?=$r['telefono']?></td>
		<td><a href="?p=transladar_fondos_admin&nvirtual=<?=$r['nvirtual']?>" data-toggle="tooltip" data-placement="top" title="Transladar Fondos"><i class="fa fa-sign-out"></i></a></td>
	</tr>
	<?php
}
?>
</table>
<section id="listausuarios">

<style type="text/css">
	#btn{
		background: #fff;
		padding:3px;
		border:1px solid #07a;
	}
	#btn:hover{
		background: #07a;
		color:#fff;
	}
	.activado{
		background: #07a;
		color:#fff;
	}
</style>
<center>
<?php
if(isset($pag)){
	if($pv==1){
		$pagmenos=1;
	}else{
		$pagmenos = $pv-1;
	}

	if($pv<$total){
		$pagsig = $pv+1;
	}else{
		$pagsig=$total;
	}
}
?>
<nav>
<ul class="pagination pagination-sm">
<li>
<a href="?p=usuarios&pag=<?=$pagmenos?>" arial-label="Anterior">
<span arial-hidden="true">&laquo;</span>
</a>

<?php

for($a=1;$a<=$total;$a++){
	?>
		<li  <?php if($pv==$a){ ?> class="active"	<?php } ?>>
			<a href='?p=usuarios&pag=<?=$a?>'><?=$a?> </a>
		  </li>
	<?php
}
?>
<li>
<a href="?p=usuarios&pag=<?=$pagsig?>" arial-label="Siguiente">
<span arial-hidden="true">&raquo;</span>
</a>
</li>
</ul>
</nav>
</center>
</div>
<?php
}
?>