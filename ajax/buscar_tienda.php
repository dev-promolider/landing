<?php
include "../config/conection.php";
$busq = clear($busq);

$s = mysqli_query($connection,"SELECT * FROM productos WHERE producto LIKE '%$busq%'");
while($r=mysqli_fetch_array($s)){
	if($r['activo']==1){
		$si = mysqli_query($connection,"SELECT * FROM productos_imagenes WHERE IdProducto = '".$r['id']."'");
		$ri = mysqli_fetch_array($si);
		?>
			<div class="box box-success" id="cajaproducto">
				<div class="titulo">
					<?=$r['producto']?>
				</div>
				<div class="imagen_producto">
					<img src="img/productos/<?=$ri['RutaImagen']?>" style="width:200px;height:150px;"/>
				</div>
				<div class="footer_producto">
					<p class="pull-left" style="position:relative;top:8px;">
						<?=$r['precio']?>
						<?=$r['simbolo_moneda']?>
					</p>
					<p class="pull-right">
						<button onclick="aggcar(<?=$r['id']?>);" class="btn btn-success"><span class="fa fa-shopping-cart"></span> Agregar</button>
					</p>
				</div>
			</div>
		<?php
	}
}
?>