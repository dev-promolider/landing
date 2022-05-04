<?php
check_admin();

$id = clear($id);
$s = mysqli_query($connection,"SELECT * FROM afiliaciones WHERE id = '$id'");

if(mysqli_num_rows($s)<1){
	redir("?p=afiliaciones");
}

$r = mysqli_fetch_array($s);

if(isset($enviar)){
	$nombre = clear($nombre);
	$precio = clear($precio);
	$comisionable = clear($comisionable);
	$iva = clear($iva);
	$descuento = clear($descuento);
	$porcentaje = clear($porcentaje);
	$ganancia = clear($ganancia);
	$ganancia2 = clear($ganancia2);

	mysqli_query($connection,"UPDATE afiliaciones SET nombre = '$nombre', precio = '$precio', comisionable = '$comisionable', iva= '$iva', descuento = '$descuento', porcentaje_pago_corte = '$porcentaje', ganancia = '$ganancia', ganancia2 = '$ganancia2' WHERE id = '$id'");
	
	mysqli_query($connection,"UPDATE productos SET precio = '$precio' WHERE producto = '$nombre'");

	alert("Afiliacion modificada");
	redir("?p=afiliaciones");

}

?>
<form method="post" action="">
<div class="content invoice">

<h3><i class="fa fa-dollar"></i> Modificar Afiliación</h3>
<hr>
<div class="form-group">
Nombre
<input type="text" required value="<?=$r['nombre']?>" class="form-control" placeholder="Nombre" name="nombre"/>
</div>
<div class="form-group">
Precio
<input type="text" value="<?=$r['precio']?>" required class="form-control" placeholder="Precio" name="precio"/>
</div>
<div class="form-group">
Comisionable (opcional)
<input type="text" class="form-control" value="<?=$r['comisionable']?>" placeholder="Comisionable (opcional)" name="comisionable"/>
</div>
<div class="form-group">
Iva (opcional) EJ: 16 (16% sin el simbolo)
<input type="text" value="<?=$r['iva']?>" class="form-control" placeholder="Iva (opcional)" name="iva"/>
</div>
<div class="form-group">
Descuento en compra EJ: 20 (20% sin el simbolo)
<input type="text" class="form-control" value="<?=$r['descuento']?>" placeholder="Descuento en compra EJ: 20 (20% sin el simbolo)" name="descuento"/>
</div>
<div class="form-group">
% en corte de binarios EJ: 15 (15% sin el simbolo)
<input type="text" value="<?=$r['porcentaje_pago_corte']?>" class="form-control" placeholder="% en corte de binarios EJ: 15 (15% sin el simbolo)" name="porcentaje"/>
</div>
<div class="form-group">
% Ganancia en Compras
<input type="text" value="<?=$r['ganancia']?>" class="form-control" placeholder="% Ganancia en Compras" name="ganancia"/>
</div>
<div class="form-group">
% Ganancia en Compras 2da Generacion
<input type="text" value="<?=$r['ganancia2']?>" class="form-control" placeholder="% Ganancia en Compras 2da Generacion" name="ganancia2"/>
</div>
<div class="form-group">
<input type="submit" class="btn btn-primary" value="Modificar" name="enviar"/>
</div>
</div>
</form>