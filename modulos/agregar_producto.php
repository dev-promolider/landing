<?php
check_admin();

if(isset($enviar)){

	$producto = clear($producto);
	$precio = clear($precio);
	$iva = clear($iva);
	$comisionable = clear($comisionable);
	$descripcion = clear($descripcion);
	$simbolo_moneda = clear($simbolo_moneda);
	$descuento = clear($descuento);

	

	mysqli_query( $connection, "INSERT INTO productos (producto,precio,iva,comisionable,descripcion,simbolo_moneda,descuento) VALUES ('$producto','$precio','$iva','$comisionable','$descripcion','$simbolo_moneda','$descuento')");


	$sss = mysqli_query( $connection, "SELECT * FROM productos WHERE producto = '$producto' AND precio = '$precio'");
	$rrr = mysqli_fetch_array($sss);

	$idd = $rrr['id'];

	if(is_uploaded_file($_FILES['imagenproducto']['tmp_name'])){

		$ext = pathinfo($_FILES['imagenproducto']['name']);
		$extv = $ext['extension'];

		if(no_es_imagen($extv)){
			alert("Solo se permiten imagenes para el producto. ".$extv);
			redir("");
		}

		$imagennueva = date("his").$_FILES['imagenproducto']['name'];

		
			mysqli_query( $connection, "INSERT INTO productos_imagenes (IdProducto,RutaImagen) VALUES ('$idd','$imagennueva')");
			move_uploaded_file($_FILES['imagenproducto']['tmp_name'], "img/productos/".$imagennueva);

	}

	alert("Producto Agregado.");
	redir("?p=config_productos");
}

?>
<form method="post" action="" enctype="multipart/form-data">
<h3>
	<i class="fa fa-plus-circle"></i> Agregar Producto
</h3><hr>
<div class="form-group">
	<input type="file" required name="imagenproducto" data-toggle="tooltip" title="Imagen"/>
</div>
<div class="form-group">
	<input required type="text" class="form-control" data-toggle="tooltip" data-placement="top" title="Nombre del producto" name="producto" placeholder="Nombre del producto"/>
</div>
<div class="form-group">
	<input required type="text" class="form-control" data-toggle="tooltip" data-placement="top" title="Precio"  name="precio" placeholder="Precio"/>
</div>
<div class="form-group">
	<input required type="text" class="form-control" data-toggle="tooltip" data-placement="top" title="Iva"  name="iva" placeholder="Iva"/>
</div>
<div class="form-group">
	<input required type="text" class="form-control" data-toggle="tooltip" data-placement="top" title="Comisonable" name="comisionable" placeholder="Comisionable"/>
</div>
<div class="form-group">
	<input type="text" class="form-control" data-toggle="tooltip" data-placement="top" title="Descripcion" name="descripcion" placeholder="Descripcion"/>
</div>
<div class="form-group">
	<input type="text" class="form-control" data-toggle="tooltip" data-placement="top" title="Simbolo de moneda"  name="simbolo_moneda" placeholder="Sombolo de moneda"/>
</div>
<div class="form-group">
	<select class="form-control" name="descuento" required data-toggle="tooltip" data-placement="top" title="Aplica Descuento?">
		<option value="">¿Descuento?</option>
		<option value="1">SI</option>
		<option value="0">NO</option>
	</select>
</div>
<div class="form-group">
	<a href="?p=config_productos">
		<span class="btn btn-warning">Regresar al listado de productos</span>
	</a>
	<input type="submit" class="btn btn-primary pull-right" value="Agregar" name="enviar"/>
</div>
</form>