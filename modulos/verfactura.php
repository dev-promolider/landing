<?php
$compra = clear($compra);

$s = mysqli_query($connection,"SELECT * FROM compra_espera WHERE id = '$compra' AND nvirtual = '".$_SESSION['nvirtual']."' AND desautorizado = 2");
if(mysqli_num_rows($s)<1){
alert("Ha ocurrido un error.");
redir("?p=mis_compras");
}
$r = mysqli_fetch_array($s);
?>
<h3><i class="fa fa-file-text"></i> Factura</h3><hr>
<?php
$sp = mysqli_query($connection,"SELECT * FROM productos_compra_espera WHERE id_compra_espera = '$compra'");
while($rp=mysqli_fetch_Array($sp)){
$simg = mysqli_query($connection,"SELECT * FROM productos_imagenes WHERE IdProducto = '".$rp['producto']."'");
$rimg = mysqli_fetch_array($simg);
$imgnproducto = $rimg['RutaImagen'];
$spp = mysqli_query($connection,"SELECT * FROM productos WHERE id = '".$rp['producto']."'");
$rpp = mysqli_fetch_array($spp);

?>
<div class="form-group">
<table class="table" style="vertical-align:center;">
<tr>
<td style="width:120px;">
<img src="img/productos/<?=$imgnproducto?>" style="width:120px;height:120px;"/>
</td>
<td style="width:120px;">
<?=$rpp['producto']?> <span class="text-primary">(x<?=$rp['cantidad']?>)</span>
</td>
<td style="width:120px;">
<?=number_format($rpp['precio'],2)?> <i class=""> $</i>
</td>
</tr>
</table>
</div>
<?php
}
?>
<h1><br>
Total: <?=number_format($r['monto'],2)?><i class=""> Bs</i></h1>