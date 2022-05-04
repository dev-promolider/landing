<?php
include "../config/conection.php";
check_conectado();
?>
<h3><i class="fa fa-sign-out"></i> Recargar Fondos</h3><hr>
<form method="post" action="">
<br>
<div class="form-group">
<input type="text" class="form-control" placeholder="Monto" required name="monto"/><br>
</div>
<select id="banco" onchange="verificar();" class="form-control" required name="banco">
<option value="">Seleccione el banco</option>
<?php
$s = mysqli_query($connection,"SELECT * FROM bancos");
while($r=mysqli_fetch_array($s)){
	?>
	<option value="<?=$r['id']?>"><?=$r['banco']?></option>
	<?php
}
?>
<option value="0">PayPal</option>
</select>
<section id="ocultito">
<br>
<input type="radio" required name="tipo_pago" value="Transferencia"/> Numero de Transferencia &nbsp;
<input type="radio" required name="tipo_pago" value="Voucher"/> Numero de Voucher
<br><br>
<input required class="form-control" placeholder="Numero de Transferencia / Voucher" name="numero_proceso"/>
</section><br>
<div class="form-group">
	<button type="submit" class="btn btn-success" name="recargar">Recargar Fondos</button>
</div>
</form>

<script type="text/javascript">
	function verificar(){
		var val = $("#banco").val();

		if(val==0 || val==14 || val==15){
			$("#ocultito").html('');
		}else{
			$("#ocultito").html('<br><input type="radio" required name="tipo_pago" value="Transferencia"/> Numero de Transferencia &nbsp;<input type="radio" required name="tipo_pago" value="Voucher"/> Numero de Voucher<br><br><input required class="form-control" placeholder="Numero de Transferencia / Voucher" name="numero_proceso"/>');
		}
	}
</script>