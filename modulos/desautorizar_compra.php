<?php
check_conectado();
check_admin();
$compra = clear($compra);

$s = mysqli_query($connection, "SELECT * FROM compra_espera WHERE id = '$compra'");
$r = mysqli_fetch_array($s);

$sp = mysqli_query($connection, "SELECT * FROM pago_compra_espera WHERE id_compra_espera = '".$r['id']."'");
$rp = mysqli_fetch_array($sp);

if(isset($enviar)){
	mysqli_query($connection, "UPDATE compra_espera SET desautorizado = 1 WHERE id = '".$r['id']."'");

	$mensaje = clear(nl2br($mensaje));

	notificar($r['nvirtual'],"Compra no autorizada",$mensaje);
	alert("Compra Desautorizada.");
	redir("?p=compras_pendientes");

}

?>
<form method="post" action=""> 
<center>
<section style="padding:10px;background:#07b;color:#fff;">Denegar Compra de <?=nombre_apellido_usuario($r['nvirtual'])?></section>
<section style="padding:10px;border:1px solid #aaa;border-top:none;">
<textarea name="mensaje" required class="form-control" style="resize:none;height:200px;" placeholder="Introduzca el porque se está rechazando la compra"></textarea>
<br>
<button type="submit" name="enviar" class="btn bg-aqua btn-block">Desautorizar</button>
</section>
</center>