<?php
check_admin();
$s = mysqli_query($connection,"SELECT * FROM bono_crecimiento");
$r = mysqli_fetch_array($s);

if(isset($enviar)){
	$bono = clear($bono);
	mysqli_query($connection,"UPDATE bono_crecimiento SET precio = '$bono'");
	alert("Bono Modificado");
	redir("");
}
?>
<h1><i class="fa fa-edit"></i> Modificar Bono de Crecimiento</h1><br>
<form method="post" action="">
<div class="form-group">
	<input type="text" name="bono" class="form-control" data-toggle="tooltip" title="Cantidad del bono a pagar" value="<?=$r['precio']?>"/>
</div>
<div class="form-group">
<button type="submit" class="btn btn-primary" name="enviar"><i class="fa fa-check"></i> Modificar Bono</button>
</div>
</form>