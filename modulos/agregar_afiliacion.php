<?php
check_admin();

if(isset($enviar)){
	$nombre = clear($nombre);
	$precio = clear($precio);
	$comisionable = clear($comisionable);
	$iva = clear($iva);
	$descuento = clear($descuento);
	$porcentaje = clear($porcentaje);

	mysqli_query($connection, "INSERT INTO afiliaciones (nombre,precio,comisionable,iva,descuento,porcentaje_pago_corte) VALUES ('$nombre','$precio','$comisionable','$iva','$descuento','$porcentaje')");
	alert("Afiliacion agregada");
	redir("?p=afiliaciones");

}

?>
<form method="post" action="">
<div class="content invoice">

<h3><i class="fa fa-dollar"></i> Agregar Afiliación</h3>
<hr>
<div class="form-group">
<input type="text" required class="form-control" placeholder="Nombre" name="nombre"/>
</div>
<div class="form-group">
<input type="text" required class="form-control" placeholder="Precio" name="precio"/>
</div>
<div class="form-group">
<input type="text" class="form-control" placeholder="Comisionable (opcional)" name="comisionable"/>
</div>
<div class="form-group">
<input type="text" class="form-control" placeholder="Iva (opcional)" name="iva"/>
</div>
<div class="form-group">
<input type="text" class="form-control" placeholder="Descuento en compra EJ: 20 (20% sin el simbolo)" name="descuento"/>
</div>
<div class="form-group">
<input type="text" class="form-control" placeholder="% en corte de binarios EJ: 15 (15% sin el simbolo)" name="porcentaje"/>
</div>
<div class="form-group">
<input type="submit" class="btn btn-primary" value="Agregar" name="enviar"/>
</div>
</div>
</form>