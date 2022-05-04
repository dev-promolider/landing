<?php
$s = mysqli_query($connection,"SELECT * FROM saldo_financiero WHERE nvirtual = '".$_SESSION['nvirtual']."'");
$r = mysqli_fetch_array($s);
?>
<div class="box box-solid box-primary">
<div class="box-header" style="background:#ffffff;">
	<h3> &nbsp; <b>$</b> Saldo financiero disponible</h3>
</div>
<div class="box-body">
<h1>
<?=numero($r['saldo'])?> $</h1>
</h1>
</div>
</div>
<hr>
<h3 style="background: white !important;"><i class="fa fa-clock-o"></i> Historial</h3>
<hr>
<form method="post" action="">
<div class="form-group">
<input data-toggle="tooltip" data-placement="top" title="Filtrar por fecha" type="date" class="form-control" name="busq" style="width:90%;display:inline-block;"/>
<input type="submit" class="btn btn-success" name="enviar" value="Buscar">
</div>
</form>
<hr>
<table class="table table-striped">
<tr>
	<th>Monto</th>
	<th>Tipo</th>
	<th>Fecha</th>
	<th>Razon</th>
</tr>
<?php
if(isset($enviar)){
	$busq = clear($busq);
$sf = mysqli_query($connection,"SELECT * FROM log_financiero WHERE nvirtual = '".$_SESSION['nvirtual']."' AND fecha = '$busq'");

}else{
$sf = mysqli_query($connection,"SELECT * FROM log_financiero WHERE nvirtual = '".$_SESSION['nvirtual']."'");

}
while($rf=mysqli_fetch_array($sf)){
	if($rf['tipo']==0){
		$tipo = "Debito";
	}else{
		$tipo = "Credito";
	}
	?>
	<tr>
		<td><?=numero($rf['monto'])?> $</td>
		<td><?=$tipo?></td>
		<td><?=fecha($rf['fecha'])?></td>
		<td><?=$rf['razon']?></td>
	</tr>
	<?php
}
?>
</table>