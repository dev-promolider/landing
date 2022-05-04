<?php
check_admin();
$compra = clear($compra);

$sco = mysqli_query($connection, "SELECT * FROM compra_espera WHERE id = '$compra'");
$rco = mysqli_fetch_array($sco);

$su = mysqli_query($connection, "SELECT * FROM datosdeusuarios WHERE nvirtual = '".$rco['nvirtual']."'");
$ru = mysqli_fetch_array($su);

$sca = mysqli_query($connection, "SELECT * FROM calificados WHERE nvirtual = '".$rco['nvirtual']."'");
$rca = mysqli_fetch_array($sca);

$calificacion = $rca['calificacion'];

//echo 'xxxxx-> '.$calificacion; exit();

$s = mysqli_query($connection, "SELECT * FROM productos_compra_espera WHERE id_compra_espera = '$compra'");
//echo "SELECT * FROM productos_compra_espera WHERE id_compra_espera = '$compra'".$compra; exit();
while($r=mysqli_fetch_array($s)){


	//echo 'mmmmm-> '.$r['producto']; exit();

	$sadf = mysqli_query($connection, "SELECT * FROM productos WHERE id = '".$r['producto']."'");
	$radf =	mysqli_fetch_array($sadf);
	$precio = $radf['precio'];

	if($r['producto']==4){ //Si es recompra


		if(!esta_activo($ru['nvirtual'])){
		
		$vence = $ru['fecharegistro'];

	    $fecha_exploded = explode("-",$vence);
	    list($anio,$mesi,$dia) = $fecha_exploded;

		$mes = date("m");
		$ano = date("Y");
		
		if($mes==12){
			$mes = "01";
			$ano++;
		}else{
			$mes++;
		}
		
		if(strlen($mes)<2){
			$mes = "0".$mes;
		}

	    $nuevafecha = $ano."-".$mes."-".$dia;


	  mysqli_query($connection, "UPDATE datosdeusuarios SET vence = '$nuevafecha' WHERE nvirtual = '".$ru['nvirtual']."'");
	
	}else{

		$vence = $ru['vence'];

	    $fecha_exploded = explode("-",$vence);
	    list($anio,$mesi,$dia) = $fecha_exploded;

		$mes = $mesi;
		$ano = $anio;
		
		if($mes==12){
			$mes = "01";
			$ano++;
		}else{
			$mes++;
		}
		
		if(strlen($mes)<2){
			$mes = "0".$mes;
		}

	    $nuevafecha = $ano."-".$mes."-".$dia;


	  mysqli_query($connection, "UPDATE datosdeusuarios SET vence = '$nuevafecha' WHERE nvirtual = '".$ru['nvirtual']."'");

	}
	
	if(!$q){
		alert(mysqli_error());
	}

	    $spre = mysqli_query($connection, "SELECT * FROM productos WHERE id = '".$r['producto']."'");
		$rpre = mysqli_fetch_array($spre);
	
	
	
	    $pordar = $rpre['comisionable'];


	    $patrocinador = $ru['nvirtual'];
	    $pierna = $rca['lado'];

	    $razon = "Recompra de ".nombre_apellido_usuario($ru['nvirtual']);


	    do{

			$sdc = mysqli_query($connection, "SELECT * FROM datosdeusuarios WHERE nvirtual = '$patrocinador'");
			$rdc = mysqli_fetch_array($sdc);

			$patrocinador = $rdc['patrocinador_binario'];

			if($patrocinador != $ru['patrocinador']){
			
			if(esta_activo($patrocinador) && esta_calificado($patrocinador)){
				log_binario($patrocinador,$pordar,"Compra de ".nombre_apellido_usuario($ru['nvirtual']));
				mysqli_query($connection, "INSERT INTO puntos_por_dar (nvirtual,pierna,puntos,razon) VALUES ('$patrocinador','$pierna','$pordar','$razon')");
			}

			}else{

				log_binario($ru['patrocinador'],$pordar,"Compra de ".nombre_apellido_usuario($ru['nvirtual']));
				mysqli_query($connection, "INSERT INTO puntos_por_dar (nvirtual,pierna,puntos,razon) VALUES ('".$ru['patrocinador']."','$pierna','$pordar','$razon')");
			}

			$sdc2 = mysqli_query($connection, "SELECT * FROM calificados WHERE nvirtual = '$patrocinador'");
			$rdc2 = mysqli_fetch_array($sdc2);
			$pierna = $rdc2['lado'];

			

		}while($patrocinador!="administrador");





	}




	if($r['producto']==5){ // Si es Safip 1

		

		$saf =mysqli_query($connection, "SELECT * FROM afiliaciones WHERE id = 2");
	    $raf = mysqli_fetch_array($saf);
	    $pordar = $raf['comisionable'];

	     $pagober = $raf['precio'] * 0.18;

	    mysqli_query($connection, "UPDATE billetera SET cant = cant + $pagober WHERE nvirtual = '".$ru['patrocinador']."'");
	    log_billetera($ru['patrocinador'],$pagober,"Bono de Efectivo Rápido de: ".nombre_apellido_usuario($ru['nvirtual']),1);
	    ber($ru['patrocinador'],$pagober);

	    // Verificacion si es gratuito para aplicar 3 meses de vencimiento.
$svag = mysqli_query($connection, "SELECT * FROM calificados WHERE nvirtual = '".$ru['patrocinador']."'");
$rvag = mysqli_fetch_array($svag);

if($rca['calificacion']==1){
	$sssany = mysqli_query($connection, "SELECT * FROM datosdeusuarios WHERE nvirtual = '".$rca['nvirtual']."'");
	$rrrany = mysqli_fetch_array($sssany);
	$epf = explode("-",$ru['fecharegistro']);
	$diany= $epf[2];
	$mesactuall = date("m");
	$anoactuall = date("Y");

	if($mesactuall==12){
		$mesactuall="01";
		$anoactuall++;
	}else{
		$mesactuall++;
		if(strlen($mesactuall)<2){
			$mesactuall = "0".$mesactuall;
		}
	}

	$nuevafechavencegratuito = $anoactuall."-".$mesactuall."-".$diany;
	mysqli_query($connection, "UPDATE datosdeusuarios SET vence = '$nuevafechavencegratuito' WHERE nvirtual = '".$ru['nvirtual']."'");
}

if($rvag['calificacion']==1){
$svag2 = mysqli_query($connection, "SELECT * FROM datosdeusuarios WHERE nvirtual = '".$ru['patrocinador']."'");
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

	mysqli_query($connection, "UPDATE datosdeusuarios SET vence = '$nuevafechavence' WHERE nvirtual = '".$ru['patrocinador']."'");

}
}

//


	    $patrocinador = $ru['nvirtual'];
	    $pierna = $rca['lado'];

	    $razon = "Compra Safip 1 de ".nombre_apellido_usuario($ru['nvirtual']);

	    mysqli_query($connection, "UPDATE calificados SET calificacion = 2 WHERE nvirtual = '".$ru['nvirtual']."'");


		 do{

			$sdc = mysqli_query($connection, "SELECT * FROM datosdeusuarios WHERE nvirtual = '$patrocinador'");
			$rdc = mysqli_fetch_array($sdc);

			$patrocinador = $rdc['patrocinador_binario'];

			if($patrocinador != $ru['patrocinador']){
			
			if(esta_activo($patrocinador) && esta_calificado($patrocinador)){
				
				log_binario($patrocinador,$pordar,"Compra de ".nombre_apellido_usuario($ru['nvirtual']));
				
				mysqli_query($connection, "INSERT INTO puntos_por_dar (nvirtual,pierna,puntos,razon) VALUES ('$patrocinador','$pierna','$pordar','$razon')");
			}

			}else{
				log_binario($ru['patrocinador'],$pordar,"Compra de ".nombre_apellido_usuario($ru['nvirtual']));

				mysqli_query($connection, "INSERT INTO puntos_por_dar (nvirtual,pierna,puntos,razon) VALUES ('".$ru['patrocinador']."','$pierna','$pordar','$razon')");
			}

			$sdc2 = mysqli_query($connection, "SELECT * FROM calificados WHERE nvirtual = '$patrocinador'");
			$rdc2 = mysqli_fetch_array($sdc2);
			$pierna = $rdc2['lado'];

			

		}while($patrocinador!="administrador");


	}

	if($r['producto']==6){ //Si es Safip 2


		$saf =mysqli_query($connection, "SELECT * FROM afiliaciones WHERE id = 3");
	    $raf = mysqli_fetch_array($saf);
	    $pordar = $raf['comisionable'];

	     $pagober = $raf['precio'] * 0.18;

	    
	    mysqli_query($connection, "UPDATE billetera SET cant = cant + $pagober WHERE nvirtual = '".$ru['patrocinador']."'");
	    log_billetera($ru['patrocinador'],$pagober,"Bono de Efectivo Rápido de: ".nombre_apellido_usuario($ru['nvirtual']),1);
	    ber($ru['patrocinador'],$pagober);

	    // Verificacion si es gratuito para aplicar 3 meses de vencimiento.
$svag = mysqli_query($connection, "SELECT * FROM calificados WHERE nvirtual = '".$ru['patrocinador']."'");
$rvag = mysqli_fetch_array($svag);

if($rca['calificacion']==1){
	$sssany = mysqli_query($connection, "SELECT * FROM datosdeusuarios WHERE nvirtual = '".$rca['nvirtual']."'");
	$rrrany = mysqli_fetch_array($sssany);
	$epf = explode("-",$ru['fecharegistro']);
	$diany= $epf[2];
	$mesactuall = date("m");
	$anoactuall = date("Y");
	if($mesactuall==12){
		$mesactuall="01";
		$anoactuall++;
	}else{
		$mesactuall++;
		if(strlen($mesactuall)<2){
			$mesactuall = "0".$mesactuall;
		}
	}
	$nuevafechavencegratuito = $anoactuall."-".$mesactuall."-".$diany;
	mysqli_query($connection, "UPDATE datosdeusuarios SET vence = '$nuevafechavencegratuito' WHERE nvirtual = '".$ru['nvirtual']."'");
}

if($rvag['calificacion']==1){
$svag2 = mysqli_query($connection, "SELECT * FROM datosdeusuarios WHERE nvirtual = '".$ru['patrocinador']."'");
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

	mysqli_query($connection, "UPDATE datosdeusuarios SET vence = '$nuevafechavence' WHERE nvirtual = '".$ru['patrocinador']."'");

}
}

