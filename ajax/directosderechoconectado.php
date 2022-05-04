<?php
include "../config/conection.php";
?>
<table class="table table-striped">
<tr>
<th>Nombre</th>
<th>Fecha de registro</th>
<th>Afiliacion</th>
<th>¿Activo?</th>
<th>¿Calificado?</th>
<th>Fecha de vencimiento</th>
<th>Mensaje</th>
</tr>
<?php
$s = mysqli_query($connection,"SELECT * FROM calificados WHERE patrocinador = '".$_SESSION['nvirtual']."' AND lado = 2");
while($r=mysqli_fetch_array($s)){

	$s2 = mysqli_query($connection,"SELECT * FROM datosdeusuarios WHERE nvirtual = '".$r['nvirtual']."'");
	$r2 = mysqli_fetch_array($s2);

	$sa = mysqli_query($connection,"SELECT * FROM afiliaciones WHERE id = '".$r['calificacion']."'");
	if(mysqli_num_rows($sa)<1){
		$afiliacion = "Gratuita";
	}else{
		$ra = mysqli_fetch_array($sa);
		$afiliacion = $ra['nombre'];
	}

	if(esta_activo($r['nvirtual'])){
		$activo = "<span class='text-green'><i class='fa fa-circle'></i></span>";
	}else{
		$activo = "<span class='text-red'><i class='fa fa-circle'></i></span>";
	}

	if(esta_calificado($r['nvirtual'])){
		$calificado = "<span class='text-green'><i class='fa fa-circle'></i></span>";
	}else{
		$calificado = "<span class='text-red'><i class='fa fa-circle'></i></span>";
	}

	if($r2['vence']=="0000-00-00"){
		$vencimiento = "Sin Afiliacion";
	}else{
		$vencimiento = fecha($r2['vence']);
	}

	?>
	<tr>
	<td><?=nombre_apellido_usuario($r['nvirtual'])?></td>
	<td><?=fecha($r2['fecharegistro'])?></td>
	<td><?=$afiliacion?></td>
	<td><center><?=$activo?></center></td>
	<td><center><?=$calificado?></center></td>
	<td><?=$vencimiento?></td>
	<td>
		<a href="?p=mailbox&em=<?=$r['nvirtual']?>"><i class="fa fa-envelope fa-2x"></i></a>
	</td>
	</tr>
	<?php
}
?>
</table>