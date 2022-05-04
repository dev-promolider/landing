<?php
require "../config/conection.php";
?>
<br>
<select id="ttt" onchange="oculocul();" class="form-control" required name="banco">
<option value="">Seleccione el Metodo de Pago </option>
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
<br>
<section id="oculocul">
<input type="radio" required name="tipo_pago" value="1"/> Numero de Transferencia &nbsp;
<input type="radio" required name="tipo_pago" value="2"/> Numero de Voucher

<br><br>
<input required class="form-control" placeholder="Numero de Transferencia / Voucher" name="numero_proceso"/>
</section>

<script>
function oculocul(){
	if($("#ttt").val()==0 || $("#ttt").val()==14 || $("#ttt").val()==15){
		$("#oculocul").html('');
	}else{
		$("#oculocul").html('<input type="radio" required name="tipo_pago" value="1"/> Numero de Transferencia &nbsp; <input type="radio" required name="tipo_pago" value="2"/> Numero de Voucher <br><br> <input required class="form-control" placeholder="Numero de Transferencia / Voucher" name="numero_proceso"/>');
	}
}
</script>