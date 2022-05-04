<?php
check_admin();
$id = clear($id);
$s = mysqli_query($connection,"SELECT * FROM productos WHERE id = '$id'");
$r = mysqli_fetch_array($s);
$s2 = mysqli_query($connection,"SELECT * FROM productos_imagenes WHERE IdProducto = '$id'");
$r2 = mysqli_fetch_array($s2);
$img = $r2['RutaImagen'];

if(isset($enviar)){

	$producto = clear($producto);
	$precio = clear($precio);
	$iva = clear($iva);
	$comisionable = clear($comisionable);
	$descripcion = clear($descripcion);
	$simbolo_moneda = clear($simbolo_moneda);
	$descuento = clear($descuento);


	if(is_uploaded_file($_FILES['imagenproducto']['tmp_name'])){

		$ext = pathinfo($_FILES['imagenproducto']['name']);
		$extv = $ext['extension'];

		if(no_es_imagen($extv)){
			alert("Solo se permiten imagenes para el producto. ".$extv);
			redir("");
		}

		$imagennueva = date("his").$_FILES['imagenproducto']['name'];

		$spd = mysqli_query($connection,"SELECT * FROM productos_imagenes WHERE IdProducto = '$id'");
		if(mysqli_num_rows($spd)>0){

		mysqli_query($connection,"UPDATE productos_imagenes SET RutaImagen = '$imagennueva' WHERE IdProducto = '$id'");
		move_uploaded_file($_FILES['imagenproducto']['tmp_name'], "img/productos/".$imagennueva);
		
		}else{
			mysqli_query($connection,"INSERT INTO productos_imagenes (IdProducto,RutaImagen) VALUES ('$id','$imagennueva')");
			move_uploaded_file($_FILES['imagenproducto']['tmp_name'], "img/productos/".$imagennueva);
		}

	}

	mysqli_query($connection,"UPDATE productos SET producto = '$producto',precio = '$precio',iva = '$iva',comisionable = '$comisionable',descripcion = '$descripcion',simbolo_moneda = '$simbolo_moneda', descuento = '$descuento' WHERE id = '$id'");
	alert("Producto Modificado.");
	redir("?p=config_productos");
}

?>
<form method="post" action="" enctype="multipart/form-data">
<h3>
	<i class="fa fa-edit"></i> Editar producto
</h3><hr>
<div class="form-group">
	<img src="img/productos/<?=$img?>" style="max-width:150px;" data-toggle="tooltip" data-placement="top" title="Imagen del poducto"/>
	<input type="file" name="imagenproducto"/>
</div>
<div class="form-group">
	<input required type="text" class="form-control" data-toggle="tooltip" data-placement="top" title="Nombre del producto" value="<?=$r['producto']?>" name="producto" placeholder="Nombre del producto"/>
</div>
<div class="form-group">
	<input required type="text" class="form-control" data-toggle="tooltip" data-placement="top" title="Precio" value="<?=$r['precio']?>" name="precio" placeholder="Precio"/>
</div>
<div class="form-group">
	<input required type="text" class="form-control" data-toggle="tooltip" data-placement="top" title="Iva" value="<?=$r['iva']?>" name="iva" placeholder="Iva"/>
</div>
<div class="form-group">
	<input required type="text" class="form-control" data-toggle="tooltip" data-placement="top" title="Comisonable" value="<?=$r['comisionable']?>" name="comisionable" placeholder="Comisionable"/>
</div>
<div class="form-group">
	<input type="text" class="form-control" data-toggle="tooltip" data-placement="top" title="Descripcion" value="<?=$r['descripcion']?>" name="descripcion" placeholder="Descripcion"/>
</div>
<div class="form-group">
	<input type="text" class="form-control" data-toggle="tooltip" data-placement="top" title="Simbolo de moneda" value="<?=$r['simbolo_moneda']?>" name="simbolo_moneda" placeholder="Sombolo de moneda"/>
</div>
<div class="form-group">
	<select class="form-control" name="descuento" required data-toggle="tooltip" data-placement="top" title="Aplica Descuento?">
		<option value="1" <?php if($r['descuento']==1){ echo "selected"; } ?>>SI</option>
		<option value="0" <?php if($r['descuento']==0){ echo "selected"; } ?>>NO</option>
	</select>
</div>
<div class="form-group">
	<a href="?p=config_productos">
		<span class="btn btn-warning">Regresar al listado de productos</span>
	</a>
	<input type="submit" class="btn btn-primary pull-right" value="Editar" name="enviar"/>
</div>
</form>