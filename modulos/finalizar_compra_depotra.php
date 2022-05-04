<?php
if(isset($enviar)){
	$banco = clear($banco);
	$tipo = clear($tipo_pago);
	$documento = clear($numero_proceso);

	////////////////////////////////////////
$sca = mysqli_query($connection,"SELECT * FROM calificados WHERE nvirtual = '".$_SESSION['nvirtual']."'");
$rca = mysqli_fetch_array($sca);

$ssaaff = mysqli_query($connection,"SELECT * FROM afiliaciones WHERE id = '".$rca['calificacion']."'");
$rraaff = mysqli_fetch_array($ssaaff);
$descuento_raf = "0.".$rraaff['descuento'];

///////////////////////////////////////////

	$sc1 = mysqli_query($connection,"SELECT * FROM carrito WHERE nvirtual = '".$_SESSION['nvirtual']."'");
	$monto = 0;


	while($rc1=mysqli_fetch_array($sc1)){

		$sp = mysqli_query($connection,"SELECT * FROM productos WHERE id = '".$rc1['producto']."'");
		$rp = mysqli_fetch_array($sp);

		//////////////////////////////////////////////
		if($rp['descuento']==1 && esta_activo($_SESSION['nvirtual'])){
			$desc = $rp['precio'] * $descuento_raf;
			$preciot = $rp['precio'] * $rc1['cantidad'];
			$ttprecio = $preciot - $desc;
			$monto = $monto + $ttprecio;
		}else{
			$monto = $monto + ($rp['precio'] * $rc1['cantidad']);
		}

	}

////////////////////////////////////////////////////////////
//////////////////////// IVA ///////////////////////////////
////////////////////////////////////////////////////////////

	$ivaxd = "0.".$rp['iva'];
	$iva = $monto * $ivaxd;


	$monto = $monto + $iva;



	mysqli_query($connection,"INSERT INTO compra_espera (nvirtual,fecha,monto,tipo,documento) VALUES ('".$_SESSION['nvirtual']."',NOW(),'$monto','$tipo','$documento')");
	$s = mysqli_query($connection,"SELECT * FROM compra_espera WHERE nvirtual = '".$_SESSION['nvirtual']."' ORDER BY id DESC LIMIT 1");
	$r = mysqli_fetch_array($s);
	$id_compra = $r['id'];

	$sc = mysqli_query($connection,"SELECT * FROM carrito WHERE nvirtual = '".$_SESSION['nvirtual']."'");
	while($rc=mysqli_fetch_array($sc)){
	$sssppp = mysqli_query($connection,"SELECT * FROM productos WHERE id = '".$rc['producto']."'");
	$rrrppp = mysqli_fetch_array($sssppp);
	$articulos = $articulos.", ".$rrrppp['producto'];

	//echo "INSERT INTO productos_compra_espera (id_compra_espera,producto,cantidad) VALUES ('$id_compra','".$rc['producto']."','".$rc['cantidad']."')"; exit();

		mysqli_query($connection,"INSERT INTO productos_compra_espera (id_compra_espera,producto,cantidad) VALUES ('$id_compra','".$rc['producto']."','".$rc['cantidad']."')");
	}

	mysqli_query($connection,"INSERT INTO pago_compra_espera (id_compra_espera,banco,tipo,documento,fecha) VALUES ('$id_compra','$banco','$tipo','$documento',NOW())");

	mysqli_query($connection,"DELETE FROM carrito WHERE nvirtual = '".$_SESSION['nvirtual']."'");

	alert("Compra realizada, porfavor espera la aprobación del administrador");
	notificar("administrador","Datos de una nueva compra (".$_SESSION['nvirtual'].")","Compra Realizada del usuario ".nombre_apellido_usuario($_SESSION['nvirtual'])." Correo: ".correo($_SESSION['nvirtual'])." Articulos: ".$articulos." Monto: ".$monto."$");
	
	notificar($_SESSION['nvirtual'],"Datos de una nueva compra (".$_SESSION['nvirtual'].")","Compra Realizada del usuario ".nombre_apellido_usuario($_SESSION['nvirtual'])." Correo: ".correo($_SESSION['nvirtual'])." Articulos: ".$articulos." Monto: ".$monto."$");
	redir("./");
}
?>
<form method="post" action="">
<div class="content invoice">

<div class="box box-solid box-info">

<div class="box-header">
	<h3 class="box-title">Datos del pago efectuado</h3>
</div>

<div class="box-body">
<div class="form-group">
<select class="form-control" required name="banco">
<option value="">Seleccione el banco</option>
<?php
$s = mysqli_query($connection,"SELECT * FROM bancos");
while($r=mysqli_fetch_array($s)){
	?>
	<option value="<?=$r['id']?>"><?=$r['banco']?></option>
	<?php
}
?>
</select>
</div>
<div class="form-group">

<select required name="tipo_pago" class="form-control">
		<option>Seleccione Tipo Pago </option>
		<option value="Transferencia">Transferencia</option>
		<option value="Voucher">Voucher</option>
	</select>
<!-- <input type="radio" required name="tipo_pago" value="Transferencia"/> Numero de Transferencia &nbsp;
<input type="radio" required name="tipo_pago" value="Voucher"/> Numero de Voucher !-->

</div>
<div class="form-group">
<input required class="form-control" placeholder="Numero de Transferencia / Voucher" name="numero_proceso"/>
</div>
<div class="form-group" id="datos_banco" style="background:rgba(0,0,0,0.06);padding:10px;">
<i><a href="#" onclick="datos_banco();">Haga click para ver los datos bancarios</a></i>
</div>
<div class="form-group">
<input type="submit" name="enviar" class="btn btn-primary" value="Finalizar"/>
<buttom type="reset" name="cancelar" class="btn btn-danger" onclick='window.location="?p=finalizar_compra";'>Cancelar</buttom>
</div>

</div>

</div>

</div>
</form>