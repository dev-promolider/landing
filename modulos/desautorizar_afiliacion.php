<?php
check_conectado();
check_admin();
$afiliacion = clear($afiliacion);
$s = mysqli_query($connection,"SELECT * FROM por_afiliar WHERE id = '$afiliacion'");
$r = mysqli_fetch_array($s);

$sp = mysqli_query($connection,"SELECT * FROM pagos WHERE nvirtual = '".$r['nvirtual']."' AND descripcion = 'Afiliación' ORDER BY id DESC");
$rp = mysqli_fetch_array($sp);

if(isset($enviar)){
	mysqli_query($connection,"DELETE FROM pagos WHERE id = '".$rp['id']."'");
	mysqli_query($connection,"DELETE FROM por_afiliar WHERE id = '$afiliacion'");

	$mensaje = clear(nl2br($mensaje));

	notificar($r['nvirtual'],"Error de Afiliación",$mensaje);
	alert("Afiliación Desautorizada.");
	redir("?p=afiliaciones_pendientes");

}

?>
<form method="post" action=""> 
<center>
<section style="padding:10px;background:#07b;color:#fff;">Denegar pago de afiliación de <?=nombre_apellido_usuario($r['nvirtual'])?></section>
<section style="padding:10px;border:1px solid #aaa;border-top:none;">
<textarea name="mensaje" required class="form-control" style="resize:none;height:200px;" placeholder="Introduzca el porque se está rechazando el pago de esta afiliación"></textarea>
<br>
<button type="submit" name="enviar" class="btn bg-aqua btn-block">Desautorizar</button>
</section>
</center>