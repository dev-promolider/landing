<?php
check_admin();

if(isset($aprobar)){
	$sa = mysqli_query($connection, "SELECT * FROM translado_pendiente WHERE id = '$aprobar'");
	$ra = mysqli_fetch_array($sa);
	$sb = mysqli_query($connection, "SELECT * FROM billetera WHERE nvirtual = '".$ra['nvirtual_envia']."'");
	$rb = mysqli_fetch_array($sb);
	if($rb['cant']<$ra['cant']){
		mysqli_query($connection, "UPDATE translado_pendiente SET historico = 1 WHERE id = '$aprobar'");
		notificar($ra['nvirtual_envia'],"Translado de fondos pendiente","Tu translado pendiente para ".nombre_apellido_usuario($ra['nvirtual_recibe'])." Ha sido cancelado ya que no constas con la cantidad suficiente en tu billetera.");

		alert("el usuario ya no tiene la cantidad disponible en la billetera para aprobar esta solicitud, TRANSLADO CANCELADO.");
		
		redir("?p=translados_pendientes");
	}

	notificar($ra['nvirtual_envia'],"Translado de fondos","Se ha aceptado un translado de fondos enviado de tu parte.");

	notificar($ra['nvirtual_recibe'],"Translado de fondos","Has recibido un translado de fondos");

	log_billetera($ra['nvirtual_envia'],$ra['cant'],"Translado al usuario ".nombre_apellido_usuario($ra['nvirtual_recibe']),0);
	mysqli_query($connection, "UPDATE billetera SET cant = cant - '".$ra['cant']."' WHERE nvirtual = '".$ra['nvirtual_envia']."'");

	log_billetera($ra['nvirtual_recibe'],$ra['cant'],"Translado recibido del usuario ".nombre_apellido_usuario($ra['nvirtual_recibe']),1);
	mysqli_query($connection, "UPDATE billetera SET cant = cant + '".$ra['cant']."' WHERE nvirtual = '".$ra['nvirtual_recibe']."'");

	alert("Translado de fondos aprobado.");
	redir("?p=translados_pendientes");

}

if(isset($denegar)){
	$sa = mysqli_query($connection, "SELECT * FROM translado_pendiente WHERE id = '$denegar'");
	$ra = mysqli_fetch_array($sa);

	notificar($ra['nvirtual_envia'],"Translado de fondos pendiente","Tu solicitud de transladar fondos ha sido denegada.");
	mysqli_query($connection, "UPDATE translado_pendiente SET historico = 1 WHERE id = '$denegar'");
	alert("Solicutud rechazada");
	redir("?p=translados_pendientes");
}

?>
<h3><i class="fa fa-sign-out"></i> Translados Pendientes</h3>
<hr>
<table class="table table-striped">
<tr>
<th>Quien Envia</th>
<th>Quien Recibe</th>
<th>Monto</th>
<th>Fecha</th>
<th><i class="fa fa-cog"></i>
</tr>
<?php
$s = mysqli_query($connection, "SELECT * FROM translado_pendiente WHERE historico = 0");
while($r=mysqli_fetch_array($s)){
	?>
	<tr>
		<td>[<?=$r['nvirtual_envia']?>] <?=nombre_apellido_usuario($r['nvirtual_envia'])?></td>
		<td>[<?=$r['nvirtual_recibe']?>] <?=nombre_apellido_usuario($r['nvirtual_recibe'])?></td>
		<td><?=$r['cant']?> $</td>
		<td><?=fecha($r['fecha'])?></td>
		<td>
			<a href="?p=translados_pendientes&aceptar=<?=$r['id']?>">
				<i class="fa fa-check" data-toggle="tooltip" data-placement="top" title="Aceptar"></i>
			</a>
			&nbsp;
			<a href="?p=translados_pendientes&denegar=<?=$r['id']?>">
				<i class="fa fa-times" data-toggle="tooltip" data-placement="top" title="Rechazar"></i>
			</a>
		</td>
	</tr>
	<?php
}
?>
</table>