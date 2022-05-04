<?php
$sc = mysqli_query($connection,"SELECT * FROM calificados WHERE nvirtual = '".$_SESSION['nvirtual']."'");
$rc = mysqli_fetch_array($sc);
$saf = mysqli_query($connection,"SELECT * FROM afiliaciones WHERE id = '".$rc['calificacion']."'");
$raf = mysqli_fetch_array($saf);
$desafi = "0.".$raf['descuento'];

$s = mysqli_query($connection,"SELECT * FROM carrito WHERE nvirtual ='".$_SESSION['nvirtual']."'");
?>
<div class="table-responsive">
<table class="table table-striped table-bordered" id="tcarrito">
<tr>
<th><i class="fa fa-picture-o"></i> Imagen</th>
<th><i class="fa fa-edit"></i> Producto</th>
<th><i class="fa fa-bar-chart-o"></i> Cant.</th>
<th><i class="fa fa-money"></i> Precio U.</th>
<th><i class="fa fa-money"></i> Precio T.</th>
<th><i class="fa fa-money"></i> Precio Desc.</th>
<th><i class="fa fa-clock-o"></i> Fecha de compra</th>
<th><i class="fa fa-gear"></i> Configurar</i></th>
</tr>
<?php
while($r=mysqli_fetch_array($s)){
	$si = mysqli_query($connection,"SELECT * FROM productos_imagenes WHERE IdProducto = '".$r['producto']."'");
	$ri = mysqli_fetch_array($si);
	$sp = mysqli_query($connection,"SELECT * FROM productos WHERE id = '".$r['producto']."'");
	$rp = mysqli_fetch_array($sp);

	$pt = $rp['precio'] * $r['cantidad'];

	$imagen = $ri['RutaImagen'];

	if($rp['descuento']==1 && esta_activo($_SESSION['nvirtual'])){

	$desc = $pt * $desafi;
	$pdesc = $pt - $desc;

	}else{
		$pdesc=$pt;
	}

	?>
		<tr>
			<td><img src="img/productos/<?=$imagen?>" style="width:100px;height:100px;" class="agrandarx1"/></td>
			<td width="100"><?=$rp['producto']?></td>
			<td><?=$r['cantidad']?></td>
			<td><?=$rp['precio']?> <?=$rp['simbolo_moneda']?></td>
			<td><?=$pt?> <?=$rp['simbolo_moneda']?></td>
			<td><?=$pdesc?> <?=$rp['simbolo_moneda']?></td>
			<td><?=fecha_hora($r['fecha'])?></td>
			<td>
				<button onclick="restar_carrito(<?=$r['producto']?>);window.location='';" class="btn btn-warning" style="padding:1px 5px;">-</button>
				<button onclick="agregar_carrito(<?=$r['producto']?>);window.location='';" class="btn btn-success" style="padding:1px 5px;">+</button>
				<button onclick="quitar(<?=$r['producto']?>);window.location='';" class="btn btn-danger" style="padding:1px 5px;">X</button>
			</td>
		</tr>
	<?php
}
?>
</table>
</div>
<br>
<div style="position:relative;">
<buttom class="btn btn-success" onclick="window.location='?p=tienda'"><i class="fa fa-arrow-left"></i> Comprar productos</buttom>

<?php
if(mysqli_num_rows($s)>0){
?>
<a href="?p=finalizar_compra">
<buttom class="btn btn-success" style="position:absolute;right:5px;"><i class="fa fa-shopping-cart"></i> Finalizar Compra</buttom>
</a>
<?php
}
?>
</div>