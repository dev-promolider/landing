<?php
check_conectado();
check_admin();
?>
<div class="table-responsive">
<table id="example1" class="table table-bordered table-striped">
<tr>
<th>Usuario</th>
<th>Nombre</th>
<th>Fecha</th>
<th>Tipo de Afiliacion</th>
<th>Acciones</th>
</tr>
<?php
$s = mysqli_query($connection, "SELECT * FROM por_afiliar ORDER BY id ASC");
while($r=mysqli_fetch_array($s)){
	$su = mysqli_query($connection, "SELECT * FROM datosdeusuarios WHERE nvirtual = '".$r['nvirtual']."'");
	$ru = mysqli_fetch_array($su);
	$sa = mysqli_query($connection, "SELECT * FROM afiliaciones WHERE id = '".$r['tipo']."'");
	$ra = mysqli_fetch_array($sa);

	$sp = mysqli_query($connection, "SELECT * FROM pagos WHERE nvirtual = '".$r['nvirtual']."' AND descripcion = 'Afiliación'");
	$rp = mysqli_fetch_array($sp);
	$idpago = $rp['id'];
	?>
	<tr>
		<td><a href="#" onclick="ver_user_arbol('<?=$r['nvirtual']?>');"><?=$r['nvirtual']?></td>
		<td><?=$ru['campo_primer_nombre']?> <?=$ru['campo_primer_apellido']?></td>
		<td><?=fecha($r['fecha'])?></td>
		<td><?=$ra['nombre']?></td>
		<td>
			<a href="#" onclick="verpago(<?=$rp['id']?>);" data-toggle="tooltip" data-placement="top" title="Ver Pago"><i class="fa fa-eye"></i></a> &nbsp; 
			<a href="?p=autorizar_afiliacion&afiliacion=<?=$r['id']?>" ><i data-toggle="tooltip" data-placement="top" title="Autorizar" class="fa fa-check"></i></a> &nbsp;
			<a href="?p=desautorizar_afiliacion&afiliacion=<?=$r['id']?>"><i data-toggle="tooltip" data-placement="top" title="Desautorizar" class="fa fa-ban"></i></a>
		</td>
	</tr>
	<?php
}
?>

</table>
</div>