//
	    

	    $patrocinador = $ru['nvirtual'];
	    $pierna = $rca['lado'];

	    $razon = "Compra Safip 2 de ".nombre_apellido_usuario($ru['nvirtual']);


	    mysqli_query($connection, "UPDATE calificados SET calificacion = 3 WHERE nvirtual = '".$ru['nvirtual']."'");

		 do{

			$sdc = mysqli_query($connection, "SELECT * FROM datosdeusuarios WHERE nvirtual = '$patrocinador'");
			$rdc = mysqli_fetch_array($sdc);

			$patrocinador = $rdc['patrocinador_binario'];

			if($patrocinador != $ru['patrocinador']){
			
			if(esta_activo($patrocinador) && esta_calificado($patrocinador)){
				log_binario($patrocinador,$pordar,"Compra de ".nombre_apellido_usuario($ru['nvirtual']));
				
				mysqli_query($connection, "INSERT INTO puntos_por_dar (nvirtual,pierna,puntos,razon) VALUES ('$patrocinador','$pierna','$pordar','$razon')");
			}

			}else{
				log_binario($ru['patrocinador'],$pordar,"Compra de ".nombre_apellido_usuario($ru['nvirtual']));
				
				mysqli_query($connection, "INSERT INTO puntos_por_dar (nvirtual,pierna,puntos,razon) VALUES ('".$ru['patrocinador']."','$pierna','$pordar','$razon')");
			}

			$sdc2 = mysqli_query($connection, "SELECT * FROM calificados WHERE nvirtual = '$patrocinador'");
			$rdc2 = mysqli_fetch_array($sdc2);
			$pierna = $rdc2['lado'];

			

		}while($patrocinador!="administrador");

	}

	if($r['producto']==7){ // si es safip 3

		$saf =mysqli_query($connection, "SELECT * FROM afiliaciones WHERE id = 4");
	    $raf = mysqli_fetch_array($saf);
	    $pordar = $raf['comisionable'];

	     $pagober = $raf['precio'] * 0.18;

	    

	    mysqli_query($connection, "UPDATE billetera SET cant = cant + $pagober WHERE nvirtual = '".$ru['patrocinador']."'");
	    log_billetera($ru['patrocinador'],$pagober,"Bono de Efectivo Rápido de: ".nombre_apellido_usuario($ru['nvirtual']),1);
	    ber($ru['patrocinador'],$pagober);

	    // Verificacion si es gratuito para aplicar 3 meses de vencimiento.
$svag = mysqli_query($connection, "SELECT * FROM calificados WHERE nvirtual = '".$ru['patrocinador']."'");
$rvag = mysqli_fetch_array($svag);

if($rca['calificacion']==1){
	$sssany = mysqli_query($connection, "SELECT * FROM datosdeusuarios WHERE nvirtual = '".$rca['nvirtual']."'");
	$rrrany = mysqli_fetch_array($sssany);
	$epf = explode("-",$ru['fecharegistro']);
	$diany= $epf[2];
	$mesactuall = date("m");
	$anoactuall = date("Y");
	if($mesactuall==12){
		$mesactuall="01";
		$anoactuall++;
	}else{
		$mesactuall++;
		if(strlen($mesactuall)<2){
			$mesactuall = "0".$mesactuall;
		}
	}
	$nuevafechavencegratuito = $anoactuall."-".$mesactuall."-".$diany;
	mysqli_query($connection, "UPDATE datosdeusuarios SET vence = '$nuevafechavencegratuito' WHERE nvirtual = '".$ru['nvirtual']."'");
}

if($rvag['calificacion']==1){
$svag2 = mysqli_query($connection, "SELECT * FROM datosdeusuarios WHERE nvirtual = '".$ru['patrocinador']."'");
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

	mysqli_query($connection, "UPDATE datosdeusuarios SET vence = '$nuevafechavence' WHERE nvirtual = '".$ru['patrocinador']."'");

}
}

