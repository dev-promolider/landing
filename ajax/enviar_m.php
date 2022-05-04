<?php
include "../config/conection.php";
$nvirtual = clear($nvirtual);
$asunto = clear($asunto);
$mensaje = clear($mensaje);

	if(strlen($mensaje)>0 && strlen($asunto)>0){
		$r = mysqli_fetch_array($s);

		$q = mysqli_query($connection,"INSERT INTO bandeja_entrada (nvirtual,nvirtualenviado,asunto,mensaje,estatus,fecha) VALUES ('$nvirtual','".$_SESSION['nvirtual']."','$asunto','$mensaje',0,NOW())");
		$q2 = mysqli_query($connection,"INSERT INTO bandeja_salida (nvirtual,nvirtualenviado,asunto,mensaje,fecha) VALUES ('$nvirtual','".$_SESSION['nvirtual']."','$asunto','$mensaje',NOW())");
	}else{
		alert("Completa los campos.");
	}
	?>