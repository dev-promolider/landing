<?php
check_admin();

if(isset($enviar)){
	$banco = clear($banco);
	$cuenta = clear($cuenta);
	$titular = clear($titular);

	mysqli_query($connection, "INSERT INTO bancos (banco,cuenta,titular) VALUES ('$banco','$cuenta','$titular')");
	alert("Banco agregado satisfactoriamente");
	redir("");
}

?>
<h3>
	<i class="fa fa-plus"></i>
	Agregar Banco
</h3>
<hr>
<form method="post" action="">
<div class="form-group">
	<input type="text" class="form-control" required placeholder="Nombre del banco" name="banco"/>
</div>
<div class="form-group">
	<input type="text" class="form-control" required placeholder="Numero de cuenta" name="cuenta"/>
</div>
<div class="form-group">
	<input type="text" class="form-control" required placeholder="Titular" name="titular"/>
</div>
<div class="form-group">

<a href="?p=banco"><span class="btn btn-warning">Regresar al listado de bancos</span></a>


	<input type="submit" class="btn btn-primary pull-right" value="Agregar Banco" name="enviar"/>
</div>
</form>