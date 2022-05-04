<?php
include "../config/conection.php";


$idc = clear($idc);
$sw = 0;
$scc = mysqli_query($connection,"SELECT * FROM compra_espera WHERE nvirtual = '".$_SESSION['nvirtual']."' AND id = '$idc'");
if(mysqli_num_rows($scc)>0){
	$sw=1;
}

if(rol($_SESSION['nvirtual'])==1 || $sw ==1){

echo '<h4><i class="fa fa-shopping-cart"></i> Productos Comprados</h4><br><br>';
?>

<table class="table table-striped">
<tr>
<th colspan="2">Producto</th>
<th><center>Catidad</center></th>
<th><center>Precio</center></th>
</tr>
<?php
$sp = mysqli_query($connection,"SELECT * FROM productos_compra_espera WHERE id_compra_espera = '$idc'");
$monto =0;

$sc = mysqli_query($connection,"SELECT * FROM calificados WHERE nvirtual = '".$_SESSION['nvirtual']."'");
$rc = mysqli_fetch_array($sc);
$saf = mysqli_query($connection,"SELECT * FROM afiliaciones WHERE id = '".$rc['calificacion']."'");
$raf = mysqli_fetch_array($saf);
$desafi = "0.".$raf['descuento'];

while($rp=mysqli_fetch_array($sp)){
	$spp = mysqli_query($connection,"SELECT * FROM productos WHERE id = '".$rp['producto']."'");
	$rpp = mysqli_fetch_array($spp);
	$si = mysqli_query($connection,"SELECT * FROM productos_imagenes WHERE IdProducto = '".$rp['producto']."'");
	$ri = mysqli_fetch_array($si);
	$imgproducto = $ri['RutaImagen'];

	$monto = $monto + ($rpp['precio'] * $rp['cantidad']);

	if($rpp['descuento']==1){
	$desc = $monto * $desafi;
	$monto = $monto - $desc;
	}

?>
	<tr>
		<th>
			<img src="img/productos/<?=$imgproducto?>" style="width:50px;height:50px;"/>
		</th>
		<th>
			<h3><?=$rpp['producto']?></h3>
		</th>
		<th>
			<center><?=$rp['cantidad']?></center>
		</th>
		<th>
			<center><i class="fa fa-money"></i> <?=$rpp['precio']?></center>
		</th>
	</tr>
<?php
}
?>
<tr>
<th colspan="2">&nbsp;</th>
<th colspan="2" class="bg-aqua"><center>Monto Total</center></th>
</tr>
<tr>

<th colspan="2">&nbsp;</th>
<th colspan="2"><center><i class="fa fa-money"></i> <?=$monto?></center></th>
</tr>
</table>
<?php
}
?>