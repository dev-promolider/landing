<?php
check_conectado();
check_admin();

$id = clear($afiliacion);
$sa = mysqli_query($connection,"SELECT * FROM por_afiliar WHERE id = '$id'");
$ra = mysqli_fetch_array($sa);
$su = mysqli_query($connection,"SELECT * FROM datosdeusuarios WHERE nvirtual = '".$ra['nvirtual']."'");
$ru = mysqli_fetch_array($su);
$sca = mysqli_query($connection,"SELECT * FROM afiliaciones WHERE id = '".$ra['tipo']."'");
$rca = mysqli_fetch_array($sca);

$pordar = $rca['comisionable'];

$directo = $rca['precio'] * 0.18;

mysqli_query($connection,"UPDATE billetera SET cant = cant + $directo WHERE nvirtual = '".$ru['patrocinador']."'");
ber($ru['patrocinador'],$directo);
log_billetera($ru['patrocinador'],$directo,"Afiliacion directa de ".nombre_apellido_usuario($ru['nvirtual']),1);


// Verificacion si el patrocinador es gratuito para aplicar 3 meses de vencimiento.
$svag = mysqli_query($connection,"SELECT * FROM calificados WHERE nvirtual = '".$ru['patrocinador']."'");
$rvag = mysqli_fetch_array($svag);

if($rvag['calificacion']==1){
	$svag2 = mysqli_query($connection,"SELECT * FROM datosdeusuarios WHERE nvirtual = '".$ru['patrocinador']."'");
	$rvag2 = mysqli_fetch_array($svag2);

	$fecharegistro = $rvag2['fecharegistro'];
	$ex = explode("-",$fecharegistro);
	$dia_svag = $ex[2];
	$mes_svag = $ex[1];
	$ano_svag = $ex[0];

	$ano_svag++;

	$vence_svag = $ano_svag."-".$mes_svag."-".$dia_svag;

	if($vence_svag == $rvag2['vence']){
		$dia_vg = $dia_svag;
		$mesactual = date("m");
		$ano_vg = date("Y");

		if($mesactual==10){
			$mes_vg = 1;
			$ano_vg++;
		}
		if($mesactual == 11){
			$mes_vg = 2;
			$ano_vg++;
		}
		if($mesactual == 12){
			$mes_vg = 3;
			$ano_vg++;
		}
		if($mesactual<10){
			$mes_vg = $mesactual+3;
		}

		$nuevafechavence = $ano_vg."-".$mes_vg."-".$dia_vg;

		mysqli_query($connection,"UPDATE datosdeusuarios SET vence = '$nuevafechavence' WHERE nvirtual = '".$ru['patrocinador']."'");

	}
}

//

$razon = "Puntos de equipo binario, Afiliacion de ".$ru['campo_primer_nombre']." ".$ru['campo_primer_apellido'];

$patrocinador = $ru['nvirtual'];

$pierna = $ra['pierna'];

do{

	$sdc = mysqli_query($connection,"SELECT * FROM datosdeusuarios WHERE nvirtual = '$patrocinador'");
	$rdc = mysqli_fetch_array($sdc);

	$patrocinador = $rdc['patrocinador_binario'];

	if($patrocinador != $ru['patrocinador']){
	
	if(esta_activo($patrocinador) && esta_calificado($patrocinador)){

		log_binario($patrocinador,$pordar,"Bono Efectivo Rивpido de ".nombre_apellido_usuario($ru['nvirtual']));
				
		mysqli_query($connection,"INSERT INTO puntos_por_dar (nvirtual,pierna,puntos,razon) VALUES ('$patrocinador','$pierna','$pordar','$razon')");
	}

	}else{
		log_binario($ru['patrocinador'],$pordar,"Bono Efectivo Rивpido de ".nombre_apellido_usuario($ru['nvirtual']));
				
		mysqli_query($connection,"INSERT INTO puntos_por_dar (nvirtual,pierna,puntos,razon) VALUES ('".$ru['patrocinador']."','$pierna','$pordar','$razon')");
	}

	$sdc2 = mysqli_query($connection,"SELECT * FROM calificados WHERE nvirtual = '$patrocinador'");
	$rdc2 = mysqli_fetch_array($sdc2);
	$pierna = $rdc2['lado'];

	

}while($patrocinador!="administrador");

$calificacion = $ra['tipo'];

mysqli_query($connection,"UPDATE datosdeusuarios SET activo = 1, tipo = '".$ra['tipo']."' WHERE nvirtual = '".$ru['nvirtual']."'");


mysqli_query($connection,"INSERT INTO calificados (nvirtual,padre,patrocinador,patrocinador_binario,lado,calificacion,activo,autorizado,pier_i_activa,pier_d_activa) VALUES ('".$ra['nvirtual']."','".$ru['patrocinador']."','".$ru['patrocinador']."','".$ru['patrocinador_binario']."','".$ra['pierna']."','".$ra['tipo']."',1,1,0,0)");

activar_fecha_pago($ra['nvirtual']);

$mensaje = " <center><img src='http://i.imgur.com/hTuOwiQ.png'/></center><br><br>Su afiliacion ".$rca['nombre']." ha sido activada por un Administrador, gracias por confiar en nosotros.";

notificar($ra['nvirtual'],"Afiliacion Activada",$mensaje);

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

mail(correo($ru['nvirtual']),"Afiliacion Activada",$mensaje,$headers);

mysqli_query($connection,"DELETE FROM por_afiliar WHERE id = '$id'");

alert("Puntos repartidos y usuario afiliado satisfactoriamente.");
redir("?p=afiliaciones_pendientes");

?>