<?php
require "../config/conection.php";

$af = clear($af);

$s = mysqli_query($connection,"SELECT * FROM afiliaciones WHERE id = '$af'");
$r = mysqli_fetch_array($s);

$sconf = mysqli_query($connection,"SELECT * FROM divisa");
$rconf = mysqli_fetch_array($sconf);

$difdiv = $rconf['difdiv'];

$pb = $r['precio'] * $difdiv;

$ceb = $r['comisionable'] * $difdiv;
$iv = "0.".$r['iva'];
$iva = $r['precio'] * $iv;
$pci = $r['precio'] + $iva;

?>
Precio: <a title="Precio en Bolivares"><b><?=$r['precio']?> $</b></a>
<!-- Comisionable: <a title="Ganancias por Inscripcion de un binario directo"><b><?=$r['comisionable']?></b></a>!--><br>
IVA: <a title="Iva"><b><?=$r['iva']?>%:  <?=$iva?> $</b></a><br>
Precio + IVA: <a title="Precio con IVA"><b><?=numero($pci)?> $</b></a>

<input type="hidden" id="total" name="total" value="<?=$pci?>">