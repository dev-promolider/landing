<?php
check_conectado();
check_admin();
?>
<table class="table table-striped">
<tr>
<th>Cliente</th>
<th>Fecha de compra</th>
<th>Banco</th>
<th>Documento</th>
<th>Tipo de pago</th>
<th>Monto</th>
<th>Acciones</th>
<?php
$s = mysqli_query($connection,"SELECT * FROM compra_espera WHERE desautorizado = 0 ORDER BY id DESC");
while($r=mysqli_fetch_array($s)){
	$sp = mysqli_query($connection,"SELECT * FROM pago_compra_espera WHERE id_compra_espera = '".$r['id']."'");
	$rp = mysqli_fetch_array($sp);
	$sb = mysqli_query($connection,"SELECT * FROM bancos WHERE id = '".$rp['banco']."'");
	$rb = mysqli_fetch_array($sb);
	$banco = $rb['banco'];
	?>
		<tr>
			<td><a href="#" onclick="ver_user_arbol('<?=$r['nvirtual']?>');"><?=nombre_apellido_usuario($r['nvirtual'])?></a></td>
			<td><?=fecha_hora($r['fecha'])?></td>
			<td><?=$banco?></td>
			<td><?=$rp['documento']?></td>
			<td><?=$rp['tipo']?></td>
			<td>S/ <?=number_format($r['monto'],2)?></td>
			<td>
			<a onclick="cargarproductos(<?=$r['id']?>);" href="#" data-toggle="modal" data-target="#compose-modal" title="Ver Compra"><i class="fa fa-eye"></i></a> &nbsp; 
			<a href="?p=autorizar_compra&compra=<?=$r['id']?>" ><i data-toggle="tooltip" data-placement="top" title="Autorizar" class="fa fa-check"></i></a> &nbsp;
			<a href="?p=desautorizar_compra&compra=<?=$r['id']?>"><i data-toggle="tooltip" data-placement="top" title="Desautorizar" class="fa fa-ban"></i></a>
			</td>
		</tr>
	<?php
}
?>
</tr>
</table>