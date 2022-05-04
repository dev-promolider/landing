<?php
check_admin();

if(isset($aprobar)){
	$aprobar = clear($aprobar);
	$s = mysqli_query($connection,"SELECT * FROM recargas WHERE id = '$aprobar'");
	$r = mysqli_fetch_array($s);
	$nvirtual = $r['nvirtual'];
	notificar($nvirtual,"Solicitud de Fondos","Tu solicitud de fondos de ".$r['monto']."$ ha sido aceptada.");
	log_billetera($nvirtual,$r['monto'],"Recarga de Fondos a Billetera",1);
	mysqli_query($connection,"UPDATE billetera SET cant = cant + '".$r['monto']."' WHERE nvirtual = '$nvirtual'");
	mysqli_query($connection,"UPDATE recargas SET estado = 1 WHERE id = '$aprobar'");
	alert("Solicitud Aceptada.");
	redir("?p=recargas_pendientes");

}

if(isset($rechazar)){
	$rechazar = clear($rechazar);
	$s = mysqli_query($connection,"SELECT * FROM recargas WHERE id = '$rechazar'");
	$r = mysqli_fetch_array($s);
	$nvirtual = $r['nvirtual'];
	notificar($nvirtual,"Solicitud de Fondos","Tu solicitud de fondos de ".$r['monto']."$ Ha sido rechazada.");
	mysqli_query($connection,"UPDATE recargas SET estado = 2 WHERE id = '$rechazar'");
	alert("Solicitud Rechazada.");
	redir("?p=recargas_pendientes");
}
?>
<h3><i class="fa fa-dollar"></i> Recargas Pendientes</h3>
<table class="table table-striped">
<tr>
<th>Usuario</th>
<th>Monto</th>
<th>Fecha</th>
<th>Banco</th>
<th>Tipo</th>
<th>Numero de Proceso</th>
<th><i class="fa fa-cog"></i></th>
</tr>
<?php
$s = mysqli_query($connection,"SELECT * FROM recargas WHERE estado = 0 ORDER BY id DESC");
while($r=mysqli_fetch_array($s)){

	if($r['banco']==0){
		$banco = "PayPal";
		$tipo = "PayPal";
		$numero_proceso = "PayPal";
	}else{
		$sb =mysqli_query($connection,"SELECT * FROM bancos WHERE id = '".$r['banco']."'");
		$rb = mysqli_fetch_array($sb);

		$banco = $rb['banco'];

		$tipo = $r['tipo'];
		$numero_proceso = $r['numero_proceso'];
	}




	?>
	<tr>
		<td><?=nombre_apellido_usuario($r['nvirtual'])?></td>
		<td>S/. <?=$r['monto']?></td>
		<td><?=fecha($r['fecha'])?></td>
		<td><?=$banco?></td>
		<td><?=$tipo?></td>
		<td><?=$numero_proceso?></td>
		<td>
			<a data-toggle="tooltip" data-placement="top" title="Aceptar"  href="?p=recargas_pendientes&aprobar=<?=$r['id']?>"><i class="fa fa-check"></i></a>
			&nbsp; &nbsp;
			<a data-toggle="tooltip" data-placement="top" title="Rechazar" href="?p=recargas_pendientes&rechazar=<?=$r['id']?>"><i class="fa fa-times"></i></a>
		</td>
	</tr>
	<?php
}
?>
</table>