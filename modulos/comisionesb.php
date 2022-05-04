

<h3 style="padding:20px;background: black;color:white;border-radius:4px;"><i class="fa fa-clock-o"></i> Historial de Comisiones Binarias</h3>
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
	<th>Puntos</th>
	<th>Fecha</th>
	<th>Razon</th>
</tr>
<?php
if(isset($enviar)){
$busq = clear($busq);
$sf = mysqli_query($connection,"SELECT * FROM log_binario WHERE nvirtual = '".$_SESSION['nvirtual']."' AND fecha = '$busq'");
}else{
	
$sf = mysqli_query($connection,"SELECT * FROM log_binario WHERE nvirtual = '".$_SESSION['nvirtual']."'");	
}
while($rf=mysqli_fetch_array($sf)){
	?>
	<tr>
		<td><?=$rf['monto']?></td>
		<td><?=fecha_hora($rf['fecha'])?></td>
		<td><?=utf8_encode($rf['razon'])?></td>
	</tr>
	<?php
}
?>
</table>