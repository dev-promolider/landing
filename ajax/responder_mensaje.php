<?php
include "../config/conection.php";
$idm = clear($idm);
$asunto = clear($asunto);
$mensaje = clear($mensaje);

$s = mysqli_query($connection,"SELECT * FROM bandeja_entrada WHERE nvirtual = '".$_SESSION['nvirtual']."' AND id = '$idm'");
if(mysqli_num_rows($s)>0){
	if(strlen($mensaje)>0){
		$r = mysqli_fetch_array($s);

		$q = mysqli_query($connection,"INSERT INTO bandeja_entrada (nvirtual,nvirtualenviado,asunto,mensaje,estatus,fecha) VALUES ('".$r['nvirtualenviado']."','".$_SESSION['nvirtual']."','$asunto','$mensaje',0,NOW())");
		$q2 = mysqli_query($connection,"INSERT INTO bandeja_salida (nvirtual,nvirtualenviado,asunto,mensaje,fecha) VALUES ('".$r['nvirtualenviado']."','".$_SESSION['nvirtual']."','$asunto','$mensaje',NOW())");
	}
}