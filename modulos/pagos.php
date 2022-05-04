<?php
check_conectado();
check_admin();

if(!isset($pag)){
	$pag=1;
}
$pv = $pag;

$pag--;

if($pag!=0){
	$pag = $pag * 10;
}

$sptotal = mysqli_query($connection,"SELECT * FROM pagos");

$s = mysqli_query($connection,"SELECT * FROM pagos ORDER BY id DESC LIMIT $pag,10");

$total = mysqli_num_rows($sptotal) / 10;

?>
<table id="example1" class="table table-bordered table-striped">
<tr>
<th>Nombre</th>
<th>Usuario</th>
<th>Descripción</th>
<th>Monto</th>
<th>Banco</th>
<th>Tipo</th>
<th>Numero de Pago</th>
<th>Fecha Compra</th>

</tr>
<?php
while($r=mysqli_fetch_array($s)){
	?>
	<tr>
	<td><?=nombre_apellido_usuario($r['nvirtual'])?></td>
	<td><?=$r['nvirtual']?></td>
	<td><?=$r['descripcion']?></td>
	<td><?=$r['monto']?></td>
	<td><?=$r['banco']?></td>
	<td><?=$r['tipodepago']?></td>
	<td><?=$r['documento']?></td>
	<td><?=fecha($r['fechacompra'])?></td>
	</tr>
	<?php
}
?>
</table>
<style type="text/css">
	#btn{
		background: #fff;
		padding:3px;
		border:1px solid #07a;
	}
	#btn:hover{
		background: #07a;
		color:#fff;
	}
	.activado{
		background: #07a;
		color:#fff;
	}
</style>
<center>
<?php
if(isset($pag)){
	if($pv==1){
		$pagmenos=1;
	}else{
		$pagmenos = $pv-1;
	}

	if($pv<$total){
		$pagsig = $pv+1;
	}else{
		$pagsig=$total;
	}
}
?>
<nav>
<ul class="pagination pagination-sm">
<li>
<a href="?p=pagos&pag=<?=$pagmenos?>" arial-label="Anterior">
<span arial-hidden="true">&laquo;</span>
</a>

<?php

for($a=1;$a<=$total;$a++){
	?>
		<li  <?php if($pv==$a){ ?> class="active"	<?php } ?>>
			<a href='?p=pagos&pag=<?=$a?>'><?=$a?> </a>
		  </li>
	<?php
}
?>
<li>
<a href="?p=pagos&pag=<?=$pagsig?>" arial-label="Siguiente">
<span arial-hidden="true">&raquo;</span>
</a>
</li>
</ul>
</nav>
</center>