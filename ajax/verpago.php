<?php
require "../config/conection.php";

if(!isset($idp)){
	$id = 0;
}else{
$id = clear($idp);
}


$s = mysqli_query($connection,"SELECT * FROM pagos WHERE id = '$id'");
$r = mysqli_fetch_array($s);

$difdiv = difdiv();

$bs = $r['monto'] * $difdiv;

if(mysqli_num_rows($s)>0){

?>
<center>
	<h3 style="padding:10px;background:#06a;color:#fff;">Información del pago</h3>
<br>

</center>

Usuario: <b><?=$r['nvirtual']?></b><br><br>
Patrocinador: <b><?=$r['patrocinador']?></b><br><br>
Monto: <b>$ <?=$r['monto']?></b><br><br>
<!-- Monto: <b>$ <?=$bs?></b><br><br> -->
Documento: <b><?=$r['documento']?></b><br><br>
Tipo De Pago: <b><?=$r['tipodepago']?></b><br><br>
Banco: <b><?=$r['banco']?></b><br><br>
Fecha: <b><?=fecha($r['fechacompra'])?></b><br><br>
<?php
}else{
	echo "<i>El pago fue desautorizado.</i>";
}
?>