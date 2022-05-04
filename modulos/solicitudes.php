<?php
check_admin();

if(isset($aceptar)){
	$aceptar = clear($aceptar);
	$s = mysqli_query($connection,"SELECT * FROM peticiones WHERE id = '$aceptar'");
	$r = mysqli_fetch_array($s);
		
	$nvirtual = $r['nvirtual'];
	$sb = mysqli_query($connection,"SELECT * FROM billetera WHERE nvirtual = '$nvirtual'");
	$rb = mysqli_fetch_array($sb);
	
	if($r['cant']>$rb['cant']){
		alert("El usuario no tiene fondos suficiente en la billetera, solicitud rechazada.");
		mysqli_query($connection,"UPDATE peticiones SET estado = 2 WHERE id = '$aceptar'");
		notificar($nvirtual,"Solicitud de Fondos de billetera","Su solicitud de fondos de billetera fue rechazada ya que no tiene suficientes fondos disponibles");
	redir("?p=solicitudes");
	}
	
	mysqli_query($connection,"UPDATE billetera SET cant = cant - '".$r['cant']."' WHERE nvirtual = '$nvirtual'");
	notificar($nvirtual,"Solicitud de Fondos de billetera","Se ha aceptado la solicitud de fondos de la fecha: ".fecha_hora($r['fecha']));
	mysqli_query($connection,"UPDATE peticiones SET estado = 1 WHERE id = '$aceptar'");
	log_billetera($nvirtual,$r['cant'],"Fondos Asignados ".nombre_apellido_usuario($nvirtual),0);
	alert("Solicitud aceptada.");
	redir("?p=solicitudes");
}

if(isset($denegar)){
	$denegar = clear($denegar);
	notificar($nvirtual,"Solicitud de Fondos de billetera","Su solicitud de fondos ha sido cancelada por un administrador.");
	alert("Solicitud denegada.");
	mysqli_query($connection,"UPDATE peticiones SET estado = 2 WHERE id = '$denegar'");
	redir("?p=solicitudes");

}
?>
<h3><i class="fa fa-sign-out"></i> Solicitudes de Fondos de Billetera</h3><hr>
<table class="table table-striped">
<tr>
<th>Usuario</th>
<th>Cedula</th>
<th>Monto solicitado</th>
<th>Fecha</th>
<th><i class="fa fa-cog"></i></th>
</tr>
<?php
$s = mysqli_query($connection,"SELECT * FROM peticiones WHERE estado = 0");
while($r=mysqli_fetch_array($s)){
$su = mysqli_query($connection,"SELECT * FROM datosdeusuarios WHERE nvirtual = '".$r['nvirtual']."'");
$ru = mysqli_fetch_array($su);
$cedula = $ru['docidentidad'];
	?>
		<tr>
			<td><?=nombre_apellido_usuario($r['nvirtual'])?></td>
			<td><?=$cedula?></td>
			<td>S/. <?=$r['cant']?></td>
			<td><?=fecha_hora($r['fecha'])?></td>
			<td>
				<a href="?p=solicitudes&aceptar=<?=$r['id']?>" data-toggle="tooltip" data-placement="top" title="Aceptar">
					<i class="fa fa-check"></i>
				</a>
				&nbsp; &nbsp;
				<a href="?p=solicitudes&denegar=<?=$r['id']?>" data-toggle="tooltip" data-placement="top" title="Rechazar">
					<i class="fa fa-times"></i>
				</a>
			</td>
		</tr>
	<?php
}
?>
</table>