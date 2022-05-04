<?php
include "../config/conection.php";

$cont= 0;
$cantidad_descuento = 0;
$descuento_producto = 0;

$sc = mysqli_query($connection,"SELECT * FROM calificados WHERE nvirtual = '".$_SESSION['nvirtual']."'");
$rc = mysqli_fetch_array($sc);
$saf = mysqli_query($connection,"SELECT * FROM afiliaciones WHERE id = '".$rc['calificacion']."'");
$raf = mysqli_fetch_array($saf);
$descuento = "0.".$raf['descuento'];

$s = mysqli_query($connection,"SELECT * FROM carrito WHERE nvirtual = '".$_SESSION['nvirtual']."' ORDER BY id DESC");
while($r=mysqli_fetch_array($s)){
	$sp = mysqli_query($connection,"SELECT * FROM productos WHERE id = '".$r['producto']."'");
	$rp = mysqli_fetch_array($sp);
	

	$total = $r['cantidad'] * $rp['precio'];

	$spi = mysqli_query($connection,"SELECT * FROM productos_imagenes WHERE IdProducto = '".$rp['id']."'");
	$rpi = mysqli_fetch_array($spi);
	$imagen = $rpi['RutaImagen'];
	
	if($rp['descuento']==1 && esta_activo($_SESSION['nvirtual'])){
		$descuento_producto = $total * $descuento;
		$cantidad_descuento = $cantidad_descuento + ($total * $descuento);
	}else{
		$descuento_producto = "0";
	}
	
	$cont = $cont + $total;
	
	
	$ivaxd = "0.".$rp['iva'];
	$iva = ($cont - $cantidad_descuento) * $ivaxd;
	
	$ptotal = $cont - $cantidad_descuento;
	
	$ptc = $ptotal + $iva;
	

	?>
	<a>
	<small >
		<img src="img/productos/<?=$imagen?>" style="width:40px;height:40px;" class="img-circle"/>
	</small>
	&nbsp;
		<?php
		if(strlen($rp['producto'])>15){
				?>
				<span data-toggle="tooltip" data-placement="top" title="<?=$rp['producto']?>">
				<?php
				for($a=0;$a<=14;$a++){
					echo $rp['producto'][$a];
				}
				echo "... <span style='color:#048'><b>(".$r['cantidad'].")</b></span></span>";
			}else{
				echo $rp['producto']." <span style='color:#048'><b>(".$r['cantidad'].")</b></span>";
			}
		?>
		<br>
		<small class="pull-left fa fa-money text-green" style="position:relative;bottom:10px;left:50px"> <?=numero($rp['precio'])?><?=$rp['simbolo_moneda']?></small>
		
		<small class="pull-right" style="position:relative;bottom:30px;">
			<button onclick="restar_carrito(<?=$r['producto']?>);" class="btn btn-warning" style="padding:1px 5px;">-</button>
			<button onclick="agregar_carrito(<?=$r['producto']?>);" class="btn btn-success" style="padding:1px 5px;">+</button>
			<button onclick="quitar(<?=$r['producto']?>);" class="btn btn-danger" style="padding:1px 5px;">X</button>
		</small>
	</a>
	<?php
}
?> 

<script type="text/javascript">
	$("#total").html('<?=numero($ptc)?>');
</script>