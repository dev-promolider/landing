<?php
if(isset($si)){

$s = mysqli_query($connection,"SELECT * FROM datosdeusuarios");
while($r=mysqli_fetch_array($s)){

	$sc = mysqli_query($connection,"SELECT * FROM calificados WHERE nvirtual = '".$r['nvirtual']."'");
	$rc = mysqli_fetch_array($sc);

	$sa = mysqli_query($connection,"SELECT * FROM afiliaciones WHERE id = '".$rc['calificacion']."'");
	$ra = mysqli_fetch_array($sa);


	$porcentaje_pago_corte = "0.".$ra['porcentaje_pago_corte']."<br>";

	$vi = mysqli_query($connection,"SELECT * FROM puntos_por_dar WHERE nvirtual = '".$r['nvirtual']."' AND pierna = 1");
	$vd = mysqli_query($connection,"SELECT * FROM puntos_por_dar WHERE nvirtual = '".$r['nvirtual']."' AND pierna = 2");

	$ptsi=0;

	while($ri=mysqli_fetch_array($vi)){
		$ptsi = $ptsi + $ri['puntos'];
	}

	$ptsd=0;

	while($rd=mysqli_fetch_array($vd)){
		$ptsd = $ptsd + $rd['puntos'];
	}
	
	if($ptsi>0 && $ptsd>0){
	
	$suc = mysqli_query($connection,"SELECT * FROM ultimocorte WHERE nvirtual = '".$r['nvirtual']."'");
	if(mysqli_num_rows($suc)>0){
		$ruc = mysqli_fetch_array($suc);
		$ultimocorte = $ruc['cant'];
	}else{
		$ultimocorte = 0;
	}

	

	if($ptsi>$ptsd){
	
		$ptsip = $ptsi - $ultimocorte;

		$ladoinicio=1;
		$inicio_binario = $ptsi - $ptsd;

		$pago = $ptsd * $porcentaje_pago_corte;
		log_billetera($r['nvirtual'],$pago,"Pago del corte binario",1);
		mysqli_query($connection,"UPDATE billetera SET cant = cant + $pago WHERE nvirtual = '".$r['nvirtual']."'");

		$pago2 = $ptsip * 0.06;
		log_financiero($r['nvirtual'],$pago2,"Abono Saldo Financiero");
		mysqli_query($connection,"UPDATE saldo_financiero SET saldo = saldo + $pago2 WHERE nvirtual = '".$r['nvirtual']."'");
	}else{
		
		$ptsdp = $ptsd - $ultimocorte;
		
		$ladoinicio=2;
		$inicio_binario = $ptsd - $ptsi;

		$pago = $ptsi * $porcentaje_pago_corte;
		log_billetera($r['nvirtual'],$pago,"Pago del corte binario",1);
		mysqli_query($connection,"UPDATE billetera SET cant = cant + $pago WHERE nvirtual = '".$r['nvirtual']."'");

		$pago2 = $ptsdp * 0.06;
		log_financiero($r['nvirtual'],$pago2,"Abono Saldo Financiero");
		mysqli_query($connection,"UPDATE saldo_financiero SET saldo = saldo + $pago2 WHERE nvirtual = '".$r['nvirtual']."'");
	}
	
	$sasa = mysqli_query($connection,"SELECT * FROM ultimocorte WHERE nvirtual = '".$r['nvirtual']."'");
	if(mysqli_num_rows($sasa)>0){
		mysqli_query($connection,"UPDATE ultimocorte SET cant = '$inicio_binario' WHERE nvirtual = '".$r['nvirtual']."'");	
	}else{
		mysqli_query($connection,"INSERT INTO ultimocorte (nvirtual,cant) VALUES ('".$r['nvirtual']."','$inicio_binario')");
	}

	mysqli_query($connection,"DELETE FROM puntos_por_dar WHERE nvirtual = '".$r['nvirtual']."'");

	$razon = "Puntos de inicio binario";

	mysqli_query($connection,"INSERT INTO puntos_por_dar (nvirtual,puntos,pierna,razon) VALUES ('".$r['nvirtual']."','$inicio_binario','$ladoinicio','$razon')");
	log_binario($r['nvirtual'],$inicio_binario,$razon);
	}

}

	mysqli_query($connection,"UPDATE cont_ber SET monto = 0");
	mysqli_query($connection,"UPDATE log_mer SET cant = 0");
	mysqli_query($connection,"UPDATE log_merr SET cant = 0");

	alert("Corte realizado.");
	redir("./");
}

if(isset($no)){
	alert("Proceso cancelado.");
	redir("./");
}
?>
<form method="post" action="">
<center>
<h3>���Desea realizar el corte binario?</h3>
<input type="submit" class="btn btn-success" value="SI" name="si"/>
&nbsp;
<input type="submit" class="btn btn-danger" value="NO" name="no"/>
</center>
<br><br>
<h3><i class="fa fa-list"></i> Lista de Montos a transladar a billeteras</h3>
<br>
<table class="table table-striped">
<tr>
<th>Usuario</th>
<th>Volumen Izq.</th>
<th>Volumen Der.</th>
<th>Monto a Transladar</th>
<th>Saldo Financiero</th>
</tr>
<?php

	
$s = mysqli_query($connection,"SELECT * FROM datosdeusuarios");
while($r=mysqli_fetch_array($s)){
	
	//echo "SELECT * FROM calificados WHERE nvirtual = '".$r['nvirtual']."'";
	//echo '<br>';
	$sc = mysqli_query($connection,"SELECT * FROM calificados WHERE nvirtual = '".$r['nvirtual']."'");
	$rc = mysqli_fetch_array($sc);
	
	

	$sa = mysqli_query($connection,"SELECT * FROM afiliaciones WHERE id = '".$rc['calificacion']."'");
	$ra = mysqli_fetch_array($sa);


	$porcentaje_pago_corte = "0.".$ra['porcentaje_pago_corte']."<br>";

	$vi = mysqli_query($connection,"SELECT * FROM puntos_por_dar WHERE nvirtual = '".$r['nvirtual']."' AND pierna = 1");
	$vd = mysqli_query($connection,"SELECT * FROM puntos_por_dar WHERE nvirtual = '".$r['nvirtual']."' AND pierna = 2");

	$ptsi=0;

	while($ri=mysqli_fetch_array($vi)){
		$ptsi = $ptsi + $ri['puntos'];
	}

	$ptsd=0;

	while($rd=mysqli_fetch_array($vd)){
		$ptsd = $ptsd + $rd['puntos'];
	}
	
	

	$sulc = mysqli_query($connection,"SELECT * FROM ultimocorte WHERE nvirtual = '".$r['nvirtual']."'");
	$rulc = mysqli_fetch_array($sulc);
	
	$restar = $rulc['cant'];
	

	if($ptsi>$ptsd){

		$ladoinicio=1;
		$inicio_binario = $ptsi - $ptsd;

		$pago = $ptsd * $porcentaje_pago_corte;

		$pago2 = ($ptsi - $restar) * 0.06;
	}else{
		$ladoinicio=2;
		$inicio_binario = $ptsd - $ptsi;

		$pago = $ptsi * $porcentaje_pago_corte;

		$pago2 = ($ptsd - $restar) * 0.06;
	}
	
	if($ptsi>0 && $ptsd>0){
	
	?>
	<tr>
		<td><?=$r['nvirtual']?></td>
		<td><?=$ptsi?></td>
		<td><?=$ptsd?></td>
		<td><?=$pago?></td>
		<td><?=$pago2?></td>
	</tr>
	<?php
	}

}



?>
</table>