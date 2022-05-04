<?php

	check_admin();
	@include_once("../config/conection.php");

	
?>
<h1><i class="fa fa-money"></i> Lista de Bono de Inicio</h1>
<br>
<table class="table table-striped">
<tr>
<th>Usuario</th>
<th>Nombre</th>
<th>Monto</th>
<th>Fecha</th>
</tr>
<?php
$s = mysqli_query($connection,"SELECT * FROM calificados WHERE bono_inicio > 0");
while($r=mysqli_fetch_array($s)){
	$su = mysqli_query($connection,"SELECT * FROM datosdeusuarios WHERE nvirtual = '".$r['nvirtual']."'");
	$ru = mysqli_fetch_array($su);

	$sa = mysqli_query($connection,"SELECT * FROM log_billetera WHERE nvirtual = '".$r['nvirtual']."' AND razon = 'Bono de Inicio'");
	$ra = mysqli_fetch_array($sa);

	$fecha = fecha($ra['fecha']);

	?>
	<tr>
		<td><?=$r['nvirtual']?></td>
		<td><?=nombre_apellido_usuario($ru['nvirtual'])?></td>
		<td><?=$r['bono_inicio']?> $</td>
		<td><?=$fecha?></td>
	</tr>
	<?php
}
?>
</table>