<?php
include "../config/conection.php";
$nvirtual = clear($nvirtual);
?>

<center>
<?php
if(file_exists("../img/avatares/".$nvirtual.".jpg")){
	echo "<img src='img/avatares/".$nvirtual.".jpg' style='width:100px;height:100px;' class='img-circle'/>";
}else{
	echo "<img src='img/avatares/0.png' style='width:100px;height:100px;' class='img-circle'/>";
}

$s = mysqli_query($connection,"SELECT * FROM datosdeusuarios WHERE nvirtual = '$nvirtual'");
$r = mysqli_fetch_array($s);
$fechavence = $r['vence'];

$sca =mysqli_query($connection,"SELECT * FROM calificados WHERE nvirtual = '$nvirtual'");
$rca = mysqli_fetch_array($sca);

$calificacion = $rca['calificacion'];

$sa = mysqli_query($connection,"SELECT * FROM afiliaciones WHERE id = '$calificacion'");
$ra = mysqli_fetch_array($sa);

$afiliacion = $ra['nombre'];

$volumenizq = 0;
$volumender = 0;
$spi = mysqli_query($connection,"SELECT * FROM puntos_por_dar WHERE nvirtual = '$nvirtual' AND pierna = 1");
$spd = mysqli_query($connection,"SELECT * FROM puntos_por_dar WHERE nvirtual = '$nvirtual' AND pierna = 2");
while($rpi=mysqli_fetch_array($spi)){
	$volumenizq = $volumenizq + $rpi['puntos'];
}
while($rpd=mysqli_fetch_array($spd)){
	$volumender = $volumender + $rpd['puntos'];
}
echo "<hr>";
echo "<a href='?p=arbol&binario=$nvirtual'>Ver Arbol de ".nombre_apellido_usuario($nvirtual)."</a>";
echo "<hr>";
?>
<table class="table table-striped">
<tr>
<th align="left">Nombre</th>
<th align="right"><?=nombre_usuario($nvirtual)?></th>
</tr>
<tr>
<th align="left">Apellido</th>
<th align="right"><?=apellido_usuario($nvirtual)?></th>
</tr>
<tr>
<th align="left">Correo</th>
<th align="right"><?=$r['correo']?></th>
</tr>
<tr>
<th align="left">Telefono</th>
<th align="right"><?=$r['telefono']?></th>
</tr>
<tr>
<th align="left">Categoria</th>
<th align="right"><?=$afiliacion?></th>
</tr>
<tr>
<th align="left">Fecha de vencimiento</th>
<th align="right"><?=fecha($fechavence)?></th>
</tr>
<?php
if(esta_activo($nvirtual)){
$activo = "<i class='fa fa-circle text-green'></i>";
}else{
$activo = "<i class='fa fa-circle text-red'></i>";
}

if(esta_calificado($nvirtual)){
$calificado = "<i class='fa fa-circle text-green'></i>";
}else{
$calificado = "<i class='fa fa-circle text-red'></i>";
}



?>
<tr>
<th align="left">Activo</th>
<th align="right"><?=$activo?></th>
</tr>
<tr>
<th align="left">Calificado</th>
<th align="right"><?=$calificado?></th>
</tr>
<tr>
<th align="left">Rango</th>
<th align="right"><img src="img/oro.png" class="img-circle" style="width:50px;height:50px;"/></th>
</tr>
<tr>
<th align="left">V.I: <span style="color:#048"><?=$volumenizq?></span></th>
<th align="right">V.D: <span style="color:#048"><?=$volumender?></span></th>
</tr>
</table>
</center>