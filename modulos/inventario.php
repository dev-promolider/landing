<h3><i class="fa fa-archive"></i> Inventario<hr>
<table class="table table-striped">
<tr>
<th>Producto</th>
<th>Fecha</th>
<th>Codigo</th>
</tr>
<?php
$s = mysqli_query($connection,"SELECT * FROM inventario WHERE nvirtual = '".$_SESSION['nvirtual']."'");
while($r=mysqli_fetch_array($s)){
	$sp = mysqli_query($connection,"SELECT * FROM productos WHERE id = '".$r['producto']."'");
	$rp = mysqli_fetch_array($sp);
	?>
	<tr>
		<td><?=$rp['producto']?></td>
		<td><?=fecha_hora($r['fecha'])?></td>
		<td><?=$r['codigo']?>
	</tr>
	<?php
}
?>
</table>