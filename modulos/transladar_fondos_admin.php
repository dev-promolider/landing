<?php
check_admin();
$nvirtual = clear($nvirtual);
$s = mysqli_query($connection,"SELECT * FROM datosdeusuarios WHERE nvirtual = '$nvirtual'");
$r = mysqli_fetch_array($s);

if(isset($enviar)){
	$cant = clear($cant);
	log_billetera($nvirtual,$cant,"Fondos recibidos por el administrador",1);
	mysqli_query($connection,"UPDATE billetera SET cant = cant + '$cant' WHERE nvirtual = '".$r['nvirtual']."'");
	alert("Fondos enviados");
	redir("?p=usuarios");
}
?>
<form method="post" action="">
<h3><i class="fa fa-sign-out"></i> Transladar Fondos</h3><hr>
<div class="form-group">
Usuario: <b><?=nombre_apellido_usuario($r['nvirtual'])?></b>
</div>
<div class="form-group">
<input required type="text" class="form-control" placeholder="Cantidad a enviar" name="cant"/>
</div>
<div class="form-group">
<input type="submit" class="btn btn-primary" value="Transladar fondos" name="enviar">
</div>
</form>