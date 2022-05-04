<h3 style="background:black;color:#fff;padding:20px;border-radius:4px;"><i class="fa fa-clock-o"></i> Historial de retiros</h3><hr>
<form method="post" action="">
<div class="form-group">
<input data-toggle="tooltip" data-placement="top" title="Filtrar por fecha" type="date" class="form-control" name="busq" style="width:90%;display:inline-block;"/>
<input type="submit" class="btn btn-success" name="enviar" value="Buscar">
</div>
</form>
<hr>
<table class="table table-striped">
<tr>
	<th>Cantidad</th>
	<th>Fecha</th>
	<th>Estado</th>
</tr>
<?php
if(isset($enviar)){
	$busq = clear($busq);

	$s = mysqli_query($connection, "SELECT * FROM peticiones WHERE nvirtual = '".$_SESSION['nvirtual']."' AND fecha = '$busq'");
}else{

	$s = mysqli_query($connection, "SELECT * FROM peticiones WHERE nvirtual = '".$_SESSION['nvirtual']."'");
}
while($r=mysqli_fetch_array($s)){
	if($r['estado']==0){
		$estado = "No Revisado";
	}elseif($r['estado']==1){
		$estado = "<span style=color:green>Aprobado</span>";
	}else{
		$estado = "<span style=color:red>No Aprobado</span>";
	}
	?>
	<tr>
		<td>S/. <?=numero($r['cant'])?></td>
		<td><?=fecha_hora($r['fecha'])?></td>
		<td><?=$estado?></td>
	</tr>
	<?php
}
?>
</table>