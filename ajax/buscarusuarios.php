<?php
include "../config/conection.php";
check_admin();
$busq = clear($busq);
?>
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
$s = mysqli_query($connection,"SELECT * FROM datosdeusuarios WHERE campo_primer_nombre LIKE '%$busq%' OR campo_primer_apellido LIKE '%$busq%' OR campo_segundo_nombre LIKE '%$busq%' OR campo_segundo_apellido LIKE '%$busq%' OR nvirtual LIKE '%$busq%' OR correo LIKE '%$busq%'");

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
		<td><?=$billetera?> $</td>
		<td><?=$r['telefono']?></td>
		<td><a href="?p=transladar_fondos_admin&nvirtual=<?=$r['nvirtual']?>" data-toggle="tooltip" data-placement="top" title="Transladar Fondos"><i class="fa fa-sign-out"></i></a></td>
	</tr>
	<?php
}
?>
</table>