//


	    $patrocinador = $ru['nvirtual'];
	    $pierna = $rca['lado'];

	    $razon = "Compra Safip 3 de ".nombre_apellido_usuario($ru['nvirtual']);


	    mysqli_query($connection, "UPDATE calificados SET calificacion = 4 WHERE nvirtual = '".$ru['nvirtual']."'");


		 do{

			$sdc = mysqli_query($connection, "SELECT * FROM datosdeusuarios WHERE nvirtual = '$patrocinador'");
			$rdc = mysqli_fetch_array($sdc);

			$patrocinador = $rdc['patrocinador_binario'];

			if($patrocinador != $ru['patrocinador']){
			
			if(esta_activo($patrocinador) && esta_calificado($patrocinador)){
				log_binario($patrocinador,$pordar,"Compra de ".nombre_apellido_usuario($ru['nvirtual']));
				
				mysqli_query($connection, "INSERT INTO puntos_por_dar (nvirtual,pierna,puntos,razon) VALUES ('$patrocinador','$pierna','$pordar','$razon')");
			}

			}else{
				log_binario($ru['patrocinador'],$pordar,"Compra de ".nombre_apellido_usuario($ru['nvirtual']));
				
				mysqli_query($connection, "INSERT INTO puntos_por_dar (nvirtual,pierna,puntos,razon) VALUES ('".$ru['patrocinador']."','$pierna','$pordar','$razon')");
			}

			$sdc2 = mysqli_query($connection, "SELECT * FROM calificados WHERE nvirtual = '$patrocinador'");
			$rdc2 = mysqli_fetch_array($sdc2);
			$pierna = $rdc2['lado'];

			

		}while($patrocinador!="administrador");

	}



	if($r['producto']!=4 && $r['producto']!=5 && $r['producto']!=6 && $r['producto']!=7){

		$spro = mysqli_query($connection, "SELECT * FROM productos WHERE id = '".$r['producto']."'");
		$rpro = mysqli_fetch_array($spro);
		
		
		if($rpro['descuento']==1){
		
			$patrocinador_ganancia = $ru['patrocinador'];
			$sup = mysqli_query($connection, "SELECT * FROM calificados WHERE nvirtual = '$patrocinador_ganancia'");
			$rup = mysqli_fetch_array($sup);
			$calificacion_patrocinador = $rup['calificacion'];
			
			$sap = mysqli_query($connection, "SELECT * FROM afiliaciones WHERE id = '$calificacion_patrocinador'");
			$rap = mysqli_Fetch_array($sap);
			
			$ganancia_patrocinador = $rap['ganancia'];
			
			$ganancia_porcentaje = "0.".$ganancia_patrocinador;
			
			$ganancia_del_patrocinante = $precio * $ganancia_porcentaje;
			log_mer($patrocinador_ganancia,$ganancia_del_patrocinante);



			// Verificacion si es gratuito para aplicar 3 meses de vencimiento.
$svag = mysqli_query($connection, "SELECT * FROM calificados WHERE nvirtual = '".$patrocinador_ganancia."'");
$rvag = mysqli_fetch_array($svag);

if($rca['calificacion']==1){
	$sssany = mysqli_query($connection, "SELECT * FROM datosdeusuarios WHERE nvirtual = '".$rca['nvirtual']."'");
	$rrrany = mysqli_fetch_array($sssany);
	$epf = explode("-",$ru['fecharegistro']);
	$diany= $epf[2];
	$mesactuall = date("m");
	$anoactuall = date("Y");
	$nuevafechavencegratuito = $anoactuall."-".$mesactuall."-".$diany;
	mysqli_query($connection, "UPDATE datosdeusuarios SET vence = '$nuevafechavencegratuito' WHERE nvirtual = '".$ru['nvirtual']."'");
}

if($rvag['calificacion']==1){
$svag2 = mysqli_query($connection, "SELECT * FROM datosdeusuarios WHERE nvirtual = '".$patrocinador_ganancia."'");
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

	mysqli_query($connection, "UPDATE datosdeusuarios SET vence = '$nuevafechavence' WHERE nvirtual = '".$patrocinador_ganancia."'");

}
}

//




			//log_billetera($patrocinador_ganancia,$ganancia_del_patrocinante,"Bono de Mercadeo del usuario ".nombre_apellido_usuario($ru['nvirtual']),1);
			log_billetera($patrocinador_ganancia,$ganancia_del_patrocinante,"Bono de Mercadeo del usuario ".nombre_apellido_usuario($ru['nvirtual']),1);
			mysqli_query($connection, "UPDATE billetera SET cant = cant + $ganancia_del_patrocinante WHERE nvirtual = '$patrocinador_ganancia'");
			
			
			
			
			
			
			
			
			

			$sup2 = mysqli_query($connection, "SELECT * FROM calificados WHERE nvirtual = '".$rup['patrocinador']."'");
			$rup2 = mysqli_fetch_array($sup2);

			$calificacion_patrocinador2 = $rup2['calificacion'];
			
			$sap2 = mysqli_query($connection, "SELECT * FROM afiliaciones WHERE id = '$calificacion_patrocinador2'");
			$rap2 = mysqli_Fetch_array($sap2);
			
			$ganancia_patrocinador2 = $rap2['ganancia2'];
			
			$ganancia_porcentaje2 = "0.0".$ganancia_patrocinador2;
			
			$ganancia_del_patrocinante2 = $precio * $ganancia_porcentaje2;
			log_merr($rup2['nvirtual'],$ganancia_del_patrocinante2);
			log_billetera($rup2['nvirtual'],$ganancia_del_patrocinante2,"Bono de Mercadeo Residual del usuario ".nombre_apellido_usuario($ru['nvirtual']),1);


			// Verificacion si es gratuito para aplicar 3 meses de vencimiento.
$svag3 = mysqli_query($connection, "SELECT * FROM calificados WHERE nvirtual = '".$rup2['nvirtual']."'");
$rvag3 = mysqli_fetch_array($svag3);

if($rca['calificacion']==1){
	$sssany = mysqli_query($connection, "SELECT * FROM datosdeusuarios WHERE nvirtual = '".$rca['nvirtual']."'");
	$rrrany = mysqli_fetch_array($sssany);
	$epf = explode("-",$ru['fecharegistro']);
	$diany= $epf[2];
	$mesactuall = date("m");
	$anoactuall = date("Y");
	$nuevafechavencegratuito = $anoactuall."-".$mesactuall."-".$diany;
	mysqli_query($connection, "UPDATE datosdeusuarios SET vence = '$nuevafechavencegratuito' WHERE nvirtual = '".$ru['nvirtual']."'");
}

if($rvag3['calificacion']==1){
$svag4 = mysqli_query($connection, "SELECT * FROM datosdeusuarios WHERE nvirtual = '".$rup2['nvirtual']."'");
$rvag4 = mysqli_fetch_array($svag4);

$fecharegistro2 = $rvag4['fecharegistro'];
$ex2 = explode("-",$fecharegistro2);
$dia_svag2 = $ex2[2];
$mes_svag2 = $ex2[1];
$ano_svag2 = $ex2[0];

$ano_svag2++;

$vence_svag2 = $ano_svag2."-".$mes_svag2."-".$dia_svag2;

if($vence_svag2 == $rvag4['vence']){
	$dia_vg2 = $dia_svag2;
	$mesactual2 = date("m");
	$ano_vg2 = date("Y");

	if($mesactual2==10){
		$mes_vg2 = 1;
		$ano_vg2++;
	}
	if($mesactual2 == 11){
		$mes_vg2 = 2;
		$ano_vg2++;
	}
	if($mesactual2 == 12){
		$mes_vg2 = 3;
		$ano_vg2++;
	}
	if($mesactual2<10){
		$mes_vg2 = $mesactual2+3;
	}

	$nuevafechavence2 = $ano_vg2."-".$mes_vg2."-".$dia_vg2;

	mysqli_query($connection, "UPDATE datosdeusuarios SET vence = '$nuevafechavence2' WHERE nvirtual = '".$rup2['nvirtual']."'");

}
}

//




			mysqli_query($connection, "UPDATE billetera SET cant = cant + $ganancia_del_patrocinante2 WHERE nvirtual = '".$rup2['nvirtual']."'");
			// habilitar en caso de que siga dando el registro de 18.06
			
			
		
		
		}
		
		if($rpro['comisionable']>0){



		    $pordar = $rpro['comisionable'];

		    $pagober = $rpro['precio'] * 0.18;

		    

		    //mysqli_query($connection, "UPDATE billetera SET cant = cant + $pagober WHERE nvirtual = '".$ru['patrocinador']."'");
		    //log_billetera($ru['patrocinador'],$pagober,"Bono de Efectivo Rápido de: ".nombre_apellido_usuario($ru['nvirtual'])." ->".$rpro['precio'],1);
	   	    //ber($ru['patrocinador'],$pagober);


		    $patrocinador = $ru['nvirtual'];
		    $pierna = $rca['lado'];

		    $razon = "Compra de producto [".$rpro['producto']."] de ".nombre_apellido_usuario($ru['nvirtual']);


			 do{

				$sdc = mysqli_query($connection, "SELECT * FROM datosdeusuarios WHERE nvirtual = '$patrocinador'");
				$rdc = mysqli_fetch_array($sdc);

				$patrocinador = $rdc['patrocinador_binario'];

				if($patrocinador != $ru['patrocinador']){
				
				if(esta_activo($patrocinador) && esta_calificado($patrocinador)){
					
					log_binario($patrocinador,$pordar,"Compra de ".nombre_apellido_usuario($ru['nvirtual']));
					
					mysqli_query($connection, "INSERT INTO puntos_por_dar (nvirtual,pierna,puntos,razon) VALUES ('$patrocinador','$pierna','$pordar','$razon')");
				}

				}else{
					
					log_binario($ru['patrocinador'],$pordar,"Compra de ".nombre_apellido_usuario($ru['nvirtual']));
					
					mysqli_query($connection, "INSERT INTO puntos_por_dar (nvirtual,pierna,puntos,razon) VALUES ('".$ru['patrocinador']."','$pierna','$pordar','$razon')");
				}

				$sdc2 = mysqli_query($connection, "SELECT * FROM calificados WHERE nvirtual = '$patrocinador'");
				$rdc2 = mysqli_fetch_array($sdc2);
				$pierna = $rdc2['lado'];

				

			}while($patrocinador!="administrador");
		}
		
		mysqli_query($connection, "INSERT INTO inventario (producto,nvirtual,fecha,cant) VALUES ('".$r['producto']."','".$ru['nvirtual']."',NOW(),1)");
	}

}

$productosss = "";
$ssss = mysqli_query($connection, "SELECT * FROM productos_compra_espera WHERE id_compra_espera = '$compra'");
while($rrrr=mysqli_fetch_array($ssss)){
	$sspp = mysqli_query($connection, "SELECT * FROM productos WHERE id = '".$rrrr['producto']."'");
	$rrpp = mysqli_fetch_array($sspp);
	$productosss = $productosss." ".$rrpp['producto'];
}

$descripcion = "Compra: ".$productosss;

mysqli_query($connection, "INSERT INTO pagos (descripcion,nvirtual,monto,tipodepago,documento,fechacompra) VALUES ('$descripcion','".$rco['nvirtual']."','".$rco['monto']."','".$rco['tipo']."','".$rco['documento']."',NOW())");

$mensaje = "Su compra fue autorizada correctamente.";

notificar($r['nvirtual'],"Compra Autorizada",$mensaje);
mysqli_query($connection, "UPDATE compra_espera SET desautorizado = 2 WHERE id = '$compra'");
alert("Compra autorizada.");
redir("?p=compras_pendientes");

?>