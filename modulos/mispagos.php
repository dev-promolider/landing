<h3 style="background:black;color:#fff;padding:20px;border-radius:4px;"><i class="">$</i> Mis Pagos</h3><hr>
<?php
$s = mysqli_query($connection,"SELECT * FROM pagos WHERE nvirtual = '".$_SESSION['nvirtual']."'");
?>
<table class="table table-striped">
<tr>
<th>Descripci&oacute;n</th>
<th>Monto</th>
<th>Tipo De Pago</th>
<th>Documento</th>
<th>Fecha</th>
</tr>
<?php
while($r=mysqli_fetch_array($s)){
	?>
	<tr>
	<td><?=$r['descripcion']?></td>
	<td><?=numero($r['monto'])?></td>
	<td><?=$r['tipodepago']?></td>
	<td><?=$r['documento']?></td>
	<td><?=fecha($r['fechacompra'])?></td>
	</tr>
	<?php
}
?>
</table>