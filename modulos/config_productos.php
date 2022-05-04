<?php
check_admin();
if(isset($eliminar)){
	mysqli_query($connection,"DELETE FROM productos WHERE id = '$eliminar'");
	mysqli_query($connection,"DELETE FROM productos_imagenes WHERE IdProducto = '$eliminar'");
	alert("Producto Eliminado");
	redir("?p=config_productos");
}
?>
<h3>
	<i class="fa fa-cog"></i> Configuración de productos
</h3>
<hr>
<table class="table table-striped">
<tr>
	<th>Producto</th>
	<th>Precio</th>
	<th>Iva</th>
	<th>Comisionable</th>
	<th>Aplica Descuento</th>
	<th>Descripcion</th>
	<th>Simbolo de Moned</th>
	<th>Acciones</th>
</tr>
<?php
$s = mysqli_query($connection,"SELECT * FROM productos");
while($r=mysqli_fetch_array($s)){
if($r['descuento']==1){
	$descuento = "SI";
}else{
	$descuento = "NO";
}
	$si = mysqli_query($connection,"SELECT * FROM productos_imagenes WHERE IdProducto = '".$r['id']."'");
	$ri = mysqli_fetch_array($si);
	$imgproducto = $ri['RutaImagen'];
	?>
	<tr>
		<td>
		<table><tr><td>
		<img src="img/productos/<?=$imgproducto?>" style="max-width:100px;"/>
		</td><td>
		<?=$r['producto']?></td></tr></table></td>
		<td><?=$r['precio']?></td>
		<td><?=$r['iva']?></td>
		<td><?=$r['comisionable']?></td>
		<td><?=$descuento?></td>
		<td><?=$r['descripcion']?></td>
		<td><?=$r['simbolo_moneda']?></td>
		<td>
			<a data-toggle="tooltip" data-placement="top" title="Eliminar" onclick="eliminar_producto(<?=$r['id']?>);"><i class="fa fa-times"></i></a>
			&nbsp;
			<a href="?p=editar_producto&id=<?=$r['id']?>" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></a>
			
		</td>
	</tr>
	<?php
}
?>
</table>
<br>
<a href="?p=agregar_producto"><span class="btn btn-primary">Agregar Producto</span></a>
<script>
function eliminar_producto(idp){
	var sino = window.confirm("¿Estas seguro de querer eliminar este producto?");
	if(sino==true){
		window.location="?p=config_productos&eliminar="+idp;
	}
}
</script>