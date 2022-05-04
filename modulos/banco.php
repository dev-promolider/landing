<?php
check_admin();
if(isset($eliminar)){
	mysqli_query($connection,"DELETE FROM bancos WHERE id = '$eliminar'");
	alert("Banco eliminado.");
	redir("?p=banco");
}
?>
<h3>
	<i class="">S/.</i> Manejar Bancos
</h3>
<table class="table table-striped">
<tr>
	<th>Banco</th>
	<th>Numero de Cuenta</th>
	<th>Titular</th>
	<th><i class="fa fa-cog"></i> Acciones</th>
</tr>
<?php
$s = mysqli_query($connection,"SELECT * FROM bancos");
while($r=mysqli_fetch_array($s)){
	?>
	<tr>
		<td><?=$r['banco']?></td>
		<td><?=$r['cuenta']?></td>
		<td><?=$r['titular']?></td>
		<td><a onclick="eliminar_banco(<?=$r['id']?>);" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa fa-times"></i></a>
	</tr>
	<?php
}
?>
</table>
<br>
<a href="?p=agregar_banco"><button class="btn btn-primary">Agregar Banco</button></a>

<script>
function eliminar_banco(idb){
	var sino = window.confirm("¿Estas seguro de eliminar este banco?");
	if(sino==true){
		window.location="?p=banco&eliminar="+idb;
	}
}
</script>